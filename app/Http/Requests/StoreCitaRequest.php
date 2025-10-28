<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCitaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'paciente_id' => 'required|exists:pacientes,id',
            'empleado_id' => 'nullable|exists:empleados,id',
            'fecha_hora'  => 'required|date',
            'motivo'      => 'nullable|string|max:500',
            'estado'      => 'required|in:pendiente,confirmada,cancelada',
        ];
    }

    public function messages(): array
    {
        return [
            'paciente_id.required' => 'Debes seleccionar un paciente.',
            'paciente_id.exists'   => 'El paciente seleccionado no existe.',
            'empleado_id.exists'   => 'El empleado seleccionado no existe.',
            'fecha_hora.required'  => 'Debes seleccionar fecha y hora.',
            'fecha_hora.date'      => 'Formato de fecha y hora no válido.',
            'estado.required'      => 'El estado es obligatorio.',
            'estado.in'            => 'El estado debe ser pendiente, confirmada o cancelada.',
        ];
    }
}
