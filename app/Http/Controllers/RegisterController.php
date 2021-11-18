<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{

    public function index()
    {
        //dd(auth()->user());
        return view('register');
    }

    public function store(Request $request)
    {
        if (empty($request->checkRequest)) {
            $validator = \Validator::make($request->all(), [
                'name'  => ['required', 'max:50'],
                'phone_number'  => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'digits:10', 'unique:users,phone_number,' . $request->phone_number],
                'agree_to_tc'   => ['required'],
                'captcha_input' => ['required'],
                // 'captcha_input' => ['required', 'required_with:captcha', 'same:captcha'],
                // 'captcha'       => ['required'],
            ]);

            if ($validator->passes()) {
                // Here I generate random number as password and Send to Register mobile nummber
                $password = mt_rand(1000, 9999);

                $user = User::create([
                    'name'                  => $request->name,
                    'phone_number'          => $request->phone_number,
                    'gender'                => $request->gender,
                    'city'                  => $request->city,
                    'signup_for_letters'    => $request->signup_for_letters == "on" ? 1 : 0,
                    'agree_to_tc'           => $request->agree_to_tc == "on" ? 1 : 0,
                    'password'              => bcrypt(1234567),
                    'role'                  => 'User'
                ]);

                self::sendNotification($request->phone_number);

                return response()->json(['status' => true, 'user_id' => $user->id]);
            } else {
                return response()->json(['status' => false, 'error' => $validator->errors()->all()]);
            }
        } else {
            return response()->json(['status' => false, 'error' => 'Something went wrong']);
        }
    }

    static function sendNotification($mobile_number, $exstraSettings = [])
    {
        // Send Notification to register user.
    }
}
