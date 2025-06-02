@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4" style="color: #FDE5AF;">Daftar Properti</h2>

        {{-- Tampilkan pesan sukses jika ada --}}
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        @can('properti-create')
            <a href="{{ route('properties.create') }}" class="btn btn-custom-orange mb-3">
                <i class="fas fa-plus me-1"></i> Tambah Kost Baru
            </a>
        @endcan

        <div class="card mt-4">
            <div class="card-body">
                <table class="table table-bordered" id="properties-table">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Kota</th>
                            <th>Foto</th>
                            <th width="200px">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script>
        $(function() {
            $('#properties-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('properties.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        className: 'text-center'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'kota',
                        name: 'kota'
                    },
                    {
                        data: 'foto',
                        name: 'foto',
                        render: function(data, type, full, meta) {
                            console.log(data);

                            return `<img src="/storage/${data}" width="60" class="img-thumbnail"/>`;
                        },
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    },
                ]
            });
        });
    </script>
@endpush
