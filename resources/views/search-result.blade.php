@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection
{{-- {{ dd($searchResults) }} --}}
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center title">
            <h1>Search Results</h1>
        </div>
        <div class="row justify-content-center">
            There are {{ $searchResults->count() }} results.

            @foreach ($searchResults->groupByType() as $type => $modelSearchResults)
                <h2 class="type">{{ $type }}</h2>

                @foreach ($modelSearchResults as $searchResult)
                    <div class="card card-search">
                        <div class="card-header">
                            <a href="{{ $searchResult->url }}">
                                <h4>{{ $searchResult->title }}</h4>
                            </a>
                        </div>
                        <div class="card-body ">
                            <blockquote class="blockquote mb-0">
                                <p>{{ $searchResult->searchable->detail }}</p>
                                {{-- <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source
                                        Title</cite></footer> --}}
                            </blockquote>
                        </div>
                    </div>
                @endforeach
            @endforeach
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
@endsection
