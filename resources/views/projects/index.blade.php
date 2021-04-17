@extends('layouts.master')

@section('content')	

<div class="container my-4">

	<div class="row align-items-center">
	
		<div class="col-md-4">
			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#projectModal">
				Crear Nuevo Proyecto
			</button>
		
		</div>

	
	</div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title green-title-sm" id="exampleModalLabel">Borrar proyecto</h5>
        <button type="button" class="btn-close btn-primary" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	  
      <div class="row">
      <div class="modal-r-body col-8" style="margin: auto;">
			
			<div class="form-group mb-3">
				<h1>¿Estas seguro de que quieres borrar <span id="deleteName" class="green-title-sm"></span> de la lista de proyectos?</h1>
				<br>
				<h3 class="red-title">Borrar el proyecto también eliminara todas las tareas que pertenezcan al mismo</h3>
				
			</div>
			
			
      </div>
  </div>
      <div class="modal-footer col-8" style="margin: auto;">
		<form id="deleteForm" method="POST" action="">
			{{ csrf_field() }}	
			{{ method_field('DELETE') }}
		<button class="btn btn-danger" type="submit">BORRAR</button>
		</form>

        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        
      </div>
	  
	  
    </div>
  </div>
</div>


<div class="modal fade" id="projectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title green-title-sm" id="exampleModalLabel">Crear Nuevo Proyecto</h5>
        <button type="button" class="btn-close btn-primary" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	  
	  <form method="POST" action="{{ route('proyectos.store') }}">
      <div class="row">
      <div class="modal-r-body col-8" style="margin: auto;">
        <!--Campo de protección de Formulario-->
			{{ csrf_field() }}
			
			<div class="form-group mb-3">
				<label>Nombre de proyecto</label>
				<input maxlength="35" required class="form-control" type="text" name="name" placeholder="Nombre de proyecto">
			</div>
			
			<div class="form-group mb-3">
				<label>Descripción</label>
				<textarea required class="form-control" name="description"></textarea>
			</div>
			
			<div class="form-group mb-3">
				<label>Fecha de finalización</label>
				<input class="form-control" type="date" name="final_date">
			</div>

			<div class="form-group mb-3">
				<label>Color</label>
				<input class="form-control" type="color" name="hex">
			</div>
      </div>
  </div>
      <div class="modal-footer col-8" style="margin: auto;">
      	<button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        
      </div>
	  </form>
	  
    </div>
  </div>
</div>


<!-- Modal de Tareas-->
@foreach($projects as $project)
<div class="modal fade" id="taskModal_{{ $project->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title green-title-sm" id="exampleModalLabel">Nueva tarea de {{ $project->name }}</h5>
        <button type="button" class="btn-close btn-primary" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	  
	  <form method="POST" action="{{ route('tareas.store') }}">
	  	<div class="row">
      <div class="modal-r-body col-8" style="margin: auto;">
        <!--Campo de protección de Formulario-->
			{{ csrf_field() }}
			
			<input class="form-control" type="hidden" name="project_id" value={{ $project->id }}>

			<div class="form-group mb-3">
				<label>Nombre de tarea</label>
				<input maxlength="35" required class="form-control" type="text" name="name" placeholder="Nombre de tarea">
			</div>
			
			<div class="form-group mb-3">
				<label>Descripción</label>
				<textarea required class="form-control" name="description"></textarea>
			</div>
			
			<div class="form-group mb-3">
				<label>Fecha de entrega</label>
				<input class="form-control" type="date" name="due_date">
			</div>
      </div>
  </div>
      <div class="modal-footer col-8" style="margin: auto;">
      	<button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        
      </div>
	  </form>
	  
    </div>
  </div>
</div>
@endforeach


<div class="container">
	<div class="container-fluid">
    <div class="px-4 mb-5 text-center">
      <h1 class="display-4 fw-bold green-title">Listado de Proyectos</h1>
      <div class="col-lg-6 mx-auto">
        <p class="lead mb-4">Estos son tus proyectos creados</p>

      </div>
      <div class="overflow-hidden" style="max-height: 30vh;">
        <div class="container px-5">
          
        </div>
      </div>
    </div>
