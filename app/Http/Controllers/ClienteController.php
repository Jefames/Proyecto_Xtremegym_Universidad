<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\ServiceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Notificacion;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expedienteCliente = Cliente::all();
        return view('services.clientes.index', ['clientes' => $expedienteCliente]);
    }

    public  function show(Cliente $cliente){
        //   $expedientesCall = CallCenter::all();
           return view('services.clientes.show',compact('cliente'));
       }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('services.clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        
        $validatedData = $request->except('biometrico'); // Excluir el campo 'biometrico'
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:50',
            'seg_nombre' => 'nullable|string|max:100',
            'apellido' => 'required|string|max:100',
            'seg_apellido' => 'nullable|string|max:100',
            'telefono' => 'nullable|string|max:15',
            'direccion' => 'nullable|string',
            'email' => 'nullable|string|max:255',
            'estado' => 'required|boolean'
        ]);
    
        $cliente = new Cliente();
        // Asignar valores a los campos del modelo
        $cliente->nombre = $validatedData['nombre'];
        $cliente->seg_nombre = $validatedData['seg_nombre'] ?? null;
        $cliente->apellido = $validatedData['apellido'];
        $cliente->seg_apellido = $validatedData['seg_apellido'] ?? null;
        $cliente->telefono = $validatedData['telefono'] ?? null;
        $cliente->direccion = $validatedData['direccion'] ?? null;
        $cliente->email = $validatedData['email'] ?? null;
        $cliente->estado = $validatedData['estado'];
        $cliente->save();
    
    
        return redirect()->route('clientes.showCapturaHuella', $cliente->id);
    }
    
    public function edit($id)
    {
        $expedienteCliente = Cliente::findOrFail($id);
    
        return view('services.clientes.edit', compact('expedienteCliente'));
    }
    
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:50',
            'seg_nombre' => 'nullable|string|max:100',
            'apellido' => 'required|string|max:100',
            'seg_apellido' => 'nullable|string|max:100',
            'telefono' => 'nullable|string|max:15',
            'direccion' => 'nullable|string',
            'email' => 'nullable|string|max:255',
        ]);
    
        $expedienteCliente = Cliente::findOrFail($id);
    
        // Actualizar los campos del expedienteCliente
        $expedienteCliente->nombre = $validatedData['nombre'];
        $expedienteCliente->seg_nombre = $validatedData['seg_nombre'] ?? null;
        $expedienteCliente->apellido = $validatedData['apellido'];
        $expedienteCliente->seg_apellido = $validatedData['seg_apellido'] ?? null;
        $expedienteCliente->telefono = $validatedData['telefono'] ?? null;
        $expedienteCliente->direccion = $validatedData['direccion'] ?? null;
        $expedienteCliente->email = $validatedData['email'] ?? null;
    
        $expedienteCliente->save();
        return redirect()->route('clientes.index')->with('success', 'Datos actualizados con éxito');
        
    }
    
        public function showCapturaHuella($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('services.clientes.showCapturaHuella', compact('cliente'));
    }
    // DESACTIVAR CLIENTE
    public function inactivar($id)
    {
        $cliente = Cliente::findOrFail($id);
    
        // Verificar si el cliente tiene una suscripción activa
        if ($cliente->suscripciones()->where('estado', 'activa')->exists()) {
            return redirect()->route('clientes.index')->with('error', 'No se puede desactivar el cliente porque tiene una suscripción activa.');
        }
    
        $cliente->estado = false; // Desactivar el cliente
        $cliente->save();
    
        return redirect()->route('clientes.index')->with('success', 'Cliente desactivado con éxito');
    }
    
    public function reactivar($id)
{
    // Encontrar al cliente por su ID
    $cliente = Cliente::findOrFail($id);

    // Verificar si el estado es "inactivo"
    if (!$cliente->estado) {  // Si estado es false (inactivo)
        $cliente->estado = true;  // Reactivar el cliente
        $cliente->save();

        return redirect()->route('clientes.index')->with('success', 'Cliente reactivado con éxito.');
    }

    return redirect()->route('clientes.index')->with('error', 'El cliente ya está activo.');
}

public function capturarHuella($id)
{
    $cliente = Cliente::findOrFail($id);

    try {
        // Hacer la solicitud HTTP al servidor C# enviando el ID del cliente
        $response = Http::post('http://localhost:8000/', [
            'id' => $id, // Enviar el ID del cliente como parte de la solicitud
        ]);

        if ($response->successful()) {
            // Obtener el nombre del archivo desde el cuerpo de la respuesta
            $nombreArchivo = $response->body();
            Log::info($nombreArchivo);

            // Asegurarse de que el nombre del archivo no está vacío
            if (!empty($nombreArchivo)) {
                // Guardar el nombre del archivo en la base de datos asociado al cliente
                $cliente->biometrico = $nombreArchivo;
                $cliente->save();

                return response()->json(['success' => true, 'message' => 'Huella capturada y guardada con éxito en el archivo: ' . $nombreArchivo]);
            } else {
                return response()->json(['success' => false, 'message' => 'Error: Archivo de huella vacío recibido.']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Error al capturar la huella.']);
        }
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
}


// public function enrolarHuellaTemp()
// {
//     try {
//         // Hacer la solicitud HTTP al servidor C# para capturar la huella
//         $response = Http::post('http://localhost:8000/');

//         if ($response->successful()) {
//             // Guardar el nombre del archivo en la sesión de Laravel
//             session(['temp_biometrico' => $response->body()]);

//             return response()->json(['success' => true, 'message' => 'Huella capturada y almacenada temporalmente en archivo.']);
//         } else {
//             return response()->json(['success' => false, 'message' => 'Error al capturar la huella.']);
//         }
//     } catch (\Exception $e) {
//         return response()->json(['success' => false, 'message' => $e->getMessage()]);
//     }
// }


}