@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4" style="color: #FDE5AF;">Daftar Penyewa</h2>

    @can('penyewa-create')
        <a href="{{ route('penyewas.create') }}" class="btn btn-custom-orange mb-3">
            <i class="fas fa-plus me-1"></i> Tambah Penyewa
        </a>
    @endcan

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered text-center" id="penyewa-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No HP</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
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
    $('#penyewa-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('penyewas.index') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'nama', name: 'nama' },
            { data: 'email', name: 'email' },
            { data: 'nohp', name: 'nohp' },
            { data: 'alamat', name: 'alamat' },
            { data: 'jenis_kelamin', name: 'jenis_kelamin' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });
});
</script>
@endpush
