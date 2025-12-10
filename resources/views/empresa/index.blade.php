@extends('layouts.app')

@section('title','Empresa')

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
@include('layouts.partials.alert')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Mi empresa</h1>

    <!-- Breadcrumb plano -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Mi empresa</li>
        </ol>
    </nav>

    <!-- Formulario plano -->
    <form action="{{ $empresa->exists ? route('empresa.update', $empresa) : '#' }}" method="POST">
    @csrf
    @if($empresa->exists)
        @method('PATCH')
    @endif

        <div class="row g-4">

            <div class="col-md-6">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $empresa->nombre) }}" required>
            </div>



            <div class="col-md-6">
                <label for="nit" class="form-label">RUC / NIT</label>
                <input type="text" name="nit" id="nit" class="form-control" value="{{ old('nit', $empresa->nit) }}" required>
            </div>

            <div class="col-md-6">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" name="direccion" id="direccion" class="form-control" value="{{ old('direccion', $empresa->direccion) }}" required>
            </div>


            <div class="col-md-4">
                <label for="correo" class="form-label">Correo</label>
                <input type="email" name="correo" id="correo" class="form-control" value="{{ old('correo', $empresa->correo) }}">
            </div>

            <div class="col-md-4">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono', $empresa->telefono) }}">
            </div>

            <div class="col-md-4">
                <label for="ubicacion" class="form-label">Ubicación</label>
                <input type="text" name="ubicacion" id="ubicacion" class="form-control" value="{{ old('ubicacion', $empresa->ubicacion) }}">
            </div>

        </div>

        @can('editar-empresa')
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
        @endcan

    </form>
</div>
@endsection

@push('js')
@endpush