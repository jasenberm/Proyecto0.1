@extends('layouts.app')

@section('title', 'Item')

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
              <a href="{{ route('item.create') }}" class="btn btn-primary">Agregar Nuevo</a>
              @else
              <p>Agregar el <a href="">restaurante</a> para poder empezar a registrar productos que su negocio 
                va a proveer</p>
              @endif
              @include('layouts.partial.msg')
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Todas las Items</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="table" class="table table-striped" style="width:100%">
                      <thead class="text-primary">
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Imagen</th>
                        <th>Categoria</th>
                        <th>Descripcion</th>
                        <th>Precio</th>
                        <th>Creado</th>
                        <th>Actualizado</th>
                        <th>Acciones</th>
                      </thead>
                      <tbody>
                        @foreach ($items as $key=>$item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td><img class="img-responsive img-thumbnail" src="{{ asset('upload/item/'.$item->image) }}" 
                                  style="height: 100px; width: 100px" alt=""></td>                        
                                <td>{{ $item->category->name }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->updated_at }}</td>
                                <td>
                                  <a href="{{ route('item.edit', $item->id) }}" class="btn btn-info btn-sm">
                                    <i class="material-icons">mode_edit</i>
                                  </a>
                                  <form method="POST" id="delete-form-{{ $item->id }}" action="{{ route('item.destroy', $item->id) }}" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                  </form>
                                  <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('¿Estas seguro de eliminarlo?')){
                                    event.preventDefault();
                                    document.getElementById('delete-form-{{ $item->id }}').submit();
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