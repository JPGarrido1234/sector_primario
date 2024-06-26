@extends('theme')
@section('title', 'Listado de empresas ')
@section('content')
<div class="row justify-content-center">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="col-sm-12 col-md-12">
        <table id="empresas-table" class="table table-striped">
            <thead>
                <tr>
                    <th> {{ __('empresa_tipo') }} </th>
                    <th> {{ __('empresa_nombre') }} </th>
                    <th> {{ __('empresa_cif') }} </th>
                    <th> {{ __('empresa_imagen_logo') }} </th>
                    <th> {{ __('empresa_telefono') }} </th>
                    <th> {{ __('empresa_sector') }} </th>
                    <th> {{ __('empresa_web') }} </th>
                    <th> {{ __('empresa_activo') }} </th>
                    <th> {{ __('empresa_condicion') }} </th>
                    <th> {{ __('empresa_creado') }} </th>
                    <th> {{ __('empresa_accion') }} </th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@section('css')
    <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
@section('js')
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        var empresasUrl = '{{ route("admin.empresas") }}';
    </script>
    <script src="{{ asset('assets/js/listado_empresas.js') }}"></script>
@endsection
@endsection
