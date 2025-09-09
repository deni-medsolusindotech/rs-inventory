<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class farmasi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function codeproduk(){
        return $this->belongsTo(codeproduk::class,'produk');
    }
    
    public function by(){
        return $this->belongsTo(User::class,'author');
    }
}
