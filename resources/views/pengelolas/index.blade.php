@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4" style="color: #FDE5AF;">Daftar Pengelola</h2>

    @can('pengelola-create')
        <a href="{{ route('pengelolas.create') }}" class="btn btn-custom-orange mb-3">
            <i class="fas fa-plus me-1"></i> Tambah Pengelola
        </a>
    @endcan

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered text-center" id="pengelola-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>No. Telepon</th>
                        <th>Alamat</th>
                        <th>Foto</th>
                        <th>Aksi</th>
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
    $('#pengelola-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('pengelolas.index') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'nama', name: 'nama' },
            { data: 'no_telp_pengelola', name: 'no_telp_pengelola' },
            { data: 'alamat', name: 'alamat' },
            { data: 'foto', name: 'foto', orderable: false, searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });
});
</script>
@endpush
