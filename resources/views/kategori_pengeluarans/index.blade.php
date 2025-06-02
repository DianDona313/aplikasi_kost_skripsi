@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4" style="color: #FDE5AF;">Daftar Kategori Pengeluaran</h2>
    @can('kategori_pengeluarans-create')
    <a href="{{ route('kategori_pengeluarans.create') }}" class="btn btn-custom-orange mb-3">
        <i class="fas fa-plus me-1"></i> Tambah Kategori Kost
    </a>
    @endcan

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered text-center" id="kategori-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
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
    $('#kategori-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('kategori_pengeluarans.index') }}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'nama', name: 'nama' },
            { data: 'deskripsi', name: 'deskripsi' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
});
</script>
@endpush
