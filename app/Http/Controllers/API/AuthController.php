<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\FuncCall;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    //Cara 1 (pesan error satu satu)
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
            'password'  => Hash::make($request->password),
            'alamat'    => $request->alamat,
            'telp'      => $request->telp
        ]);

        return response()->json([
            'status'   => 1,
            'pesan'    => "Halo $request->name Registrasi Anda Berhasil!",
            'data'     => $user
        ],Response::HTTP_OK);
    }

    //Cara 2 (pesan error untuk semuanya)
    public function daftar(Request $request)
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

        $request->validate([
            'name'      => 'required',
            'email'     => 'required|unique:users|email',
            'password'  => 'required|min:4|confirmed',
        ], $pesan);

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

    public function login(Request $request){
        $pesan = [
            'email.required'        => "Email Tidak Boleh Kosong",
            'password.required'     => "Password Tidak Boleh Kosong",
        ];

        $validasi = Validator::make($request->all(),[
            'email'     => 'required',
            'password'  => 'required',
        ], $pesan);

        if($validasi->fails()){
            $val = $validasi->errors()->all();
            return $this -> responError(0, $val[0]);
        }

        $user = User::where('email', $request->email)->first();

        //cek dua duanya
        if(!$user || !Hash::check($request->password, $user->password)){
            return $this -> responError(0, "Email atau Password Salah!");
        }

        //cek HANYA email
        // if(!$user){
        //     return $this -> responError(0, "Email tidak terdaftar!");
        // }

        //cek HANYA password
        // if(!Hash::check($request->password, $user->password)){
        //     return $this -> responError(0, "Password Salah!");
        // }

        return response()->json([
            'status'   => 1,
            'pesan'    => "Halo $user->name, Selamat Datang!",
            'data'     => $user
        ],Response::HTTP_OK);
    }

    public function editProfile(Request $request, $user_id)
    {
        $user = User::where('id', $user_id)->first();

        if(!$user){
            return $this->responError(0, "User Tidak Ditemukan");
        }

        $validasi = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required',
            'alamat'    => 'required',
            'telp'      => 'required',
        ]);

        if($validasi->fails()){
            $val = $validasi->errors()->all();
            return $this->responError(0, $val[0]);
        }

        $user->update([
            'name'      =>  $request->name,
            'email'     =>  $request->email,
            'alamat'    =>  $request->alamat,
            'telp'      =>  $request->telp,
            'photo'     =>  $request->photo
        ]);

        return response()->json([
            'status'   => 1,
            'pesan'    => "Data Kamu Berhasil diupdate!",
            'data'     => $user
        ],Response::HTTP_OK);
    }

    public function editPassword(Request $request, $id)
    {
        $user = User::where('id', $id)->first();

        if(!$user){
            return $this->responError(0, "User Tidak Ditemukan");
        }

        if((!Hash::check($request->password, $user->password))) {
            return $this->responError(0, "Password Salah");
        }

        if(strcmp($request->get('password'), $request->get('new_password')) == 0) {
            return response() -> json([
                'status' => 0,
                'pesan'  => "Password Tidak Boleh Sama"
            ], 400);
        }

        $validasi = Validator::make($request->all(),[
            'password'      => 'required',
            'new_password'  => 'required|confirmed'
        ]);

        if($validasi->fails()){
            $val = $validasi->errors()->all();
            return $this->responError(0, $val[0]);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'status'   => 1,
            'pesan'    => "Password Kamu Berhasil Diedit",
            'data'     => $user
        ],Response::HTTP_OK);
    }

    public function getUser($user_id)
    {
        $user = User::where('id', $user_id)->first();

        return response()->json([
            'status'    => 1,
            'message'   => "Berhasil Mendapatkan User",
            'result'    => $user
        ], Response::HTTP_NOT_FOUND);
    }

    public function getAllUser()
    {
        $user = User::all();

        return response()->json([
            'status'    => 1,
            'message'   => "Berhasil Mendapatkan Semua Data User",
            'result'    => $user
        ], Response::HTTP_NOT_FOUND);

    }

    public function responError($sts, $pesan)
    {
        return response()->json([
            'status'    => $sts,
            'message'   => $pesan
        ], Response::HTTP_UNAUTHORIZED);
    }
}
