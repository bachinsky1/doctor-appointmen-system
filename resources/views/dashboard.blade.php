@extends('layouts.app')

@section('content')

@auth

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">

            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif


            @if($role->slug == 'administrator')
            <!-- Load data for Administrator -->
            @include('partials.users')

            @elseif($role->slug == 'health-professional')
            <!-- Load data for Health Professional -->
            <p>Container for Health proffesional data</p>
            @else
            <!-- Load data for Patient -->
            <p>Container for Patient data</p>

            @endif

        </div>
    </div>
</div>

@endauth

@endsection
