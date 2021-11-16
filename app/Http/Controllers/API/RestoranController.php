<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Restoran;
use Illuminate\Http\Request;
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

        $menu      = new Menu();

        $menu->resto_id       = $resto->id;
        $menu->nama_menu      = $request->nama_menu;
        $menu->harga          = $request->harga;
        $menu->nama_kategori  = $request->nama_kategori;
        $menu->save();

        return response()->json([
            'status'   => 1,
            'pesan'    => "Menu Berhasil Ditambahkan!",
            'data'     => $resto ,$menu
        ],Response::HTTP_OK);
    }
}