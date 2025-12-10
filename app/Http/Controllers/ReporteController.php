<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Cita;
use App\Models\Empresa;

class ReporteController extends Controller
{
    public function reporteCitas(Request $request)
    {
        // Validar fechas
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        // 🔹 Obtener datos de la empresa (solo 1 registro)
        $empresa = Empresa::first();

        if (!$empresa) {
            return back()->with('error', 'No hay datos de empresa registrados.');
        }

        // 🔹 Obtener citas directamente desde la BD
        $citas = Cita::with(['paciente'])
            ->whereDate('fecha_hora', '>=', $request->fecha_inicio)
            ->whereDate('fecha_hora', '<=', $request->fecha_fin)
            ->orderBy('fecha_hora', 'asc')
            ->get()
            ->map(function ($cita) {
                return [
                    'id' => $cita->id,
                    'paciente' => $cita->paciente?->nombre . ' ' . $cita->paciente?->apellido,
                    'motivo' => $cita->motivo,
                    'estado' => ucfirst($cita->estado),
                    'fecha' => $cita->fecha_hora->format('Y-m-d'),
                    'hora' => $cita->fecha_hora->format('H:i'),
                ];
            });

        // 🔹 Generar PDF
        $pdf = Pdf::loadView('reportes.citas', [
            'empresa' => $empresa,
            'citas' => $citas,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin
        ])->setPaper('letter', 'portrait');

        return $pdf->stream('reporte_citas.pdf');
    }
}
