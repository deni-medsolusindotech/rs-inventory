<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('slug')->unique()->nullable();
            $table->unsignedBigInteger('kategori_id'); 
            $table->bigInteger('harga')->default(0);
            $table->string('merk');
            $table->string('spesifikasi')->nullable();
            $table->text('keterangan');
            $table->string('gambar')->nullable();
            $table->timestamps();
            $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('cascade');
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('produks');
    }
};
