<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>

{{-- <style>
  input{
    border: 1px #ced4da solid !important;
  }
</style> --}}


<!-- Modal -->
<div class="modal fade" id="login-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title tit2" id="staticBackdropLabel">Login</h5>
        <button type="button" class="close" @click="cerrarModal(event)" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="loginForm" autocomplete="off">
      <div class="modal-body">        
        
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <div class="col-md-12">
          <div class="form-group">
            <label class="bmd-label-floating txt9">Usuario</label>
              <input type="text" class="form-control" v-model="user" value="{{ old('user') }}" required style=" border: 1px solid red !important">
          </div>
        </div>
        
        <div class="col-md-12">
          <div class="form-group">
            <label class="bmd-label-floating txt9">Clave</label>
              <input id="pass" type="password" class="form-control" v-model="password" required style=" border: 1px solid red !important">
          </div>
        </div>
        <div class="col-md-12">
          <p>¿No tienes una cuenta? <a href="{{ route('register') }}">Registrate</a></p>
          
          {{-- <p>¿No tienes una cuenta? <a onClick="registrarclient();" href="javascript:void(0)">Registrate</a></p> --}}
        </div>         
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-primary iniciarSesion" @click="iniciarSessionEvent(event)" value="iniciar sesion"/>
        <button type="button" class="btn btn-secondary" @click="cerrarModal(event)">Cerrar</button>      
      </div>
    </form>
    </div>
  </div>
</div>

<script>
  new Vue({
      el:'#login-modal',
      data:{
          user:'',
          password:''
      },
      
      methods:{
        iniciarSessionEvent(e){           
          e.preventDefault();
               
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
                           
          $.post("{{ url('/login') }}",
            { user:this.user,password:this.password,
              beforeSend: function(){
              $('.iniciarSesion').val('validando...');
            }},function(response){            
            }).fail(function (jqXHR, textStatus, errorThrown) {
              var message = '';                                            
              $.each( jqXHR.responseJSON.errors, function( key, value ) {
                message = message + value + '\n';
              });
                // alert(message);                        
                // aqui se oculta el modal
                let errors = jqXHR.responseJSON.errors;
                $('#login-modal').modal('hide');
                if (errors.hasOwnProperty('user')) {                  
                  Swal.fire( '¡Por favor, vuelva a intentar!', message, 'error' ).then((confirm)=>{
                    if(confirm){                                                          
                      // y luego que se cierre el modas se vuelve a mostrar                                                                      
                      $('#login-modal').modal('show');
                      $('.iniciarSesion').val('Iniciar Sesion'); 
                      
                                             
                    }
                  });
                }

                if (errors.hasOwnProperty('password')) {
                  // $('#login-modal').modal('hide');
                  Swal.fire( '¡Por favor, vuelva a intentar!', message, 'error' ).then((confirm)=>{
                    if(confirm){                                                          
                      // y luego que se cierre el modas se vuelve a mostrar                                
                      $('#login-modal').modal('show');
                      $('.iniciarSesion').val('Iniciar Sesion');                      
                    }
                  });
                }

                if (errors.hasOwnProperty('login')) {
                  // $('#login-modal').modal('hide');
                  Swal.fire( '¡Por favor, vuelva a intentar!', message, 'error' ).then((confirm)=>{
                    if(confirm){                                                                                                                                                   
                      window.location.reload();                              
                    }
                  });
                }
                        
            }).done(function (data, textStatus, jqXHR) {                       
              // aqui es por que todo salio bien
              $('#login-modal').modal('hide');
                Swal.fire( 'Datos correctos', 'Bienvenido', 'success' );
                window.location.reload();
            }).always(function (dataOrjqXHR, textStatus, jqXHRorErrorThrown) { 
              // aqui es cuando ya finalice la peticion                          
            });            
        },
        cerrarModal(e){
          $('#login-modal').modal('hide');
          this.user = '';
          this.password = '';
          $('#loginForm').each(function(){
            this.reset();
          });
        }
      }
  });
</script>