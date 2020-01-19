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
                  <h4 class="card-title ">Agregar Nuevo Restaurante</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('restaurant.store') }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="bmd-label-floating">Categoria</label>
                            <select class="form-control" name="category">
                              <option selected>Seleccione la categoria...</option>
                              @foreach ($categoryRestaurant as $categories)
                              <option value="{{ $categories->id }}"> {{ $categories->name }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Nombre del Restaurante</label>
                                <input type="text" class="form-control" name="name_restaurant" value="{{ old('name_restaurant') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                              <label class="bmd-label-floating">RUC</label>
                              <input type="numeric" class="form-control" name="ruc" value="{{ old('ruc') }}">
                          </div>
                      </div>
                        <div class="col-md-12">
                          <div class="custom-file">
                              <label class="bmd-label-floating">Elegir una foto</label>
                              <input type="file" name="image">
                          </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Descripción</label>
                                <input type="text" class="form-control" name="description" value="{{ old('description') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="bmd-label-floating">Dirección</label>
                                <input type="text" class="form-control" name="address">
                            </div>
                        </div>
                        <br>
                        <a href="{{ route('restaurant.index') }}" class="btn btn-danger">Retroceder</a>
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