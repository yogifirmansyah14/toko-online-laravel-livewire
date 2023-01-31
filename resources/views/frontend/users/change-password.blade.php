@extends('layouts.app')

@section('title', 'Change Password')

@section('content')
    <div class="container mb-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li class="text-danger ms-5">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                @if (session('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @elseif (session('danger'))
                    <div class="alert alert-danger">{{ session('danger') }}</div>
                @endif

                <h4>Change Password
                    <a href="{{ url('profile') }}" class="btn btn-danger text-white float-end">Back</a>
                </h4>
                <div class="underline"></div>
            </div>
            <div class="col-md-8">
                <div class="card card-body shadow">
                    <form action="{{ url('change-password') }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <label for="">Current Password</label>
                            <input type="password" name="current_password" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label for="">New Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="mb-2">
                            <label for="">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>
                        <div class="mb-2">
                            <button type="submit" class="btn btn-primary">Change</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection