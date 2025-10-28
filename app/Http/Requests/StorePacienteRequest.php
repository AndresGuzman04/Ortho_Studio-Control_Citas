<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePacienteRequest extends FormRequest
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
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:100|unique:pacientes,email',
            'numero_documento' => 'required|string|max:20|unique:pacientes,numero_documento',
            'estado' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del paciente es obligatorio.',
            'nombre.string' => 'El nombre debe ser un texto válido.',
            'nombre.max' => 'El nombre no puede superar los 100 caracteres.',
            
            'apellido.required' => 'El apellido del paciente es obligatorio.',
            'apellido.string' => 'El apellido debe ser un texto válido.',
            'apellido.max' => 'El apellido no puede superar los 100 caracteres.',

            'direccion.string' => 'La dirección debe ser un texto válido.',
            'direccion.max' => 'La dirección no puede superar los 255 caracteres.',

            'telefono.string' => 'El teléfono debe ser un texto válido.',
            'telefono.max' => 'El teléfono no puede superar los 15 caracteres.',

            'email.email' => 'Debe ingresar un correo válido.',
            'email.max' => 'El correo no puede superar los 100 caracteres.',
            'email.unique' => 'Este correo ya está registrado.',

            'numero_documento.required' => 'El número de documento es obligatorio.',
            'numero_documento.string' => 'El número de documento debe ser un texto válido.',
            'numero_documento.max' => 'El número de documento no puede superar los 20 caracteres.',
            'numero_documento.unique' => 'Este número de documento ya está registrado.',

            'estado.boolean' => 'El estado debe ser verdadero o falso.',
        ];
    }
}
