@extends('theme')
@section('title', 'Nuevo - Datos Básicos ')
@section('content')
<div class="row">
<div id="select_AGR" @if(isset($empresa_user->sectorEmpresa) && $empresa_user->sectorEmpresa->nombre_corto == 'AGR') @disabled(false) @else @disabled(true) @endif class="col-sm-12 col-md-12">
    @include('admin.modulos_sectores.new_form_AGR')
</div>
<div id="select_TRANS" @if(isset($empresa_user->sectorEmpresa) && $empresa_user->sectorEmpresa->nombre_corto == 'TRANS') @disabled(false) @else @disabled(true) @endif class="col-sm-12 col-md-12">
    @include('admin.modulos_sectores.new_form_TRANS')
</div>
<div id="select_TI" @if(isset($empresa_user->sectorEmpresa) && $empresa_user->sectorEmpresa->nombre_corto == 'TI') @disabled(false) @else @disabled(true) @endif class="col-sm-12 col-md-12">
    @include('admin.modulos_sectores.new_form_TI')
</div>
<div id="select_COM" @if(isset($empresa_user->sectorEmpresa) && $empresa_user->sectorEmpresa->nombre_corto == 'COM') @disabled(false) @else @disabled(true) @endif class="col-sm-12 col-md-12">
    @include('admin.modulos_sectores.new_form_COM')
</div>
</div>
@section('css')
@endsection
@section('js')
    <script src="{{ asset('assets/js/form_new_sector.js') }}"></script>
@endsection
@endsection
