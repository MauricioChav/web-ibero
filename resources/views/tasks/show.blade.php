@extends('layouts.master')

@section('content')

<div class="container">
	<div class="row mt-4">
		<div class="col-md-8">
	
			<h2 class="green-title"> {{ $task->name }} </h2>
			<p> {{ $task->description }} </p>
			<h3> <span class="green-title"> Fecha de entrega:</span> {{ $task->due_date }} </h3>
			<h5 class="mb-5"> <span class="green-title"> Estatus: </span>
			@if($task->status == 0)
			<span class="badge bg-warning text-dark">En Proceso</span>
			@else
			<span class="badge bg-success">Completada</span>
			@endif
			</h5>
			<a class="btn btn-secondary" href="{{ route('tareas.index') }}">Regresar a Tareas</a>
			<a class="btn btn-secondary" href="{{ route('proyectos.index') }}">Regresar a Proyectos</a>
			
		</div>
		
		<div class="col-md-4" style="text-align: right;">
		<a class="btn btn-info mt-2" href="{{ route('tareas.edit', $task->id) }}">Editar Tarea</a>
	
			<form method="POST" action="{{ route('tareas.destroy', $task->id) }}">
			{{ csrf_field() }}	
			{{ method_field('DELETE') }}
			<button class="btn btn-danger mt-2" type="submit">BORRAR</button>
			</form>
			
		</div>
	</div>
</div>

	
	
@endsection