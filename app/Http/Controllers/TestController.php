<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    function index(Request $request){
        // Multilingual Purpose
        $extraSettings['header'] = ['NAME','PHONE_NUMBER', 'CITY','ACTION'];

        $extraSettings['action_buttons'] = [
            'name'  => 'BTN_SHOW',
           // ''
        ];
    }
}
