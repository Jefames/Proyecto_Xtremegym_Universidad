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
        Schema::create('callcenter_coordinations', function (Blueprint $table) {
            $table->foreignId('call_center_id')->constrained()->onDelete('cascade');
            $table->foreignId('coordinations_id')->constrained()->onDelete('cascade');
            $table->primary(['call_center_id', 'coordinations_id']); // Clave primaria compuesta
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('callcenter_coordinations');
    }
};
