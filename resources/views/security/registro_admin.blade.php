<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('frontend/images/icons/ejemplo3.png') }}" type="favicon/ico" />

    <title>Registro</title>
      
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/utilCambio.css') }}">
	
        
</head>

<body class="bg2-pattern">
<div class="content" style="margin-top: 50px">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-6 col-md-offset-1">
      @include('layouts.partial.msg')
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Registro Dueños de Restaurantes</h4>
          </div>
          <div class="card-body bg1-pattern">
            <form method="POST" action="{{ route('register_owner_post') }}" autocomplete="off">
            @csrf
              <div class="form-row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">Usuario</label>
                      <input type="text" placeholder="Ej: dueño123" id="user"class="form-control" name="user" value="{{ old('user') }}" required>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="bmd-label-floating">Correo</label>
                      <input type="email" placeholder="Ej: dueño@hotmail.com" id="email" placeholder="Ej: usuario@hotmail.com" class="form-control" name="email" value="{{ old('email') }}" required>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Nombres</label>
                      <input type="text" placeholder="Ej: nombre dueño" id="name" class="form-control" name="name" value="{{ old('name') }}" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Apellidos</label>
                      <input type="text" placeholder="Ej: apellido dueño" id="last_name" class="form-control" name="last_name" value="{{ old('last_name') }}" required>
                  </div>
                </div>
              </div>
              <div class="form-row">                
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Clave</label>
                      <input type="password" class="form-control" id="password" name="password" required>
                  </div>
                </div>          
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Confirmación de Clave</label>
                      <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" required>
                  </div>
                </div>  
              </div>              
              <button type="submit" class="btn btn-primary">Registrar</button>
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

<script src="{{ asset ('frontend/js/bootstrap-validate.js') }}"></script>    


<script>  
  bootstrapValidate('#user','required:El campo usuario es requerido');
  bootstrapValidate('#user','min:8:Ingrese al menos 8 caracteres');
  bootstrapValidate('#user','max:16:No ingrese mas de 16 caracteres');

  bootstrapValidate('#email','email:Ingrese un formato valido');  
  bootstrapValidate('#email','required:El campo correo es requerido');

  bootstrapValidate('#name', 'regex:^[a-zA-Z ]*$:Ingrese solo letras, sin tildes ni caracteres especiales');
  bootstrapValidate('#name','required:El campo nombre es requerido');

  bootstrapValidate('#last_name', 'regex:^[a-zA-Z ]*$:Ingrese solo letras, sin tildes ni caracteres especiales');
  bootstrapValidate('#last_name','required:El campo Apellidos es requerido');

  // (?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*.])(?=.{8,})
  bootstrapValidate('#password','min:8:Ingrese al menos 8 caracteres');
  bootstrapValidate('#password', 'regex:^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*.])(?=.{8,}):Debe contener MAYUSCULA, minuscula, caracter especial y Numero Ejemplo "Dueño@2020"');

  bootstrapValidate('#password_confirmation','matches:#password:Las contraseñas no coinciden');
</script>

</body>
</html>