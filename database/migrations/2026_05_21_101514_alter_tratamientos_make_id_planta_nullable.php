<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tratamientos', function (Blueprint $table) {
            $table->foreignId('id_planta')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('tratamientos', function (Blueprint $table) {
            $table->foreignId('id_planta')->nullable(false)->change();
        });
    }
};