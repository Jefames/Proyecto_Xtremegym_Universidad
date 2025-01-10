<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membresia;

class CatalogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     //MEMBRESIAS
    public function index_membresia()
    {
        $membresias = Membresia::all();
        return view('catalogs.membresias.index', ['membresias'=>$membresias]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_membresia()
    {
        return view('catalogs.membresias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store_membresia(Request $request)
    {
        $request->validate([
            'tipomem'=> 'required|string|max:100',
            'tiempo' => 'required|integer',
            'descripcion' => 'required|string|max:1000',
            'precio' => 'required|numeric'
        ]);

        $membresia = new Membresia();
        $membresia->tipomem = $request->tipomem;
        $membresia->tiempo = $request->tiempo;
        $membresia->descripcion = $request->descripcion;
        $membresia->precio = $request->precio;
        $membresia ->save();

        return redirect()->route('membresias.index')->with('success','Registro de membresia creado con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit_membresia(string $id)
    {
        $membresia = Membresia::findOrFail ($id);
        return view('catalogs.membresias.edit', compact('membresia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_membresia(Request $request, string $id)
    {
        $request->validate([
            'tipomem'=> 'required|string|max:100',
            'tiempo' => 'required|integer',
            'descripcion' => 'required|string|max:1000',
             'precio' => 'required|numeric'
        ]);

        $membresia = Membresia::findOrFail($id);
        $membresia->tipomem = $request->tipomem;
        $membresia->tiempo = $request->tiempo;
        $membresia->descripcion = $request->descripcion;
        $membresia->precio = $request->precio;
        $membresia ->save();

        return redirect()->route('membresias.index')->with('success','Membresia editada con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
