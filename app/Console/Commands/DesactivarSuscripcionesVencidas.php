<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ClienteMembresia;
use Carbon\Carbon;

class DesactivarSuscripcionesVencidas extends Command
{
    // El nombre y la descripción del comando
    protected $signature = 'suscripciones:desactivar-vencidas';
    protected $description = 'Desactiva las suscripciones que han llegado a su fecha límite';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Obtener la fecha actual
        $fechaActual = Carbon::now();

        // Buscar suscripciones activas cuya fecha de finalización haya pasado
        $suscripcionesVencidas = ClienteMembresia::where('estado', 'activa')
            ->where('fecha_finalizacion', '<', $fechaActual)
            ->get();

        // Desactivar cada suscripción vencida
        foreach ($suscripcionesVencidas as $suscripcion) {
            $suscripcion->estado = 'inactiva'; // Cambiar el estado a 'inactiva'
            $suscripcion->save();

            $this->info("Suscripción del cliente {$suscripcion->cliente->nombre} desactivada.");
        }

        $this->info('Proceso de desactivación completado.');
    }
}

