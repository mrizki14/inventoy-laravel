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
        Schema::create('log__data', function (Blueprint $table) {
            $table->id();
            $table->string('kategori_barang');
            $table->integer('id_barang');
            $table->string('pengguna');
            $table->date('tanggal');
            $table->integer('jumlah');
            $table->bigInteger('total');
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
        Schema::dropIfExists('log__data');
    }
};
