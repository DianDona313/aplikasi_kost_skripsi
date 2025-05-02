@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Detail Pengelola Properti</h2>
    
    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $pengelolaProperty->id }}</p>
            <p><strong>Pengelola:</strong> {{ $pengelolaProperty->pengelola->name ?? 'Tidak Diketahui' }}</p>
            <p><strong>Properti:</strong> {{ $pengelolaProperty->properti->nama ?? 'Tidak Diketahui' }}</p>
        </div>
    </div>

    <a href="{{ route('pengelola_properties.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
