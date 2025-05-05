@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4" style="color: #FDE5AF;">Users Management</h2>

    {{-- Tampilkan pesan sukses jika ada --}}
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @can('user-create')
        <a class="btn btn-custom-orange mb-3" href="{{ route('users.create') }}">
            <i class="fa fa-plus me-1"></i> Create New User
        </a>
    @endcan

    <div class="card mt-4">
        <div class="card-body">
            <table class="table table-bordered text-center" id="users-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th width="280px">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function () {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('users.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'roles', name: 'roles', orderable: false, searchable: false },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });
    });
</script>
@endpush