</div>

<script type="text/javascript">
	function sendDeleteInfo(id, projectName) {
  		document.getElementById("deleteName").innerHTML = projectName;
  		document.getElementById("deleteForm").action = "{{ route('proyectos.destroy', "") }}" + "/" + id;
	}
</script>

<div class="row">
	@foreach($projects as $project)
	<div class="col-md-4 mt-4">
			<div class="card">

					<div class="card-body row">
						<div class="col-9">
							<h4 class="green-title-sm">{{ $project->name }}</h4>
						</div>

						<div class="col-1 text-center">

							<button class="btn btn-sm btn-info mt-2" type="button" data-bs-toggle="modal" data-bs-target="#editProject_{{ $project->id }}" onclick="sendDeleteInfo({{ $project->id }}, '{{ $project->name }}' )"><ion-icon name="create-outline"></ion-icon></button>
							
						</div>

						<div class="col-2 text-center">

							<button class="btn btn-sm btn-danger mt-2" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="sendDeleteInfo({{ $project->id }}, '{{ $project->name }}' )"><ion-icon name="trash-outline"></ion-icon></button>
							
						</div>
						
					</div>

					<div class="line-color" style="height: 8px; width: 100%; background-color: {{ $project->hex }};"></div>

					<div class="card-body">
						<p>{{ $project->description }}</p>
					</div>

					<div class="tasks">
						<ul>

							@foreach($project->tasks as $task)
							<li>
								<div class="row container"> 
							<div class="col-8"> 
								<a class="btn btn-sm
								@php
								if($task->status == 0 && $task->due_date < date("Y-m-d")){
									echo "btn-danger";
								}else{
									echo "btn-primary";
								}
							@endphp

								 " href="{{ route('tareas.show', $task->id) }}">{{$task->name}}
								 @php
								if($task->status == 0 && $task->due_date < date("Y-m-d")){
									echo "(Vencida)";
								}
							@endphp
								</a>
							</div>

							<div class="col-4 mb-4" style="text-align: right; color: 
							@php
								if($task->status == 0 && $task->due_date < date("Y-m-d")){
								echo "red";
							}else{
								echo "#17C117";
						}
							@endphp

							"> 
								<p>{{ $task->due_date }}</p>
							</div>
						</div>
						</li>
							@endforeach
							
						</div>
						</ul>
						
					

					<button type="button" class="btn btn-rect btn-primary" data-bs-toggle="modal" data-bs-target="#taskModal_{{ $project->id }}">
				Crear Nueva Tarea
			</button>

				</div>

			</div>

			<div class="modal fade" id="editProject_{{ $project->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
					<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title green-title-sm">Editar Proyecto {{$project->name}}</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
	  
				<form method="POST" action="{{ route('proyectos.update', $project->id) }}">
					<div class="row">
		      			<div class="modal-r-body col-8" style="margin: auto;">
							
						<!--Campo de protección de Formulario-->
						{{ csrf_field() }}
						<!-- Se sobrescribe metodo, pues siempre se necesita de enviar la info como POST-->
						{{ method_field('PUT') }}
						
								<div class="form-group mb-3">
									<label>Nombre de proyecto</label>
									<input maxlength="35" required class="form-control" type="text" name="name" placeholder="Nombre de proyecto" value="{{ $project->name }}">
								</div>
								
								<div class="form-group mb-3">
									<label>Descripción</label>
									<textarea required class="form-control" name="description">{{ $project->description }}</textarea>
								</div>
								
								<div class="form-group mb-3">
									<label>Fecha de finalización</label>
									<input class="form-control" type="date" name="final_date" value="{{ $project->final_date }}">
								</div>

								<div class="form-group mb-3">
									<label>Color</label>
									<input class="form-control" type="color" name="hex" value="{{ $project->hex }}">
								</div>
						</div>
					</div>
						<div class="modal-r-body col-8" style="margin: auto;">
							<button type="submit" class="btn btn-primary">Guardar Cambios</button>
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
						</div>
				</form>
	  
    </div>
  </div>
</div>
			
	
	@endforeach

	</div>
</div>

	
@endsection
