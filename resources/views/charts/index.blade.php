@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center title">
        <h1>Charts</h1>
    </div>
    <div class="row justify-content-center">
        <canvas id="Chart1"></canvas>
        <canvas id="Chart2"></canvas>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/chart.js') }}"></script>
@endsection
