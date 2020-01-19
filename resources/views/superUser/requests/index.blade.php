@extends('layouts.app')

@section('title', 'Solicitudes')

@push('css')
{{--<link rel="stylesheet" href="{{ asset('backend/css/table-bootstrap.min.css') }}">--}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              @include('layouts.partial.msg')
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Nuevas solicitudes</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="table" class="table table-striped" style="width:100%">
                      <thead class="text-primary">
                        <th>Id</th>
                        <th>Usuario</th>                        
                        <th>Restaurante</th>
                        <th>RUC</th>
                        <th>Creado</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                      </thead>
                      <tbody>
                        @foreach ($restaurants as $key=>$restaurant)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $restaurant->user->user }}</td>
                                <td>{{ $restaurant->name_restaurant }}</td>
                                <td>{{ $restaurant->name_restaurant }}</td>
                                <td>{{ $restaurant->created_at }}</td>
                                <td>
                                  @if ($restaurant->status == true)
                                    <span class="badge badge-info">Confirmado</span>
                                  @else
                                    <span class="badge badge-danger">Sin Confirmar</span>
                                  @endif
                                </td>
                                <td>
                                  @if ($restaurant->status == false)
                                  <form method="POST" id="status-form-{{ $restaurant->id }}" 
                                    action="{{ route('reservation.status', $restaurant->id) }}" style="display: none;">
                                      @csrf
                                    </form>
                                    <button type="button" class="btn btn-info btn-sm" onclick="if(confirm('¿Verificaste la Solicitud por Telefono?')){
                                      event.preventDefault();
                                      document.getElementById('status-form-{{ $restaurant->id }}').submit();
                                      }else{
                                        event.preventDefault();
                                      }">
                                      <i class="material-icons">done</i>
                                    </button>      
                                  @endif
                                  
                                  <form method="POST" id="delete-form-{{ $restaurant->id }}" 
                                    action="{{ route('reservation.destory', $restaurant->id) }}" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                  </form>
                                  <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('¿Estas seguro de eliminarlo?')){
                                    event.preventDefault();
                                    document.getElementById('delete-form-{{ $restaurant->id }}').submit();
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
    <script src="{{ asset('backend/js/dataTables.bootstrap4.min.js') }}"></script>
    {{--<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>--}}
<script>
    $(document).ready(function() {
    $('#table').DataTable();
    } );
</script>
@endpush