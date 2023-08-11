@extends('layouts.app')

@section('content')

<div class="container mt-5 mb-5">

    <h2>Update Category</h2>
    <hr>

    <form action="{{route('category.update', $category->id)}}" method="POST" enctype="multipart/form-data">
        @csrf

      <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" name="name" id="name"  value="{{$category->name}}">
      </div>

      <div class="mb-3">
          <label for="detail" class="form-label">Detail</label>
          <input type="text" class="form-control" name="detail" id="detail" value="{{$category->detail}}">
      </div>

            <div class="mb-3">
                <label for="img_path" class="form-label">Choose Picture</label>
                <input class="form-control" type="file" name="img_path" id="img_path" value="{{$category->img_path}}">
            </div>

          <button type="submit" class="btn btn-primary">Update Category</button>

    </form>

</div>


@endsection
