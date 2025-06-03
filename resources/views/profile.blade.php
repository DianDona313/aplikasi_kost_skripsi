@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4" style="color: #FDE5AF;">Profil Pengguna</h2>

        <div class="row">
            <div class="col-md-4 text-center">
                <img src="{{ asset('storage/' . $penyewas->foto) }}" alt="Foto Pengguna" class="img-fluid mb-3 border"
                    style="max-width: 400px; border: 4px solid white;">
            </div>

            <div class="col-md-8">
                <div class="card mb-4 h-100">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h4 style="color: green" class="card-title">Informasi Akun</h4>
                            <p><strong>Nama Lengkap:</strong> {{ $users->name }}</p>
                            <p><strong>Jenis Kelamin:</strong> {{ $penyewas->jenis_kelamin }}</p>
                            <p><strong>Email:</strong> {{ $users->email }}</p>
                            <p><strong>No Handphone:</strong> {{ $penyewas->nohp }}</p>
                            <p><strong>Alamat:</strong> {{ $penyewas->alamat }}</p>
                            <p><strong>Hak Akses:</strong> {{ $users->getRoleNames()->implode(', ') }}</p>
                        </div>

                        {{-- <a href="{{ route('password.edit') }}" class="btn btn-warning mt-3">Ubah Password</a> --}}
                        {{-- Ganti `password.edit` sesuai dengan route untuk ubah password --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
