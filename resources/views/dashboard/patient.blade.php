@role('patient')

@extends('layouts.app')

@section('content')

@auth

{{-- If the user is authenticated, show the following content --}}
{{-- If there is a status message, show it in an alert box --}}
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

<div class="alert alert-success" role="alert">
    This is a container for Patient's dashboard
</div>


@endauth

@endsection
@endrole

