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
        Schema::table('ubicaciones', function (Blueprint $table) {
            // Agregar id_usuario si no existe
            if (!Schema::hasColumn('ubicaciones', 'id_usuario')) {
                $table->foreignId('id_usuario')
                    ->nullable()
                    ->after('id')
                    ->constrained('users')
                    ->onDelete('cascade');
            }

            // Cambiar tipo de enum a que incluya pública y privada si no está configurado
            if (!Schema::hasColumn('ubicaciones', 'es_publica')) {
                $table->boolean('es_publica')->default(true)->after('tipo');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ubicaciones', function (Blueprint $table) {
            if (Schema::hasColumn('ubicaciones', 'id_usuario')) {
                $table->dropForeignKeyIfExists(['id_usuario']);
                $table->dropColumn('id_usuario');
            }

            if (Schema::hasColumn('ubicaciones', 'es_publica')) {
                $table->dropColumn('es_publica');
            }
        });
    }
};
