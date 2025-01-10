<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use App\Models\Asistencia;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Carbon\Carbon;

class NotificacionController extends Controller
{
    public function index(Request $request)
    {
        // Obtener la fecha seleccionada o usar la fecha actual por defecto
        $fecha = $request->input('fecha', Carbon::today()->toDateString());
    
        // Filtrar las notificaciones por la fecha seleccionada
        $notificaciones = Notificacion::whereDate('created_at', $fecha)
                        ->with('cliente')
                        ->orderBy('created_at', 'desc')
                        ->get();
    
        // Enviar los datos y la fecha a la vista
        return view('services.notificaciones.notificacion', compact('notificaciones', 'fecha'));
    }

    public function getNotificaciones()
    {
        $notificaciones = Notificacion::with('cliente')->orderBy('created_at', 'desc')->get();
        return response()->json($notificaciones);
    }

    // Método para guardar notificaciones enviadas desde C#
    public function guardar(Request $request)
    {
        // Validar los datos entrantes
        $request->validate([
            'clienteId' => 'required|exists:clientes,id',
            'estado' => 'required|in:permitido,denegado',
        ]);

        // Crear el mensaje basado en el estado del acceso
        $mensaje = $request->estado === 'permitido' ? 'Acceso permitido: Membresia Activa' : 'Acceso denegado: Membresia Inactiva o No cuenta con una';

        // Crear y guardar la notificación en la base de datos
        Notificacion::create([
            'cliente_id' => $request->clienteId,
            'mensaje' => $mensaje,
            'tipo' => $request->estado === 'permitido' ? 'aceptado' : 'denegado',
        ]);
            // Solo registrar la asistencia si es "permitido"
            if ($request->estado === 'permitido') {
                $this->registrarAsistencia($request->clienteId);
            }

            return response()->json(['success' => true]);
    }

    private function registrarAsistencia($clienteId)
    {
        $cliente = Cliente::findOrFail($clienteId);
        $ultimaAsistencia = Asistencia::where('cliente_id', $cliente->id)->latest()->first();

        // Si no hay registros o está inactivo, registrar como entrada
        if (!$ultimaAsistencia || $ultimaAsistencia->estado === 'inactivo') {
            Asistencia::create([
                'cliente_id' => $cliente->id,
                'estado' => 'activo',
                'hora_entrada' => now(),
            ]);
        } else {
            // Si ya está activo, marcar como salida
            $ultimaAsistencia->update([
                'estado' => 'inactivo',
                'hora_salida' => now(),
            ]);
        }
    }

        public function asist(Request $request)
        {
            // Obtener la fecha seleccionada (si existe) o usar la fecha actual por defecto
            $fecha = $request->input('fecha', Carbon::today()->toDateString());

            // Recuperar clientes activos e inactivos de la fecha seleccionada
            $activos = Asistencia::where('estado', 'activo')
                        ->whereDate('hora_entrada', $fecha)
                        ->with('cliente')
                        ->get();

            $inactivos = Asistencia::where('estado', 'inactivo')
                        ->whereDate('hora_salida', $fecha)
                        ->with('cliente')
                        ->get();

            // Enviar la fecha y los registros a la vista
            return view('services.asistencias.asistencia', compact('activos', 'inactivos', 'fecha'));
        }


}


