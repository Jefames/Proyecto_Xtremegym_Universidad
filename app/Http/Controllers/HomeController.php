<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
//        $pacientes = Paciente::count();
//        $cita = Cita::all();
//        $fechaHoy = Carbon::today();
//        $totalCitasHoy = Cita::whereDate('fecha', $fechaHoy)->count();
//
//        $c_pendiente = Cita::where('estado', 'PENDIENTE')->count();
//        $c_cancelado = Cita::where('estado', 'CANCELADA')->count();
//        $c_completado = Cita::where('estado', 'COMPLETADA')->count();
//
//
//        $datosVista = [
//            'totalPacientes' => $pacientes,
//            'totalCitasHoy' => $totalCitasHoy,
//            'citas' => $cita,
//            'c_pendientes' => $c_pendiente,
//            'c_canceladas' => $c_cancelado,
//            'c_completadas' => $c_completado
//        ];
        return view('home.index');
    }
}
