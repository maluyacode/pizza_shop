@extends('layouts.app')

@section('content')
<div class="container-fluid">
    {{-- <div class="alert alert-success alert-dismissible fade show" role="alert"
        style="position:absolute; top:9.5%; width: 95%;">
        You should check in on some of those fields below.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button> --}}
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            </div>
            <table id="categoryTable" class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Detail</th>
                        {{-- <th scope="col">Image</th> --}}
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="{{ asset('/js/category.js') }}"></script>
@endsection
