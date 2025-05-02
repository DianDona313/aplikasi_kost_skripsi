@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4" style="color: #FDE5AF;">Daftar Kamar</h2>
        <a href="{{ route('rooms.create') }}" class="btn btn-custom-orange mb-3">
            <i class="fas fa-plus me-1"></i> Tambah Kamar Kost
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
                            <th>Nama Kamar</th>
                            <th>Harga</th>
                            <th>Ketersediaan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rooms as $room)
                            <tr class="text-center">
                                <td class="text-center">{{ ++$i }}</td>
                                <td>{{ $room->room_name }}</td>
                                <td>Rp {{ number_format($room->harga, 0, ',', '.') }}</td>
                                <td>
                                    @if ($room->is_available)
                                        <span class="badge bg-success">Tersedia</span>
                                    @else
                                        <span class="badge bg-danger">Tidak Tersedia</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('/rooms/' . urlencode($room->id)) }}"
                                        class="btn btn-info btn-sm">Detail</a>
                                    <a href="{{ route('rooms.edit', $room->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('rooms.destroy', $room->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kamar ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" >Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-3">
                    {!! $rooms->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
