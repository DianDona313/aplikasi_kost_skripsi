@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4" style="color: #FDE5AF;">Profil Pengguna</h2>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Informasi Akun</h5>
            <p><strong>Nama:</strong> {{ $users->name }}</p>
            <p><strong>Email:</strong> {{ $users->email }}</p>
            <p><strong>Role:</strong> {{ $users->getRoleNames()->implode(', ') }}</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Data Penyewa Terkait</h5>
            @php
                $penyewaSaya = $penyewas->where('user_id', $users->id);
            @endphp

            @if ($penyewaSaya->count())
                <ul>
                    @foreach ($penyewaSaya as $penyewa)
                        <li>{{ $penyewa->nama }} - {{ $penyewa->no_hp }}</li>
                    @endforeach
                </ul>
            @else
                <p>Tidak ada data penyewa terkait.</p>
            @endif
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Properti yang Tersedia</h5>
            <div class="row">
                @foreach ($properties as $property)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <img src="{{ asset('storage/' . $property->foto) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $property->nama }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $property->nama }}</h5>
                                <p class="card-text">{{ $property->alamat }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
