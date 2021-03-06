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
                  <h4 class="card-title ">Editar Categoria</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('category.update', $category->id) }}" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Nuevo nombre de clasificación</label>
                                <input type="text" id="name" class="form-control" name="name" value="{{ $category->name }}">
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