@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4" style="color: #FDE5AF;">Daftar Metode Pembayaran</h2>
        @can('metode_pembayaran-create')
        <a href="{{ route('metode_pembayarans.create') }}" class="btn btn-custom-orange mb-3">
            <i class="fas fa-plus me-1"></i> Tambah Metode Pembayaran
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
                            <th>Kost</th>
                            <th>Nama Bank</th>
                            <th>No Rekening</th>
                            <th>Atas Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($metode_pembayarans as $metode)
                            <tr class="text-center">
                                <td class="text-center">{{ ++$i }}</td>
                                <td>{{ $metode->property->nama }}</td>
                                <td>{{ $metode->nama_bank }}</td>
                                <td>{{ $metode->no_rek }}</td>
                                <td>{{ $metode->atas_nama }}</td>
                                <td>
                                    <a href="{{ route('metode_pembayarans.show', $metode->id) }}" class="btn btn-info btn-sm">Lihat</a>
                                    @can('metode_pembayaran-edit')
                                    <a href="{{ route('metode_pembayarans.edit', $metode->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    @endcan @can('metode_pembayaran-delete')
                                    <form action="{{ route('metode_pembayarans.destroy', $metode->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?');">
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
            </div>
        </div>
    </div>
@endsection
