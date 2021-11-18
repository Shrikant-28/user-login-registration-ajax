<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index(Request $request){
        return view('dashboard.home');
    }

    function ShowRegisterUserList(Request $request){
        try {
            $data = User::all()->where('role','=','User');
            return view('dashboard.register-user.index',compact('data'));
        } catch (\Exception $ex) {
            print_r($ex->getMessage());
        }
    }
}
