@extends('layouts.app')

@section('title', 'Contact')

@push('css')

@endpush

@section('content')
<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Detalles de la reservación</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <div class="row">
                        <div class="col-md-12">
                            <strong>Nombre: {{ $reservations->name }} {{ $reservations->last_name }}</strong><br>                        
                            <b>Email: {{ $reservations->email }}</b><br>
                            <strong>Personas que asistiran a la reservación: {{ $reservations->people }}</strong><br><hr>                            
                            <strong>Mensaje: </strong>
                            <p>{{ $reservations->message }}</p><hr>                                   
                        </div>
                    </div>
                    <a href="{{ route('reservation.index') }}" class="btn btn-danger">Regresar</a>
                    <div class="clearfix"></div>                  
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection

@push('scripts')

@endpush