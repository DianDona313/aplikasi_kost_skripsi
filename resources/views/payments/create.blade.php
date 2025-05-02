@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Pembayaran</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('payments.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Booking</label>
                    <select name="booking_id" class="form-select" required>
                        <option value="">Pilih Booking</option>
                        @foreach ($bookings as $booking)
                            <option value="{{ $booking->id }}">
                                {{ $booking->kode_booking ?? 'Booking #' . $booking->id }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Penyewa</label>
                    <select name="user_id" class="form-select" required>
                        <option value="">Pilih Penyewa</option>
                        @foreach ($penyewas as $penyewa)
                            <option value="{{ $penyewa->id }}">{{ $penyewa->nama }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Jumlah Pembayaran</label>
                    <input type="number" name="jumlah" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Sisa Pembayaran</label>
                    <input type="number" name="sisa_pembayaran" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Metode Pembayaran</label>
                    <input type="text" name="payment_method" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="payment_status" class="form-control">
                        <option value="paid">Lunas</option>
                        <option value="pending">Menunggu</option>
                        <option value="failed">Gagal</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Bukti Pembayaran</label>
                    <input type="file" name="foto" class="form-control">
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
