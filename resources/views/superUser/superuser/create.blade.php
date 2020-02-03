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
                  <h4 class="card-title ">Crear Usuario</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('superuser.store') }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf                            
                        <br>                     
                        <div class="form-row justify-content-md-center">
                            <div class="form-group col-md-2">
                                <label class="bmd-label-floating">Usuario</label>
                                <input type="text" class="form-control" name="user">
                            </div>
                            <div class="form-group col-md-4">
                              <label class="bmd-label-floating">Correo</label>
                              <input type="text" class="form-control" name="email">
                            </div> 
                            <div class="form-group col-md-4">
                              <label class="bmd-label-floating">Contraseña</label>
                              <input type="text" class="form-control" name="password">
                            </div> 
                          </div>
                          <div class="form-row justify-content-md-center"> 
                            <div class="form-group col-md-5">
                                <label class="bmd-label-floating">Nombres</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="form-group col-md-5">
                                <label class="bmd-label-floating">Apellidos</label>
                                <input type="text" class="form-control" name="last_name">
                            </div>                                                       
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