<?php

namespace App\Http\Controllers;

use App\Pelanggan;
use App\Petugas;
use App\Transaksi;
use App\Jenis;
use App\Detail;
use JWTAuth;
use Auth;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function report($tgl_awal, $tgl_akhir){
        if(Auth::user()->level=="petugas"){
        $transaksi=DB::table('transaksi')
        ->join('pelanggan','pelanggan.id','=','transaksi.id_pelanggan')
        ->join('petugas','petugas.id','=','transaksi.id_petugas')
        ->where('transaksi.tgl_transaksi', '>=', $tgl_awal)
        ->where('transaksi.tgl_transaksi', '<=', $tgl_akhir)
        ->select('transaksi.id', 'tgl_transaksi' ,'nama', 'alamat', 'pelanggan.telp', 'tgl_selesai')
        ->get();
  
        $data[]=array(); $no=0;
        foreach ($transaksi as $tr){
          $data[$no]['tgl_transaksi'] = $tr->tgl_transaksi;
          $data[$no]['nama'] = $tr->nama;
          $data[$no]['alamat'] = $tr->alamat;
          $data[$no]['telp'] = $tr->telp;
          $data[$no]['tgl_selesai'] = $tr->tgl_selesai;

          $grand=DB::table('detail')->where('id_transaksi', $tr->id)->groupBy('id_transaksi')
          ->select(DB::raw('sum(subtotal) as grand_total'))->first();

          $data[$no]['grand_total'] = $grand;
          $detail=DB::table('detail')->join('jeniscuci','jeniscuci.id', '=', 'detail.id_jenis')
          ->where('id_transaksi', $tr->id)->select('jeniscuci.nama_jenis', 'jeniscuci.harga_perkilo', 'detail.qty', 'detail.subtotal')->get();

          $data[$no]['detail'] = $detail;
          $no++;
          }
        
        return response()->json(compact("data"));
      }
    }



    public function store(Request $req)
    {
        if(Auth::user()->level=="petugas"){
        $validator=Validator::make($req->all(),
        [
            'id_pelanggan'=>'required',
            'id_petugas'=>'required',
            'tgl_transaksi'=>'required',
            'tgl_selesai'=>'required'
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $simpan=Transaksi::create([
            'id_pelanggan'=>$req->id_pelanggan,
            'id_petugas'=>$req->id_petugas,
            'tgl_transaksi'=>$req->tgl_transaksi,
            'tgl_selesai'=>$req->tgl_selesai
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
        if(Auth::user()->level=="petugas"){
        $validator=Validator::make($req->all(),
        [
            'id_pelanggan'=>'required',
            'id_petugas'=>'required',
            'tgl_transaksi'=>'required',
            'tgl_selesai'=>'required'
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $ubah=Transaksi::where('id', $id)->update([
            'id_pelanggan'=>$req->id_pelanggan,
            'id_petugas'=>$req->id_petugas,
            'tgl_transaksi'=>$req->tgl_transaksi,
            'tgl_selesai'=>$req->tgl_selesai
        ]);
        if($ubah){
            return Response()->json(['status'=>1]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
    }
    public function hapus($id){
        if(Auth::user()->level=="petugas"){
        $hapus=Transaksi::where('id', $id)->delete();
        if($hapus){
            return Response()->json(['status'=>1]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
}

//detail_pinjam

public function simpan(Request $req)
    {
        if(Auth::user()->level=="petugas"){
        $validator=Validator::make($req->all(),
        [
            'id_transaksi'=>'required',
            'id_jenis'=>'required',
            'qty'=>'required'
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $total=DB::table('jeniscuci')->where('id', $req->id_jenis)->first();
        $subtotal = ($total->harga_perkilo * $req->qty);
        $simpan=Detail::create([
            'id_transaksi'=>$req->id_transaksi,
            'id_jenis'=>$req->id_jenis,
            'subtotal'=>$subtotal,
            'qty'=>$req->qty
        ]);
        if($simpan){
            return Response()->json(['status'=>1]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
    }

    public function ubah($id, Request $req)
    {
        if(Auth::user()->level=="petugas"){
        $validator=Validator::make($req->all(),
        [
            'id_transaksi'=>'required',
            'id_jenis'=>'required',
            'subtotal'=>'required',
            'qty'=>'required'
        ]
        );
        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $ubah=Detail::where('id', $id)->update([
            'id_transaksi'=>$req->id_transaksi,
            'id_jenis'=>$req->id_jenis,
            'subtotal'=>$req->subtotal,
            'qty'=>$req->qty
        ]);
        if($ubah){
            return Response()->json(['status'=>1]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
    }
    public function destroy($id){
        if(Auth::user()->level=="petugas"){
        $hapus=Detail::where('id', $id)->delete();
        if($hapus){
            return Response()->json(['status'=>1]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
}
    public function tampil_detail(){
        if(Auth::user()->level=="petugas"){
        $detail=DB::table('detail')
        ->join('transaksi','transaksi.id','=','detail.id_transaksi')
        ->join('jeniscuci','jeniscuci.id','=','detail.id_jenis')
        ->select('jeniscuci.nama_jenis', 'jeniscuci.harga_perkilo', 'detail.qty', 'detail.subtotal')
        ->get();
        $count=$detail->count();
        return response()->json(compact('detail', 'count'));
}
    }
}
