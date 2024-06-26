@extends('theme')
@section('title', 'Nueva empresa')
@section('header-tabs')
    <ul class="nav nav-tabs" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-basicos-tab" data-bs-toggle="pill" data-bs-target="#pills-basicos"
                type="button" role="tab" aria-controls="pills-basicos" aria-selected="true">
                <i class="material-icons-outlined">info</i> Datos básicos
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-ubicacion-tab" data-bs-toggle="pill" data-bs-target="#pills-ubicacion"
                type="button" role="tab" aria-controls="pills-ubicacion" aria-selected="false">
                <i class="material-icons-outlined">contact_page</i> Ubicación
            </button>
        </li>
    </ul>
@endsection
@section('content')
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-basicos" role="tabpanel" aria-labelledby="pills-basicos-tab">
            <form action="{{ route('admin.nueva.empresa') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row justify-content-center">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="col-sm-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">{{ __('datos_empresa') }}</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label">{{ __('name') }}</label>
                                        <input name="nombre_empresa" required="required" class="form-control" type="text"
                                            placeholder="{{ __('name_empresa') }}" value="{{ isset($user->empresa->nombre) ? $user->empresa->nombre : old('nombre_empresa') }}">
                                        @if($errors->has('nombre_empresa'))
                                            <span class="text-danger">{{ $errors->first('nombre_empresa') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <label class="form-label">CIF</label>
                                        <input name="cif" required="required" class="form-control" type="text"
                                            placeholder="CIF" value="{{ isset($user->empresa->cif) ? $user->empresa->cif : old('cif') }}">
                                        @if($errors->has('cif'))
                                            <span class="text-danger">{{ $errors->first('cif') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <label class="form-label">{{ __('img_empresa') }}</label>
                                        <input name="imagen_empresa" required="required" class="form-control" type="file" accept="image/*"
                                            placeholder="{{ __('placeholder_img_empresa') }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-label">{{ __('telefono') }}</label>
                                        <input placeholder="{{ __('telefono') }}..." type="tel" name="tel" class="form-control"
                                        value="{{ isset($user->empresa->telefono) ? $user->empresa->telefono : old('tel') }}">
                                        @if($errors->has('tel'))
                                            <span class="text-danger">{{ $errors->first('tel') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">{{ __('ciudad_empresa') }}</label>
                                        <select id="ciudad" class="form-control" name="ciudad" required autocomplete="ciudad">
                                            @if(isset($provincias))
                                                @foreach($provincias as $provincia)
                                                    @if(isset($empresa_user->ciudad) && $empresa_user->ciudad->provincia == $provincia->provincia)
                                                        <option value="{{ $provincia->id }}" selected>{{ $provincia->provincia }}</option>
                                                    @elseif(old('ciudad') == $provincia->provincia)
                                                        <option value="{{ $provincia->id }}" selected>{{ $provincia->provincia }}</option>
                                                    @else
                                                        <option value="{{ $provincia->id }}">{{ $provincia->provincia }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <label class="form-label">{{ __('tipo_empresa') }}</label>
                                        <select id="tipo_empresa" class="form-control" name="tipo_empresa" required autocomplete="tipo_empresa">
                                                @if(isset($tipo_empresas))
                                                    @foreach($tipo_empresas as $tipo_empresa)
                                                        @if(isset($empresa_user->tipoEmpresa) && $empresa_user->tipoEmpresa->tipo_nombre == $tipo_empresa->tipo_nombre)
                                                            <option value="{{ $tipo_empresa->id }}" selected>{{ $tipo_empresa->tipo_nombre }}</option>
                                                        @elseif(old('tipo_empresa') == $tipo_empresa->tipo_nombre)
                                                            <option value="{{ $tipo_empresa->id }}" selected>{{ $tipo_empresa->tipo_nombre }}</option>
                                                        @else
                                                            <option value="{{ $tipo_empresa->id }}">{{ $tipo_empresa->tipo_nombre }}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <label class="form-label">Sector</label>
                                        <select id="sector_empresa" class="form-control" name="sector_empresa" autocomplete="sector_empresa">
                                            @if(isset($sector_empresas))
                                                @foreach($sector_empresas as $sector_empresa)
                                                    @if(isset($empresa_user->sectorEmpresa) && $empresa_user->sectorEmpresa->nombre == $sector_empresa->nombre)
                                                        <option value="{{ $sector_empresa->sector_empresa_id }}" selected>{{ $sector_empresa->nombre }}</option>
                                                    @elseif(old('sector_empresa') == $sector_empresa->nombre)
                                                        <option value="{{ $sector_empresa->sector_empresa_id }}" selected>{{ $sector_empresa->nombre }}</option>
                                                    @else
                                                        <option value="{{ $sector_empresa->sector_empresa_id }}">{{ $sector_empresa->nombre }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">{{ __('datos_usuario') }}</div>
                            </div>
                            <div class="card-body row">
                                <div class="col-12">
                                    <label class="form-label">{{ __('name') }}</label>
                                    <input placeholder="{{ __('name') }}" type="text" class="form-control" value="{{ $user->name }}" disabled>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">{{ __('email') }}</label>
                                    <input placeholder="{{ __('email') }}..." type="email" class="form-control" value="{{ $user->email }}" disabled>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">{{ __('idioma') }}</label>
                                    <select id="idioma" class="form-control" name="idioma" required autocomplete="idioma">
                                        @if(isset($idiomas))
                                            @foreach($idiomas as $idioma)

                                                @if(old('sector_empresa') == $idioma->idioma)
                                                    <option value="{{ $idioma->idioma_id }}" selected>{{ $idioma->idioma }}</option>
                                                @else
                                                    <option value="{{ $idioma->idioma_id }}">{{ $idioma->idioma }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">{{ __('fecha_alta') }}</label>
                                    <input placeholder="{{ __('fecha_alta') }}" type="text" class="form-control" value="{{ $user->created_at->format('d-m-Y') }}" disabled>
                                </div>
                                <div class="col-6" style="margin-top: 10%;">
                                    <label class="form-label">{{ __('recibe_notificaciones') }}</label>
                                    <input type="checkbox" name="permite_notificaciones" @if(isset($user->permite_notificacion) && $user->permite_notificacion == 1) checked @endif>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <label class="form-label">{{ __('email_valido') }} </label>
                                            @if(isset($user->email_verified_at))
                                                @if($user->email_verified_at != null)
                                                    <span class="badge badge-success">{{ __('si') }}</span>
                                                @else
                                                    <span class="badge badge-danger">NO</span>
                                                @endif
                                            @else
                                                <span class="badge badge-danger">NO</span>
                                            @endif
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <label class="form-label">Cuenta </label>
                                            @if(isset($user->empresa->activo))
                                                @if($user->empresa->activo == 1)
                                                    <span class="badge badge-success">Activa</span>
                                                @else
                                                    <span class="badge badge-danger">Inactiva</span>
                                                @endif
                                            @else
                                                <span class="badge badge-danger">Inactiva</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <label class="form-label">Web</label>
                                        <input name="url_web" required="required" class="form-control" type="text"
                                            placeholder="Url web" value="{{ isset($user->empresa->web) ? $user->empresa->web : old('url_web') }}">
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <label class="form-label">Descripción</label>
                                        <textarea name="descripcion" style="width: 100%" cols="50" rows="5" class="form-control" type="text" placeholder="Breve descripción"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12" style="text-align:center;">
                        <input type="checkbox" name="acepto_condiciones" @if(isset($user->empresa->acepto_condiciones) && $user->empresa->acepto_condiciones == 1) checked @endif>
                        <label class="form-label" style="margin-top: 0;">He lído y acepto las condiciones y políticas de privacidad</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button style="width: 100%;" type="submit" class="btn btn-lg btn-block btn-primary loader">{{ __('btn_crear_empresa') }}</button>
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane fade" id="pills-ubicacion" role="tabpanel" aria-labelledby="pills-ubicacion-tab">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-12">
                    <div id="result_ok" class="alert alert-success alert-dismissible fade show" role="alert">
                        <span>Ubicación guardada correctamente</span>
                    </div>
                    <div id="result_error" class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span>Error al guardar la ubicación</span>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            @if(isset($user->empresa->ciudad))
                                <div class="row">
                                    <div class="col-12">
                                        <div class="col-sm-12 col-md-6">
                                            <p>Comunidad Autónoma: <span>{{ isset($user->empresa->ciudad->ccaa) ? $user->empresa->ciudad->ccaa : ''  }}</span></p>
                                            <p>Provincia: <span id="prov_actual">{{ isset($user->empresa->ciudad->provincia) ? $user->empresa->ciudad->provincia : '' }}</span></p>
                                        </div>
                                        <div id='map' style='width: 80%; height: 300px;'></div>
                                        <div class="col-sm-12 col-md-6">
                                            <p>Dirección: <span id="direccion"></span></p>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <button id="btn_guardar_ubicacion" class="btn btn-primary">Guardar ubicación</button>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <h1>Aún no dispone de ubicación</h1>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/form_new_company.css') }}">
    <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.css' type='text/css' />
    <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css' type='text/css' />
@endsection
@section('js')
    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js'></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js'></script>
    <script>
        var accessToken = '{{ env('MAPBOX_API_KEY') }}';
        var ciudad_user_geo_lat = '{{ isset($user->empresa->ciudad->lat) ? $user->empresa->ciudad->lat : '' }}';
        var ciudad_user_geo_lon = '{{ isset($user->empresa->ciudad->lon) ? $user->empresa->ciudad->lon : '' }}';
        var direccion_empresa = '{{ isset($user->empresa->ubicacion) ? $user->empresa->ubicacion : '' }}';
        var route_guarda_ubic = '{{ route('admin.guardar.ubicacion') }}';
    </script>
    <script src="{{ asset('assets/js/form_new_company.js') }}"></script>
@endsection
@endsection
