@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
             <div class="card mt-5">
                <div class="card-header green-title"><h1 class="green-title">Editar {{ $task->name }} </h1></div>
                <div class="card-body">
	
				<form method="POST" action="{{ route('tareas.update', $task->id) }}">
					<!--Campo de protección de Formulario-->
					{{ csrf_field() }}
					<!-- Se sobrescribe metodo, pues siempre se necesita de enviar la info como POST-->
					{{ method_field('PUT') }}
					
					<input type="hidden" name="origin" value=1>

					<input type="hidden" name="project_id" value={{ $task->project_id }}>
					
					<div class="form-group row">
							<div class="col-9" style="margin: auto;">
	                            
								<label class="mt-3">Nombre de tarea</label>

								<input maxlength="35" class="form-control" type="text" name="name" placeholder="Nombre de tarea" value="{{ $task->name }}">
								
						</div>
					</div>
					
					
					<div class="form-group row">
						<div class="col-9" style="margin: auto;">
						<label class="mt-3">Descripción</label>
						<br>
						<textarea class="form-control" name="description">{{ $task->description }}</textarea>
					</div>
					</div>
					
					
					<div class="form-group row">
						<div class="col-9" style="margin: auto;">
						<label class="mt-3">Fecha de entrega:</label>
						
						<input class="form-control" type="date" name="due_date" value="{{ $task->due_date }}">
					</div>
					</div>
					
					<div class="form-group row">
						<div class="col-9" style="margin: auto;">
						<label class="mt-3">Estatus:</label>
						
						<select class="form-control" name="status">
						<option value=0 @if($task->status == 0) selected @endif >En Proceso</option>
						<option value=1 @if($task->status == 1) selected @endif>Completada</option>
						</select>
					</div>
					</div>
					
					
					<div class="form-group row mb-0">
                            <div class="col-9" style="margin: auto;">
					<button class="btn btn-primary mt-3" type="submit">Guardar Tarea</button>
					<a class="btn btn-secondary mt-3" href="{{ route('tareas.show', $task->id) }}">Regresar</a>
				</div>
			</div>

				</form>
			</div>
		</div>
        </div>
    </div>
</div>
	
@endsection