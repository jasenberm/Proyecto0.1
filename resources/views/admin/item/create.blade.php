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
                    <form method="POST" action="{{ route('item.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                          <div class="form-group">
                              <label class="bmd-label-floating">Categoria</label>
                              <select class="form-control" name="category">
                                  <option selected>Seleccione la categoria...</option>
                                @foreach ($categories as $category)
                                  <option value="{{ $category->id }}"> {{ $category->name }}</option>
                                @endforeach
                              </select>
                          </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Nombre</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                              <label class="bmd-label-floating">Descripcion</label>
                              <textarea class="form-control" name="description"></textarea>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                              <label class="bmd-label-floating">Precio</label>
                              <input type="number" class="form-control" name="price" step="any">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <label class="bmd-label-floating">Imagen</label><br>
                          <input type="file" name="image">
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
    
@endpush