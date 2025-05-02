@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4" style="color: #FDE5AF;">Daftar History Pengeluaran</h2>
    <a href="{{ route('history_pengeluarans.create') }}" class="btn btn-custom-orange mb-3">
        <i class="fas fa-plus me-1"></i> Tambah Pengeluaran
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
                        <th>Nama Pengeluaran</th>
                        <th>Jumlah</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($historyPengeluaran as $pengeluaran)
                    <tr class="text-center">
                        <td>{{ $pengeluaran->id }}</td>
                        <td>{{ $pengeluaran->nama_pengeluaran }}</td>
                        <td>Rp {{ number_format($pengeluaran->jumlah_pengeluaran, 0, ',', '.') }}</td>
                        <td>{{ $pengeluaran->tanggal_pengeluaran }}</td>
                        <td>
                            <a href="{{ route('history_pengeluarans.show', $pengeluaran->id) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('history_pengeluarans.edit', $pengeluaran->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('history_pengeluarans.destroy', $pengeluaran->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?');">
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
                {!! $historyPengeluaran->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection
