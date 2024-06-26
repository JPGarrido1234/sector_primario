@extends('theme')
@section('title', 'Productos a la venta')
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-12 col-md-12">
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @elseif(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-auto d-flex align-items-center">
                                <div class="form-group">
                                    <label for="frutas">Frutas</label>
                                    <input type="checkbox" id="frutas" name="frutas" required>
                                </div>
                            </div>
                            <div class="col-auto d-flex align-items-center">
                                <div class="form-group">
                                    <label for="verduras">Verduras</label>
                                    <input type="checkbox" id="verduras" name="verduras" required>
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('admin.nuevo.producto') }}">
                            @csrf
                            <div id="lista_productos" class="row m-3">
                                <i id="loading-icon" class="fas fa-spinner fa-spin" style="display: none;"></i>
                            </div>
                            <div id="box_form_card">
                                <div class="row">
                                    <h4>{{ __('info_venta_producto') }}</h4>
                                    <div class="col-sm-12 col-md-3">
                                        <label class="form-label">{{ __('Peso en Kg') }}</label>
                                        <input name="peso_pieza" required="required" class="form-control btn_validar_form" type="text"
                                            placeholder="{{ __('peso por pieza') }}">
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <label class="form-label">{{ __('Precio') }}</label>
                                        <input name="precio_pieza" required="required" class="form-control btn_validar_form" type="text"
                                            placeholder="{{ __('precio por unidad') }}">
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <label class="form-label">{{ __('Cantidad en venta') }}</label>
                                        <input name="en_venta" required="required" class="form-control btn_validar_form" type="text"
                                            placeholder="{{ __('cantidad para vender') }}">
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <label class="form-label">{{ __('Stock') }}</label>
                                        <input name="stock" required="required" class="form-control btn_validar_form" type="text"
                                            placeholder="{{ __('stock') }}">
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <label class="form-label">{{ __('fecha cosecha') }}</label>
                                        <input name="fecha_cosecha" required="required" class="form-control btn_validar_form" type="date"
                                            placeholder="{{ __('Fecha de recogida de cosecha') }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <button id="nuevoProducto" type="submit" class="btn btn-outline-primary m-2">
                                        <i class="bi bi-plus-circle-fill"></i>Nuevo producto
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card p-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h4 class="text-left">Productos disponibles</h4>
                    </div>
                    @if(isset($productos_disponibles))
                        @foreach($productos_disponibles as $producto)
                        <div class="col-3">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="../assets/frutasVerduras/{{ $producto->fruitVegetable->image_url }}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $producto->fruitVegetable->name }}</h5>
                                    <p>
                                        <b>Peso Unidad:</b> {{ $producto->peso }}
                                        <b>Precio Unidad:</b> {{ $producto->precio_unidad }}
                                        <b>En venta:</b> {{ $producto->cantidad_en_venta }}
                                    </p>
                                    <p style="text-align: center;">
                                        <a href="{{ route('admin.ver.producto', ['id' => $producto->id]) }}" class="btn btn-primary">VER</a>
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
    </script>
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
