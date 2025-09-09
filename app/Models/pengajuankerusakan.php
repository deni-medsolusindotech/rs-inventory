<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengajuankerusakan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function by(){
        return $this->belongsTo(User::class,'author');
    }

    public function produkrusak(){
        return $this->belongsTo(codeproduk::class,'produk');
    }
    
    public function confirmation(){
        return $this->belongsTo(confirmation::class,'konfirmasi');
    }

    public function getStatusAttribute(){
        return $this->confirmation->status;
    }
}
