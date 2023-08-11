@extends('layouts.app')
@section('content')
    <div class="container">
    </div>
    <div class="container">
        <h1>Category List</h1>
        <div class="container; table-responsive">
            <div class="row">
                <a href="{{ route('category.create') }}" class="btn btn-success">Category Create</a>
                <div class="col-md-6" style="display:flex">

                    {!! $dataTable->table() !!}
                    {!! $dataTable->scripts() !!}

                </div>
            </div>
        </div>
    </div>
@endsection
