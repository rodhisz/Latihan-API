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

        //Tambah menu satu satu
        // $menu      = new Menu();

        // $menu->resto_id       = $resto->id;
        // $menu->nama_menu      = $request->nama_menu;
        // $menu->harga          = $request->harga;
        // $menu->nama_kategori  = $request->nama_kategori;
        // $menu->save();

        //Tambah menu langsung banyak
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
            'Menu'     => $data
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
            'nama_resto' => 'required',
            'alamat'     => 'required',
            'telp'       => 'required',
            'jam_buka'   => 'required',
        ]);

        if($validasi->fails()){
            $val = $validasi->errors()->all();
            return $this->responError(0, $val[0]);
        }

        $resto->update([
            'nama_resto' =>  $request->nama_resto,
            'alamat'     =>  $request->alamat,
            'telp'       =>  $request->telp,
            'jam_buka'   =>  $request->jam_buka
        ]);

        return response()->json([
            'status'   => 1,
            'pesan'    => "Data Resto Kamu Berhasil Diupdate",
            'data'     => $resto
        ],Response::HTTP_OK);
    }

    public function searchMenu(Request $request)
    {
        $keyword = $request->search;

        //Jika menu tidak ada
        $menuempty =  Menu::where('nama_menu','like',"%". $keyword . "%")->orWhere('nama_kategori','like',"%". $keyword . "%")->first();

        if(!$menuempty) {
            return $this->responError(0, "Hasil Pencarian '$keyword' Tidak ada");
        }

        //Jika menu ada
        $menu =  Menu::where('nama_menu','like',"%". $keyword . "%")->orWhere('nama_kategori','like',"%". $keyword . "%")->get();

        return response()->json([
            'status'   => 1,
            'pesan'     => "Hasil Pencarian '$keyword'",
            'result'     => $menu
        ],Response::HTTP_OK);
    }

    public function deleteMenu($resto_id, $menu_id)
    {
        $resto = Restoran::findOrFail($resto_id)->first();

        if(!$resto){
            return $this->responError(0, "Resto ID Tidak Ditemukan");
        }

        $menu = Menu::findOrFail($menu_id);

        if(!$menu){
            return $this->responError(0, "Menu ID Tidak Ditemukan");
        }

        $menu->delete();

        return response()->json([
            'status'   => 1,
            'pesan'    => "'$menu->nama_menu' Berhasil Dihapus dari $resto->nama_resto",
        ],Response::HTTP_OK);
    }

    public function createMenu(Request $request, $resto_id)
    {
        $resto = Restoran::find($resto_id);

        if(!$resto){
            return $this->responError(0, "Resto ID Tidak Ditemukan");
        }

        $request-> validate([
            'nama_menu'     => 'required',
            'harga'         => 'required',
            'nama_kategori' => 'required',
        ]);

        $menu = new Menu();

        $menu->resto_id      = $resto->id;
        $menu->nama_menu     = $request->nama_menu;
        $menu->harga         = $request->harga;
        $menu->nama_kategori = $request->nama_kategori;
        $menu->save();

        return response()->json([
            'status'   => 1,
            'pesan'    => "Berhasil menambahkan menu '$menu->nama_menu' ke $resto->nama_resto",
            'result'   => $menu
        ],Response::HTTP_OK);
    }

    public function editMenu(Request $request, $resto_id, $menu_id)
    {
        $resto = Restoran::find($resto_id);

        if(!$resto){
            return $this->responError(0, "Resto ID Tidak Ditemukan");
        }

        $menu = Menu::find($menu_id);

        if(!$menu){
            return $this->responError(0, "Menu ID Tidak Ditemukan");
        }

        $request-> validate([
            'nama_menu'     => 'required',
            'harga'         => 'required',
            'nama_kategori' => 'required',
        ]);

        $menu->update([
            'nama_menu'     =>  $request->nama_menu,
            'harga'         =>  $request->harga,
            'nama_kategori' =>  $request->nama_kategori,
        ]);

        return response()->json([
            'status'   => 1,
            'pesan'    => "Berhasil Merubah Data Menu '$request->nama_menu' dari $resto->nama_resto",
            'data'     => $menu
        ],Response::HTTP_OK);
    }

    public function updateRestoMenu(Request $request, $resto_id)
    {
        $resto = Restoran::find($resto_id);

        if(!$resto){
            return $this->responError(0, "Resto ID Tidak Ditemukan");
        }

        $request-> validate([
            'nama_resto' => 'required',
            'alamat'     => 'required',
            'telp'       => 'required',
            'jam_buka'   => 'required',
        ]);

        $resto->update([
            'nama_resto' =>  $request->nama_resto,
            'alamat'     =>  $request->alamat,
            'telp'       =>  $request->telp,
            'jam_buka'   =>  $request->jam_buka,
            'rating'     =>  $request->rating
        ]);

        Menu::where('resto_id', $resto->id)->delete();

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
            'pesan'    => "Menu Upadete Menu Baru di $resto->nama_resto!",
            'Resto'    => $resto,
            'Menu'     => $data
        ],Response::HTTP_OK);

    }

    public function getAllResto()
    {
        $resto = Restoran::all();

        return response()->json([
            'status'    => 1,
            'message'   => "Berhasil Mendapatkan Semua Resto",
            'result'    => $resto
        ], Response::HTTP_NOT_FOUND);

    }

    public function responError($sts, $pesan)
    {
        return response()->json([
            'status'    => $sts,
            'message'   => $pesan
        ], Response::HTTP_NOT_FOUND);
    }
}
