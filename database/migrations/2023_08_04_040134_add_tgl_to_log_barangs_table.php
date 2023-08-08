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
        Schema::table('log_barangs', function (Blueprint $table) {
            $table->date('tgl_masuk')->after('barang_masuk')->nullable();
            $table->date('tgl_keluar')->after('barang_keluar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_barangs', function (Blueprint $table) {
            $table->date('tgl_masuk')->after('barang_masuk')->nullable();
            $table->date('tgl_keluar')->after('barang_keluar')->nullable();
        });
    }
};
