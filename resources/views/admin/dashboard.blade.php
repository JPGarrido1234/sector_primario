@extends('theme')
@section('title', 'Dashboard')
@section('content')
<div class="row justify-content-center">
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @elseif(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="col-sm-12 col-md-6">
        @if(Auth::user()->roles[0]->name == 'admin')
            @if(isset($users_chart_count))
                <canvas data-datos="{!! json_encode($users_chart_count->values(), true) !!}" id="myChart"></canvas>
            @endif
        @endif
    </div>
</div>
@section('js')
    <script src="{{ asset('assets/js/charts_web.js') }}"></script>
@endsection
@endsection
