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
        Schema::create('notificaciones', function (Blueprint $table) {
            $table->id();
        
            $table->foreignId('id_usuario')
                ->constrained('users')
                ->onDelete('cascade');
        
            $table->foreignId('id_recomendacion_cuidado')
                ->nullable()
                ->constrained('recomendaciones_cuidado')
                ->onDelete('set null');
        
            $table->string('titulo');
        
            $table->text('mensaje');
        
            $table->string('tipo')->nullable();
        
            $table->boolean('leida')->default(false);
        
            $table->dateTime('fecha_envio')->useCurrent();
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notificacions');
    }
};
