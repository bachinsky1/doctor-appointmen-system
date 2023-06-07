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

            <div class="alert alert-success" role="alert">
                This is a container for Health Professional's dashboard
            </div>

        </div>
    </div>
</div>

@endauth

@endsection
