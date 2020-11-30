@extends('layouts.admin-app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-white">Admin Users / Tenants</div>
                <div class="card-body">
                    <a class="btn btn-success mb-3 text-light" href="{{ route('users.create') }}">
                        {{ __('Add New') }}
                    </a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                           @forelse ($admins as $admin)
                            <tr>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>
                                    <a href="{{ route('users.edit', $admin->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('users.destroy', $admin->id) }}" class="d-inline-block" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                           @empty
                            <tr>
                                <td colspan="2">No Admin User.</td>
                            </tr>
                           @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
