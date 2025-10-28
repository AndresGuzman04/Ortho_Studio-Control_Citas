<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Http\Requests\StoreEmpresaRequest;
use App\Http\Requests\UpdateEmpresaRequest;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        // Si tienes solo una empresa
        $empresa = Empresa::first(); // devuelve un modelo o null

        // Si no existe, puedes crear un modelo vacío para evitar errores
        $empresa ??= new Empresa();

        return view('empresa.index', compact('empresa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmpresaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empresa $empresa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmpresaRequest $request, Empresa $empresa)
    {
        // Validar y actualizar la empresa
        $empresa->update($request->validated());

        // Redirigir con mensaje de éxito
        return redirect()->route('empresa.index')->with('success', 'Empresa editada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa)
    {
        //
    }
}
