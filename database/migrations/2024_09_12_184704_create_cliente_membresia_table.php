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
    Schema::create('cliente_membresia', function (Blueprint $table) {
        $table->id();
        $table->foreignId('cliente_id')->constrained('clientes'); // Relación con la tabla clientes
        $table->foreignId('membresia_id')->constrained('membresias'); // Relación con la tabla membresías
        $table->date('fecha_inicio');
        $table->date('fecha_finalizacion');
        $table->enum('estado', ['activa', 'inactiva']);
        $table->decimal('subtotal', 8, 2);
        $table->decimal('total', 8, 2);
        $table->enum('metodo_pago', ['efectivo']); // Solo efectivo por ahora
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('cliente_membresia');
}

};
