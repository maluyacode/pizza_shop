@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/product-details.css') }}">
@endsection
{{-- {{ dd($categories) }} --}}
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center title">
            <div class="card mb-3" style="max-width: 1000px; max-height: 500px;">
                <div class="row g-0">
                    <div class="col-md-5 left-col">
                        <img src="https://mdbcdn.b-cdn.net/wp-content/uploads/2020/06/vertical.webp"
                            alt="Trendy Pants and Shoes" class="img-fluid rounded-start" />
                    </div>
                    <div class="col-md-7" style="display: flex; flex-direction:column;justify-content:space-between">
                        <div class="card-body">
                            <h1 class="card-title"><span>{{ $product->name }} </span> <span>&#8369;{{ $product->price }}
                                </span>
                            </h1>
                            <p class="card-text">{{ $product->detail }}</p>
                            <p class="card-text">
                                <small class="text-muted">{{ $product->detail }}</small>
                            </p>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-outline-warning" style="float: right">Add to Cart</button>
                        </div>
                    </div>
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
@endsection
