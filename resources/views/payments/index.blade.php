@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4" style="color: #FDE5AF;">Daftar Pembayaran</h2>
    @can('payment-create')
        <a href="{{ route('payments.create') }}" class="btn btn-custom-orange mb-3">
            <i class="fas fa-plus me-1"></i> Tambah Pembayaran
        </a>
    @endcan

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered text-center" id="payments-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Booking</th>
                        <th>Pengguna</th>
                        <th>Jumlah</th>
                        <th>Sisa</th>
                        <th>Metode</th>
                        <th>Status</th>
                        <th>Bukti</th>
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
    $('#payments-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('payments.index') }}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'booking_id', name: 'booking_id' },
            { data: 'user', name: 'user.name' },
            { data: 'jumlah', name: 'jumlah' },
            { data: 'sisa', name: 'sisa_pembayaran' },
            { data: 'metode', name: 'payment_method' },
            { data: 'status', name: 'payment_status', orderable: false, searchable: false },
            { data: 'bukti', name: 'foto', orderable: false, searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
});
</script>
@endpush
