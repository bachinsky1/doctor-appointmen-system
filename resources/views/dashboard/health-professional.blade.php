@role('health-professional')

@extends('layouts.app')

@section('content')

@auth

@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

<div class="row">
    <div class="col-6">
        <next-appointments-component></next-appointments-component>
    </div>

    <div class="col-3"> 
        <documents-to-classify-component></documents-to-classify-component>
        <activities-component></activities-component>
    </div>

    <div class="col-3">
        <tasks-component></tasks-component>
    </div>
</div>



@endauth

@endsection

@endrole
