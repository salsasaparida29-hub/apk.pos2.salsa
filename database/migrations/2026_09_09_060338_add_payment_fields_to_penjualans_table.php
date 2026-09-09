<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('penjualan', function (Blueprint $table) {
            $table->integer('uang_masuk')->nullable()->after('metode_pembayaran');
            $table->integer('kembalian')->nullable()->after('uang_masuk');
        });
    }

    public function down()
    {
        Schema::table('penjualan', function (Blueprint $table) {
            $table->dropColumn(['uang_masuk', 'kembalian']);
        });
    }
};