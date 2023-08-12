@extends('layouts.app')

@yield('styles')
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
                        {{-- <th scope="col">Image</th> --}}
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    </div>

    <div class="modal fade" id="modalCategory" tabindex="-1" role="dialog" aria-labelledby="modalCategorTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mmodalCategoryTitleLongTitle">Create</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="authorForm">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter author name"
                                name="name">
                        </div>
                        <div class="form-group">
                            <label for="name">Age</label>
                            <input type="number" class="form-control" id="age" placeholder="Enter author name"
                                name="age">
                        </div>
                        {{-- <div class="form-group">
                            <label for="document" id="document1">Attachments</label>
                            <div class="needsclick dropzone" id="document-dropzone"></div>
                        </div> --}}
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="save" type="button" class="btn btn-primary">Save</button>
                    <button id="update" type="button" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
    <script></script>
    <script src="{{ asset('/js/category.js') }}"></script>
@endsection
