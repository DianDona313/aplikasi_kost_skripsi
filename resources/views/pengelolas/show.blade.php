@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Detail Pengelola</h2>

        <div class="card">
            <div class="card-body">
                <p><strong>Nama:</strong> {{ $pengelola->nama }}</p>
                <p><strong>No. Telepon:</strong> {{ $pengelola->no_telp_pengelola }}</p>
                <p><strong>Alamat:</strong> {{ $pengelola->alamat }}</p>
                <p><strong>Deskripsi:</strong> {{ $pengelola->deskripsi }}</p>
                <p><strong>Foto:</strong> <br> <img src="{{ asset('storage/' . $pengelola->foto) }}" width="150"></p>

                <a href="{{ route('pengelolas.edit', $pengelola->id) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('pengelolas.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection
