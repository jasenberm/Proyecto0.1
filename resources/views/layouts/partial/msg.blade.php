@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="material-icons">close</i>
            </button>                
            <span>
                <b> Danger - </b>{{ $error }}</span>
        </div> 
    @endforeach
@endif

@if (session('successMsg'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="material-icons">close</i>
        </button>
        <span>
            <b> Exito - </b>{{ session('successMsg') }}</span>
    </div>
@endif

@if (session('alertMsg'))
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="material-icons">close</i>
        </button>
        <span>
            <b> Alerta - </b>{{ session('alertMsg') }}</span>
    </div>
@endif