<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    use HasFactory;

    public function cliente()
    {
        // Esta función define una relación uno a uno con CentroLlamadas
        return $this->hasOne(Cliente::class);
    }
}
