<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DoaController extends Controller
{
    public function doa()
    {
        $response = Http::get('https://doa-doa-api-ahmadramadhan.fly.dev/api')->json();
        // dd($response);
        return view('doa', compact('response'));
    }

    public function postData()
    {
        return view('post-data');
    }

    public function posting(Request $request)
    {
        // dd($request);
        Http::post('https://ictjuara.000webhostapp.com/api/regis', $request->input());
        return redirect()->route('doa');
    }

    public function kategori(Request $request)
    {
        return view('kategori');
    }

    public function addKategori(Request $request)
    {
        // dd($request);
        Http::post('https://ictjuara.000webhostapp.com/api/add-kategori', $request->input());
        return redirect()->route('doa');
    }
}
