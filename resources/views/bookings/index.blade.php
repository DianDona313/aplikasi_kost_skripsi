@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4" style="color: #FDE5AF;">Daftar Booking</h2>
        @can('booking-create')
            <a href="{{ route('bookings.create') }}" class="btn btn-custom-orange mb-3">
                <i class="fas fa-plus me-1"></i> Tambah Booking
            </a>
        @endcan

        {{-- Tampilkan pesan sukses jika ada --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @can('booking-list')
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped" id="bookingsTable">
                        <thead>
                            <tr class="text-center">
                                <th>ID</th>
                                <th>Properti</th>
                                <th>Penyewa</th>
                                <th>Kamar</th>
                                <th>Periode</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be populated by DataTables via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        @endcan
    </div>

    @push('scripts')
    <script>
        $(document).ready(function() {
            $('#bookingsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('bookings.index') }}", // Menunjuk route controller booking
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' }, // Kolom index
                    { data: 'properti', name: 'properti' },
                    { data: 'penyewa', name: 'penyewa' },
                    { data: 'kamar', name: 'kamar' },
                    { data: 'periode', name: 'periode' },
                    { data: 'status', name: 'status' },
                    { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
                ]
            });
        });
    </script>
    @endpush
@endsection
