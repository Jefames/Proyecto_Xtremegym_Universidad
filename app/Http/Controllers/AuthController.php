<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\ServiceType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public  function index(){
        $users = User::all();
        return view('users.index', ['usuarios' => $users]);
    }
    public function create()
    {
        $departamentos = Department::all();
        $tipos_servicio = ServiceType::all();

        return view('users.create', compact('departamentos', 'tipos_servicio'));
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'cod_user' => 'required|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'cod_user' => $request->cod_user,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json($user);
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'cod_user' => 'required',
                'password' => 'required',
            ]);

            if (Auth::attempt(['cod_user' => $request->cod_user, 'password' => $request->password])) {
                // Autenticación exitosa
                return redirect()->intended('/cliente/create');
            } else {
                return response()->json(['message' => 'Código o contraseña incorrectos'], 401);
            }
        }catch (\Illuminate\Validation\ValidationException $ex) {
        return response()->json(['message' => $ex->errors()], 422);
    } catch (\Exception $ex) {
        return response()->json(['message' => 'Error de autenticación desconocido'], 500);
    }
    }

    //GUARDAR USUARIO
    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'unique:users,email',
            'password' => 'required',
            'rol' => 'required',
            'departamento_id' => 'required|exists:departments,id',
            'tipo_servicio_id' => 'required|exists:service_types,id',
        ]);

        $user = new User();
        $user->name = $request->nombre;
        $user->apellidos = $request->apellido;
        if (!is_null($request->email)){
            $user->email = $request->email;
        }
        $user->password = bcrypt($request->password); // Encripta la contraseña
        $user->departamento_id = $request->departamento_id;
        $user->tipo_servicio_id = $request->tipo_servicio_id;
        $user->rol = $request->rol;

        // Busca el tipo de servicio para obtener el código de servicio
        $tipoServicio = ServiceType::find($request->tipo_servicio_id);

        // Asegúrate de que el tipo de servicio existe
//        if (!$tipoServicio) {
//            return back()->withErrors(['tipo_servicio_id' => 'El tipo de servicio seleccionado no es válido.']);
//        }

        // Generar el código del usuario
        $codigoDepartamento = sprintf('%02d', $user->departamento_id);
        $codigoServicio = $tipoServicio->cod_service; // Aquí obtienes el código del tipo de servicio
        $idUsuario = User::max('id') + 1; // Obtiene el próximo ID de usuario

        $user->cod_user = $codigoDepartamento . $codigoServicio . sprintf('%02d', $idUsuario);

        $user->save();

        return redirect()->route('users.create')->with('success', 'Usuario creado con éxito.');
    }

    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        $departamentos = Department::all();
        $tipos_servicio = ServiceType::all();

        // Aquí puedes pasar cualquier otra información necesaria para la vista
        return view('users.edit', compact('usuario','departamentos','tipos_servicio'));
    }

    //GUARDAR EDICION DEL USUARIO
    public function update(Request $request, $id)
    {

        // Valida los otros campos aquí...
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'unique:users,email,' . $id,
            'password' => 'nullable',
            'rol' => 'required',
            'departamento_id' => 'required|exists:departments,id',
            'tipo_servicio_id' => 'required|exists:service_types,id',
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->nombre;
        $user->apellidos = $request->apellido;

        if (!is_null($request->email)){
            $user->email = $request->email;
        }
        // Actualizar la contraseña solo si se proporcionó una nueva
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        $user->departamento_id = $request->departamento_id;
        $user->tipo_servicio_id = $request->tipo_servicio_id;
        $user->rol = $request->rol;

        // Busca el tipo de servicio para obtener el código de servicio
        $tipoServicio = ServiceType::find($request->tipo_servicio_id);

        // Generar el código del usuario
        $codigoDepartamento = sprintf('%02d', $user->departamento_id);
        $codigoServicio = $tipoServicio->cod_service; // Aquí obtienes el código del tipo de servicio
        $idUsuario = $id;

        $user->cod_user = $codigoDepartamento . $codigoServicio . sprintf('%02d', $idUsuario);


        // Guardar los cambios
        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuario editado con éxito.');

    }


    //CERRAR SESION
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }

    //DESACTIVAR USUARIO
    public function inactivar($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->estado = false; // Asumiendo que tienes un campo 'activo' en tu modelo
        $usuario->save();

        return redirect()->route('users.index')->with('success', 'Usuario desactivado con éxito');
    }

    //ACTIVAR USUARIO
    public function activar($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->estado = true;
        $usuario->save();

        return redirect()->route('users.index')->with('success', 'Usuario desactivado con éxito');
    }

}

