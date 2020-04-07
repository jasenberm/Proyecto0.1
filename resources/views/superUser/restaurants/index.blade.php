@extends('layouts.app')

@section('title', 'Clientes')

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
        <a href="{{ route('export.restaurant') }}" class="btn btn-primary">Exportar Restaurantes</a>
      @include('layouts.partial.msg')
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Restaurantes</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="table" class="table table-striped" style="width:100%">
                <thead class="text-primary">
                  <th>Id</th>
                  <th>Categoria</th>
                  <th>Nombre</th>
                  {{-- <th>Dueño</th> --}}
                  <th>RUC</th>
                  {{-- <th>Creado</th> --}}
                  <th>Estado</th>
                  <th>Actualizado</th>
                  <th>Acciones</th>
                </thead>
                <tbody>
                    @foreach ($restaurants as $key=>$restaurant)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $restaurant->category_restaurant->name}}</td>
                        <td>{{ $restaurant->name_restaurant}}</td>
                        {{-- <td>{{ $restaurant->user->name}}</td> --}}
                        <td>{{ $restaurant->ruc}}</td>
                        <td>
                          @if ($restaurant->status == true)
                            <span class="badge badge-success">Activado</span>
                          @else
                            <span class="badge badge-danger">Desactivado</span>
                          @endif
                        </td>
                        {{-- <td>{{ $restaurant->created_at}}</td> --}}
                        <td>{{ $restaurant->updated_at}}</td>
                        <td>
                          <form method="POST" id="status-form-{{ $restaurant->id }}" 
                            action="{{ route('restaurant.status', $restaurant->id) }}" style="display: none;">
                              @csrf
                              @method('PUT')
                            </form>
                            @if ($restaurant->status == true)
                            <button type="button" data-toggle="tooltip" data-placement="top" title="Desactivar Restaurante" class="btn btn-warning btn-sm" onclick="if(confirm('Al desactivar el restaurante se generara una nueva Solicitud de Activación ¿Desactivar este restaurante? ')){
                              event.preventDefault();
                              document.getElementById('status-form-{{ $restaurant->id }}').submit();
                              }else{
                                event.preventDefault();
                              }">                                                        
                            <i class="material-icons">highlight_off</i>
                          </button>
                          @else
                          <button type="button" data-toggle="tooltip" data-placement="top" title="Activar Usuario" class="btn btn-success btn-sm" onclick="if(confirm('¿Seguro de activar este usuario?')){
                            event.preventDefault();
                            document.getElementById('status-form-{{ $restaurant->id }}').submit();
                            }else{
                              event.preventDefault();
                            }">                                                    
                            <i class="material-icons">check_circle</i>
                          </button>                                                     
                          @endif
                          
                          <form method="POST" id="delete-form-{{ $restaurant->id }}" action="{{ route('restaurant_admin.destroy', $restaurant->id) }}" style="display: none;">
                            @csrf
                            @method('DELETE')
                          </form>
                          <button type="button" data-toggle="tooltip" data-placement="top" title="Eliminar Usuario" class="btn btn-danger btn-sm" onclick="if(confirm('¿Estas seguro de eliminarlo?')){
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
    {{-- <script src="{{ asset('backend/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/js/dataTables.bootstrap4.min.js') }}"></script> --}}
    {{--<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>--}}
<script>
    $(document).ready(function() {
      $('#table').DataTable();
    });

    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endpush