@extends('layouts.app')

@section('title', 'Reservation')

@push('css')
{{--<link rel="stylesheet" href="{{ asset('backend/css/table-bootstrap.min.css') }}">--}}
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"> --}}
<link rel="stylesheet" href="{{ asset('backend/css/jquery.dataTables.min.css') }}">
@endpush

@section('content')
<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <a href="{{ route('export.clients') }}" class="btn btn-primary">Exportar mis Clientes</a>  
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
                        {{--<th>Telefono</th>--}}
                        <th>Email</th>
                        {{--<th>Dia</th>
                        <th>Hora</th>
                        <th>Mensaje</th>--}}
                        <th>Estado</th>
                        <th>Creado</th>
                        <th>Acciones</th>
                      </thead>
                      <tbody>
                        @foreach ($reservations as $key=>$reservation)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $reservation->name }}</td>
                                {{--<td>{{ $reservation->phone}}</td>--}}
                                <td>{{ $reservation->email }}</td>
                                {{--<td>{{ $reservation->date }}</td>
                                <td>{{ $reservation->time }}</td>
                                <td>{{ $reservation->message }}</td>--}}
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
<script src="{{ asset('backend/js/jquery.dataTables.min.js') }}"></script>
    {{-- <script src="{{ asset('backend/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/js/dataTables.bootstrap4.min.js') }}"></script> --}}
    {{--<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>--}}
<script>
    $(document).ready(function() {
    $('#table').DataTable();
    } );
</script>
@endpush