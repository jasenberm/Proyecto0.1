<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Inicio de Sesion</title>

    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">
        
</head>

<body>
<div class="content" style="margin-top: 100px">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-4 col-md-offset-1">
      @include('layouts.partial.msg')
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Inicio de Sesion</h4>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('login_post') }}" autocomplete="off">
            @csrf
              <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating">Usuario</label>
                    <input type="text" class="form-control" name="user" value="{{ old('user') }}" required>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label class="bmd-label-floating">Clave</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
              </div>
              <div class="col-md-12">
                <p>¿No tienes una cuenta? <a href="{{ route('register') }}">Registrate</a></p>
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

<div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="modalLoginLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLoginLbel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" autocomplete="off">
          @csrf
            <div class="col-md-12">
              <div class="form-group">
                <label class="bmd-label-floating">Usuario</label>
                  <input type="text" class="form-control" name="user" value="{{ old('user') }}" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label class="bmd-label-floating">Clave</label>
                  <input type="password" class="form-control" name="password" required>
              </div>
            </div>
            <div class="col-md-12">
              <p>¿No tienes una cuenta? <a href="{{ route('register') }}">Registrate</a></p>
            </div>             
            <br>
            <button type="submit" class="btn btn-primary">Iniciar Sesion</button>
            <a href="{{ route('welcome') }}" class="btn btn-danger">Retroceder</a>
          </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>

<script src="{{ asset ('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset ('frontend/js/jquery-3.3.1.slim.min.js') }}"></script>
<script src="{{ asset ('frontend/js/popper.min.js') }}"></script>    

</body>
</html>