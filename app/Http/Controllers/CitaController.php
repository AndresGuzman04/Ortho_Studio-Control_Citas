<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Http\Requests\StoreCitaRequest;
use App\Http\Requests\UpdateCitaRequest;
use App\Models\Paciente;
use App\Models\Empleado;
use Illuminate\Support\Facades\DB;
use Exception;



class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $citas = Cita::with(['paciente', 'empleado'])->latest()->get();

        $citas_json = $citas->map(function($cita) {
            return [
                'id' => $cita->id,
                'paciente_id' => $cita->paciente_id,
                'paciente' => $cita->paciente?->nombre . ' ' . $cita->paciente?->apellido ?? 'Sin nombre',
                'empleado_id' => $cita->empleado_id,
                'motivo' => $cita->motivo,
                'estado' => $cita->estado,
                'year' => $cita->fecha_hora->year,
                'month' => $cita->fecha_hora->month,
                'day' => $cita->fecha_hora->day,
                'hour' => $cita->fecha_hora->format('H:i')
            ];
        });

        return view('cita.calendar', compact('citas_json'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $pacientes = Paciente::all();
        $empleados = Empleado::all();
        return view('cita.create', compact('pacientes', 'empleados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCitaRequest $request)
    {
        try {
            DB::beginTransaction();

            // Obtener datos validados
            $data = $request->validated();

            // Crear la cita
            $cita = Cita::create($data);

            DB::commit();

            return redirect()->route('citas.index')
                            ->with('success', 'Cita creada correctamente.');

        } catch (Exception $e) {
            DB::rollBack();

            return back()->withErrors('Error al guardar la cita: ' . $e->getMessage())
                        ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cita $cita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cita $cita)
    {
        //
        $pacientes = Paciente::all();
        $empleados = Empleado::all();
        return view('cita.edit', compact('cita', 'pacientes', 'empleados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCitaRequest $request, Cita $cita)
    {
        try {
            DB::beginTransaction();

            // CORRECCIÓN: Usamos el objeto $cita de Route Model Binding para actualizarlo directamente.
            // Esto solo funcionará si los campos están en la propiedad $fillable del modelo Cita.
            $cita->update($request->validated());

            DB::commit();

            return redirect()->route('citas.index')->with('success', 'Cita actualizada correctamente.');

        } catch (Exception $e) {
            DB::rollBack();

            // Opcional: Registrar el error completo en los logs de Laravel
            Log::error('Error al actualizar la cita: ' . $e->getMessage(), ['exception' => $e]);

            return back()->withErrors('Error al actualizar la cita. Por favor, intente de nuevo.')
                        ->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cita $cita)
    {
      try {
            // Eliminar la cita usando el objeto de Route Model Binding
            $cita->delete();

            return redirect()->route('citas.index')->with('success', 'Cita eliminada correctamente.');

        } catch (Exception $e) {
             // Opcional: Registrar el error completo en los logs de Laravel
            Log::error('Error al eliminar la cita: ' . $e->getMessage(), ['exception' => $e]);

            return back()->withErrors('Error al eliminar la cita. Por favor, intente de nuevo.');
        }
    }
}
