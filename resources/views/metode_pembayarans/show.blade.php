@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Detail Metode Pembayaran</h2>

        <div class="card">
            <div class="card-body">
                <p><strong>Kost:</strong> {{ $metode_pembayaran->property->nama }}</p>
                <p><strong>Nama Bank:</strong> {{ $metode_pembayaran->nama_bank }}</p>
                <p><strong>No Rekening:</strong> {{ $metode_pembayaran->no_rek }}</p>
                <p><strong>Atas Nama:</strong> {{ $metode_pembayaran->atas_nama }}</p>

                <a href="{{ route('metode_pembayarans.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection
