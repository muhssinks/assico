
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Employee</div>

                <div class="card-body">
                        @if($edit == 0)
                        <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                        @else
                        <form action="{{ route('employees.update', $obj->id) }}" method="POST" enctype="multipart/form-data">
                        <input name="_method" type="hidden" value="PATCH" />
                        @endif
                        <input type="hidden" name="id" id="id" value="{{ empty($obj->id) ? 0 : $obj->id }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name', $obj->first_name) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $obj->last_name) }}" class="form-control" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $obj->email) }}" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', $obj->phone) }}" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label for="company_id">Company</label>
                            <select name="company_id" id="company_id" class="form-control">
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}" @if($company->id == $obj->company_id) selected @endif>{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Employee</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
