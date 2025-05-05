@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4" style="color: #FDE5AF;">Daftar History Pesan</h2>
    @can('history_pesan0-create')
    <a href="{{ route('history_pesans.create') }}" class="btn btn-custom-orange mb-3">
        <i class="fas fa-plus me-1"></i> Tambah History Pesan
    </a>
    @endcan

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Pesan</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($historyPesans as $history)
                    <tr class="text-center">
                        <td>{{ $history->id }}</td>
                        <td>{{ $history->pesan }}</td>
                        <td>{{ $history->tanggal_mulai }}</td>
                        <td>{{ $history->tanggal_selesai }}</td>
                        <td>
                            <a href="{{ route('history_pesans.show', $history->id) }}" class="btn btn-info btn-sm">Detail</a>
                            @can('history_pesans-edit')
                            <a href="{{ route('history_pesans.edit', $history->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            @endcan
                            @can('history_pesans-delete')
                            <form action="{{ route('history_pesans.destroy', $history->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?');">
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

            <div class="d-flex justify-content-center mt-3">
                {!! $historyPesans->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection
