@extends('layouts.app')

@section('title', 'Crear Paciente')

@push('css')
<!-- Aquí puedes poner CSS adicional si lo necesitas -->
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Crear Paciente</h1>

    <!-- Breadcrumb plano -->
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('pacientes.index') }}">Pacientes</a></li>
        <li class="breadcrumb-item active">Crear Paciente</li>
    </ol>

    <div class="card text-bg-light">
        <form action="{{ route('pacientes.store') }}" method="POST" id="formPaciente">
            @csrf
            <div class="card-body">
                <div class="row g-4">
                    <!-- Nombre -->
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
                        @error('nombre')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Apellido -->
                    <div class="col-md-6">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" name="apellido" id="apellido" class="form-control" value="{{ old('apellido') }}" required>
                        @error('apellido')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Dirección -->
                    <div class="col-md-6">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" name="direccion" id="direccion" class="form-control" value="{{ old('direccion') }}">
                        @error('direccion')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Teléfono -->
                    <div class="col-md-6">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono') }}">
                        @error('telefono')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Número de documento -->
                    <div class="col-md-6">
                        <label for="numero_documento" class="form-label">DUI</label>
                        <input type="text" name="numero_documento" id="numero_documento" class="form-control" value="{{ old('numero_documento') }}" required>
                        @error('numero_documento')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary">Guardar Paciente</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
<!-- Aquí puedes poner JS adicional si lo necesitas -->
@endpush
