@extends('layouts.app')

@section('title', 'Item')

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
                  <h4 class="card-title ">Agregar Nuevo Item</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('item.store') }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="col-md-12">
                          <div class="form-group">
                              <label class="bmd-label-floating">Clasifiación</label>
                              <select class="form-control" id="category" name="category" required>
                                  <option selected>Seleccione la Clasificación a la que pertece...</option>
                                @foreach ($categories as $category)
                                  <option value="{{ $category->id }}"> {{ $category->name }}</option>
                                @endforeach
                              </select>
                          </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Nombre del Plato</label>
                                <input type="text" id="nombre" class="form-control" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                              <label class="bmd-label-floating">Descripcion de Plato</label>
                              <textarea class="form-control" id="descripcion" name="description" required></textarea>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                              <label class="bmd-label-floating">Precio del PLato</label>
                              <input type="number" id="precio" class="form-control" name="price" step="any" required>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <label class="bmd-label-floating">Imagen del Plato</label><br>
                          <input type="file" id="imagen" name="image" required>
                        </div>
                        <br>
                        <a href="{{ route('item.index') }}" class="btn btn-danger">Retroceder</a>
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
    bootstrapValidate('#nombre','required:El campo nombre es requerido');
    bootstrapValidate('#descripcion','required:El campo descripción es requerido');
    bootstrapValidate('#precio','required:El campo precio es requerido');
    bootstrapValidate('#imagen','required:El campo imagen es requerido');
    
    
  </script>
@endpush