@extends('layouts.app')

@section('title', 'Pacientes')

@push('css-datatable')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')

@include('layouts.partials.alert')

<div class="container-fluid ">

                        <!-- Breadcrumb plano -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Pacientes</li>
                            </ol>
                        </nav>

                        <div class="mb-4">
                        <a href="{{ route('pacientes.create') }}"><button class="btn btn-primary">Añadir Paciente</button></a>
                        </div>

                        <div class="mb-4">
                        <a href=""><button class="btn btn-primary">Generar Reporte General</button></a>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                DataTable Example
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Direccion</th>
                                            <th>Telefono</th>
                                            <th>Dui</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pacientes as $paciente)
                                        <tr>
                                            <td>
                                                {{$paciente->nombre}}
                                            </td>
                                            <td>
                                                {{$paciente->apellido}}
                                            </td>
                                            <td>
                                                {{$paciente->direccion}}
                                            </td>
                                            <td>
                                                {{$paciente->telefono}}
                                            </td>
                                            <td>
                                                {{$paciente->numero_documento}}
                                            </td>
                                            <td>
                                                <div class="container" style="font-size: small;">
                                                    @if ($paciente->estado == 1)
                                                    <div class="row">
                                                        <span  class="m-1 rounded-pill p-1 bg-success text-white text-center">Activo</span>
                                                    </div>
                                                    @else
                                                    <div class="row">
                                                        <span  class="m-1 rounded-pill p-1 bg-danger text-white text-center">Eliminado</span>
                                                    </div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <!-- Botón de Editar -->
                                                <form action="{{ route('pacientes.edit', ['paciente' => $paciente]) }}" method="get" class="d-inline">
                                                    <button style="width: 31%; height: 35px;" type="submit" class="btn btn-secondary btn-sm">
                                                        <i class="fas fa-edit" style="font-size: 18px; color: white;"></i> <!-- Icono de edición -->
                                                    </button>
                                                </form>

                                                <a href="" >
                                                    <button style="width: 31%; height: 35px;" type="button" class="btn btn-success btn-sm" >
                                                        <i class="fas fa-file-pdf" style="font-size: 18px; color: white;"></i> <!-- Icono de PDF -->
                                                </button> 
                                                </a>

                                                <!-- Botón de Eliminar o Restaurar -->
                                                @if ($paciente->estado == 1)
                                                    <button style="width: 31%; height: 35px;" type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$paciente->id}}">
                                                        <i class="fas fa-trash" style="font-size: 18px;"></i> <!-- Icono de papelera -->
                                                    </button>
                                                @else
                                                    <button style="width: 31%; height: 35px;" type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$paciente->id}}">
                                                        <i class="fas fa-undo" style="font-size: 18px;"></i> <!-- Icono de restaurar -->
                                                    </button>
                                                @endif
                                            </td>
                                            
                                            </tr>

                                            <!-- Modal -->
                                        <div class="modal fade" id="confirmModal-{{$paciente->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de confirmación</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ $paciente->estado == 1 ? '¿Seguro que quieres eliminar el paciente?' : '¿Seguro que quieres restaurar el paciente?' }}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                        <form action="{{ route('pacientes.destroy',['paciente'=>$paciente->id]) }}" method="post">
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

<script>

<!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

</script>

@endif

@endpush