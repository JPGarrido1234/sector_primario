@extends('theme')
@section('title', 'Ver producto a la venta')
@section('content')
<div class="row justify-content-center">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="row m-3">
                            <div class="col-3 box">
                                <div class="card d-flex align-items-center" style="border: 1px solid #4bad48;">
                                   <img style="width:216px; height:130px; margin-top:15px;" src="/assets/frutasVerduras/{{ $producto->fruitVegetable->image_url }}" class="card-img-top" alt="...">
                                   <div class="card-body">

                                   </div>
                                </div>
                            </div>
                            <div class="col-8 d-flex align-items-center"><p>{{ $producto->fruitVegetable->descripcion }}</p></div>
                        </div>
                        <div class="row d-flex text-center" style="padding-bottom: 2em;">
                            <div class="col-4">
                                <span><b>{{ __('valoracion') }}: </b>0</span>
                            </div>
                            <div class="col-4">
                                <span><b>{{ __('veces_vendido') }}: </b>0</span>
                            </div>
                            <div class="col-4">
                                <span><b>{{ __('cantidad_vendida') }}: </b>0</span>
                            </div>
                        </div>
                        <div class="row">
                            <h4>{{ __('info_venta_producto') }}</h4>
                            <div class="col-sm-12 col-md-2">
                                <label class="form-label">{{ __('Peso en Kg') }}</label>
                                <input name="peso_pieza" required="required" class="form-control" type="text"
                                    placeholder="{{ __('peso por pieza') }}" value="{{ $producto->peso }}">
                            </div>
                            <div class="col-sm-12 col-md-2">
                                <label class="form-label">{{ __('Precio') }}</label>
                                <input name="precio_pieza" required="required" class="form-control" type="text"
                                    placeholder="{{ __('precio por unidad') }}" value="{{ $producto->precio_unidad }}">
                            </div>
                            <div class="col-sm-12 col-md-2">
                                <label class="form-label">{{ __('Cantidad en venta') }}</label>
                                <input name="en_venta" required="required" class="form-control" type="text"
                                    placeholder="{{ __('cantidad para vender') }}" value="{{ $producto->cantidad_en_venta }}">
                            </div>
                            <div class="col-sm-12 col-md-2">
                                <label class="form-label">{{ __('Stock') }}</label>
                                <input name="stock" required="required" class="form-control" type="text"
                                    placeholder="{{ __('stock') }}" value="{{ $producto->cantidad_stock }}">
                            </div>
                            <div class="col-sm-12 col-md-2">
                                <label class="form-label">{{ __('fecha cosecha') }}</label>
                                <input name="fecha_cosecha" required="required" class="form-control" type="date"
                                    placeholder="{{ __('Fecha de recogida de cosecha') }}" value="{{ $producto->fecha_cosecha }}" disabled>
                            </div>
                            <div class="col-sm-12 col-md-2">
                                <label class="form-label">{{ __('Estado producto') }}</label>
                                <p class="d-flex align-items-center"><span style="color:#4bad48; margin-top:5%;">BUENO</span></p>
                            </div>
                        </div>
                        <div class="row">
                            <button type="submit" class="btn btn-outline-primary m-2">
                                <i class="bi bi-plus-circle-fill"></i>{{ __('editar')}}
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <h4>{{ __('historial_ventas_producto') }}</h4>
                    <div class="col-12 p-3">
                        <h5>{{ __('lista_venta_vacia') }}</h5>
                    </div>
                </div>
                <div class="row">
                    <h4>{{ __('historial_rutas_producto') }}</h4>
                    <div class="col-12 p-3">
                        <h5>{{ __('lista_rutas_vacia') }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
