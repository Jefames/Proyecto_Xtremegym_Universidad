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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('tipo_servicio_id')->nullable(); // Clave foránea opcional
            $table->foreign('tipo_servicio_id')->references('id')->on('service_types')->onDelete('set null');

            /* Esto establece una clave foránea en la tabla users que se relaciona con la tabla tipo_servicios.
            Si el TipoServicio se elimina, el tipo_servicio_id en el usuario se establece en null debido a onDelete('set null').*/

            $table->unsignedBigInteger('departamento_id')->nullable();
            $table->foreign('departamento_id')->references('id')->on('departments')->onDelete('set null');

            $table->string('apellidos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
