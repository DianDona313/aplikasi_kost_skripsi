@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Pembayaran</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $payment->id }}</p>
            <p><strong>Booking:</strong> {{ $payment->booking_id }}</p>
            <p><strong>Pengguna:</strong> {{ $payment->user->name ?? 'Tidak Diketahui' }}</p>
            <p><strong>Jumlah:</strong> Rp {{ number_format($payment->jumlah, 0, ',', '.') }}</p>
            <p><strong>Sisa Pembayaran:</strong> Rp {{ number_format($payment->sisa_pembayaran, 0, ',', '.') }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ ucfirst($payment->payment_method) }}</p>
            <p><strong>Status:</strong> 
                @if($payment->payment_status == 'paid')
                    <span class="badge bg-success">Lunas</span>
                @elseif($payment->payment_status == 'pending')
                    <span class="badge bg-warning">Menunggu</span>
                @else
                    <span class="badge bg-danger">Gagal</span>
                @endif
            </p>
            <p><strong>Bukti Pembayaran:</strong></p>
            <img src="{{ asset('storage/' . $payment->foto) }}" width="150">
        </div>
    </div>
    <a href="{{ route('payments.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
