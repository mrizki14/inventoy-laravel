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
        Schema::create('log_barang', function (Blueprint $table) {
            $table->id();
            $table->integer('users_id');
            $table->bigInteger('codes_id');
            $table->bigInteger('barang_masuks_id');
            $table->bigInteger('barang_keluars_id');
            $table->bigInteger('qty');
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
        Schema::dropIfExists('log_barang');
    }
};
