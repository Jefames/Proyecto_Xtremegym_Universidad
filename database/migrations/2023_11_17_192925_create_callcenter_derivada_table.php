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
        Schema::create('call_center_derivada', function (Blueprint $table) {

            $table->foreignId('call_center_id')->constrained()->onDelete('cascade');
            $table->foreignId('derivada_id')->constrained()->onDelete('cascade');
            $table->primary(['call_center_id', 'derivada_id']); // Clave primaria compuesta

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('call_center_derivada');
    }
};
