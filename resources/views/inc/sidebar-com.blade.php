<div class="app-sidebar">
    <div class="app-menu">
        <img id="sidebar-logo" src="/images/logo-h.png">
        <ul class="accordion-menu mt-3">
            <li @if(url()->full() == route('com')) class="active-page" @endif>
                <a href="{{ route('com') }}" class="active"><i class="material-icons-two-tone">dashboard</i>Resumen</a>
            </li>
            <li @if(url()->full() == route('com.bodas')) class="active-page" @endif>
                <a href="{{ route('com.bodas') }}"><i class="material-icons-two-tone">favorite</i></a>
                <ul class="sub-menu" style="display: none;">
                    <li>
                        <a href="{{ route('com.bodas') }}"><i class="material-icons">list</i> </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.bodas.crear') }}"><i class="material-icons">add</i> </a>
                    </li>
                </ul>
            </li>
            <li @if(url()->full() == route('admin.mensajes')) class="active-page" @endif>
                <a href="{{ route('admin.mensajes') }}"><i class="material-icons-two-tone">question_answer</i>Mensajes  @if($count_new_messages > 0)<span class="badge rounded-pill badge-danger float-end">{!! $count_new_messages !!}</span>@endif</a>
            </li>
            <li><hr></li>
            <li>
                <a href="{{ route('logout') }}" onclick="return confirm('¿Estás seguro que deseas cerrar la sesión?')"><i class="material-icons-two-tone">logout</i>Cerrar sesión</a>
            </li>
        </ul>
    </div>
</div>
