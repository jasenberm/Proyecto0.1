<div class="sidebar" data-color="purple" data-background-color="white" data-image="{{ asset('backend/img/sidebar-2.jpg') }}">
    <div class="logo">
        <a href="{{ route('admin.dashboard') }}" class="simple-text logo-normal">
            Accesos de Control
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="{{ Request::is('admin/dashboard*')? 'active': '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="material-icons">dashboard</i>
                    <p>Tablero</p>
                </a>
            </li>
            <li class="{{ Request::is('admin/restaurant*')? 'active': '' }}">
                <a class="nav-link" href="{{ route('restaurant.index') }}">
                    <i class="material-icons">restaurant</i>
                    <p>Restaurante</p>
                </a> 
            </li>
            {{-- <li class="{{ Request::is('admin/slider*')? 'active': '' }}">
                <a class="nav-link" href="{{ route('slider.index') }}">
                    <i class="material-icons">slideshow</i>
                    <p>Deslizantes</p>
                </a>
            </li> --}}
            <li class="{{ Request::is('admin/category*')? 'active': '' }}">
                <a class="nav-link" href="{{ route('category.index') }}">
                    <i class="material-icons">content_paste</i>
                    <p>Categorias</p>
                </a>
            </li>
            <li class="{{ Request::is('admin/item*')? 'active': '' }}">
                <a class="nav-link" href="{{ route('item.index') }}">
                    <i class="material-icons">library_books</i>
                    <p>Items</p>
                </a>
            </li>
            <li class="{{ Request::is('admin/reservation*')? 'active': '' }}">
                <a class="nav-link" href="{{ route('reservation.index') }}">
                    <i class="material-icons">chrome_reader_mode</i>
                    <p>Reservaciones</p>
                </a>
            </li>
            <li class="{{ Request::is('admin/contact*')? 'active': '' }}">
                <a class="nav-link" href="{{ route('contact.index') }}">
                    <i class="material-icons">message</i>
                    <p>Mensajes</p>
                </a> 
            </li>
            {{-- <li class="{{ Request::is('admin/maps*')? 'active': '' }}">
                <a class="nav-link" href="{{ route('maps.index') }}">
                    <i class="material-icons">add_location</i>
                    <p>Mapa</p>
                </a>
            </li> --}}
        </ul>
    </div>
</div>