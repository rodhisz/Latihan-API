<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function myApi()
    {
        return view('Api.myApi');
    }

    public function registerApi()
    {
        $response['status'] = 1;
        return view('Api.register', compact('response'));
    }

    public function daftarApi(Request $request)
    {
        $response = Http::post('https://latihan-api-rsz.herokuapp.com/api/register', $request->input())->json();

        $data = $response['data'];

        if($data['status'] == 0){
            return view('Api.register',compact('response'));
        };

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


}
