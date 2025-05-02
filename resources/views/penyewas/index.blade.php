@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4" style="color: #FDE5AF;">Daftar Penyewa</h2>
        <a href="{{ route('penyewas.create') }}" class="btn btn-custom-orange mb-3">
            <i class="fas fa-plus me-1"></i> Tambah Penyewa
        </a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penyewas as $penyewa)
                            <tr>
                                <td class="text-center">{{ ++$i }}</td>
                                <td>{{ $penyewa->nama }}</td>
                                <td>{{ $penyewa->email }}</td>
                                <td>{{ $penyewa->nohp }}</td>
                                <td>{{ $penyewa->alamat }}</td>
                                <td>{{ $penyewa->jenis_kelamin }}</td>
                                <td class="text-center">
                                    <a href="{{ route('penyewas.show', $penyewa->id) }}" class="btn btn-info btn-sm">Lihat</a>
                                    <a href="{{ route('penyewas.edit', $penyewa->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('penyewas.destroy', $penyewa->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        
                {{-- Pagination --}}
                <div class="d-flex justify-content-center mt-3">
                    {!! $penyewas->links() !!}
                </div>
            </div>
        </div>
        
    </div>
@endsection
