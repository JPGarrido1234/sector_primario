<div class="app-sidebar">
    <div class="app-menu">
        <div class="d-flex flex-column align-items-center justify-content-center">
            <img src="{{ asset('storage/empresas/TIENDA/logo_empresa.jpg') }}" alt="Avatar" class="avatar">
            <div class="app-menu__user-name">{{ Auth::user()->name }}</div>
            <div class="app-menu__user-designation">{{ Auth::user()->empresa->nombre }}</div>
        </div>
        <hr>
        <ul class="accordion-menu mt-3">
            <li @if(url()->full() == route('admin.dashboard')) class="active-page" @endif>
                <a href="{{ route('admin.dashboard') }}"><i class="material-icons-two-tone">tune</i>{{ __('panel_control') }}</a>
            </li>
            <li class="sidebar-title">{{ __('sidebar_title_empresas') }}</li>
            @if(Auth::user()->empresa->validado_admin == 0)
                <li @if(url()->full() == route('admin.nueva.form.empresa')) class="active-page" @endif>
                    <a href="{{ route('admin.nueva.form.empresa') }}" style="margin-left: 18px; border: 1px solid #4bad48;" class="btn btn-link">
                        <i style="padding-right: 9px;" class="material-icons-two-tone">apartment</i>{{ __('sidebar_nueva_empresa') }}
                    </a>
                </li>
            @else
                <li @if(url()->full() == route('admin.nueva.form.empresa')) class="active-page" @endif>
                    <a href="{{ route('admin.nueva.form.empresa') }}"><i class="material-icons">apartment</i>{{ __('sidebar_empresa') }}</a>
                </li>
                @if(Auth::user()->empresa->sectorEmpresa->nombre_corto == 'AGR')
                    <li @if(url()->full() == route('admin.producto')) class="active-page" @endif>
                        <a href="{{ route('admin.producto') }}"><i class="material-icons">restaurant</i>{{ __('productos') }}</a>
                    </li>
                    <li>
                        <a href="#"><i class="material-icons">local_shipping</i>{{ __('transportes') }}</a>
                    </li>
                    <li @if(url()->full() == route('admin.ver.mapa')) class="active-page" @endif>
                        <a href="{{ route('admin.ver.mapa') }}"><i class="material-icons">map</i>{{ __('mapa') }}</a>
                    </li>
                @elseif(Auth::user()->empresa->sectorEmpresa->nombre_corto == 'TI')
                    <li @if(url()->full() == route('admin.lista.ver.producto')) class="active-page" @endif>
                        <a href="{{ route('admin.lista.ver.producto') }}"><i class="material-icons">restaurant</i>{{ __('productos_disponibles') }}</a>
                    </li>
                    <li>
                        <a href="#"><i class="material-icons">taxi_alert</i>Solicitudes en proceso</a>
                    </li>
                @elseif(Auth::user()->empresa->sectorEmpresa->nombre_corto == 'TRANS')
                    <li>
                        <a href="#"><i class="material-icons">local_shipping</i>{{ __('transportes') }}</a>
                    </li>
                    <li @if(url()->full() == route('admin.ver.mapa')) class="active-page" @endif>
                        <a href="{{ route('admin.ver.mapa') }}"><i class="material-icons">map</i>{{ __('mapa') }}</a>
                    </li>
                    <li>
                        <a href="#"><i class="material-icons">fork_right</i>{{ __('rutas') }}</a>
                    </li>
                @endif
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
            @endif
            <li class="sidebar-title">Ayuda</li>
            <li>
                <!-- ChatBots -->
                <a href="#"><i class="material-icons">feedback</i>Soporte</a>
            </li>
            <li><hr></li>
            <li>
                <a href="{{ route('logout') }}" onclick="return confirm('¿Estás seguro que deseas cerrar la sesión?')"><i class="material-icons-two-tone">logout</i>{{__('cerrar_sesion')}}</a>
            </li>
        </ul>
    </div>
</div>
