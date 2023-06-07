<table class="table table-hover">

    <thead>
        <tr>
            <th scope="col">{{ __('ID') }}</th>
            <th scope="col">{{ __('Name') }}</th>
            <th scope="col">{{ __('Email') }}</th>
            <th scope="col">{{ __('Email Verified at') }}</th>
            <th scope="col">{{ __('Created at') }}</th>
            <th scope="col">{{ __('Updated at') }}</th>
            <th scope="col">{{ __('Deleted at') }}</th>
            <th scope="col">{{ __('Action') }}</th>
        </tr>
    </thead>

    <tbody>
        @foreach($allUsers as $user)
        <tr>
            <th scope="row">{{$user->id}}</th>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->email_verified_at}}</td>
            <td>{{$user->created_at}}</td>
            <td>{{$user->updated_at}}</td>
            <td>{{$user->deleted_at}}</td>
            <td><button class="btn btn-sm btn-warning">{{ __('Delete') }}</button></td>
        </tr>
        @endforeach
    </tbody>

    @if ($allUsers->lastPage() > 1)
    <tfoot>
        <tr>
            <td colspan="8">
                @include('partials.pagination', ['data' => $allUsers])
            </td>
        </tr>
    </tfoot>
    @endif

</table>
