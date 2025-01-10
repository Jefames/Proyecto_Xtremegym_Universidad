<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $fillable = ['cliente_id', 'estado', 'hora_entrada', 'hora_salida'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
