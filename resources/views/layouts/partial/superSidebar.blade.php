<div class="sidebar" data-color="purple" data-background-color="white" data-image="{{ asset('backend/img/sidebar-2.jpg') }}">
    <div class="logo">
        <a href="" class="simple-text logo-normal">
            Accesos de Control
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
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
            <li class="{{ Request::is('superuser/category*')? 'active': '' }}">
                <a class="nav-link" href="{{ route('category.index') }}">
                    <i class="material-icons">dashboard</i>
                    <p>Restaurante-Categorias</p>
                </a>
            </li>
        </ul>
    </div>
</div>