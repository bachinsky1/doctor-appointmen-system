@role('administrator')

@extends('layouts.app')
@section('content')

@foreach($medests as $medest)



{{dump($medest->name)}}

    
@endforeach


@endsection

@endrole

