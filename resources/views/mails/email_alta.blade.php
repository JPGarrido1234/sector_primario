<h1>Bienvenido a nuestro sitio web, {{ $user->name }}</h1>
<p>Gracias por registrarte. Esperamos que disfrutes de nuestro contenido.</p>
<a class="btn btn-primary" href="{{ route('user.valida_email', ['id' => $user->id]) }}">Validar Email</a>
