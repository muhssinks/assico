@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-2">
    <div class="col-md-6">
        <div class="mb-3">
            <a href="{{route('companies.create')}}" class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-plus me-2"></i> Add New</a>
        </div>
    </div>
    </div>
    <h2>Companies</h2>
    <table class="table" id="companies-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Logo</th>
                <th>Website</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@push('scripts')
<script>
$(function() {
    getData();
    function getData(){ 
    $('#companies-table').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        ajax: '{!! route('companies.data') !!}',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'image', name: 'image',
                    render: function( data, type, full, meta ) {
                        if(data != '-'){
                            return "<img src=\"" + data + "\" height=\"50\"/>";
                        } else {
                            return '-';
                        }
                    }
            },
            { data: 'website', name: 'website' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
    }
});
</script>
@endpush
