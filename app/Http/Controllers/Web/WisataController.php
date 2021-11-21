<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WisataController extends Controller
{
    public function wisata()
    {
        $response = Http::get('https://ictjuara.000webhostapp.com/api/wisata')->json();
        // dd($response);
        $response = $response['data'];
        return view('ICT.wisata', compact('response'));
    }
}
