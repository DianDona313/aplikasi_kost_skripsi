@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Detail Penyewa</h2>

        <div class="card">
            <div class="card-body">
                <p><strong>Nama:</strong> {{ $penyewa->nama }}</p>
                <p><strong>Email:</strong> {{ $penyewa->email }}</p>
                <p><strong>No HP:</strong> {{ $penyewa->nohp }}</p>
                <p><strong>Alamat:</strong> {{ $penyewa->alamat }}</p>
                <p><strong>Jenis Kelamin:</strong> {{ $penyewa->jenis_kelamin }}</p>

                {{-- Tampilkan foto jika ada --}}
                @if ($penyewa->foto)
                    <div class="mb-3">
                        <strong>Foto:</strong><br>
                        <img src="{{ asset('storage/' . $penyewa->foto) }}" alt="Foto Penyewa" width="150" class="img-thumbnail mt-2">
                    </div>
                @endif

                <a href="{{ route('penyewas.index') }}" class="btn btn-secondary">Kembali</a>
                <a href="{{ route('penyewas.edit', $penyewa->id) }}" class="btn btn-warning">Edit</a>
            </div>
        </div>
    </div>
@endsection
