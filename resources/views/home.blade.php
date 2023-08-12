@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection
{{-- {{ dd($categories) }} --}}
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center title">
            <h1>Menu</h1>
        </div>
        <div class="row justify-content-center">
            @foreach ($categories as $category)
                <div class="card col-md-4">
                    @if (count($category->media) > 0)
                        <img class="card-img-top" src="{{ $category->media[0]->original_url }}" alt="Card image cap">
                    @else
                        <img class="card-img-top" src="{{ asset('storage/images/profilePic.jpg') }}" alt="Card image cap">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $category->name }}</h5>
                        <p class="card-text">{{ $category->detail }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('ViewAllProduct', $category->id) }}" class="btn btn-dark">View All</a>
                    </div>
                </div>
            @endforeach
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
@endsection
