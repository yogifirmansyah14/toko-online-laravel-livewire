@extends('layouts.admin')

@section('title', 'List Users')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
                <div class="card mb-3">
                    <div class="card-header bg-primary">
                        <h3 class="text-white mb-0">List User
                            <a href="{{ url('admin/users/create') }}" class="btn btn-primary btn-sm float-end text-white">Add User</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <td>ID</td>
                                <td>Name</td>
                                <td>Email</td>
                                <td>Role As</td>
                                <td>Action</td>
                            </th>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                    @if ($user->role_as == '1')
                                        <label class="badge btn-success">Admin</label>                                    
                                    @else
                                        <label class="badge btn-primary">User</label>
                                    @endif
                                    </td>                                        
                                    <td>
                                        <a href="{{ url('admin/users/'.$user->id.'/edit') }}" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="{{ url('admin/users/'.$user->id.'/delete') }}"
                                        onclick="return confirm('Are You Sure Want To Delete This Date?')"
                                        class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">User Not Found</td>
                                </tr>
                            @endforelse
                        </table>
                        <div class="mt-3">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection