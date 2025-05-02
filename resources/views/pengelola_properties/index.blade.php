@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4" style="color: #FDE5AF;">Daftar Pengelola Properti</h2>
    <a href="{{ route('pengelola_properties.create') }}" class="btn btn-primary mb-3">Tambah Pengelola Properti</a>

    {{-- Tampilkan pesan sukses jika ada --}}
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
                        <th>Pengelola</th>
                        <th>Properti</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($pengelolaProperties as $index => $pengelolaProperty)
                    <tr class="text-center">
                        <td>{{ $index + 1 + ($pengelolaProperties->currentPage() - 1) * $pengelolaProperties->perPage() }}</td>
                        <td>{{ $pengelolaProperty->pengelola->name ?? 'Tidak Diketahui' }}</td>
                        <td>{{ $pengelolaProperty->properti->nama ?? 'Tidak Diketahui' }}</td>
                        <td>
                            <a href="{{ route('pengelola_properties.edit', $pengelolaProperty->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('pengelola_properties.destroy', $pengelolaProperty->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?');">
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
                {!! $pengelolaProperties->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection
