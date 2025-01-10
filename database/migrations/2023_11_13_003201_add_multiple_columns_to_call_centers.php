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
        Schema::table('call_centers', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('tipo_servicio_id'); // Clave foránea
            $table->date('fecha');
            $table->time('hora');
            $table->string('via_reporte', 50);
            $table->string('seg_nombre', 100)->nullable();
            $table->string('ter_nombre', 100)->nullable();
            $table->string('apellido', 100);
            $table->string('seg_apellido', 100)->nullable();
            $table->string('apellido_cas', 100)->nullable();
            $table->string('telefono', 15)->nullable();
            $table->string('pueblo', 50);
            $table->string('comunidad_linguistica', 50)->nullable();
            $table->text('direccion')->nullable();
            $table->string('discapacidad', 50);
            $table->string('inf_servdemi', 50);
            $table->text('inf_ofireg');
            $table->string('modalidades', 50);
            $table->boolean('asesor_orienta')->default(false);
            $table->text('transfer_ofcentr');
            $table->boolean('seguimiento')->default(false);
            $table->text('ref_ofreg');
            $table->text('descripcion');

            $table->foreign('tipo_servicio_id')->references('id')->on('service_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('call_centers', function (Blueprint $table) {
            //
        });
    }
};
