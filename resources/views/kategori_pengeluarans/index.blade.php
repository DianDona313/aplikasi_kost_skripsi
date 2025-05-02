@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4" style="color: #FDE5AF;">Daftar Kategori Pengeluaran</h2>
    <a href="{{ route('kategori_pengeluarans.create') }}" class="btn btn-custom-orange mb-3">
        <i class="fas fa-plus me-1"></i> Tambah Kategori Kost
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
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kategoriPengeluarans as $kategori)
                    <tr class="text-center">
                        <td>{{ $kategori->id }}</td>
                        <td>{{ $kategori->nama }}</td>
                        <td>{{ $kategori->deskripsi }}</td>
                        <td>
                            {{-- <a href="{{ route('kategori_pengeluarans.show', $kategori->id) }}" class="btn btn-info btn-sm">Detail</a> --}}
                            <a href="{{ route('kategori_pengeluarans.edit', $kategori->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('kategori_pengeluarans.destroy', $kategori->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-3">
                {!! $kategoriPengeluarans->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection
