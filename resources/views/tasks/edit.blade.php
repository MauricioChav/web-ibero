@extends('layouts.master')

@section('content')
	
	<div class="container">
		<div class="row mt-4">
			<div class="col-sm-8">
				<h1>Editar </h1>
	
				<form method="POST" action="{{ route('tareas.update', $task->id) }}">
					<!--Campo de protección de Formulario-->
					{{ csrf_field() }}
					<!-- Se sobrescribe metodo, pues siempre se necesita de enviar la info como POST-->
					{{ method_field('PUT') }}
					
					<input type="hidden" name="origin" value=1>
					
					<div class="form-group mb-3">
						<label class="mt-3">Nombre de tarea</label>
						<br>
						<input class="form-control" type="text" name="name" placeholder="Nombre de tarea" value="{{ $task->name }}">
					</div>
					
					
					<div class="form-group mb-3">
						<label class="mt-3">Descripción</label>
						<br>
						<textarea class="form-control" name="description">{{ $task->description }}</textarea>
					</div>
					
					
					<div class="form-group mb-3">
						<label class="mt-3">Fecha de entrega:</label>
						
						<input class="form-control" type="date" name="due_date" value="{{ $task->due_date }}">
					</div>
					
					<div class="form-group mb-3">
						<label class="mt-3">Estatus:</label>
						
						<select class="form-control" name="status">
						<option value=0 @if($task->status == 0) selected @endif >En Proceso</option>
						<option value=1 @if($task->status == 1) selected @endif>Completada</option>
						</select>
					</div>
					
					
					<button class="btn btn-success mt-3" type="submit">Guardar Tarea</button>
					<a class="btn btn-secondary mt-3" href="{{ route('tareas.show', $task->id) }}">Regresar</a>
				</form>
			</div>
			<div class="col-sm-4">
			
			</div>
		</div>
	</div>
	
	
@endsection