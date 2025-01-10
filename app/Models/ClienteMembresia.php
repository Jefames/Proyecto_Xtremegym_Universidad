<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteMembresia extends Model
{
    use HasFactory;
    protected $table = 'cliente_membresia';  // Nombre de tu tabla actual

    protected $fillable = [
        'cliente_id', 'membresia_id', 'fecha_inicio', 
        'fecha_finalizacion', 'subtotal', 'total', 'metodo_pago'
    ];
    
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function membresia()
    {
        return $this->belongsTo(Membresia::class, 'membresia_id');
    }
}
