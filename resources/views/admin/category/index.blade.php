@extends('layouts.app')

@section('title', 'Category')

@push('css')
{{--<link rel="stylesheet" href="{{ asset('backend/css/table-bootstrap.min.css') }}">--}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              @if ($valRestaurant->isNotEmpty())
              <a href="{{ route('category.create') }}" class="btn btn-primary">Agregar Nuevo</a>                  
              @else
              <p>Agregar el <a href="{{ route('restaurant.index') }}">restaurante</a> para poder empezar a registrar categorias de productos que su negocio 
                va a proveer.</p>
              @endif
              @include('layouts.partial.msg')
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Todas las categorias</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="table" class="table table-striped" style="width:100%">
                      <thead class="text-primary">
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Slug</th>
                        <th>Creado</th>
                        <th>Actualizado</th>
                        <th>Acciones</th>
                      </thead>
                      <tbody>
                        @foreach ($categories as $key=>$categorie)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $categorie->name }}</td>
                                <td>{{ $categorie->slug }}</td>
                                <td>{{ $categorie->created_at }}</td>
                                <td>{{ $categorie->updated_at }}</td>
                                <td>
                                  <a href="{{ route('category.edit', $categorie->id) }}" class="btn btn-info btn-sm">
                                    <i class="material-icons">mode_edit</i>
                                  </a>
                                  <form method="POST" id="delete-form-{{ $categorie->id }}" action="{{ route('category.destroy', $categorie->id) }}" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                  </form>
                                  <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('¿Estas seguro de eliminarlo?')){
                                    event.preventDefault();
                                    document.getElementById('delete-form-{{ $categorie->id }}').submit();
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
    {{--<script src="{{ asset('backend/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/js/dataTables.bootstrap4.min.js') }}"></script>--}}
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
    $('#table').DataTable();
    } );
</script>
@endpush