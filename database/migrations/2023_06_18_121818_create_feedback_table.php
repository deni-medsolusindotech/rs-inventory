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
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->string('from')->index();
            $table->string('to')->index();
            $table->string('subject')->default('feedback');
            $table->text('message');
            $table->boolean('deleteTo')->default(false);
            $table->boolean('deleteFrom')->default(false);
            $table->boolean('readTo')->default(false);
            $table->boolean('readFrom')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedback');
    }
};
