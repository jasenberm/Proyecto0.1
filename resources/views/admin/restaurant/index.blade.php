@extends('layouts.app')

@section('title', 'Restaurant')

@push('css')
  
{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}

@endpush

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
      @if ($restaurants->isNotEmpty())
      @foreach ($restaurants as $restaurant)
        <a href="{{ route('restaurant.edit', $restaurant->id) }}" class="btn btn-primary">Modificar Informacion</a>  
      @endforeach
      @else
        <p><a href="{{ route('restaurant.create') }}" class="btn btn-primary">Agregar</a> el restaurante para proceder con la 
          creación de las categorias y productos que su negocio va a proveer.</p>
      @endif
      @include('layouts.partial.msg')
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Informacion de mi Restaurante</h4>
          </div>
          @foreach ($restaurants as $restaurant)    
          <div class="card-body">
            <div class="col-12">
              <dl class="row">
                <dt class="col-sm-3">Nombre de mi restaurante </dt>
                <dd class="col-sm-9">{{ $restaurant->name_restaurant }}<br></dd>

                <dt class="col-sm-3">Foto de mi restaurante </dt>
                <dd class="col-sm-9"><a href="#" data-toggle="modal" data-target="#modalImagen">{{ $restaurant->image }}</a><br></dd>
                
                <dt class="col-sm-3">Categoria</dt>
                <dd class="col-sm-9">{{ $categoryRestaurant->name }}<br></dd>
        
                <dt class="col-sm-3">Descripción</dt>
                <dd class="col-sm-9">{{ $restaurant->description }}<br></dd>
        
                <dt class="col-sm-3">Dirección</dt>
                <dd class="col-sm-9">{{ $restaurant->address }}<br></dd>
              </dl>
            </div>
          </div>
          <div class="modal fade" id="modalImagen" tabindex="-1" role="dialog" aria-labelledby="modalImagenLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="modalImagenLbel">{{ $restaurant->image }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <img src="{{ asset('upload/restaurant/'.$restaurant->image) }}" alt="restaurante"
                    style="width:100%">
                  </div>
                  <div class="modal-footer">
                    <h3>{{ $restaurant->name_restaurant }}</h3>
                  </div>
                </div>
              </div>
            </div>
          
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
{{--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>--}}
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
@endpush