{{-- Create a table with a hover effect --}}


<table class="table table-hover">

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

    {{-- Create a table body with rows for each user in $allUsers --}}
    <tbody>
        @foreach($allUsers as $user)
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
            <td><button class="btn btn-sm btn-warning">{{ __('Delete') }}</button></td>
        </tr>
        @endforeach
    </tbody>

    {{-- If there is more than one page of users, show a table footer with pagination links --}}
    @if ($allUsers->lastPage() > 1)
    <tfoot>
        <tr>
            <td colspan="9">
                @include('partials.pagination', ['data' => $allUsers])
            </td>
        </tr>
    </tfoot>
    @endif

</table>

