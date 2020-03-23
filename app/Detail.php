<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $table="detail";
    protected $primaryKey='id';

    protected $fillable = [
        'id_transaksi', 'id_jenis', 'subtotal', 'qty'
    ];

    public function transaksi(){
        return $this->belongsTo('App/Transaksi', 'id_transaksi');
    }
    public function jeniscuci(){
        return $this->belongsTo('App/Jenis', 'id_jenis');
    }
}