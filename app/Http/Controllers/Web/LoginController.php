<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function postData()
    {
        return view('ICT.post-data');
    }

    public function posting(Request $request)
    {
        // dd($request);
        Http::post('https://ictjuara.000webhostapp.com/api/regis', $request->input());
        return redirect()->back();
    }

    public function kategori(Request $request)
    {
        return view('ICT.kategori');
    }

    public function addKategori(Request $request)
    {
        // dd($request);
        Http::post('https://ictjuara.000webhostapp.com/api/add-kategori', $request->input());
        return redirect()->back();
    }

    public function login()
    {
        $response['status'] = 1;
        return view('ICT.login', compact('response'));
    }

    public function dataLogin(Request $request)
    {
        $response = Http::post('https://ictjuara.000webhostapp.com/api/login', $request->input())->json();

        if($response['status'] == 0){
            return view('ICT.login',compact('response'));
        };

        return view('ICT.dataLogin' , compact('response'));
    }
}
