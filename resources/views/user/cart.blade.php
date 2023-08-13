@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endsection
@php
    $total = 0;
@endphp
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
                        @if ($cart == [])
                            <tr>
                                <td>
                                    <p>No items</p>
                                </td>
                                <td>
                                    <p>No items</p>
                                </td>
                                <td>
                                    <p>No items</p>
                                </td>
                                <td>
                                    <p>No items</p>
                                </td>
                            </tr>
                        @endif
                        @foreach ($cart as $key => $item)
                            {{-- {{ dd($item) }} --}}
                            <tr>
                                <td>{{ $item['product_name'] }}</td>
                                <td>
                                    <button data-id="{{ $key }}"
                                        class="btn btn-outline-success btn-sm sub">-</button>
                                    <input class="quantity" class="form-control form-inline" disabled
                                        value="{{ $item['quantity'] }}">
                                    <button data-id="{{ $key }}"
                                        class="btn btn-outline-success btn-sm add">+</button>
                                </td>
                                <td class="item-price">{{ $item['quantity'] * $item['product_price'] }}</td>
                                <td>
                                    <a href="{{ route('removeItem', $key) }}" class="btn btn-danger btn-sm">Remove</a>
                                </td>
                            </tr>
                            @php
                                $total += $item['quantity'] * $item['product_price'];
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <form id="checkoutForm" action="{{ route('checkout') }}" method="POST">
                    @csrf
                    <div class="checkout-card card border-dark mb-3" style="max-width: 18rem;">
                        <div class="card-header bg-body-secondary border-dark">Order Summary</div>
                        <div class="card-body">

                            <div class="form-group form-cart">
                                <label for="address">Delivery Address </label> <i class="bi bi-info-circle"
                                    data-toggle="tooltip" data-placement="top"
                                    title="If you leave this blank, we deliver it to your home address"></i>
                                <input type="text" class="form-control" id="address"
                                    placeholder="Enter delivery address" name="address">
                            </div>
                            <div class="form-group form-cart">
                                <label for="address">Payment Method</label>
                                <select class="form-control" id="payment" name="payment_id">
                                    <option value="">Select payment method</option>
                                    @foreach ($payments as $key => $method)
                                        <option value="{{ $key }}">{{ $method }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <h5 class="card-title"><span>Total Price </span><span
                                    id="total-price">&#8369;{{ $total }}</span></h5>
                        </div>
                        <div class="card-footer bg-body-secondary border-dark">
                            <a href="{{ route('removeAll') }}"style="float: left; {{ $cart == [] ? 'pointer-events: none' : '' }}"
                                class="btn btn-outline-danger">Remove
                                All</a>
                            <button {{ $cart == [] ? 'disabled' : '' }}  type="submit" id="checkout" style="float: right;"
                                class="btn btn-outline-success">Checkout</button>
                        </div>
                    </div>
                </form>
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
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="{{ asset('js/cart.js') }}"></script>
@endsection
