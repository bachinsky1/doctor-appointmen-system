@role('administrator')

@extends('layouts.app')
@section('content')


@if(empty($medests))

<div class="alert alert-warning" role="alert">
    {{__('No medests')}}
</div>

@else 

<table class="table table-hover table-striped">
    {{-- Create a table header row with column headings --}}
    <thead>
        <tr>
            <th scope="col">{{ __('ID') }}</th>
            <th scope="col">{{ __('Name') }}</th>
            <th scope="col">{{ __('Address') }}</th>
            <th scope="col">{{ __('Type') }}</th> 
            <th scope="col">{{ __('Created at') }}</th>
            <th scope="col">{{ __('Updated at') }}</th>
            <th scope="col">{{ __('Deleted at') }}</th>
            <th scope="col">{{ __('Action') }}</th>
        </tr>
    </thead>

    {{-- Create a table body with rows for each user in $users --}}

    <tbody>
        @foreach($medests as $medest)
        <tr>
            <th scope="row">{{$medest->id}}</th>
            <td>{{$medest->name}}</td>  
            <td>{{$medest->address}}</td>  
            <td>{{$medest->type}}</td>  
            <td>{{$medest->created_at}}</td>

            <td>{{$medest->updated_at}}</td>


            <td>{{$medest->deleted_at}}</td>


            <td>
                @if($medest->deleted_at)

                <span class="btn btn-warning disabled">{{ __('Deleted') }}</span>
                @else
                <form action="{{ route('medicalestablishments.destroy', $medest->id) }}" method="POST">

                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">{{ __('Delete') }}</button>
                </form>
                @endif
            </td>

        </tr>
        @endforeach

    </tbody> 

    @if ($medests->lastPage() > 1)

    <tfoot>
        <tr>
            <td colspan="8">
                @include('pagination', ['data' => $medests])
            </td>
        </tr>
    </tfoot>

    @endif

</table>

@endif

@endsection

@endrole

