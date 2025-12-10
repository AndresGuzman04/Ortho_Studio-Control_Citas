@extends('layouts.app')

@section('title','Panel')

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
<div class="container-fluid">

@if (session('success'))
<script>
    Swal.fire({
    title: "{{ session('success') }}",
    showClass: {
        popup: `
        animate__animated
        animate__fadeInUp
        animate__faster
        `
    },
    hideClass: {
        popup: `
        animate__animated
        animate__fadeOutDown
        animate__faster
        `
    }
    });
</script>
@endif

@php
    use App\Models\Cita;

    $totalMes = Cita::whereMonth('fecha_hora', now()->month)
                    ->whereYear('fecha_hora', now()->year)
                    ->count();

    $pendientesMes = Cita::where('estado', 'pendiente')
                         ->whereMonth('fecha_hora', now()->month)
                         ->whereYear('fecha_hora', now()->year)
                         ->count();

    $confirmadasMes = Cita::where('estado', 'confirmada')
                          ->whereMonth('fecha_hora', now()->month)
                          ->whereYear('fecha_hora', now()->year)
                          ->count();

    $canceladasMes = Cita::where('estado', 'cancelada')
                         ->whereMonth('fecha_hora', now()->month)
                         ->whereYear('fecha_hora', now()->year)
                         ->count();
@endphp

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Total citas mes -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Citas (Mes)
                                            </div>

                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $totalMes }}
                                            </div>
                                        </div>

                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pendientes mes -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Completas (Mes)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $confirmadasMes }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pendientes mes -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Pendientes (Mes)
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $pendientesMes}}</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Canceladas mes -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Total Canceladas (Mes)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $canceladasMes}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                </div>
@endsection


@push('js')
<!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

@endpush