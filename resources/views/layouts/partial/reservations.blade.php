<div class="modal fade" id="modalReservations" tabindex="-1" role="dialog" aria-labelledby="modalReservationsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalReservationsLbel"><span class="tit2 t-center">Mis Reservaciones</span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-md-12">
            <div class="row-md-12" style="margin-top: 10px">
              <p class="tit2">Sin Confirmar</p>
                <ul>
                @foreach ($reservaciones as $reservacion)
                @if ($reservacion->status == false)
                  <li style="margin-top: 5px"><strong>Restaurante: </strong> {{ $reservacion->restaurant->name_restaurant }}</li>
                  <li><strong>Fecha: </strong> {{ $reservacion->date }} <strong> y hora: </strong> {{ $reservacion->time }}</li>
                @endif
                @endforeach
                </ul>
            </div>  
            <div class="row-md-12">
              <p class="tit2">Confirmadas</p>
                <ul>
                @foreach ($reservaciones as $reservacion)
                @if ($reservacion->status == true)
                  <li style="margin-top: 5px"><strong>Restaurante: </strong> {{ $reservacion->restaurant->name_restaurant }}</li>
                  <li><strong>Fecha: </strong> {{ $reservacion->date }} <strong> y hora: </strong> {{ $reservacion->time }}</li>
                @endif
                @endforeach
                </ul>
            </div>                      
          </div>                              
        </div>                                            
        <div class="modal-footer">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">Salir</span>
            </button>
        </div>
      </div>
    </div>
  </div>