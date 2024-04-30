@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Company</h2>
    @if($edit == 0)
    <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
    @else
    <form action="{{ route('companies.update', $obj->id) }}" method="POST" enctype="multipart/form-data">
    <input name="_method" type="hidden" value="PATCH" />
    @endif
        <input type="hidden" name="id" id="id" value="{{ empty($obj->id) ? 0 : $obj->id }}">
        @csrf
        <div class="form-group mb-3">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $obj->name) }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" value="{{ old('email', $obj->email) }}" name="email">
        </div>
        <div class="form-group mb-3">
            <label for="logo">Logo:</label>
            <input type="file" class="form-control-file" id="logo" name="logo" accept="image/*">
        </div>
        <div class="form-group mb-3">
            <label for="website">Website:</label>
            <input type="text" class="form-control" id="website" value="{{ old('website', $obj->website) }}" name="website">
        </div>
        @if($edit != 1)
        <button type="submit" class="btn btn-primary">Submit</button>
        @endif
    </form>
</div>
@endsection
