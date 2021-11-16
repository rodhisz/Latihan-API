<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function login()
    {
        $response['status'] = 1;
        return view('login', compact('response'));
    }

    public function dataLogin(Request $request)
    {
        $response = Http::post('https://ictjuara.000webhostapp.com/api/login', $request->input())->json();

        if($response['status'] == 0){
            return view('login',compact('response'));
        };

        return view('dataLogin' , compact('response'));
    }
}
