<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produk;

class Category extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    public function produk(){
        return $this->HasMany(CodeProduk::class,'kategori_id');
    }
}
