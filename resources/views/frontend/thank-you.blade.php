@extends('layouts.app')

@section('title', 'Thank You For Shopping')

@section('content')
    <div class="py-3 pyt-md-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    @if (session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif
                    <div class="p-5 shadow bg-white">
                        <img src="{{ asset('assets/images/kurir.png') }}" alt="" width="100px">
                        <h4>Thank You For Shopping In Seashrimps</h4>
                        <a href="{{ url('/collections') }}" class="btn btn-warning">Shop Again</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection