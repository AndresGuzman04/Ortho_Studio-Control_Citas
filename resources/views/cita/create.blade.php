@extends('layouts.app')

@section('title', 'Crear Cita')

@push('css')
    <style>
        /* Para marcar opciones no seleccionables */
    .hora-ocupada {
        color: red !important;
        font-weight: bold;
    }
    </style>
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
                    <input hidden type="number" name="user_id" id="user_id"  
                               value="{{ auth()->user()->user_id }}" >

                    <!-- Fecha y hora
                    <div class="col-md-6">
                        <label for="fecha_hora" class="form-label">Fecha y Hora</label>
                        <input type="datetime-local" name="fecha_hora" id="fecha_hora" class="form-control" 
                               value="{{ old('fecha_hora') }}" required>
                        @error('fecha_hora')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>-->

                    <!-- FECHA -->
                    <div class="col-md-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" name="fecha" id="fecha" class="form-control" required>
                    </div>

                    <!-- HORAS DISPONIBLES -->
                    <div class="col-md-3">
                        <label for="hora" class="form-label">Hora</label>
                        <select id="hora" name="hora" class="form-control" required>
                            <option value="">Seleccione una fecha...</option>
                        </select>
                    </div>

                    @error('fecha_hora')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    <!-- Motivo -->
                    <div class="col-md-12">
                        <label for="motivo" class="form-label">Motivo</label>
                        <textarea name="motivo" id="motivo" class="form-control">{{ old('motivo') }}</textarea>
                        @error('motivo')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Estado -->
                        <select hidden name="estado" id="estado" class="form-control" required>
                            <option value="pendiente" selected >Pendiente</option>
                            <option value="confirmada" >Confirmada</option>
                            <option value="cancelada" >Cancelada</option>
                        </select>

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
<script>
// Citas enviadas desde Laravel (sin rutas, sin AJAX)
    let citas = @json($citas_json);
document.getElementById("fecha").addEventListener("change", function () {

    const fecha = this.value;
    if (!fecha) return;

    const [year, month, day] = fecha.split("-");

    // Normalizamos la fecha seleccionada a "YYYY-MM-DD"
    const fechaSeleccionada = `${year}-${month}-${day}`;

    // Buscar las citas de ese día
    const ocupadas = citas
        .filter(c => {
            const fechaCita = `${c.year}-${String(c.month).padStart(2, "0")}-${String(c.day).padStart(2, "0")}`;
            return fechaCita === fechaSeleccionada;
        })
        .map(c => c.hour);

    console.log("Horas ocupadas:", ocupadas);

    const ocupadasSet = new Set(ocupadas);

    // Generar horas en intervalos de 20 minutos
    const todasLasHoras = [];
    let inicio = 7 * 60;
    let fin = 17 * 60;

    for (let min = inicio; min <= fin; min += 20) {
        const h = String(Math.floor(min / 60)).padStart(2, "0");
        const m = String(min % 60).padStart(2, "0");
        todasLasHoras.push(`${h}:${m}`);
    }

    const select = document.getElementById("hora");
    select.innerHTML = `<option value="">Seleccione una hora...</option>`;

    todasLasHoras.forEach(hora => {
        const option = document.createElement("option");
        option.textContent = hora;

        if (ocupadasSet.has(hora)) {
            option.disabled = true;
            option.classList.add("hora-ocupada");
            option.style.color = "red";
        } else {
            option.value = hora;
        }

        select.appendChild(option);
    });  

});


</script>
@endpush
