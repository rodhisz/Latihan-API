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

        // return dd($response);

        return view('Api.dataLoginApi' , compact('response'));
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

        return view('Api.dataLoginApi' , compact('response'));
    }

    public function editApi($user_id)
    {
        $response = Http::get('https://latihan-api-rsz.herokuapp.com/api/getuser/' . $user_id)->json();
        return view('Api.edit', compact('response'));
    }

    public function editUserApi(Request $request, $user_id)
    {
        $response = Http::put('https://latihan-api-rsz.herokuapp.com/api/edit/' . $user_id, $request->input())->json();

        if($response['status'] == 0){
            return view('Api.edit',compact('response'));
        };

        return view('Api.dataLoginApi' , compact('response'));
    }


}
