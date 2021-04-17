@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5">
                <div class="card-header green-title">{{ __('Recuperar Contraseña') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <label for="email" class="text-md-right">{{ __('Esta vista fue incluida debido a que se agrego a la prueba de estilos, sin embargo, no cuenta con Funcionalidad (Y tampoco es mostrada en el mapa de navegación)') }}</label>

                        <div class="form-group row">
                            <div class="col-9" style="margin: auto;">
                                <div class="row my-2">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-9" style="margin: auto;">
                                <div class="row">
                            <div class="col-md-8 offset-md-4 my-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Enviar Link para resetear la Contraseña') }}
                                </button>
                            </div>
                        </div>
                    </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
