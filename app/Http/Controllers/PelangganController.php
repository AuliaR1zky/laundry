<?php

namespace App\Http\Controllers;

use App\Pelanggan;
use JWTAuth;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PelangganController extends Controller
{
    public function store(Request $req)
    {
        if(Auth::user()->level=="admin"){
        $validator=Validator::make($req->all(),
        [
            'nama'=>'required',
            'alamat'=>'required',
            'telp'=>'required'
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $simpan=pelanggan::create([
            'nama'=>$req->nama,
            'alamat'=>$req->alamat,
            'telp'=>$req->telp
        ]);
        if($simpan){
            return Response()->json(['status'=>1]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
}

    public function update($id, Request $req)
    {
        if(Auth::user()->level=="admin"){
        $validator=Validator::make($req->all(),
        [
            'nama'=>'required',
            'alamat'=>'required',
            'telp'=>'required'
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $ubah=pelanggan::where('id', $id)->update([
            'nama'=>$req->nama,
            'alamat'=>$req->alamat,
            'telp'=>$req->telp
        ]);
        if($ubah){
            return Response()->json(['status'=>1]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
}

    public function hapus($id){
        if(Auth::user()->level=="admin"){
        $hapus=pelanggan::where('id', $id)->delete();
        if($hapus){
            return Response()->json(['status'=>1]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
}
    public function tampil(){
        if(Auth::user()->level=="admin"){
      $data_pelanggan = pelanggan::get();
      $count = $data_pelanggan->count();
      $arr_data = array();
      foreach ($data_pelanggan as $dt_pel){
        $arr_data[] = array(
          'id' => $dt_pel->id,
          'nama'=>$dt_pel->nama,
          'alamat'=>$dt_pel->alamat,
          'telp'=>$dt_pel->telp
        );
      }
      $status=1;
      return Response()->json(compact('count','count', 'arr_data'));
}
}
}

