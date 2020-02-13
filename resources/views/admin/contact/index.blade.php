@extends('layouts.app')

@section('title', 'Contact')

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
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Todos los Mensajes</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="table" class="table table-striped" style="width:100%">
                      <thead class="text-primary">
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Titulo</th>
                        <th>Mensaje</th>
                        <th>Enviado el</th>
                        <th>Acciones</th>
                      </thead>
                      <tbody>
                        @foreach ($contacts as $key=>$contact)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->subject }}</td>
                                <td>{{ $contact->message }}</td>
                                <td>{{ $contact->created_at }}</td>
                                <td>
                                  <a href="{{ route('contact.show', $contact->id) }}" class="btn btn-info btn-sm">
                                    <i class="material-icons">details</i>
                                  </a>
                                  <form method="POST" id="delete-form-{{ $contact->id }}" 
                                    action="{{ route('contact.destroy', $contact->id) }}" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                  </form>
                                  <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('¿Estas seguro de eliminarlo?')){
                                    event.preventDefault();
                                    document.getElementById('delete-form-{{ $contact->id }}').submit();
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
    {{--<script src="{{ asset('backend/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/js/dataTables.bootstrap4.min.js') }}"></script>--}}
    {{-- <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script> --}}
<script>
    $(document).ready(function() {
    $('#table').DataTable();
    } );
</script>
@endpush