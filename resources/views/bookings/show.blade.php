@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Booking</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Properti: {{ $booking->property->nama ?? 'Tidak Diketahui' }}</h5>
            <p class="card-text">
                Penyewa: {{ $booking->penyewa->nama ?? 'Tidak Diketahui' }} <br>
                Kamar: {{ $booking->room->room_name ?? 'Tidak Diketahui' }} <br>
                Periode: {{ $booking->start_date }} - {{ $booking->end_date }} <br>
                Status: <span class="badge {{ $booking->status == 'confirmed' ? 'bg-success' : 'bg-warning' }}">
                    {{ ucfirst($booking->status) }}
                </span>
            </p>
            <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection
