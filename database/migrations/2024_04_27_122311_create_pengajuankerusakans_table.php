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
        Schema::create('pengajuankerusakans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produk');  
            $table->unsignedBigInteger('konfirmasi');
            $table->string('author');
            $table->string('bukti');
            $table->longText('keterangan');
            $table->longText('produk_hilang')->nullable();
            $table->bigInteger('jumlah');
            $table->timestamps();
            $table->foreign('produk')->references('id')->on('codeproduks');
            $table->foreign('konfirmasi')->references('id')->on('confirmations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengajuankerusakans');
    }
};
