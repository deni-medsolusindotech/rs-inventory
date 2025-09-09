<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Produk extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function kategori(){
        return $this->belongsTo(kategori::class);
    }
    
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function setSlugAttribute($slug){
        $this->attributes['slug'] = Str::slug($slug,'-');
    }
    public function getHargaRupiahAttribute(){
        $hasil_rupiah = "Rp " . number_format($this->attributes['harga'],2,',','.');
	    return $hasil_rupiah;
    }
    public function codeproduk(){
        return $this->hasOne(codeproduk::class);
    }

}
