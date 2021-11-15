<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function registrasi(Request $request)
    {
        $pesan = [
            'name.required'         => "Nama Tidak Boleh Kosong",
            'email.required'        => "Email Tidak Boleh Kosong",
            'email.unique'          => "Email Telah Terdaftar",
            'email.email'           => "Email Tidak Valid",
            'password.required'     => "Password Tidak Boleh Kosong",
            'password.min'          => "Password Tidak Boleh Kurang Dari 4",
            'password.confirmed'    => "Password Tidak Cocok",
        ];

        $validasi = Validator::make($request->all(),[
            'name'      => 'required',
            'email'     => 'required|unique:users|email',
            'password'  => 'required|min:4|confirmed',
        ], $pesan);

        if($validasi->fails()){
            $val = $validasi->errors()->all();
            return $this -> responError(0, $val[0]);
        }

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password)
        ]);

        return response()->json([
            'status'   => 1,
            'pesan'    => "Halo $request->name Registrasi Anda Berhasil!",
            'data'     => $user
        ],Response::HTTP_OK);
    }

    public function responError($sts, $pesan)
    {
        return response()->json([
            'status'    => $sts,
            'message'   => $pesan
        ], Response::HTTP_OK);
    }
}
