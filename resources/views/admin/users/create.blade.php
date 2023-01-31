@extends('layouts.admin')

@section('title', 'Add User')

@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <form action="{{ url('admin/users') }}" method="POST">
                @csrf
                <div class="card mb-3">
                    <div class="card-header bg-primary">
                        <h3 class="text-white mb-0">Add User
                            <a href="{{ url('admin/users') }}" class="btn btn-danger btn-sm float-end text-white">Back</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('admin/users') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control">
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control">
                                    @error('password')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Role As</label>
                                    <select name="role_as" class="form-control">
                                        <option>Select Role</option>
                                        <option value="0">User</option>
                                        <option value="1">Admin</option>
                                    </select>
                                    @error('role_as')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-12 mt-5">
                                    <button type="submit" class="btn btn-primary float-end text-white">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
    </div>
@endsection