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
        Schema::table('barang_keluars', function (Blueprint $table) {
            $table->renameColumn('total_keluar', 'qty');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('barang_keluars', function (Blueprint $table) {
            $table->renameColumn('total_keluar', 'qty');
            
        });
    }
};
