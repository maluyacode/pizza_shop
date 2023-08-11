@extends('layouts.app')

@section('content')

<div class="container mt-5 mb-5">

    <h2>Update Product</h2>
    <hr>

    <form action="{{route('product.update', $product->id)}}" method="POST" enctype="multipart/form-data">
        @csrf

      <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" name="name" id="name"  value="{{$product->name}}">
      </div>

      <div class="mb-3">
          <label for="price" class="form-label">Price</label>
          <input type="text" class="form-control" name="price" id="price" value="{{$product->price}}">
      </div>

      <div class="mb-3">
          <label for="detail" class="form-label">Detail</label>
          <input type="text" class="form-control" name="detail" id="detail" value="{{$product->detail}}">
      </div>

            <div class="mb-3">
                <label for="img_path" class="form-label">Choose Picture</label>
                <input class="form-control" type="file" name="img_path" id="img_path" value="{{$product->img_path}}">
            </div>

          <button type="submit" class="btn btn-primary">Update Product</button>

    </form>

</div>


@endsection
