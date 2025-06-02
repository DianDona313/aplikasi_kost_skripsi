@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4" style="color: #FDE5AF;">Daftar Fasilitas</h2>
        @can('fasilitas-create')
            <a href="{{ route('fasilitas.create') }}" class="btn btn-custom-orange mb-3">
                <i class="fas fa-plus me-1"></i> Tambah Fasilitas
            </a>
        @endcan

        {{-- Tampilkan pesan sukses jika ada --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @can('fasilitas-list')
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped" id="fasilitasTable">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data akan dimuat menggunakan AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        @endcan
    </div>

    @push('scripts')
    <script>
        $(document).ready(function() {
            $('#fasilitasTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('fasilitas.index') }}", // URL untuk AJAX request
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' }, // Kolom index
                    { data: 'nama', name: 'nama' },
                    { data: 'deskripsi', name: 'deskripsi' },
                    { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
                ]
            });
        });
    </script>
    @endpush
@endsection
