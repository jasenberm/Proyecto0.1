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
                  <th>Dueño</th>
                  <th>RUC</th>
                  <th>Creado</th>
                  <th>Actualizado</th>
                  <th>Acciones</th>
                </thead>
                <tbody>
                    @foreach ($restaurants as $key=>$restaurant)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $restaurant->category_restaurant->name}}</td>
                        <td>{{ $restaurant->name_restaurant}}</td>
                        <td>{{ $restaurant->user->name}}</td>
                        <td>{{ $restaurant->ruc}}</td>
                        <td>{{ $restaurant->created_at}}</td>
                        <td>{{ $restaurant->updated_at}}</td>
                        <td>
                          <a href="" class="btn btn-info btn-sm">
                            <i class="material-icons">more_horiz</i>
                          </a>                    
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