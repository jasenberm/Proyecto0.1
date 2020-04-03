<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('frontend/images/icons/ejemplo3.png') }}" type="favicon/ico" /> 

    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.min.js"></script>


    <title>Registro</title> 

    {{-- CSS --}}
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
        crossorigin="anonymous"> --}}
      
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}">
        
</head>

<body>
<div id="idparavue" class="content" style="margin-top: 50px">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-6 col-md-offset-1">
      @include('layouts.partial.msg')
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Registro de Cliente</h4>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('register_client_post') }}" autocomplete="off">
            @csrf
              <div class="form-row">          
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="bmd-label-floating">Usuario</label>
                    <input type="text" placeholder="Ej: Cliente123" id="user" class="form-control" name="user" value="{{ old('user') }}" required>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="bmd-label-floating">Correo</label>
                    <input type="email" placeholder="Ej: cliente@hotmail.com" id="email" class="form-control" name="email" value="{{ old('email') }}" required>
                  </div>
                </div>
              </div>
              <div class="form-row">              
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Nombres</label>
                    <input type="text" placeholder="Ej: nombre cliente" id="name" class="form-control" name="name" value="{{ old('name') }}" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Apellidos</label>
                    <input type="text" placeholder="Ej: apellido cliente" id="last_name" class="form-control" name="last_name" value="{{ old('last_name') }}" required>
                  </div>
                </div>
              </div>
              <div class="form-row">              
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Clave</label>
                    <input type="password" id="password" class="form-control" name="password" required>                    
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
            <br>
            {{-- <div class="row">
            <form 
              id="formulario_registro" 
              method="POST" 
              action="{{ route('register_client_post') }}" 
              autocomplete="off" 
              @submit.prevent="validateBeforeSubmit">
              @csrf
              <div class="form-group">
                <v-input 
                  id="test" 
                  placeholder="hi" 
                  v-model="nombre"
                  type="text" 
                  validate="min:8|max:16|required|password"></v-input> --}}
                {{--<input  type="text" v-model="nombre" validacion="min:8|max:16" class="form-control" placeholder="write your name"> --}}

                {{-- <div class="input-group">
                  <div class="input-group-prepend">
                      <input v-model="nombre"  id="test2" name="test2" type="text" validacion="password" class="form-control">
                      <span id="test2_info" class="input-group-text" style="border: 0px"></span>
                  </div>
              </div>
              
              </div>
            </form>
            </div> --}}
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>


<script src="{{ asset ('frontend/js/jquery-3.3.1.slim.min.js') }}"></script>
<script src="{{ asset ('frontend/js/popper.min.js') }}"></script>
<script src="{{ asset ('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset ('frontend/js/bootstrap-validate.js') }}"></script>    
<script src="{{ asset ('backend/js/validaciones.js') }}"></script>    
<script src="{{ asset ('backend/js/componentes.js') }}"></script>    


<script>
  $('[data-toggle="tooltip"]').tooltip({ trigger: "hover focus" });
  var instanciadevue = new Vue({
    el:"#idparavue",
    data:{
      nombre:""
    },
    methods: {
      validateBeforeSubmit(){
        var formulario = document.getElementById('formulario_registro');
        var contadorError = validarFormulario(formulario);
        if (contadorError == 0) {
          console.log("exito");
            // aqui se manda a ejecutar el formulario , por quetodo esta bien
        }else{
          console.log("error");
          // aqui se envia cualquier mensaje de error
        }
      }
    },
    watch: {
      nombre(value){
        this.validateBeforeSubmit();
      }
    },
  });
</script>


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

  // Debe de contener al menos 8 caracteres. 
  bootstrapValidate('#password','min:8:Ingrese al menos 8 caracteres');
  bootstrapValidate('#password', 'regex:^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*.])(?=.{8,}):Debe contener MAYUSCULA, minuscula, caracter especial y Numero Ejemplo "Cliente@2020"');
  
  bootstrapValidate('#password_confirmation','matches:#password:Las contraseñas no coinciden');
</script>

</body>
</html>