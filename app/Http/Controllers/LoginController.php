<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // retun login view.
    public function index(Request $request)
    {
        return view('login');
    }

    /**
     * @var phone_number
     * @var password
     */
    public function signin(Request $request)
    {
        try {
            $validator = \Validator::make($request->all(), [
                'phone_number'  => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'digits:10'],
                'captcha_input' => ['required'],
                'password'      => ['required']
            ]);

            if ($validator->passes()) {
                $requestData = $request->all();
                $userData =  User::where('phone_number', $requestData['phone_number'])
                    ->first();

                if (!empty($userData)) {
                    if ($userData->role === 'Admin') {
                        if (Hash::check($requestData['password'], $userData->password)) {
                            if (!$token = Auth::loginUsingId($userData->id)) {
                                return response()->json(['status' => false, 'error' => 'Incorrect credentials']);
                            }
                        } else {
                            return response()->json(['status' => false, 'error' => 'Incorrect credentials']);
                        }
                        return response()->json(['status' => true, 'token' => $token]);
                    }
                    return response()->json(['status' => false, 'error' => 'Unauthorised person']);
                } else {
                    return response()->json(['status' => false, 'error' => 'User not found']);
                }
            } else {
                return response()->json(['status' => false, 'error' => $validator->errors()->all()]);
            }
        } catch (\Exception $ex) {
            print_r($ex->getMessage());
        }
    }

    function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
