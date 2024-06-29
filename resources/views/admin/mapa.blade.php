@extends('theme')
@section('title', 'Mapa - España ')
@section('content')
<div class="row justify-content-center">
    <div class="d-flex justify-content-start">
        <select id="select-provincia" class="form-select m-2" aria-label="Default select example">
            <option value="-1" selected>Toda Espa&ntilde;a</option>
            @foreach($provincias as $provincia)
                <option value="{{ $provincia->id }}">{{ $provincia->texto }}</option>
            @endforeach
        </select>
        <button id="btn-todo" class="btn btn-outline-primary m-2">TODO</button>
        <button id="btn-tiendas" class="btn btn-outline-primary m-2">TIENDAS</button>
        <button id="btn-agricultores" class="btn btn-outline-primary m-2">AGRICULTORES</button>
        <button id="btn-transportistas" class="btn btn-outline-primary m-2">TRANSPORTISTAS</button>
    </div>
    <div class="col-sm-12 col-md-12">
        <div id='map' style='width: 100%; height: 500px;'></div>
    </div>
</div>
@section('css')
<link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css' type='text/css' />
@endsection
@section('js')
<script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js'></script>
<script>
    var accessToken = '{{ env('MAPBOX_API_KEY') }}';
    var icon_tienda_url = '{{ asset('assets/mapa/tienda.png') }}';
    var select_provincia_dato = $('#select-provincia').val();
    var url_base = '/admin/ver-mapa/todos/';
    var url_todos = url_base + select_provincia_dato;
</script>
<script src="{{ asset('assets/js/mapa_uso_general.js') }}"></script>
@endsection
@endsection
