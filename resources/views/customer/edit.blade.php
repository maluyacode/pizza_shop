@extends('layouts.app')

@section('content')

<div class="container mt-5 mb-5">

    <h2>Update Customer</h2>
    <hr>

    <form action="{{route('customer.update', $customer->id)}}" method="POST">
        @csrf

      <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" name="name" id="name"  value="{{$customer->name}}">
      </div>

      <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="text" class="form-control" name="email" id="email" value="{{$customer->email}}">
      </div>

      <div class="mb-3">
          <label for="phone" class="form-label">Phone</label>
          <input type="text" class="form-control" name="phone" id="phone" value="{{$customer->phone}}">
      </div>

      <div class="mb-3">
          <label for="address" class="form-label">Address</label>
          <input class="form-control" name="address" id="address" value="{{$customer->address}}">
      </div>

          <button type="submit" class="btn btn-primary">Update Customer</button>

    </form>

</div>


@endsection
