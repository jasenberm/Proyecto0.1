<style>
  input{
    border: 1px #ced4da solid !important;
  }
</style>


<!-- Modal -->
<div class="modal fade" id="register-client-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title tit2" id="staticBackdropLabel">Registro Cliente</h5>
        <button type="button" class="close" @click="cerrar(event)" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>            
      <form autocomplete="off">
        <p class="error" v-if="!$v.formResponses.name.required">this field is required</p>
      <div class="modal-body">        
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="form-row">          
          <div class="col-md-4">
            <div class="form-group">
              <label class="bmd-label-floating">Usuario</label>
              <input type="text" placeholder="Ej: usuario123" id="user" class="form-control" v-model="user" value="{{ old('user') }}" required>
            </div>
          </div>
          <div class="col-md-8">
            <div class="form-group">
              <label class="bmd-label-floating">Correo</label>
              <input type="email" placeholder="Ej: usuario@hotmail.com" id="email" class="form-control" v-model="email" value="{{ old('email') }}" required>
            </div>
          </div>
        </div>
        <div class="form-row">              
          <div class="col-md-6">
            <div class="form-group">
              <label class="bmd-label-floating">Nombres</label>
              <input type="text" placeholder="Ej: nombre usuario" id="name" class="form-control" v-model="name" value="{{ old('name') }}" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label class="bmd-label-floating">Apellidos</label>
              <input type="text" placeholder="Ej: apellido usuario" id="last_name" class="form-control" v-model="last_name" value="{{ old('last_name') }}" required>
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
              <input type="password" class="form-control" name="password_confirmation" required>
            </div>
          </div>  
        </div>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-primary" value="Registrarse"/>
      </form>  
        <button type="button" class="btn btn-secondary" @click="cerrar(event)">Cerrar</button>      
      </div>
    
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>
<script src="{{ asset ('frontend/js/bootstrap-validate.js') }}"></script> 

{{-- <script>  
  bootstrapValidate('#user','required:El campo usuario es requerido');
  bootstrapValidate('#user','min:8:Ingrese al menos 8 caracteres');
  bootstrapValidate('#user','max:16:No ingrese mas de 16 caracteres');

  bootstrapValidate('#email','email:Ingrese un formato valido');  
  bootstrapValidate('#email','required:El campo correo es requerido');

  bootstrapValidate('#name', 'regex:^[a-zA-Z ]*$:Ingrese solo letras, sin tildes ni caracteres especiales');
  bootstrapValidate('#name','required:El campo nombre es requerido');

  bootstrapValidate('#last_name', 'regex:^[a-zA-Z ]*$:Ingrese solo letras, sin tildes ni caracteres especiales');
  bootstrapValidate('#last_name','required:El campo Apellidos es requerido');
  
  bootstrapValidate('#password','min:8:Ingrese al menos 8 caracteres');
  bootstrapValidate('#password', 'regex:^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*.])(?=.{8,}):Debe de contener al menos un caracter en minusculas y mayusculas. Debe de contener al menos un caracter numerico. Debe de conter un caracter especial "!@#\$%\^&\*."');

  bootstrapValidate('#password','required:El campo es requerido');
</script> --}}

<script>    
  import { required, minLength } from 'vuelidate/lib/validators';
  new Vue({    
      el:'#register-client-modal',
      data:{
          user:'',
          name:'',
          last_name:'',
          email:'',
          password:'',
          password_confirmation:''
      },    
      validations: {
        name: {
          required,
          minLength: minLength(4)
        },
      },  
      methods:{
        registrarEvent(e){ 
          e.preventDefault();
          console.log('llega por aqui');          
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          
          $.post("{{ url('/') }}",                           
            { user:this.user,
              name:this.name,
              last_name:this.last_name,
              email:this.email,
              password:this.password,
              password_confirmation:this.password_confirmation},
            function(response){            
            }).fail(function (jqXHR, textStatus, errorThrown) {
              alert('ejemplo ');              
                        
            }).done(function (data, textStatus, jqXHR) {          
              
            }).always(function (dataOrjqXHR, textStatus, jqXHRorErrorThrown) { 
              // aqui es cuando ya finalice la peticion
            });                          
        },

        cerrar(e){
          console.log('cerrar');
          $('#register-client-modal').modal('hide');
          
        }
      }     
  });
</script>