<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    protected $table = 'notificaciones'; // Nombre correcto de la tabla
    protected $fillable = ['cliente_id', 'mensaje', 'tipo'];

    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }
}