@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center title">
            <h1>{{ $category->name }}</h1>
        </div>
        <div class="row justify-content-center">
            @foreach ($products as $product)
                <div class="card col-md-4">
                    @if (count($product->media) > 0)
                        <img class="card-img-top" src="{{ $product->media[0]->original_url }}" alt="Card image cap">
                    @else
                        <img class="card-img-top" src="{{ asset('storage/images/profilePic.jpg') }}" alt="Card image cap">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title" style="display:flex;justify-content:space-between; ">
                            <span>{{ $product->name }}</span><span>&#8369;{{ $product->price }}</span>
                        </h5>
                        <p class="card-text">{{ $product->detail }}</p>
                    </div>
                    <div class="card-footer" style="display:flex;justify-content:space-between; ">
                        <button class="btn btn-dark">Add to Cart</button>
                        <a href="{{ route('product.details', $product->id) }}" class="btn btn-dark">Quick View</a>
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
