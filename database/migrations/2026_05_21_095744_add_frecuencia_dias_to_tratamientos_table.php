<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('tratamientos', function (Blueprint $table) {
        $table->unsignedInteger('frecuencia_dias')->default(1)->after('indicaciones');
    });
}

public function down()
{
    Schema::table('tratamientos', function (Blueprint $table) {
        $table->dropColumn('frecuencia_dias');
    });
}

    
};

