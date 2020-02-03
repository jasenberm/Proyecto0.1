<div class="sidebar" data-color="purple" data-background-color="white" data-image="{{ asset('backend/img/sidebar-2.jpg') }}">
    <div class="logo">
        <a href="" class="simple-text logo-normal">
            Accesos de Control
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="{{ Request::is('superuser/superuser*')? 'active': '' }}">
                <a class="nav-link" href="{{ route('superuser.index') }}">
                    <i class="material-icons">dashboard</i>
                    <p>Super Usuarios</p>
                </a>
            </li>
            <li class="{{ Request::is('superuser/client*')? 'active': '' }}">
                <a class="nav-link" href="{{ route('client.index') }}">
                    <i class="material-icons">dashboard</i>
                    <p>Usuarios Clientes</p>
                </a>
            </li>
            <li class="{{ Request::is('superuser/owner*')? 'active': '' }}">
                <a class="nav-link" href="{{ route('owner.index') }}">
                    <i class="material-icons">dashboard</i>
                    <p>Usuarios Dueños</p>
                </a>
            </li>
            <li class="{{ Request::is('superuser/category_admin*')? 'active': '' }}">
                <a class="nav-link" href="{{ route('category_admin.index') }}">
                    <i class="material-icons">dashboard</i>
                    <p>Restaurante-Categorias</p>
                </a>
            </li>
            <li class="{{ Request::is('superuser/request*')? 'active': '' }}">
                <a class="nav-link" href="{{ route('request.index') }}">
                    <i class="material-icons">dashboard</i>
                    <p>Solicitudes</p>
                </a>
            </li>                        
            <li class="{{ Request::is('superuser/restaurant_admin*')? 'active': '' }}">
                <a class="nav-link" href="{{ route('restaurant_admin.index') }}">
                    <i class="material-icons">dashboard</i>
                    <p>Restaurantes</p>
                </a>
            </li>
        </ul>
    </div>
</div>