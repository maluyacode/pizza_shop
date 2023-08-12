@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/category.css') }}">
@endsection
@section('content')
    <div class="container-fluid">
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
                        <th scope="col">Actions</th>
                        <th scope="col">Image</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modalCategory" tabindex="-1" role="dialog" aria-labelledby="modalCategoryTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="emodalCategoryLongTitle">Create Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="categoryForm">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter Category Name"
                                name="name">
                        </div>
                        <div class="form-group">
                            <label for="detail">Detail</label>
                            <input type="text" class="form-control" id="detail" placeholder="Enter Detail"
                                name="detail">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="save" type="button" class="btn btn-primary">Save</button>
                    <button id="update" type="button" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="{{ asset('js/category.js') }}"></script>
@endsection
@endsection
