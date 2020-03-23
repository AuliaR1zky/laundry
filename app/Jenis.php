<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    protected $table="jeniscuci";
    protected $primaryKey='id';

    protected $fillable = [
        'nama_jenis', 'harga_perkilo'
    ];

    public function detail(){
        return this()->hasMany('App\Detail', 'id_jenis');
    }
}
