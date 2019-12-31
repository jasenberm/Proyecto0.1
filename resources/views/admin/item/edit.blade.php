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
                          <label class="bmd-label-floating">Categoria</label>
                          <select class="form-control" name="category">
                            @foreach ($categories as $category)
                            <option {{ $category->id == $item->category->id ? 'selected' : '' }} value="{{ $category->id }}"> {{ $category->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nombre</label>
                          <input type="text" class="form-control" value="{{ $item->name }}" name="name">
                        </div>
                      </div>                        
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Descripcion</label>
                          <textarea class="form-control" name="description">{{ $item->description }}</textarea>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Precio</label>
                          <input type="number" class="form-control" value="{{ $item->price }}" name="price" step="any">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <label class="bmd-label-floating">Imagen</label><br>
                        <input type="file" name="image">
                      </div>
                      <br>
                      <a href="{{ route('item.index') }}" class="btn btn-danger">Back</a>
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