<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('tratamientos', function (Blueprint $table) {
        $table->integer('frecuencia_dias')->default(1)->after('indicaciones');
    });
}

public function down(): void
{
    Schema::table('tratamientos', function (Blueprint $table) {
        $table->dropColumn('frecuencia_dias');
    });
}
};
