@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection
{{-- {{ dd($categories) }} --}}
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center title">
            <h1>Profile</h1>
        </div>
        <div class="row justify-content-center">
            <div class="card card-profile">
                @if (count($user->media) > 0)
                    <img class="card-img-top" src="{{ $user->media[0]->original_url }}" alt="Card image cap">
                @else
                    <img class="card-img-top" src="{{ asset('storage/images/profilePic.jpg') }}" alt="Card image cap">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $user->name }}</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><span class="bold">Address</span><span>{{ $user->address }}</span></li>
                    <li class="list-group-item"><span class="bold">Email</span><span>{{ $user->email }}</span></li>
                    <li class="list-group-item"><span class="bold">Phone</span><span>{{ $user->phone }}</span></li>
                    <li class="list-group-item"><span class="bold">Joined In: </span><span>{{ $user->created_at }}</span>
                    </li>
                </ul>
                <div class="card-body">

                </div>
            </div>
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
