@extends('layouts.app')

@section('title', 'Export')

@push('css')
{{--<link rel="stylesheet" href="{{ asset('backend/css/table-bootstrap.min.css') }}">--}}
<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
@endpush

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">        
                @include('layouts.partial.msg')
                <a href="{{ route('export.client') }}" class="btn btn-primary">Exportar Clientes</a>
                <a href="{{ route('export.owner') }}" class="btn btn-primary">Exportar Dueños</a>
                <a href="{{ route('export.restaurant') }}" class="btn btn-primary">Exportar Restaurantes</a>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
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