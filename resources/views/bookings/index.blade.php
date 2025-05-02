@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4" style="color: #FDE5AF;">Daftar Booking</h2>

    {{-- <a href="{{ route('bookings.create') }}" class="btn btn-primary mb-3">Tambah Booking</a> --}}
    <a href="{{ route('bookings.create') }}" class="btn btn-custom-orange mb-3">
    <i class="fas fa-plus me-1"></i> Tambah Booking
</a>


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
                        <th>ID</th>
                        <th>Properti</th>
                        <th>Penyewa</th>
                        <th>Kamar</th>
                        <th>Periode</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                    <tr class="text-center">
                        <td class="text-center">{{ ++$i }}</td>
                        <td>{{ $booking->property->nama ?? 'Tidak Diketahui' }}</td>
                        <td>{{ $booking->penyewa->nama ?? 'Tidak Diketahui' }}</td>
                        <td>{{ $booking->room->room_name ?? 'Tidak Diketahui' }}</td>
                        <td>{{ $booking->start_date }} - {{ $booking->end_date }}</td>
                        <td>
                            @if($booking->status == 'confirmed')
                                <span class="badge bg-success">Terkonfirmasi</span>
                            @elseif($booking->status == 'pending')
                                <span class="badge bg-warning">Menunggu</span>
                            @else
                                <span class="badge bg-danger">Dibatalkan</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus booking ini?');">
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
                {!! $bookings->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection
