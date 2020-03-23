<?php

namespace App\Http\Controllers;

use App\Transaksi;
use App\Jenis;
use App\Detail;
use JWTAuth;
use DB;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    public function report($tgl_awal, $tgl_akhir){
        $transaksi=DB::table('transaksi')
        ->join('pelanggan','pelanggan.id','=','transaksi.id_pelanggan')
        ->join('petugas','petugas.id','=','transaksi.id_petugas')
        ->where('transaksi.tgl_transaksi', '>=', $tgl_awal)
        ->where('transaksi.tgl_transaksi', '<=', $tgl_akhir)
        ->get();
  
        $data=array(); $no=0;
        foreach ($transaksi as $tr){
          $data[$no]['tgl_transaksi'] = $tr->tgl_transaksi;
          $data[$no]['nama'] = $tr->nama;
          $data[$no]['alamat'] = $tr->alamat;
          $data[$no]['telp'] = $tr->telp;
          $data[$no]['tgl_selesai'] = $tr->tgl_selesai;

          $grand=DB::table('detail')->where('id_transaksi', $tr->id)->groupBy('id_transaksi')
          ->select(DB::raw('sum(subtotal) as grand_total'))->first();

          $data[$no]['grand_total'] = $grand->grand_total;
          $detail=DB::table('detail')->join('jenis_cuci','jenis_cuci.id', '=', 'detail.id_jenis')
          ->where('id_transaksi', $tr->id)->select('jenis_cuci.nama_jenis', 'jenis_cuci.harga_perkilo', 'detail.qty', 'detail.subtotal')->get();

          $data[$no]['detail'] = $grand->detail;
          }
        return response()->json(compact("data"));
      }
}
