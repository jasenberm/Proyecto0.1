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
                  <h4 class="card-title ">Editar Item</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('item.update', $item->id) }}" enctype="multipart/form-data" autocomplete="off">
                      @csrf
                      @method('PUT')
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Clasifiación</label>
                          <select class="form-control" name="category">
                            @foreach ($categories as $category)
                            <option {{ $category->id == $item->category->id ? 'selected' : '' }} value="{{ $category->id }}"> {{ $category->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nombre del Plato</label>
                          <input type="text" id="nombre" class="form-control" value="{{ $item->name }}" name="name">
                        </div>
                      </div>                        
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Descripción del Plato</label>
                          <textarea class="form-control" id="descripcion" name="description">{{ $item->description }}</textarea>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Precio del Plato</label>
                          <input type="number" class="form-control" value="{{ $item->price }}" name="price" step="any">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <label class="bmd-label-floating">Imagen del Plato</label><br>
                        <input type="file" id="imagen" name="image">
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