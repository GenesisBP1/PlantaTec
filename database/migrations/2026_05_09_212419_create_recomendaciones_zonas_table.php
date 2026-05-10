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
        Schema::create('recomendaciones_zona', function (Blueprint $table) {
            $table->id();

            $table->string('nombre_lugar')->nullable();

            $table->string('tipo_zona')->nullable();

            $table->text('indicaciones')->nullable();

            $table->decimal('latitud', 10, 7)->nullable();

            $table->decimal('longitud', 10, 7)->nullable();

            $table->text('descripcion')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recomendaciones_zona');
    }
};
