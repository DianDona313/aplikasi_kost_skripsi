@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4" style="color: #FDE5AF;">Daftar Fasilitas</h2>
        @can('fasilitas-create')
            <a href="{{ route('fasilitas.create') }}" class="btn btn-custom-orange mb-3">
                <i class="fas fa-plus me-1"></i> Tambah Fasilitas
            </a>
        @endcan


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
                        @foreach ($fasilitas as $index => $item)
                            <tr class="text-center">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td>
                                    @can('fasilitas-edit')
                                        <a href="{{ route('fasilitas.edit', $item->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                    @endcan
                                    @can('fasilitas-delete')
                                        <form action="{{ route('fasilitas.destroy', $item->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Pagination --}}
                <div class="d-flex justify-content-center mt-3">
                    {{ $fasilitas->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
