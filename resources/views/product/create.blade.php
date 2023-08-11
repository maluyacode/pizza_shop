@extends('layouts.app')

@section('content')
    <div class="container mt-5 mb-5">

        <h2>Create Product</h2>
        <hr>

        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Price</label>
                <input type="text" class="form-control" name="price" id="price" placeholder="Enter Price">
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Detail</label>
                <textarea class="form-control" name="detail" id="detail" placeholder="Enter Description"></textarea>
            </div>

            <div class="mb-3">
                <label for="img_path" class="form-label">Choose Picture</label>
                <input class="form-control" type="file" name="img_path" id="img_path">
            </div>

            <button type="submit" class="btn btn-primary">Create Product</button>

        </form>



    </div>
@endsection