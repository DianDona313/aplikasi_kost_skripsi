@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4" style="color: #FDE5AF;">Daftar Peraturan</h2>
        <a href="{{ route('peraturans.create') }}" class="btn btn-custom-orange mb-3">
            <i class="fas fa-plus me-1"></i> Tambah Peraturan
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
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peraturans as $peraturan)
                            <tr class="text-center">
                                <td class="text-center">{{ ++$i }}</td>
                                {{-- <td>{{ $peraturan->id }}</td> --}}
                                <td>{{ $peraturan->nama }}</td>
                                <td>{{ $peraturan->deskripsi }}</td>
                                <td>
                                    <a href="{{ route('peraturans.edit', $peraturan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('peraturans.destroy', $peraturan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
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
