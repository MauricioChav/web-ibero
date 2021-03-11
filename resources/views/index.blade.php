@extends('layouts.app')

@section('content')	

<div class="container-fluid mb-4">

	<div class="row align-items-center">
	
		<div class="col-md-8">
			<div class="title-page px-4 py-5">
			<h3 class="display-1">¡Bienvenido Usuario!</h3>
			<p class="lead">La besto aplicación de Tareas</p>
			
			<h3 style="color:red;" class="lead"><strong>Para cambiar el estado de una tarea haz click en su etiqueta</strong></h3>
			</div>
		</div>
		<div class="col-md-4">
			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#taskModal">
				Crear Nueva Tarea
			</button>
		
		</div>

	
	</div>
</div>

<div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear Nueva</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	  
	  <form method="POST" action="{{ route('tareas.store') }}">
      <div class="modal-body">
        <!--Campo de protección de Formulario-->
			{{ csrf_field() }}
			
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

<div class="container">
	<div class="row">
		
		<div class="col-md-12">
			
			<div class="card">
				<h5 class="card-header">Listado de tareas</h5>
				<div class="card-body">
				
				<table class="table">
				<thead>
				<tr>
				<th scope="col">#</th>
				<th scope="col">Tarea</th>
				<th scope="col">Descripción</th>
				<th scope="col">Fecha de Entrega</th>
				<th scope="col">Estado</th>
				<th scope="col">Acciones</th>
				</tr>
				</thead>
			<tbody>
			@foreach($tasks as $task)
				<tr>
					<th scope="row">{{ $task->id }}</th>
					<td>{{ $task->name }}</td>
					<td>{{ $task->description }}</td>
					<td>{{ $task->due_date }}</td>
					
					<td>
					<button type="button" class="btn btn-sm  btn-light" data-bs-toggle="modal" data-bs-target="#taskComplete_{{ $task->id }}">
					<!-- In Process -->
					@if($task->status == 0)
						<span class="badge bg-warning text-dark">En Proceso</span>
					
					
					<!-- Completed -->
					@else
						<span class="badge bg-success">	Completada</span>
					
					
					@endif
					</button>
					</td>
					
					<td>
						<a class="btn btn-sm btn-success" href="{{ route('tareas.show', $task->id) }}">Ver detalle</a>
						<!-- Button trigger modal -->
					<button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editTask_{{ $task->id }}">
						Editar Tarea
					</button>
					
					<form method="POST" action="{{ route('tareas.destroy', $task->id) }}">
						{{ csrf_field() }}	
						{{ method_field('DELETE') }}
						<button class="btn btn-sm btn-danger mt-2" type="submit">BORRAR REGISTRO</button>
						</form>
					</td>
					</tr>
					
				<div class="modal fade" id="editTask_{{ $task->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
					<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Editar Tarea</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
	  
				<form method="POST" action="{{ route('tareas.update', $task->id) }}">
				<div class="modal-body">
					
				<!--Campo de protección de Formulario-->
				{{ csrf_field() }}
				<!-- Se sobrescribe metodo, pues siempre se necesita de enviar la info como POST-->
				{{ method_field('PUT') }}
				<input type="hidden" name="origin" value=0>
				
				<input type="hidden" name="status" value={{ $task->status }}>
				
						<div class="form-group mb-3">
							<label>Nombre de tarea</label>
							<input class="form-control" type="text" name="name" placeholder="Nombre de tarea" value="{{ $task->name }}">
						</div>
			
						<div class="form-group mb-3">
							<label>Descripción</label>
							<textarea class="form-control" name="description">{{ $task->description }}</textarea>
						</div>
			
						<div class="form-group mb-3">
							<label>Fecha de entrega</label>
							<input class="form-control" type="date" name="due_date" value="{{ $task->due_date }}">
						</div>
						
						<div class="form-group mb-3">
						<label class="mt-3">Estatus:</label>
						
						<select class="form-control" name="status">
						<option value=0 @if($task->status == 0) selected @endif >En Proceso</option>
						<option value=1 @if($task->status == 1) selected @endif>Completada</option>
						</select>
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



				<div class="modal fade" id="taskComplete_{{ $task->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog">
									<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Estatus</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
					  
								<form method="POST" action="{{ route('tareas.update', $task->id) }}">
								<div class="modal-body">
									
								<!--Campo de protección de Formulario-->
								{{ csrf_field() }}
								<!-- Se sobrescribe metodo, pues siempre se necesita de enviar la info como POST-->
								{{ method_field('PUT') }}
								
								
							<input type="hidden" name="name" value="{{ $task->name }}">
							
							<input type="hidden" name="description" value="{{ $task->description }}">
						
							<input type="hidden" name="due_date" value="{{ $task->due_date }}">
						
								
								
								@if($task->status == 0)
								<input type="hidden" name="status" value=1>
								@else
								<input type="hidden" name="status" value=0>
								@endif
								
										<h4>¿Quieres cambiar el estado de la tarea "<strong>{{ $task->name }}</strong>" de 
										
										@if($task->status == 0)
										<span class="badge bg-warning text-dark">En Proceso</span> a <span class="badge bg-success">Completada</span>
										
										@else
										<span class="badge bg-success">Completada</span> a <span class="badge bg-warning text-dark">En Proceso</span>
										
										@endif
										?
										</h4>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-success">Si</button>
									<button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
								</div>
								</form>
					  
					</div>
				  </div>
				</div>
			@endforeach
				
			</tbody>
			</table>
					
				</div>
				
			</div>
			
			
		</div>
	</div>
</div>

	
	
	
@endsection
