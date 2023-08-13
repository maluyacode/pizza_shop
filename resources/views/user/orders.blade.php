@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/order-user.css') }}">
@endsection
{{-- {{ dd($categories) }} --}}
@php
    $total = 0;
@endphp
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center title">
            <h1>Your Orders</h1>
        </div>
        <div class="row justify-content-center">
            <table class="table table-striped table-order-id">
                <thead>
                    <tr>
                        <th scope="col">Order ID</th>
                        <th scope="col">Order Date</th>
                        <th scope="col">Deliver Address</th>
                        <th scope="col">Order Status</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <th scope="row">{{ $order->id }}</th>
                            <td>{{ $order->order_date }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->status }}</td>
                            @php
                                foreach ($order->products as $product) {
                                    $total += $product->price * $product->pivot->quantity;
                                }
                            @endphp
                            <td>&#8369;{{ $total }}</td>
                            <td>
                                <button class="btn btn-outline-success view-order" data-id="{{ $order->id }}"
                                    data-toggle="modal" data-target="#orderModal">View</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row justify-content-center title">
            {{ $orders->links('pagination::bootstrap-5') }}
        </div>
    </div>


    <div class="modal fade bd-example-modal-lg" id="orderModal" tabindex="-1" role="dialog"
        aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">Order Details</h5>
                    <button type="button" class="close btn btn-outline-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table order-products">
                        <thead>
                            <tr>
                                <th scope="col">Product ID</th>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- <tr>
                                <td scope="row">1</td>
                                <td>Mark</td>
                                <td>Mark</td>
                                <td>Otto</td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
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
    <script src="{{ asset('js/user-orders.js') }}"></script>
@endsection
