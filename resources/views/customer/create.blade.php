@extends('layouts.app')

@section('content')
    <div class="container mt-5 mb-5">

        <h2>Create Customer</h2>
        <hr>

        <form action="{{ route('customer.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email">
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <textarea class="form-control" name="phone" id="phone" placeholder="Enter Phonenumber"></textarea>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" name="address" id="address" placeholder="Enter Address"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Create Customer</button>

        </form>



    </div>
@endsection