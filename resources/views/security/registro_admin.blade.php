<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="shortcut icon" href="images/star.png" type="favicon/ico" /> -->

    <title>Registro</title>

    {{-- CSS --}}
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
        crossorigin="anonymous"> --}}
      
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">
        
</head>

<body>
<div class="content">
  <div class="container-fluid">
    <div class="row justify-content-left">
      <div class="col-md-8 col-md-offset-1">
      @include('layouts.partial.msg')
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Registro Dueños de Restaurantes</h4>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('register_owner_post') }}" autocomplete="off">
            @csrf
              <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating">Usario</label>
                    <input type="text" class="form-control" name="user" value="{{ old('user') }}" required>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating">Nombres</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating">Apellidos</label>
                    <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating">Correo</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating">Clave</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
              </div>          
              <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating">Confirmación de Clave</label>
                    <input type="password" class="form-control" name="password_confirmation" required>
                </div>
              </div>  
              <br>
              <button type="submit" class="btn btn-primary">Iniciar Sesion</button>
              <a href="{{ route('welcome') }}" class="btn btn-danger">Retroceder</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="{{ asset ('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset ('frontend/js/jquery-3.3.1.slim.min.js') }}"></script>
<script src="{{ asset ('frontend/js/popper.min.js') }}"></script>    

{{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" 
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" 
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" 
        crossorigin="anonymous"></script> --}}
</body>
</html>