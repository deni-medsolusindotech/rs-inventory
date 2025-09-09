<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengajuankebutuhan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function getStatusAttribute(){
        return $this->confirmation->status;
    }

    public function by(){
        return $this->belongsTo(User::class,'author');
    }
    
    public function produk(){
        return $this->belongsTo(codeproduk::class,'produk_baru');
    }

    public function lokasi(){
        return $this->belongsTo(lokasi::class,'lokasi_tujuan');
    }

    public function confirmation(){
        return $this->belongsTo(confirmation::class,'konfirmasi');
    }
}
