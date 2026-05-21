<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seguimiento_tratamientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_reporte_problema')->constrained('reporte_problemas')->onDelete('cascade');
            $table->foreignId('id_tratamiento')->constrained('tratamientos')->onDelete('cascade');
            $table->dateTime('fecha_aplicacion')->useCurrent();
            $table->string('imagen')->nullable();
            $table->text('observaciones')->nullable();
            $table->enum('estado', ['pendiente', 'aplicado', 'atrasado'])->default('pendiente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seguimiento_tratamientos');
    }
};