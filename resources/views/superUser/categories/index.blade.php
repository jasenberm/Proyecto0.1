@extends('layouts.app')

@section('title', 'Clientes')

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
            <h4 class="card-title">Categorias de Restaurantes</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="table" class="table table-striped" style="width:100%">
                <thead class="text-primary">
                  <th>Id</th>
                  <th>Nombre</th>
                  <th>Estado</th>
                  <th>Creado</th>
                  <th>Actualizado</th>                  
                  <th>Acciones</th>
                </thead>
                <tbody>
                    @foreach ($categories as $key=>$category)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $category->name}}</td>
                        <td>
                          @if ($category->status == true)
                            <span class="badge badge-success">Activado</span>
                          @else
                            <span class="badge badge-danger">Desactivado</span>
                          @endif
                        </td>
                        <td>{{ $category->created_at}}</td>
                        <td>{{ $category->updated_at}}</td>                        
                        <td>              
                          <form method="POST" id="status-form-{{ $category->id }}" 
                            action="{{ route('category_admin.update', $category->id) }}" style="display: none;">
                              @csrf
                              @method('PUT')
                            </form>
                            @if ($category->status == true)
                            <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('¿Seguro de desactivar esta categoria?')){
                              event.preventDefault();
                              document.getElementById('status-form-{{ $category->id }}').submit();
                              }else{
                                event.preventDefault();
                              }">
                              
                          
                            <i class="material-icons">highlight_off</i>
                          </button>
                          @else
                          <button type="button" class="btn btn-success btn-sm" onclick="if(confirm('¿Seguro de activar esta categoria?')){
                            event.preventDefault();
                            document.getElementById('status-form-{{ $category->id }}').submit();
                            }else{
                              event.preventDefault();
                            }">
                            
                        
                            <i class="material-icons">check_circle</i>
                        </button>
                           
                          
                          @endif
                                                                    
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