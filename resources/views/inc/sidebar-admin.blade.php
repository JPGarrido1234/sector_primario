<div class="app-sidebar">
    <div class="app-menu">
        <ul class="accordion-menu mt-3">
            <li @if(url()->full() == route('admin.dashboard')) class="active-page" @endif>
                <a href="{{ route('admin.dashboard') }}"><i class="material-icons-two-tone">tune</i>{{ __('panel_control') }}</a>
            </li>
            <li class="sidebar-title">{{ __('sidebar_title_empresas') }}</li>
            <li>
                <a href="#"><i class="material-icons">list</i>{{ __('usuarios') }}</a>
            </li>
            <li @if(url()->full() == route('admin.lista.empresas')) class="active-page" @endif>
                <a href="{{ route('admin.lista.empresas') }}"><i class="material-icons">apartment</i>{{ __('sidebar_empresas') }}</a>
            </li>
            <li>
                <a href="#"><i class="material-icons">local_shipping</i>{{ __('transportes') }}</a>
            </li>
            <li>
                <a href="#"><i class="material-icons">shopping_cart</i>{{ __('tiendas') }}</a>
            </li>
            <li>
                <a href="#"><i class="material-icons">people_alt</i>{{ __('comerciales') }}</a>
            </li>
            <li>
                <a href="#"><i class="material-icons">fork_right</i>{{ __('rutas') }}</a>
            </li>
            <li @if(url()->full() == route('admin.ver.mapa')) class="active-page" @endif>
                <a href="{{ route('admin.ver.mapa') }}"><i class="material-icons">map</i>{{ __('mapa') }}</a>
            </li>
            <li>
                <a href="#"><i class="material-icons">restaurant</i>{{ __('productos') }}</a>
            </li>
            <li>
                <a href="#"><i class="material-icons">taxi_alert</i>Pedidos</a>
            </li>
            <li class="sidebar-title">{{ __('sistema_mensaje') }}</li>
            <li>
                <a href="#"><i class="material-icons">email</i>Mensajes</a>
            </li>
            <li>
                <a href="#"><i class="material-icons">feed</i>Noticias</a>
            </li>
            <li class="sidebar-title">{{ __('general') }}</li>
            <li>
                <a href="#"><i class="material-icons">description</i>Documentos</a>
            </li>
            <li>
                <a href="#"><i class="material-icons">money</i>Facturas</a>
            </li>
            <li class="sidebar-title">Configuración</li>
            <li>
                <a href="#"><i class="material-icons">settings</i>Ajustes</a>
            </li>
            <li><hr></li>
            <li>
                <a href="{{ route('logout') }}" onclick="return confirm('¿Estás seguro que deseas cerrar la sesión?')"><i class="material-icons-two-tone">logout</i>{{ __('cerrar_sesion') }}</a>
            </li>
        </ul>
    </div>
</div>
