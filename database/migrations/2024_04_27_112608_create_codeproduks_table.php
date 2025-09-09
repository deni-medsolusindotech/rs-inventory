<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()
    {
        Schema::create('codeproduks', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('jumlah_awal'); 
            $table->BigInteger('jumlah_akhir'); 
            $table->unsignedBigInteger('produk_id'); 
            $table->unsignedBigInteger('lokasi_id'); 
            $table->date('tgl_kadaluarsa')->nullable();
            $table->date('tgl_pembelian');
            $table->string('status_rencana_belanja')->nullable();
            $table->string('status_input_pengadaan')->nullable();
            $table->timestamps();
            $table->foreign('produk_id')->references('id')->on('produks');
            $table->foreign('lokasi_id')->references('id')->on('lokasis');
            $table->string('codeprodukid')->nullable();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('codeproduks');
    }
};
