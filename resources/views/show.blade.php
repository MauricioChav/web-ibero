@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row mt-4">
		<div class="col-md-8">
	
			<h2> {{ $task->name }} </h2>
			<p> {{ $task->description }} </p>
			<h3> Fecha de entrega: {{ $task->due_date }} </h3>
			<h5> Estatus: 
			@if($task->status == 0)
			<span class="badge bg-warning text-dark">En Proceso</span>
			@else
			<span class="badge bg-success">Completada</span>
			@endif
			</h5>
			<a class="btn btn-secondary" href="{{ route('tareas.index') }}">Regresar</a>
			
		</div>
		
		<div class="col-md-4">
		<a class="btn btn-primary mt-2" href="{{ route('tareas.edit', $task->id) }}">Editar Tarea</a>
	
			<form method="POST" action="{{ route('tareas.destroy', $task->id) }}">
			{{ csrf_field() }}	
			{{ method_field('DELETE') }}
			<button class="btn btn-danger mt-2" type="submit">BORRAR REGISTRO</button>
			</form>
			
		</div>
	</div>
</div>

	
	
@endsection