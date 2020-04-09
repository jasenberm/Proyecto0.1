@extends('layouts.app')

@section('title', 'Category Restaurant')

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
            <h4 class="card-title ">Agregar Nueva Categoria</h4>
          </div>
          <div class="card-body">
              <form method="POST" action="{{ route('category_admin.update', $category->id) }}" autocomplete="off">
                  @csrf
                  @method('PUT')
                  <div class="col-md-12">
                      <div class="form-group">
                          <label class="bmd-label-floating">Nombre</label>
                          <input type="text" class="form-control" value="{{ $category->name }}" name="name">
                      </div>
                  </div>
                  <br>
                  <a href="{{ route('category_admin.index') }}" class="btn btn-danger">Retroceder</a>
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