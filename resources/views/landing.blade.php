@extends('layouts.master')

@section('content')	
<div class="container-fluid cover-img">
    <div class="px-4 mb-5 text-center front-banner">
      <h1 class="display-4 fw-bold">La App de Tareas más Eficiente </h1>
      <div class="col-lg-6 mx-auto">
        <p class="lead mb-4">IoTareas te permite gestionar tus labores de una manera organizada e intuitiva</p>

        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
          <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-4 me-sm-3">Registrate Ahora</a>
        </div>
      </div>
      <div class="overflow-hidden" style="max-height: 30vh;">
        <div class="container px-5">
          
        </div>
      </div>
    </div>
</div>

<div class="container">
  <div class="row">
        <div class="col-4 text-center">
          <img class="home-icon" src="{{ asset('css/img/Icon_Homework.png') }}">
          <h2>Control Sobre tus tareas</h2>
        </div>

        <div class="col-4 text-center">
          <img class="home-icon" src="{{ asset('css/img/Icon_Time.png') }}">
          <h2>Gestiona tu tiempo</h2>
        </div>

        <div class="col-4 text-center">
          <img class="home-icon" src="{{ asset('css/img/Icon_Folder.png') }}">
          <h2>Clasifica por Proyecto</h2>
        </div>

</div>
  
</div>

@endsection