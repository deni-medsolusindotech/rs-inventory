<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class codeproduk extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts = [
        'tgl_pembelian' => 'date:Y-m-d',
        'tgl_kadaluarsa' => 'date:Y-m-d',
    ];
    protected static function boot()
    {
        parent::boot();
        static::saving(function ($produk) {
            if ($produk->jumlah_akhir == null) {
                $produk->jumlah_akhir = $produk->jumlah_awal;
            }
        });
    }
    public function produk(){
        return $this->belongsTo(Produk::class);
    }

    public function lokasi(){
        return $this->belongsTo(lokasi::class);
    }

    public function distribusi(){
        return $this->hasMany(Distribusi::class,'produk_id');
    }
}
