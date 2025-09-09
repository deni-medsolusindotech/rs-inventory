<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuankebutuhans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('jenis');
            $table->bigInteger('jumlah');
            $table->longText('deskripsi');
            $table->unsignedBigInteger('lokasi_tujuan');
            $table->unsignedBigInteger('produk_baru')->nullable();
            $table->unsignedBigInteger('konfirmasi');
            $table->string('author')->index();
            $table->timestamps();
            $table->foreign('konfirmasi')->references('id')->on('confirmations');
            $table->foreign('produk_baru')->references('id')->on('codeproduks');
            $table->foreign('lokasi_tujuan')->references('id')->on('lokasis');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengajuankebutuhans');
    }
};
