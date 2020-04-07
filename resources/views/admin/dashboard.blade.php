@extends('layouts.app')

@section('title', 'Dashboard')

@push('css')

@endpush

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">content_copy</i>
                        </div>
                        <p class="card-category">Clasificaciones/Platos</p>
                        <h3 class="card-title">{{ $categoryCount }}/{{ $itemCount }}
                        </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">local_offer</i> Total de Clasificaciones y Platos
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">slideshow</i>
                        </div>
                        <p class="card-category">Deslizantes</p>
                        <h3 class="card-title">{{ $sliderCount }}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">date_range</i><a href="{{ route('slider.index') }}">Obtener mas Detalles...</a>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-danger card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">info_outline</i>
                        </div>
                        <p class="card-category">Reservaciones</p>
                        <h3 class="card-title">{{ $reservations->count() }}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons text-danger">info</i> Reservaciones sin Confirmar
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i class="fa fa-twitter"></i>
                        </div>
                        <p class="card-category">Mensajes</p>
                        <h3 class="card-title">{{ $contactCount }}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">update</i> Mensajes recibidos
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @include('layouts.partial.msg')
                <div class="card">
                    <div class="card-header card-header-primary">
                      <h4 class="card-title">Todas las Reservaciones sin Confirmar</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table" class="table table-striped" style="width:100%">
                                <thead class="text-primary">
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>N° de Personas</th>
                                    <th>Dia y Hora</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody>
                                @foreach ($reservations as $key=>$reservation)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $reservation->name }}</td>
                                        <td>{{ $reservation->email}}</td>    
                                        <td>{{ $reservation->people}}</td>                        
                                        {{-- <td>
                                        @if ($reservation->status == true)
                                            <span class="badge badge-info">Confirmado</span>
                                        @else
                                            <span class="badge badge-danger">Sin Confirmar</span>
                                        @endif
                                        </td> --}}
                                        <td>{{ $reservation->date }} - {{ $reservation->time }}</td>
                                        <td>
                                            @if ($reservation->message == !null)                                                
                                            <a href="{{ route('reservation.show', $reservation->id) }}" data-toggle="tooltip" data-placement="top" title="Ver Detalle de Reservación" class="btn btn-warning btn-sm">
                                                <i class="material-icons">details</i>
                                            </a>
                                            @endif
                                        @if ($reservation->status == false)
                                            <form method="POST" id="status-form-{{ $reservation->id }}" 
                                                action="{{ route('reservation.status', $reservation->id) }}" style="display: none;">
                                            @csrf
                                            </form>
                                            <button type="button" data-toggle="tooltip" data-placement="top" title="Aceptar Reservación" class="btn btn-info btn-sm" onclick="if(confirm('¿Aceptar Reservación?')){
                                                    event.preventDefault();
                                                    document.getElementById('status-form-{{ $reservation->id }}').submit();
                                                }else{
                                                event.preventDefault();
                                                }">
                                                <i class="material-icons">done</i>
                                            </button>      
                                        @endif
                                        
                                            <form method="POST" id="delete-form-{{ $reservation->id }}" 
                                                action="{{ route('reservation.destory', $reservation->id) }}" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                            </form>
                                            <button type="button" data-toggle="tooltip" data-placement="top" title="Eliminar Reservación" class="btn btn-danger btn-sm" onclick="if(confirm('¿Estas seguro de eliminarlo?')){
                                                    event.preventDefault();
                                                    document.getElementById('delete-form-{{ $reservation->id }}').submit();
                                                }else{
                                                    event.preventDefault();
                                                }">
                                                <i class="material-icons">delete</i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endpush