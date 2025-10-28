@extends('layouts.app')

@section('title', 'Citas')

@push('css-datatable')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')

@include('layouts.partials.alert')

<div class="container-fluid">

    <!-- Breadcrumb plano -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Citas</li>
        </ol>
    </nav>

    <div class="mb-4">
        <a href="{{ route('citas.create') }}"><button class="btn btn-primary">Añadir Cita</button></a>
    </div>
    <div class="mb-4">
        <a href=""><button class="btn btn-primary">Generar Reporte General</button></a>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Lista de Citas
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>Paciente</th>
                        <th>Empleado</th>
                        <th>Fecha y Hora</th>
                        <th>Motivo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($citas as $cita)
                    <tr>
                        <td>{{ $cita->paciente->nombre }} {{ $cita->paciente->apellido }}</td>
                        <td>{{ $cita->empleado?->nombre ?? '-' }} {{ $cita->empleado?->apellido ?? '' }}</td>
                        <td>{{ $cita->fecha_hora->format('d/m/Y H:i') }}</td>
                        <td>{{ $cita->motivo ?? '-' }}</td>
                        <td>
                            <div class="container" style="font-size: small;">
                                @if ($cita->estado == 'pendiente')
                                    <span class="m-1 rounded-pill p-1 bg-warning text-white text-center">Pendiente</span>
                                @elseif ($cita->estado == 'confirmada')
                                    <span class="m-1 rounded-pill p-1 bg-success text-white text-center">Confirmada</span>
                                @else
                                    <span class="m-1 rounded-pill p-1 bg-danger text-white text-center">Cancelada</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <!-- Botón de Editar -->
                            <form action="{{ route('citas.edit', ['cita' => $cita]) }}" method="get" class="d-inline">
                                <button style="width: 31%; height: 35px;" type="submit" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-edit" style="font-size: 18px; color: white;"></i>
                                </button>
                            </form>
                             <a href="" >
                                                    <button style="width: 31%; height: 35px;" type="button" class="btn btn-success btn-sm" >
                                                        <i class="fas fa-file-pdf" style="font-size: 18px; color: white;"></i> <!-- Icono de PDF -->
                                                </button> 
                                                </a>

                            <!-- Botón de Eliminar -->
                            <button style="width: 31%; height: 35px;" type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$cita->id}}">
                                <i class="fas fa-trash" style="font-size: 18px;"></i>
                            </button>
                        </td>
                    </tr>

                    <!-- Modal de confirmación -->
                    <div class="modal fade" id="confirmModal-{{$cita->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmación</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                </div>
                                <div class="modal-body">
                                    ¿Seguro que quieres eliminar esta cita?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <form action="{{ route('citas.destroy',['cita'=>$cita->id]) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Confirmar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
<script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
@if ($errors->any())
<script>
    var myModal = new bootstrap.Modal(document.getElementById('verModal-create'));
    myModal.show();
</script>
@endif
@endpush
