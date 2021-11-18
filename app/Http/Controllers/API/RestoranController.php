<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Restoran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class RestoranController extends Controller
{
    public function createRestoMenu(Request $request)
    {
        $resto      = new Restoran();

        $pesan = [
            'nama_resto.required'   =>'Nama tidak boleh kosong',
            'alamat.required'       =>'Alamat tidak boleh kosong',
            'telp.required'         =>'Telp tidak boleh kosong',
            'jam_buka.required'     =>'Jam Buka tidak boleh kosong',
        ];

        $request-> validate([
            'nama_resto' => 'required',
            'alamat'     => 'required',
            'telp'       => 'required',
            'jam_buka'   => 'required',
        ],$pesan);

        $resto->nama_resto = $request->nama_resto;
        $resto->alamat     = $request->alamat;
        $resto->telp       = $request->telp;
        $resto->jam_buka   = $request->jam_buka;
        $resto->rating     = $request->rating;
        $resto->save();

        // $menu      = new Menu();

        // $menu->resto_id       = $resto->id;
        // $menu->nama_menu      = $request->nama_menu;
        // $menu->harga          = $request->harga;
        // $menu->nama_kategori  = $request->nama_kategori;
        // $menu->save();

        foreach($request->list_menu as $value)
        {
            $menu = array(
                'resto_id'      => $resto->id,
                'nama_menu'     => $value['nama_menu'],
                'harga'         => $value['harga'],
                'nama_kategori' => $value['nama_kategori'],
            );
            Menu::create($menu);
        }

        $data = Menu::where('resto_id', $resto->id)->get();

        return response()->json([
            'status'   => 1,
            'pesan'    => "Menu Berhasil Ditambahkan!",
            'Resto'    => $resto,
            'Data'     => $data
        ],Response::HTTP_OK);
    }

    public function getRestoMenu($id)
    {
        $resto = Restoran::where('id', $id)->first();

        if(!$resto){
            return $this->responError(0, "Data Restoran Tidak Ada");
        }

        $data = Menu::where('resto_id', $id)->get();

        return response()->json([
            'status'   => 1,
            'pesan'    => "Menu Berhasil Ditambahkan!",
            'Resto'     => $resto,
            'Menu'     => $data
        ],Response::HTTP_OK);
    }

    public function getAllMenu()
    {
        $menu = Menu::all();

        return response()->json([
            'status'    => 1,
            'message'   => "Berhasil Mendapatkan Semua Menu",
            'result'    => $menu
        ], Response::HTTP_NOT_FOUND);

    }

    public function editResto(Request $request, $id)
    {
        $resto = Restoran::where('id', $id)->first();

        if(!$resto){
            return $this->responError(0, "Resto Tidak Ditemukan");
        }

        $validasi = Validator::make($request->all(), [
            'nama_resto'      => 'required',
            'email'     => 'required',
            'alamat'    => 'required',
            'telp'      => 'required',
        ]);

        if($validasi->fails()){
            $val = $validasi->errors()->all();
            return $this->responError(0, $val[0]);
        }

        $resto->update([
            'name'      =>  $request->name,
            'email'     =>  $request->email,
            'alamat'    =>  $request->alamat,
            'telp'      =>  $request->telp,
            'photo'     =>  $request->photo
        ]);

        return response()->json([
            'status'   => 1,
            'pesan'    => "Data Kamu Berhasil Diupdate",
            'data'     => $resto
        ],Response::HTTP_OK);
    }

    public function responError($sts, $pesan)
    {
        return response()->json([
            'status'    => $sts,
            'message'   => $pesan
        ], Response::HTTP_NOT_FOUND);
    }
}
