@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4" style="color: #FDE5AF;">Daftar Pengelola</h2>
        <a href="{{ route('pengelolas.create') }}" class="btn btn-custom-orange mb-3">
            <i class="fas fa-plus me-1"></i> Tambah Pengelola
        </a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama</th>
                            <th>No. Telepon</th>
                            <th>Alamat</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengelolas as $pengelola)
                            <tr class="text-center">
                                <td >{{ ++$i }}</td>
                                <td>{{ $pengelola->nama }}</td>
                                <td>{{ $pengelola->no_telp_pengelola }}</td>
                                <td>{{ $pengelola->alamat }}</td>
                                <td><img src="{{ asset('storage/' . $pengelola->foto) }}" width="50"></td>
                                <td>
                                    <a href="{{ route('pengelolas.show', $pengelola->id) }}" class="btn btn-info btn-sm">Detail</a>
                                    <a href="{{ route('pengelolas.edit', $pengelola->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('pengelolas.destroy', $pengelola->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus pengelola ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
