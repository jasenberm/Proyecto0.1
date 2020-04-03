@extends('layouts.app')

@section('title', 'Clients')

@push('css')
{{--<link rel="stylesheet" href="{{ asset('backend/css/table-bootstrap.min.css') }}">--}}
{{-- <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"> --}}
<link rel="stylesheet" href="{{ asset('backend/css/jquery.dataTables.min.css') }}">
@endpush

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">     
        @if (Request::is('superuser/client'))
        <a href="{{ route('export.client') }}" class="btn btn-primary">          
          Exportar Clientes
          <i class="material-icons">cloud_download</i>
        </a>  
        @else
        <a href="{{ route('export.owner') }}" class="btn btn-primary">Exportar Dueños</a>
        @endif
        
      @include('layouts.partial.msg')
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Usuarios</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="table" class="table table-striped" style="width:100%">
                <thead class="text-primary">
                  <th>Id</th>
                  <th>Usuario</th>
                  <th>Nombre</th>
                  <th>Correo</th>
                  <th>Estado</th>
                  <th>Creado</th>
                  <th>Actualizado</th>                                    
                  <th>Acciones</th>
                </thead>
                <tbody>
                    @foreach ($users as $key=>$user)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $user->user}}</td>
                        <td>{{ $user->name}} {{ $user->last_name }}</td>
                        <td>{{ $user->email}}</td>
                        <td>
                          @if ($user->status == true)
                            <span class="badge badge-success">Activado</span>
                          @else
                            <span class="badge badge-danger">Desactivado</span>
                          @endif
                        </td>
                        <td>{{ $user->created_at}}</td>
                        <td>{{ $user->updated_at}}</td>                        
                        <td>
                          <form method="POST" id="status-form-{{ $user->id }}" 
                            action="{{ route('status', $user->id) }}" style="display: none;">
                              @csrf
                              @method('PUT')
                            </form>
                            @if ($user->status == true)
                            <button type="button" data-toggle="tooltip" data-placement="top" title="Desactivar Usuario" class="btn btn-warning btn-sm" onclick="if(confirm('¿Seguro de desactivar este usuario?')){
                              event.preventDefault();
                              document.getElementById('status-form-{{ $user->id }}').submit();
                              }else{
                                event.preventDefault();
                              }">                                                        
                            <i class="material-icons">highlight_off</i>
                          </button>
                          @else
                          <button type="button" data-toggle="tooltip" data-placement="top" title="Activar Usuario" class="btn btn-success btn-sm" onclick="if(confirm('¿Seguro de activar este usuario?')){
                            event.preventDefault();
                            document.getElementById('status-form-{{ $user->id }}').submit();
                            }else{
                              event.preventDefault();
                            }">                                                    
                            <i class="material-icons">check_circle</i>
                          </button>                                                     
                          @endif
                          
                          <form method="POST" id="delete-form-{{ $user->id }}" action="{{ route('superuser.update', $user->id) }}" style="display: none;">
                            @csrf
                            @method('DELETE')
                          </form>
                          <button type="button" data-toggle="tooltip" data-placement="top" title="Eliminar Usuario" class="btn btn-danger btn-sm" onclick="if(confirm('¿Estas seguro de eliminarlo?')){
                            event.preventDefault();
                            document.getElementById('delete-form-{{ $user->id }}').submit();
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
{{-- <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> --}}
    <script src="{{ asset('backend/js/jquery.dataTables.min.js') }}"></script>
    {{-- <script src="{{ asset('backend/js/dataTables.bootstrap4.min.js') }}"></script> --}}
    {{--<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>--}}
<script>
    $(document).ready(function() {
    $('#table').DataTable();
    } );

    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })

</script>
@endpush