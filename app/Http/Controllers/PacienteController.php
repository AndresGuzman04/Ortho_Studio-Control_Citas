<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Http\Requests\StorePacienteRequest;
use App\Http\Requests\UpdatePacienteRequest;
use Exception;
use Illuminate\Support\Facades\DB;

class PacienteController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:ver-pacientes|crear-paciente|editar-paciente|eliminar-paciente|restaurar-paciente', ['only' => ['index']]);
        $this->middleware('permission:crear-paciente', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-paciente', ['only' => ['edit', 'update']]);
        $this->middleware('permission:eliminar-paciente', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $pacientes = Paciente::latest()->get(); 

         return view('paciente.index', compact('pacientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('paciente.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePacienteRequest $request,  Paciente $paciente)
    {
        //
        //dd($request);
        try {
            DB::beginTransaction();

            // Obtener datos validados
            $data = $request->validated();

            // Crear paciente
            $paciente = Paciente::create($data);

            DB::commit();
            return redirect()->route('pacientes.index')
            ->with('success', 'Paciente creado correctamente');

        } catch (Exception $e) {
            DB::rollBack();
             return back()->withErrors('Error al guardar el paciente: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Paciente $paciente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paciente $paciente)
    {
        //
        return view('paciente.edit', ['paciente' => $paciente]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePacienteRequest $request, Paciente $paciente)
    {
        //
        Paciente::where('id', $paciente->id)
            ->update($request->validated());

        return redirect()->route('pacientes.index')->with('success', 'Paciente editado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paciente $paciente)
    {
        // Variable para mensaje
    $message = '';

    // Alternar estado
    if ($paciente->estado == 1) {
        $paciente->update(['estado' => 0]);
        $message = 'Paciente eliminado';
    } else {
        $paciente->update(['estado' => 1]);
        $message = 'Paciente restaurado';
    }

    return redirect()->route('pacientes.index')->with('success', $message);
    }
}
