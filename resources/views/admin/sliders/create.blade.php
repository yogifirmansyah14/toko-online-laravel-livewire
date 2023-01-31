@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>
                        Add Sliders
                        <a href="{{ url('admin/sliders') }}" class="btn btn-danger btn-sm float-end">Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/sliders') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="10"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Image</label>
                            <input type="file" class="form-control" name="image">
                        </div>
                        <div class="mb-3">
                            <label>Status</label>
                            <input type="checkbox" name="status"><small class="ms-3">(Checked = Hidden, Unchecked = Visible)</small>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Add Sliders</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection