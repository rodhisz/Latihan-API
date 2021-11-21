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
        return view('Public.doa', compact('response'));
    }
}
