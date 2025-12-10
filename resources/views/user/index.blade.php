@extends('layouts.app')

@section('title','usuarios')

@push('css-datatable')
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

@endpush

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')

@include('layouts.partials.alert')

<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Usuarios</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Usuarios</li>
    </ol>

    @can('crear-usuario')
    <div class="mb-4">
        <a href="{{route('users.create')}}">
            <button type="button" class="btn btn-primary">
                Añadir nuevo usuario</button>
        </a>
    </div>
    @endcan
   

    <div class="card">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tabla de usuarios
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped fs-6">
                <thead>
                    <tr>
                        <th>Alias</th>
                        <th>Email</th>
                        <th>Puesto</th>
                        <th>Rol</th>
                        <th></th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $item)
                    <tr>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->puesto}}</td>
                        <td>
                            {{$item->getRoleNames()->first()}}
                        </td>
                        <td style="padding: 0">
                                                <div class="container" style="font-size: small;">
                                                    @if ($item->estado == 1)
                                                    <div class="row">
                                                        <span  class="">🟢</span>
                                                    </div>
                                                    @else
                                                    <div class="row">
                                                        <span  class="">🔴</span>
                                                    </div>
                                                    @endif
                                                </div>
                                            </td>
                        <td style="padding: 8px 0px">

                            @can('editar-usuario')
                            <!-- Botón Editar -->
                            <form action="{{ route('users.edit', ['user' => $item]) }}" method="get" class="d-inline">
                                <button style="width: 2rem; height: 35px;" type="submit" class="btn btn-secondary btn-sm" title="Editar">
                                    <i class="fas fa-edit" style="font-size: 18px; color: white;"></i>
                                </button>
                            </form>
                            @endcan
                            
                            @can('eliminar-usuario')
                            <!-- Botón Eliminar o Restaurar -->
                            @if ($item->estado == 1)
                                <button style="width: 2rem; height: 35px;" 
                                        type="button"
                                        class="btn btn-danger btn-sm"
                                        title="Desactivar"
                                        data-bs-toggle="modal"
                                        data-bs-target="#confirmModal-{{ $item->id }}">
                                    <i class="fas fa-trash" style="font-size: 18px; color:white;"></i>
                                </button>
                            @else
                                <button style="width: 2rem; height: 35px;" 
                                        type="button"
                                        class="btn btn-success btn-sm"
                                        title="Restaurar"
                                        data-bs-toggle="modal"
                                        data-bs-target="#confirmModal-{{ $item->id }}">
                                    <i class="fas fa-undo" style="font-size: 18px; color:white;"></i>
                                </button>
                            @endif
                            @endcan

                        </td>

                    </tr>

                    <!-- Modal de confirmación-->
                    <div class="modal fade" id="confirmModal-{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de confirmación</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{ $item->estado == 1 ? '¿Seguro que quieres desactivar el usuario?' : '¿Seguro que quieres restaurar el usuario?' }}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <form action="{{ route('users.destroy',['user'=>$item->id]) }}" method="post">
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
@endpush