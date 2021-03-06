@extends('layouts.app')

@section('title', 'Category')

@push('css')

@endpush

@section('content')
<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
                @include('layouts.partial.msg')
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Agregar Nueva Clasificación de Platos</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('category.store') }}" autocomplete="off">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Nombre de nueva calsificación</label>
                                <input type="text" id="name" class="form-control" name="name">
                                <small class="text-muted">
                                  Ejemplo: Plato fuerte.
                                </small>
                            </div>
                        </div>
                        <br>
                        <a href="{{ route('category.index') }}" class="btn btn-danger">Retroceder</a>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection

@push('scripts')
  <script src="{{ asset ('frontend/js/bootstrap-validate.js') }}"></script>
  <script>
    bootstrapValidate('#name','required:El campo nombre es requerido.');
  </script>
  
@endpush