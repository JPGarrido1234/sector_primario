<div class="app-sidebar">
    <div class="app-menu">
        <ul class="accordion-menu mt-3">
            <li @if(url()->full() == route('admin.gestor')) class="active-page" @endif>
                <a href="{{ route('admin.gestor') }}" class="active"><i class="material-icons-two-tone">dashboard</i></a>
            </li>
            <li><hr></li>
            <li>
                <a href="{{ route('logout') }}" onclick="return confirm('¿Estás seguro que deseas cerrar la sesión?')"><i class="material-icons-two-tone">logout</i>Cerrar sesión</a>
            </li>
        </ul>
    </div>
</div>
