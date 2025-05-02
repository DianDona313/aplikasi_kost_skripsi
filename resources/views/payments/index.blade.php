@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4" style="color: #FDE5AF;">Daftar Pembayaran</h2>
        <a href="{{ route('payments.create') }}" class="btn btn-custom-orange mb-3">
            <i class="fas fa-plus me-1"></i> Tambah Pembayaran
        </a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr class="text-center">
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
                    <tbody>
                        @foreach ($payments as $payment)
                            <tr class="text-center">
                                <td>{{ $payment->id }}</td>
                                <td>{{ $payment->booking_id }}</td>
                                <td>{{ $payment->user->name ?? 'Tidak Diketahui' }}</td>
                                <td>Rp {{ number_format($payment->jumlah, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($payment->sisa_pembayaran, 0, ',', '.') }}</td>
                                <td>{{ ucfirst($payment->payment_method) }}</td>
                                <td>
                                    @if ($payment->payment_status == 'paid')
                                        <span class="badge bg-success">Lunas</span>
                                    @elseif($payment->payment_status == 'pending')
                                        <span class="badge bg-warning">Menunggu</span>
                                    @else
                                        <span class="badge bg-danger">Gagal</span>
                                    @endif
                                </td>
                                <td>
                                    <img src="{{ asset('storage/' . $payment->foto) }}" alt="Bukti Pembayaran" width="50px">
                                </td>
                                <td>
                                    <a href="{{ route('payments.show', $payment->id) }}"
                                        class="btn btn-info btn-sm">Detail</a>
                                    <a href="{{ route('payments.edit', $payment->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('payments.destroy', $payment->id) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus pembayaran ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center mt-3">
                    {!! $payments->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
