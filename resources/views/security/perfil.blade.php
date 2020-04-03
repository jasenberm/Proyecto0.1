<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>

{{-- <style>
  input{
    border: 1px #ced4da solid !important;
  }
</style> --}}


<!-- Modal -->
<div class="modal fade" id="perfil-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title tit2" id="staticBackdropLabel">Mi Perfil</h5>
        <button type="button" class="close" @click="cerrarPerfilModal(event)" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="loginForm" autocomplete="off">
      <div class="modal-body">        
        
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <div class="row">
            <div class="col-md-5">
                <img src="{{ asset('frontend/images/perfil-default.jpg') }}" alt="perfil-default" style="margin-top: 25px">
            </div>
    
            <div class="col-md-7">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating txt9">Usuario</label>
                      <input type="text" id="usuario" readonly class="form-control" v-model="user" required>
                  </div>
                </div>
                
                <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating txt9">Nombres</label>
                        <input type="text" id="nombres" readonly class="form-control" v-model="nombres" required>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating txt9">Apellidos</label>
                        <input type="text" id="apellidos" readonly class="form-control" v-model="apellidos" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="bmd-label-floating txt9">Correo</label>
                      <input type="text" id="correo" readonly class="form-control" v-model="correo" required>
                  </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="bmd-label-floating txt9">Contraseña</label>
                      <input type="text" id="contrasenia" readonly class="form-control" v-model="contrasenia" required>
                  </div>
            </div>
        </div>
               
      </div>
      <div class="modal-footer">
        <input type="button" id="confirmar" style="display: none" class="btn btn-success confirmar hiden" @click="guardarPerfil(event)" value="Confirmar">
        <input type="button" id="editar" class="btn btn-primary editarUsuario" @click="editarEvent(event)" value="Editar Usuario"/>
        <button type="button" class="btn btn-secondary" @click="cerrarPerfilModal(event)">Cerrar</button>      
      </div>
    </form>
    </div>
  </div>
</div>

<script>
  new Vue({
      el:'#perfil-modal',
      data:{
          user: '{{ Auth::user()->user }}',
          nombres: '{{ Auth::user()->name }}',
          apellidos: '{{ Auth::user()->last_name }}',
          correo: '{{ Auth::user()->email }}',
          contrasenia: ''
      },
      
      methods:{
        cerrarPerfilModal(e){
            $('#perfil-modal').modal('hide');
            document.getElementById("editar").style.display="block";            
            $("#usuario").attr("readonly", "readonly");
            $("#nombres").attr("readonly", "readonly");
            $("#apellidos").attr("readonly", "readonly");
            $("#correo").attr("readonly", "readonly");
            $("#contrasenia").attr("readonly", "readonly");
            document.getElementById("confirmar").style.display="none";
        },
        editarEvent(e){
            document.getElementById("editar").style.display="none";   
            $("#usuario").attr("readonly", false);         
            $("#nombres").attr("readonly", false); 
            $("#apellidos").attr("readonly", false);
            $("#correo").attr("readonly", false); 
            $("#contrasenia").attr("readonly", false);
            document.getElementById("confirmar").style.display="block";
                     
        },
        guardarPerfil(e){
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.post("{{ url('/login') }}",
            { user:this.user,name:this.nombres,last_name:this.apellidos,email:this.correo,password
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
        }    
      }
  });
</script>