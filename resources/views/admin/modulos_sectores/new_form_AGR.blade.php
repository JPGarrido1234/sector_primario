<div class="card">
    <div class="card-header">
        <div class="card-title">Datos agricultor</div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <label class="form-label">{{ __('ubicacion_empresa') }}</label>
                <input name="ubicacion" required="required" class="form-control" type="text"
                    placeholder="{{ __('ubicacion_empresa') }}">
            </div>
            <div class="col-sm-12 col-md-6">
                <label class="form-label">{{ __('producto_siembra') }}</label>
                <input name="producto_siembra" required="required" class="form-control" type="text" placeholder="{{ __('producto') }}">
            </div>
            <div class="col-sm-12 col-md-6">
                <label class="form-label">{{ __('vende_producto') }}</label>
                <input name="vende_producto" required="required" class="form-control" type="text" placeholder="{{ __('vende_producto en Kg') }}">
            </div>
            <div class="col-sm-12 col-md-6">
                <label class="form-label">{{ __('fecha_producto recogida siembra') }}</label>
                <input name="fecha_producto" required="required" class="form-control" type="text" placeholder="{{ __('fecha_producto en venta') }}">
            </div>
            <div class="col-sm-12 col-md-6">
                <label class="form-label">{{ __('caducidad_producto recogida siembra') }}</label>
                <input name="caducidad_producto" required="required" class="form-control" type="text" placeholder="{{ __('caducidad_producto en venta') }}">
            </div>
        </div>
    </div>
</div>
