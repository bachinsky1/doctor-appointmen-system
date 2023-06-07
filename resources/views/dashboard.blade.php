@extends('layouts.app')

@section('content')

@auth

{{-- If the user is authenticated, show the following content --}}
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">

            {{-- If there is a status message, show it in an alert box --}}
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif


            {{-- Load data based on the user's role --}}
            @if($role->slug == 'administrator')
            {{-- If the user has the administrator role, load the users partial view --}}
            @include('partials.users')

            @elseif($role->slug == 'health-professional')
            {{-- If the user has the health professional role, show a container for their data --}}
            <p>Container for Health professional data</p>
            @else
            {{-- If the user has any other role, show a container for patient data --}}
            <p>Container for Patient data</p>

            @endif

        </div>
    </div>
</div>

@endauth

@endsection


