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
            $table->integer('stock_awal')->default(0)->after('codes_id');
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
            $table->integer('stock_awal')->default(0)->after('codes_id');
        });
    }
};
