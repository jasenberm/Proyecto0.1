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
                  <h4 class="card-title ">Editar Restaurante</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('restaurant.update', $restaurant->id) }}" enctype="multipart/form-data" autocomplete="off">
                      @csrf
                      @method('PUT')
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Categoria</label>
                          <select class="form-control" name="category">
                            <option selected>Seleccione la categoria...</option>
                            @foreach ($categoryRestaurant as $categories)
                            <option {{ $categories->id == $restaurant->category_restaurant->id? 'selected' : '' }} value="{{ $categories->id }}"> {{ $categories->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nombre</label>
                          <input type="text" class="form-control" value="{{ $restaurant->name_restaurant }}" name="name_restaurant">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">RUC</label>
                          <input type="text" class="form-control" value="{{ $restaurant->ruc }}" name="ruc">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="custom-file">
                          <label class="bmd-label-floating">Elegir una foto</label>
                          <input type="file" class="form-control" name="image">
                        </div>
                      </div>   
                      <br>                     
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Descripción</label>
                          <textarea class="form-control" name="description">{{ $restaurant->description }}</textarea>
                        </div>
                      </div>      
                      <br>
                      <a href="{{ route('restaurant.index') }}" class="btn btn-danger">Back</a>
                      <button type="submit" class="btn btn-primary">Save</button>
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