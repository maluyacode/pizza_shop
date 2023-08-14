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
            <div class="row row-best-sellers">
                <canvas id="Chart1"></canvas>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <canvas id="Chart2"></canvas>
                </div>
                <div class="col-md-6">
                    <canvas id="Chart3"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
    <script src="{{ asset('asset/chart.js') }}"></script>
    <script src="{{ asset('js/chart.js') }}"></script>
@endsection
