@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Detail Properti</h2>

        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <h5 class="card-title">Nama Properti</h5>
                    <p class="card-text">{{ $property->nama }}</p>
                </div>
                <div class="mb-3">
                    <h5 class="card-title">Alamat</h5>
                    <p class="card-text">{{ $property->alamat }}</p>
                </div>
                <div class="mb-3">
                    <h5 class="card-title">Kota</h5>
                    <p class="card-text">{{ $property->kota }}</p>
                </div>
                <div class="mb-3">
                    <h5 class="card-title">Jenis Kost</h5>
                    <p class="card-text">{{ $property->jeniskost->nama }}</p>
                </div>
                <div class="mb-3">
                    <h5 class="card-title">Deskripsi</h5>
                    <p class="card-text">{{ $property->deskripsi }}</p>
                </div>
                @if($property->foto)
                    <div class="mb-3">
                        <h5 class="card-title">Foto</h5>
                        <img src="{{ asset('storage/' . $property->foto) }}" class="img-fluid" alt="Foto Properti">
                    </div>
                @endif
                <a href="{{ route('properties.index') }}" class="btn btn-secondary">Kembali</a>
                <a href="{{ route('properties.edit', $property->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('properties.destroy', $property->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
@endsection
