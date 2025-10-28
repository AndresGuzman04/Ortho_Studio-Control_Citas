
@extends('layouts.app')

@section('title', 'Citas')


@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="calendar/css/calendar.css">
@endpush

@section('content')

@include('layouts.partials.alert')

<div class="container-fluid">

		<div class="content w-100" style="height: auto; background: none;" >
			<div class="d-flex gap-2 justify-content-center">
				<input type="date" id="buscarFecha" class="form-control" style="max-width: 200px;">
				<input type="text" id="buscarPaciente" class="form-control" placeholder="Buscar por paciente ID o nombre...">
				<button id="btnBuscar" class="btn btn-primary">Buscar</button>
				<button id="btnLimpiar" class="btn btn-secondary">Limpiar</button>
			</div>
		</div>

		<div class="content w-100">
			
			<div class="calendar-container">
				
				      <div class="calendar"> 
				        <div class="year-header"> 
				          <span class="left-button fa fa-chevron-left" id="prev"> </span> 
				          <span class="year" id="label"></span> 
				          <span class="right-button fa fa-chevron-right" id="next"> </span>
				        </div> 
				        <table class="months-table w-100"> 
				          <tbody>
				            <tr class="months-row">
				              <td class="month">Jan</td> 
				              <td class="month">Feb</td> 
				              <td class="month">Mar</td> 
				              <td class="month">Apr</td> 
				              <td class="month">May</td> 
				              <td class="month">Jun</td> 
				              <td class="month">Jul</td>
				              <td class="month">Aug</td> 
				              <td class="month">Sep</td> 
				              <td class="month">Oct</td>          
				              <td class="month">Nov</td>
				              <td class="month">Dec</td>
				            </tr>
				          </tbody>
				        </table> 
				        
				        <table class="days-table w-100"> 
				          <td class="day">Sun</td> 
				          <td class="day">Mon</td> 
				          <td class="day">Tue</td> 
				          <td class="day">Wed</td> 
				          <td class="day">Thu</td> 
				          <td class="day">Fri</td> 
				          <td class="day">Sat</td>
				        </table> 
				        <div class="frame"> 
				          <table class="dates-table w-100"> 
			              <tbody class="tbody">             
			              </tbody> 
				          </table>
				        </div> 
						<div class="mb-4 d-flex gap-2">
							<a href="{{ route('citas.create') }}">
								<button class="btn mr-3 btn-primary">Añadir Cita</button>
							</a>
							<a href="#">
								<button class="btn btn-primary">Generar Reporte General</button>
							</a>
						</div>
				      </div>
				    </div>
				    <div class="events-container">
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

<script>
    var event_data = {
        events: @json($citas_json)
    };
    //console.log(event_data);

</script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="calendar/js/popper.js"></script>
<script src="calendar/js/bootstrap.min.js"></script>
<script src="calendar/js/main.js"></script>


<script>
const btnBuscar = document.getElementById("btnBuscar");

// Función de búsqueda (la que ya tienes)
function buscarCitas() {
    const fechaBuscada = document.getElementById("buscarFecha").value;
    const pacienteBuscado = document.getElementById("buscarPaciente").value.toLowerCase();

    const resultados = event_data.events.filter(e => {
        const fechaCompleta = `${e.year}-${String(e.month).padStart(2,'0')}-${String(e.day).padStart(2,'0')}`;
        const coincideFecha = fechaBuscada ? fechaCompleta === fechaBuscada : true;
        const coincidePaciente = pacienteBuscado ? 
            (e.paciente_id?.toString().includes(pacienteBuscado) || 
             (e.paciente ?? '').toLowerCase().includes(pacienteBuscado)) : true;
        return coincideFecha && coincidePaciente;
    });

    const fecha = fechaBuscada ? new Date(fechaBuscada) : new Date();
    const month = fecha.toLocaleString('es-ES', { month: 'long' });
    const day = fecha.getUTCDate();

    show_events(resultados, month, day);
	console.log(day);
}

// Botón clic
btnBuscar.addEventListener("click", buscarCitas);

// Presionar Enter en cualquier input dispara la búsqueda
document.querySelectorAll("#buscarFecha, #buscarPaciente").forEach(input => {
    input.addEventListener("keydown", function(e) {
        if (e.key === "Enter") {
            e.preventDefault(); // evita que se recargue la página si está en un form
            buscarCitas();
        }
    });
});


function limpiarBusqueda() {
    // Limpiar inputs
    document.getElementById("buscarFecha").value = '';
    document.getElementById("buscarPaciente").value = '';

    // Mostrar todas las citas del día actual
    const fecha = new Date();
    const month = fecha.toLocaleString('es-ES', { month: 'long' });
    const day = fecha.getDate();

    // Mostrar todos los eventos de hoy
    const eventosHoy = event_data.events.filter(e => {
        return e.year === fecha.getFullYear() &&
               e.month === fecha.getMonth() + 1 &&
               e.day === day;
    });

    show_events(eventosHoy, month, day);
}

// Asignar al botón
document.getElementById("btnLimpiar").addEventListener("click", limpiarBusqueda);


</script>

  <script>
    const csrfToken = "{{ csrf_token() }}";
</script>


@endpush




