@extends('layouts.master')

@section('content')	

<div class="px-4 pt-5 my-5 text-center border-bottom">
  <h1 class="display-4 fw-bold">La mejor App de Tareas</h1>
  <div class="col-lg-6 mx-auto">
    <p class="lead mb-4">¿Cansado de vivir? Esta app no te ayudará con eso, pero te ayudará para poder registrar tus tareas. Así podrás estar sad, pero al menos podrás trabajar eficientemente.</p>

    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
      <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-4 me-sm-3">Registrate Ahora</a>
      <a href="" class="btn btn-outline-secondary btn-lg px-4">Conoce más</a>
    </div>
  </div>
  <div class="overflow-hidden" style="max-height: 30vh;">
    <div class="container px-5">
      
    </div>
  </div>
</div>

@endsection