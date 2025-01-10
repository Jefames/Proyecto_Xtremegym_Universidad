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
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id'); // Relación con la tabla de clientes
            $table->enum('estado', ['activo', 'inactivo'])->default('inactivo');
            $table->timestamp('hora_entrada')->nullable(); // Hora de entrada
            $table->timestamp('hora_salida')->nullable();  // Hora de salida (puede ser null si aún no ha salido)
            $table->timestamps();
        
            // Relación con la tabla de clientes
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};
