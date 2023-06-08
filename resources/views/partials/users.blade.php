{{-- Create a table with a hover effect --}}
@role('administrator') 
@extends('layouts.app')
@section('content')


@if(!empty($users))

<table class="table table-hover table-striped">
    {{-- Create a table header row with column headings --}}
    <thead>
        <tr>
            <th scope="col">{{ __('ID') }}</th>
            <th scope="col">{{ __('Name') }}</th>
            <th scope="col">{{ __('Roles') }}</th>
            <th scope="col">{{ __('Email') }}</th>
            <th scope="col">{{ __('Email Verified at') }}</th>
            <th scope="col">{{ __('Created at') }}</th>
            <th scope="col">{{ __('Updated at') }}</th>
            <th scope="col">{{ __('Deleted at') }}</th>
            <th scope="col">{{ __('Action') }}</th>
        </tr>
    </thead>

    {{-- Create a table body with rows for each user in $users --}}

    <tbody>

        @foreach($users as $user)
        <tr>
            <th scope="row">{{$user->id}}</th>
            <td>{{$user->name}}</td>
            <td>
                @foreach($user->roles as $role)
                {{$role->name}}
                @endforeach
            </td>
            <td>{{$user->email}}</td>
            <td>{{$user->email_verified_at}}</td>
            <td>{{$user->created_at}}</td>
            <td>{{$user->updated_at}}</td>
            <td>{{$user->deleted_at}}</td>
            <td>
                @if($user->deleted_at)
                    <span class="btn btn-warning disabled">{{ __('User deleted') }}</span>
                @else
                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">{{ __('Delete') }}</button>
                </form>
                @endif
            </td>

        </tr>
        @endforeach

    </tbody>

    {{-- If there is more than one page of users, show a table footer with pagination links --}}
    @if ($users->lastPage() > 1)

    <tfoot>
        <tr>
            <td colspan="9">
                @include('partials.pagination', ['data' => $users])
            </td>
        </tr>
    </tfoot>

    @endif

</table>

@else

<div class="alert alert-warning" role="alert">
    {{__('No data')}}
</div>


@endif
@endsection

@endrole

