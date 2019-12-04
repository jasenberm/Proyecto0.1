@extends('layouts.app')

@section('title', 'Dashboard')

@push('css')

@endpush

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">content_copy</i>
                        </div>
                        <p class="card-category">Categoria/Items</p>
                        <h3 class="card-title">{{ $categoryCount }}/{{ $itemCount }}
                        </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons text-danger">info</i> Total de Categorias e Items
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
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
            </div>
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
                            <i class="material-icons">local_offer</i> Reservaciones sin Confirmar
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
                        <p class="card-category">Contactos</p>
                        <h3 class="card-title">{{ $contactCount }}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">update</i> Just Updated
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
                      <h4 class="card-title">Todas las Reservaciones</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table" class="table table-striped" style="width:100%">
                                <thead class="text-primary">
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Telefono</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody>
                                @foreach ($reservations as $key=>$reservation)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $reservation->name }}</td>
                                        <td>{{ $reservation->phone}}</td>                        
                                        <td>
                                        @if ($reservation->status == true)
                                            <span class="badge badge-info">Confirmado</span>
                                        @else
                                            <span class="badge badge-danger">Sin Confirmar</span>
                                        @endif
                                        </td>
                                        <td>{{ $reservation->created_at }}</td>
                                        <td>
                                        @if ($reservation->status == false)
                                            <form method="POST" id="status-form-{{ $reservation->id }}" 
                                                action="{{ route('reservation.status', $reservation->id) }}" style="display: none;">
                                            @csrf
                                            </form>
                                            <button type="button" class="btn btn-info btn-sm" onclick="if(confirm('¿Verificaste la Solicitud por Telefono?')){
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
                                            <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('¿Estas seguro de eliminarlo?')){
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

@endpush