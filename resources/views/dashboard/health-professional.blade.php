@role('health-professional')

@extends('layouts.app')

@section('content')

@auth

@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

<div class="alert alert-primary" role="alert">
    This is a container for Health Professional's dashboard
</div>


@endauth

@endsection

@endrole
