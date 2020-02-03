@extends('layouts.app')

@section('title', 'Super Usuario')

@push('css')

@endpush

@section('content')
<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
                @include('layouts.partial.msg')
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Editar Usuario</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('superuser.update', $user->id) }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf  
                        @method('PUT')       
                        <br>                     
                        <div class="form-row justify-content-md-center">
                            <div class="form-group col-md-2">
                                <label class="bmd-label-floating">Usuario</label>
                                <input type="text" class="form-control" name="user" value="{{ $user->user }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="bmd-label-floating">Nombres</label>
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                            </div>
                            <div class="form-group col-md-4 ">
                                <label class="bmd-label-floating">Apellidos</label>
                                <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}">
                            </div>
                            {{-- <div class="form-group col-md-6">
                                <label class="bmd-label-floating">Correo</label>
                                <input type="text" class="form-control" name="email" placeholder="{{ $user->email }}">
                            </div>                             --}}
                        </div>                                                                                                                                                        
                        <br>                        
                        <a href="{{ route('superuser.index') }}" class="btn btn-danger">Retroceder</a>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection

@push('scripts')
    
@endpush