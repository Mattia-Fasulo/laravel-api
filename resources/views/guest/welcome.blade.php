@extends('layouts.app')
@section('content')

<div class="jumbotron p-5 mb-4  rounded-3">
    <div class="container text-center py-5">


        <h1 class="mt-5 fw-bold">
            Welcome to BoolFolio
        </h1>
        <p class="mt-5">
            BoolFolio is the application that allows you to create your personal portfolio and manage it easily.
            <br>
            Complete the registration and create your portfolio!
        </p>

        {{-- <button id="btn-register" class="btn btn-dark btn-lg mt-4" type="button">
            <a class="text-white text-decoration-none" href="{{ route('register') }}">Register</a>
        </button> --}}
    </div>
</div>


@endsection
