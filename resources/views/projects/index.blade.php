@extends('layouts.master')

@section('content')	

<div class="container-fluid mb-4">

	<div class="row align-items-center">
	
		<div class="col-md-4">
			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#projectModal">
				Crear Nuevo Proyecto
			</button>
		
		</div>

	
	</div>
</div>

<div class="modal fade" id="projectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear Nuevo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	  
	  <form method="POST" action="{{ route('proyectos.store') }}">
      <div class="modal-body">
        <!--Campo de protección de Formulario-->
			{{ csrf_field() }}
			
			<div class="form-group mb-3">
				<label>Nombre de proyecto</label>
				<input class="form-control" type="text" name="name" placeholder="Nombre de proyecto">
			</div>
			
			<div class="form-group mb-3">
				<label>Descripción</label>
				<textarea class="form-control" name="description"></textarea>
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
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Nueva tarea de {{ $project->name }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	  
	  <form method="POST" action="{{ route('tareas.store') }}">
      <div class="modal-body">
        <!--Campo de protección de Formulario-->
			{{ csrf_field() }}
			
			<input class="form-control" type="hidden" name="project_id" value="{{ $project->id }}">

			<div class="form-group mb-3">
				<label>Nombre de tarea</label>
				<input class="form-control" type="text" name="name" placeholder="Nombre de tarea">
			</div>
			
			<div class="form-group mb-3">
				<label>Descripción</label>
				<textarea class="form-control" name="description"></textarea>
			</div>
			
			<div class="form-group mb-3">
				<label>Fecha de entrega</label>
				<input class="form-control" type="date" name="due_date">
			</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
      </div>
	  </form>
	  
    </div>
  </div>
</div>
@endforeach


<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<h5 class="card-header">Listado de Proyectos</h5>
				<div class="card-body">
					<h5 class="card-title">Proyectos en curso</h5>
					<p class="card-text">Este es tu listado principal de proyectos, ponte a trabajar.</p>
				</div>
			</div>
		</div>
	</div>

<div class="row">
	@foreach($projects as $project)
	<div class="col-md-4 mt-4">
			<div class="card">
				<div class="line-color" style="height: 5px; width: 100%; background-color: {{ $project->hex }};"></div>

					<div class="card-body">
						<h4>{{ $project->name }}</h4>
						<p>{{ $project->description }}</p>
					</div>

					<div class="tasks">
						<ul>
							@foreach($project->tasks as $task)
							<li>{{ $task->name }}</li>
							@endforeach
							
						</ul>
					</div>

					<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#taskModal_{{ $project->id }}">
				Crear Nueva Tarea
			</button>

				</div>

			</div>
			
	
	@endforeach

	</div>
</div>

	
@endsection
