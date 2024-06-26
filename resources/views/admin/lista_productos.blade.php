@extends('theme')
@section('title', "Productos disponibles para la venta en " . (Auth::user()->Empresa->ciudad->provincia ?? ''))
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-12 col-md-12">
        <div class="card p-3">
            <div class="card-body">
                <div class="row">
                    @if(isset($productos))
                        @foreach($productos as $producto)
                        <div class="col-3">
                            <div class="card p-1" style="width: 18rem;">
                                <div class="d-flex justify-content-center m-1">
                                    <p>Valoración: 0/10</p>
                                </div>
                                <img class="card-img-top" src="/assets/frutasVerduras/{{ $producto->fruitVegetable->image_url }}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $producto->fruitVegetable->name }}</h5>
                                    <ul style="list-style: none;">
                                        <li><b>Precio Unidad:</b> {{ $producto->precio_unidad }}</li>
                                        <li><b>Quedan:</b> {{ $producto->cantidad_en_venta }}</li>
                                        <li><b>Última venta:</b> --</li>
                                        <li id="distancia_{{$producto->id}}">{{ $producto->User->Empresa->lonlat }}</li>
                                    </ul>
                                </div>
                                <div class="card-footer">
                                    <p style="text-align: center;">
                                        <a href="{{ route('admin.lista.producto.solicitar', ['id' => $producto->id]) }}" class="btn btn-primary">SOLICITAR COMPRA</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@section('css')
    <style>
        .p-3{
            padding: 1rem; /* Cambia 1rem al valor que desees */
        }
        .m-2{
            margin: 0.5rem; /* Cambia 0.5rem al valor que desees */
        }
    </style>
@endsection
@section('js')
    <script>
        var token = '{{ csrf_token() }}';
        var url_get_productos = '{{ route('api.productos.imagenes') }}';
        var productos_js = @json($productos);
        var miUbicacion = '{{ \App\Http\Controllers\AdminController::getMiUbicacion() }}';
    </script>
    <script src='https://npmcdn.com/@turf/turf/turf.min.js'></script>
    <script src="{{ asset('assets/js/form_new_producto.js') }}"></script>
    <script>
        function handleCardClick(id, descripcion) {
           $('.box').hide();
           $('#lista_productos').append('<div class="col-8 d-flex align-items-center"><p>'+descripcion+'</p></div>');
           $('#lista_productos').append('<input type="hidden" name="opcion" value="'+id+'">');
           $('#'+id).show();
           $('#box_form_card').show();
        }
    </script>
@endsection
@endsection
