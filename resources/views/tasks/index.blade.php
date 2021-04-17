@extends('layouts.master')

@section('content')	

<div class="container my-4">

	<div class="row align-items-center">
		<div class="col-md-4">
		@if(count( $projects ) == 0)
		<a href="{{ route('proyectos.index') }}" class="btn btn-primary btn-lg px-4 me-sm-3">Ir a Proyectos</a>
		@else
			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#taskModal">
				Crear Nueva Tarea
			</button>

		@endif


		
		</div>

	
	</div>
</div>
<div class="container">
<div class="container-fluid">
    <div class="px-4 mb-5 text-center">
      <h1 class="display-4 fw-bold green-title">Listado de Tareas</h1>
      <div class="col-lg-6 mx-auto">
        <p class="lead mb-4">Aqui podrás visualizar un listado completo de tareas</p>
        
        @if(count( $projects ) == 0)
         <p class="lead mb-4" style="font-weight: bold;
">*Para comenzar a crear tareas, cree un proyecto primero*</p>

        @else

        <p class="lead mb-4" style="font-weight: bold;
">*Para editar el estado de una tarea haz click en su etiqueta*</p>

        @endif

        

      </div>
      <div class="overflow-hidden" style="max-height: 30vh;">
        <div class="container px-5">
          
        </div>
      </div>
    </div>
</div>
</div>



<div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title green-title-sm" id="exampleModalLabel">Crear Nueva Tarea</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	  
	  <form method="POST" action="{{ route('tareas.store') }}">
      <div class="row">
      	<div class="modal-r-body col-8" style="margin: auto;">
        <!--Campo de protección de Formulario-->
			{{ csrf_field() }}
			
			<div class="form-group mb-3">
				<label>Nombre de tarea</label>
				<input maxlength="35" required class="form-control" type="text" name="name" placeholder="Nombre de tarea">
			</div>
			
			<div class="form-group mb-3">
				<label>Descripción</label>
				<textarea required class="form-control" name="description"></textarea>
			</div>

			<div class="form-group mb-3">
				<label>Proyectos</label>
				<select class="form-control" name="project_id">
					@foreach($projects as $project)
					<option value="{{ $project->id }}">{{ $project->name }}</option>
					@endforeach
				</select>
			</div>
			
			<div class="form-group mb-3">
				<label>Fecha de entrega</label>
				<input required class="form-control" type="date" name="due_date">
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

<div class="container">
	<div class="row">
		
		<div class="col-md-12">
			
			<div class="card">
				
				<div class="card-body">
				
				<table class="table">
				<thead>
				<tr>
				<th scope="col">Proyecto</th>
				<th scope="col">Tarea</th>
				<th scope="col">Descripción</th>
				<th scope="col">Fecha de Entrega</th>
				<th scope="col">Estado</th>
				<th scope="col">Acciones</th>
				</tr>
				</thead>
			<tbody>
			@foreach($tasks as $task)

					@php
					$projectname = "";
					$projectcolor = "";
					$dateColor = 1;
					@endphp

					@foreach($projects as $project)
					@php
					if($project->id == $task->project_id){

						$projectname = $project->name;
						$projectcolor = $project->hex;

					}

					@endphp

					@endforeach

				<tr style="background-color: {{ $projectcolor }}70;">
					<th scope="row">{{ $projectname }}</th>
					<td>{{ $task->name }}</td>
					<td>{{ $task->description }}</td>

					@php
						if($task->status != 0){
							$dateColor = 2;

						}else{
							
							if($task->due_date < date("Y-m-d")){
								$dateColor = 0;
							}else{
								$dateColor = 1;

							}
						}

						
					@endphp

					<td style="font-weight: bold; color: 
					@php
						if($dateColor == 0){
							echo "#ED1818";
						}else if($dateColor == 1){
							echo "white";
					}else{
						echo "#17C117;";
				}
					@endphp
					">{{ $task->due_date }}</td>
					
					<td>
					<button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#taskComplete_{{ $task->id }}">
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
						<a class="btn btn-sm btn-primary" href="{{ route('tareas.show', $task->id) }}">Ver detalle</a>
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
				<tr style="height: 20px !important;"></tr>
					
				<div class="modal fade" id="editTask_{{ $task->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
					<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title green-title-sm">Editar Tarea {{$task->name}}</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
	  
				<form method="POST" action="{{ route('tareas.update', $task->id) }}">
					<div class="row">
		      			<div class="modal-r-body col-8" style="margin: auto;">
							
						<!--Campo de protección de Formulario-->
						{{ csrf_field() }}
						<!-- Se sobrescribe metodo, pues siempre se necesita de enviar la info como POST-->
						{{ method_field('PUT') }}
						<input type="hidden" name="origin" value=0>
						
						<input type="hidden" name="status" value={{ $task->status }}>
						<input type="hidden" name="project_id" value={{ $task->project_id }}>
						
								<div class="form-group mb-3">
									<label>Nombre de tarea</label>
									<input maxlength="35" required class="form-control" type="text" name="name" placeholder="Nombre de tarea" value="{{ $task->name }}">
								</div>
					
								<div class="form-group mb-3">
									<label>Descripción</label>
									<textarea required class="form-control" name="description">{{ $task->description }}</textarea>
								</div>
					
								<div class="form-group mb-3">
									<label>Fecha de entrega</label>
									<input required class="form-control" type="date" name="due_date" value="{{ $task->due_date }}">
								</div>
								
								<div class="form-group mb-3">
								<label class="mt-3">Estatus:</label>
								
								<select class="form-control" name="status">
								<option value=0 @if($task->status == 0) selected @endif >En Proceso</option>
								<option value=1 @if($task->status == 1) selected @endif>Completada</option>
								</select>
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



				<div class="modal fade" id="taskComplete_{{ $task->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog">
									<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title green-title-sm">Estatus</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
					  
								<form method="POST" action="{{ route('tareas.update', $task->id) }}">
									<div class="row">
			      						<div class="modal-r-body col-8" style="margin: auto;">
												
											<!--Campo de protección de Formulario-->
											{{ csrf_field() }}
											<!-- Se sobrescribe metodo, pues siempre se necesita de enviar la info como POST-->
											{{ method_field('PUT') }}
											
											
										<input type="hidden" name="name" value="{{ $task->name }}">
										
										<input type="hidden" name="description" value="{{ $task->description }}">
									
										<input type="hidden" name="due_date" value="{{ $task->due_date }}">

										<input type="hidden" name="project_id" value={{ $task->project_id }}>
									
											
											
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
											<div class="modal-footer col-8" style="margin: auto;">
												<button type="submit" class="btn btn-primary">Si</button>
												<button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
										</div>
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
