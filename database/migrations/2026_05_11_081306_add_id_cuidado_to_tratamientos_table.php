<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tratamientos', function (Blueprint $table) {
            $table->foreignId('id_cuidado')
                ->nullable()
                ->after('id_planta')
                ->constrained('cuidados')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('tratamientos', function (Blueprint $table) {
            $table->dropForeign(['id_cuidado']);
            $table->dropColumn('id_cuidado');
        });
    }
};
