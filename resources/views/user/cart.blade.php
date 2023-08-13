@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endsection
{{-- {{ dd($cart) }} --}}
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center title">
            <h1>My Cart</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $key => $item)
                            {{-- {{ dd($item) }} --}}
                            <tr>
                                <td>{{ $item['product_name'] }}</td>
                                <td>
                                    <button class="btn btn-outline-success btn-sm sub">-</button>
                                    <input class="quantity" class="form-control form-inline" disabled
                                        value="{{ $item['quantity'] }}">
                                    <button class="btn btn-outline-success btn-sm add">+</button>
                                </td>
                                <td>{{ $item['quantity'] * $item['product_price'] }}</td>
                                <td>
                                    <button class="btn btn-danger btn-sm">Remove</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <div class="checkout-card card border-dark mb-3" style="max-width: 18rem;">
                    <div class="card-header bg-body-secondary border-dark">Order Summary</div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="address">Delivery Address</label>
                                <input type="text" class="form-control" id="address"
                                    placeholder="Enter delivery address">
                            </div>
                            <div class="form-group">
                                <label for="address">Payment Method</label>
                                <select class="form-control" id="payment" name="payment_id">
                                    <option>Select payment method</option>
                                    @foreach ($payments as $key => $method)
                                        <option value="{{ $key }}">{{ $method }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                        <h5 class="card-title"><span>Total Price </span><span>P2000</span></h5>
                    </div>
                    <div class="card-footer bg-body-secondary border-dark">
                        <button style="float: left;" class="btn btn-outline-danger">Remove All</button>
                        <button style="float: right;" class="btn btn-outline-success">Checkout</button>
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
