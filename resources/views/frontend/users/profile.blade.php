@extends('layouts.app')

@section('title', 'New Arrivals')

@section('content')
<div class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center">

            @if (session('message'))
            <div class="col-md-10">
                <div class="alert alert-success">{{ session('message') }}</div>
            </div>
            @endif

            @if ($errors->any())
            <div class="col-md-10">
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li class="text-danger ms-5">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        
            <div class="col-md-10">
                <h4>User Profile
                    <a href="{{ url('change-password') }}" class="btn btn-warning float-end">Change Password</a>
                </h4>
                <div class="underline mb-4"></div>
            </div> 

            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-header bg-primary">
                        <h4 class="mb-0 text-white">User Details</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('profile') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Username</label>
                                    <input type="text" name="username" value="{{ Auth::user()->name }}" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Email Adress</label>
                                    <input type="email" name="email" readonly value="{{ Auth::user()->email }}" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Phone Number</label>
                                    <input type="phone" name="phone" value="{{ Auth::user()->userDetail->phone ?? '' }}" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Pin Code</label>
                                    <input type="text" name="pincode" value="{{ Auth::user()->userDetail->pincode ?? '' }}" class="form-control">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Adress</label>
                                    <textarea name="address" id="" cols="30" rows="10" class="form-control">{{ Auth::user()->userDetail->address ?? '' }}</textarea>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
    </div> 
</div>  
@endsection