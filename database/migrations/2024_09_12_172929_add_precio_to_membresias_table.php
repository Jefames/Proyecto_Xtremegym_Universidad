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
    Schema::table('membresias', function (Blueprint $table) {
        $table->decimal('precio', 8, 2)->after('descripcion'); // Agregar columna precio después de descripción
    });
}

public function down()
{
    Schema::table('membresias', function (Blueprint $table) {
        $table->dropColumn('precio');
    });
}

};
