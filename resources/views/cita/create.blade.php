@extends('layouts.app')

@section('title', 'Crear Cita')

@push('css')
<!-- Aquí puedes agregar CSS adicional si es necesario -->
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Crear Cita</h1>

    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('citas.index') }}">Citas</a></li>
        <li class="breadcrumb-item active">Crear Cita</li>
    </ol>

    <div class="card text-bg-light">
        <form action="{{ route('citas.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row g-4">

                    <!-- Paciente -->
                    <div class="col-md-6">
                        <label for="paciente_id" class="form-label">Paciente</label>
                        <select name="paciente_id" id="paciente_id" class="form-control" required>
                            <option value="">-- Seleccione --</option>
                            @foreach($pacientes as $paciente)
                                <option value="{{ $paciente->id }}" {{ old('paciente_id') == $paciente->id ? 'selected' : '' }}>
                                    {{ $paciente->nombre }} {{ $paciente->apellido }}
                                </option>
                            @endforeach
                        </select>
                        @error('paciente_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Empleado (opcional) -->
                    <div class="col-md-6">
                        <label for="empleado_id" class="form-label">Empleado</label>
                        <select name="empleado_id" id="empleado_id" class="form-control">
                            <option value="">-- Seleccione --</option>
                            @foreach($empleados as $empleado)
                                <option value="{{ $empleado->id }}" {{ old('empleado_id') == $empleado->id ? 'selected' : '' }}>
                                    {{ $empleado->nombre }} {{ $empleado->apellido }}
                                </option>
                            @endforeach
                        </select>
                        @error('empleado_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Fecha y hora -->
                    <div class="col-md-6">
                        <label for="fecha_hora" class="form-label">Fecha y Hora</label>
                        <input type="datetime-local" name="fecha_hora" id="fecha_hora" class="form-control" 
                               value="{{ old('fecha_hora') }}" required>
                        @error('fecha_hora')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Motivo -->
                    <div class="col-md-6">
                        <label for="motivo" class="form-label">Motivo</label>
                        <textarea name="motivo" id="motivo" class="form-control">{{ old('motivo') }}</textarea>
                        @error('motivo')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Estado -->
                    <div class="col-md-6">
                        <label for="estado" class="form-label">Estado</label>
                        <select name="estado" id="estado" class="form-control" required>
                            <option value="pendiente" {{ old('estado') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="confirmada" {{ old('estado') == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                            <option value="cancelada" {{ old('estado') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                        </select>
                        @error('estado')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary">Guardar Cita</button>
                <button type="reset" class="btn btn-secondary">Reiniciar</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
<!-- Aquí puedes poner JS adicional si lo necesitas -->
@endpush
