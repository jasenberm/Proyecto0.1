@extends('layouts.app')

@section('title', 'Inicio de sesion')

@push('css')

@endpush

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row justify-content-left">
      <div class="col-md-8 col-md-offset-1">
      @include('layouts.partial.msg')
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Inicio de Sesion</h4>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
            @csrf
              <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating">Clave</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
              </div>           
              <br>
              <button type="submit" class="btn btn-primary">Iniciar Sesion</button>
              <a href="{{ route('welcome') }}" class="btn btn-danger">Retroceder</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
    
@endpush