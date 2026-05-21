<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('tratamiento_reportes', function (Blueprint $table) {
        $table->id();

        $table->foreignId('id_reporte_problema')
            ->constrained('reporte_problemas')
            ->cascadeOnDelete();

        $table->foreignId('id_tratamiento')
            ->constrained('tratamientos')
            ->cascadeOnDelete();

        $table->integer('frecuencia_dias')->default(1);
        $table->date('fecha_inicio')->nullable();
        $table->date('fecha_proxima')->nullable();

        $table->enum('estado', ['pendiente', 'evidenciado', 'resuelto'])
            ->default('pendiente');

        $table->string('imagen')->nullable();
        $table->text('descripcion')->nullable();

        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('tratamiento_reportes');
    }
};
