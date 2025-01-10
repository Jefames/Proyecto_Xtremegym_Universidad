<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asistencia;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AsistenciaController extends Controller
{
    public function obtenerAfluenciaDiaria(Request $request)
    {
        // Obtener la fecha seleccionada o usar la fecha actual por defecto
        $fecha = $request->input('fecha', Carbon::today()->toDateString());

        // Contar cuántas personas se han logueado por cada hora de la fecha seleccionada
        $afluenciaPorHora = Asistencia::selectRaw('HOUR(hora_entrada) as hora, COUNT(*) as total')
            ->whereDate('hora_entrada', $fecha)
            ->groupBy('hora')
            ->orderBy('hora')
            ->get();

        // Calcular la duración promedio en el gimnasio (en minutos) para aquellos que tienen hora de salida
        $duracionPromedio = Asistencia::whereDate('hora_entrada', $fecha)
            ->whereNotNull('hora_salida') // Solo contar aquellos con hora de salida registrada
            ->select(DB::raw('AVG(TIMESTAMPDIFF(MINUTE, hora_entrada, hora_salida)) as promedio_duracion'))
            ->value('promedio_duracion');

        // Redondeamos la duración promedio a 2 decimales para mayor precisión
        $duracionPromedio = round($duracionPromedio, 2);

        // Enviar los datos, la fecha y la duración promedio a la vista
        return view('services.asistencias.grafica', compact('afluenciaPorHora', 'fecha', 'duracionPromedio'));
    }
}




