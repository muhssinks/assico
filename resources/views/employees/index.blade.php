@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-2">
    <div class="col-md-6">
        <div class="mb-3">
            <a href="{{route('employees.create')}}" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-plus me-2"></i> Add New</a>
        </div>
    </div>
    </div>
    <h2>Employees</h2>
    <table class="table" id="employees-table">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Company</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@push('scripts')
<script>
$(function() {
    $('#employees-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('employees.data') !!}',
        columns: [
            { data: 'first_name', name: 'first_name' },
            { data: 'last_name', name: 'last_name' },
            { data: 'company.name', name: 'company.name' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
});
</script>
@endpush
