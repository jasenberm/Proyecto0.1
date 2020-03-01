@extends('layouts.app')

@section('title', 'Slider')

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
      @if ($valRestaurant->isNotEmpty())
        <a href="{{ route('slider.create') }}" class="btn btn-primary">Agregar Nuevo</a>
      @else
        <p><a href="{{ route('restaurant.index') }}">Agregar el restaurante</a> para poder empezar a ingresar las imagenes que iran en el banner 
          que represente su negocio.</p>
      @endif
      @include('layouts.partial.msg')
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">All Slider</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="table" class="table table-striped" style="width:100%">
                <thead class="text-primary">
                  <th>Id</th>
                  <th>Titulo</th>
                  <th>Sub Titulo</th>
                  <th>Imagen</th>
                  <th>Creado</th>
                  <th>Actualizado</th>
                  <th>Acciones</th>
                </thead>
                <tbody>
                  @foreach ($sliders as $key=>$slider)
                  <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $slider->title }}</td>
                    <td>{{ $slider->sub_title }}</td>
                    <td>{{ $slider->image }}</td>
                    <td>{{ $slider->created_at }}</td>
                    <td>{{ $slider->updated_at }}</td>
                    <td>
                      <a href="{{ route('slider.edit', $slider->id) }}" class="btn btn-info btn-sm">
                        <i class="material-icons">mode_edit</i>
                      </a>
                      <form method="POST" id="delete-form-{{ $slider->id }}" action="{{ route('slider.destroy', $slider->id) }}" style="display: none;">
                      @csrf
                      @method('DELETE')
                      </form>
                      <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('¿Estas seguro de eliminarlo?')){
                        event.preventDefault();
                        document.getElementById('delete-form-{{ $slider->id }}').submit();
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