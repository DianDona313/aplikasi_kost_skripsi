@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Booking</h2>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('bookings.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="property_id" class="form-label">Kost</label>
                        <select name="property_id" class="form-control">
                            <option value="">Pilih Kost</option>
                            @foreach ($properties as $property)
                                <option value="{{ $property->id }}">{{ $property->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="penyewa_id" class="form-label">Penyewa</label>
                        <select name="penyewa_id" class="form-control">
                            <option value="">Pilih Penyewa</option>
                            @foreach ($penyewas as $penyewa)
                                <option value="{{ $penyewa->id }}">{{ $penyewa->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="room_id" class="form-label">Kamar</label>
                        <select name="room_id" class="form-control" required>
                            <option value="">Pilih Kamar</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}">
                                    {{ $room->room_name }} - Rp {{ number_format($room->harga, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    

                    <div class="d-flex gap-3 mb-3">
                        <div class="flex-fill">
                            <label for="start_date" class="form-label">Tanggal Mulai</label>
                            <input type="date" name="start_date" class="form-control" required>
                        </div>
                    
                        <div class="flex-fill">
                            <label for="end_date" class="form-label">Tanggal Selesai</label>
                            <input type="date" name="end_date" class="form-control" required>
                        </div>
                    </div>
        

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="pending">Tertunda</option>
                            <option value="confirmed">Terkonfirmasi</option>
                            <option value="canceled">Batalkan</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Booking</button>
                    <a href="{{ route('bookings.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
