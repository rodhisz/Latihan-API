<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{

    public function registerApi()
    {
        $response['status'] = 1;
        return view('Api.register', compact('response'));
    }

    public function daftarApi(Request $request)
    {
        $response = Http::post('https://latihan-api-rsz.herokuapp.com/api/registrasi', $request->input())->json();

        if($response['status'] == 0){
            return view('Api.register',compact('response'));
        };

        return view('Api.Login' , compact('response'));
    }

    public function loginApi()
    {
        $response['status'] = 1;
        return view('Api.login', compact('response'));
    }

    public function masukApi(Request $request)
    {
        $response = Http::post('https://latihan-api-rsz.herokuapp.com/api/login', $request->input())->json();

        if($response['status'] == 0){
            return view('Api.login',compact('response'));
        };

        // $this->authenticate($request);

        return view('Api.dataLoginApi' , compact('response'));
    }

    public function editApi($user_id)
    {
        $response = Http::get('https://latihan-api-rsz.herokuapp.com/api/edit/' . $user_id)->json();
        return view('Api.edit', compact('response'));
    }

    public function editUserApi(Request $request, $user_id)
    {
        // $url = (env('APP_ENV') == 'local') ? env('APP_URL') . ":8000/api/edit/" . $id : env('APP_URL') . "/api/edit/" . $id;

        // $response = Http::post($url . $id, $request->input())->json();

        $response = Http::post('https://latihan-api-rsz.herokuapp.com/api/edit/' . $user_id, $request->input())->json();

        if($response['status'] == 0){
            return view('Api.login',compact('response'));
        };

        return view('Api.login' , compact('response'));
    }

    // public function authenticate(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'email' => ['required', 'email'],
    //         'password' => ['required'],
    //     ]);

    //     if (Auth::attempt($credentials)) {
    //         $request->session()->regenerate();

    //         return redirect()->back();
    //     }

    //     return back()->withErrors([
    //         'email' => 'The provided credentials do not match our records.',
    //     ]);
    // }


}
