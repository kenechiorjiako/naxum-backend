@extends('layouts.app')
@section('content')
    <h1>Account Listing</h1>
    <form method="GET" action="{{ route('accounts.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="query" class="form-control" placeholder="Search by name, contact, or email" value="{{ $query ?? '' }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Contact Number</th>
                <th>Email</th>
                <th>Is Admin</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->contact_number }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->isAdmin ? 'Yes' : 'No' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
@endsection