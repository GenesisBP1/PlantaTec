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
        Schema::create('adopciones', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_usuario')
                ->constrained('users')
                ->onDelete('cascade');

            $table->foreignId('id_planta')
                ->constrained('plantas')
                ->onDelete('cascade');

            $table->foreignId('id_ubicacion')
                ->nullable()
                ->constrained('ubicaciones')
                ->onDelete('cascade');

            $table->dateTime('fecha_adopcion')->useCurrent();

            $table->enum('estado_adopcion', [
                'activa',
                'finalizada',
                'cancelada'
            ])->default('activa');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adopciones');
    }
};
