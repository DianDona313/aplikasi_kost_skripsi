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
                        <select name="property_id" id="property_id" class="form-control">
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
                        <select name="room_id" id="room_id" class="form-control" required>
                            <option value="">Pilih Kamar</option>
                            {{-- Akan diisi lewat JavaScript --}}
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

    {{-- Script untuk load kamar berdasarkan properti --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const propertySelect = document.getElementById('property_id');
            const roomSelect = document.getElementById('room_id');

            propertySelect.addEventListener('change', function () {
                const propertyId = this.value;

                // Kosongkan dulu isi dropdown kamar
                roomSelect.innerHTML = '<option value="">Pilih Kamar</option>';

                if (propertyId) {
                    fetch(`/kamar-by-kost/${propertyId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.length === 0) {
                                roomSelect.innerHTML = '<option value="">Tidak ada kamar tersedia</option>';
                            } else {
                                data.forEach(room => {
                                    const option = document.createElement('option');
                                    option.value = room.id;
                                    option.textContent = `${room.room_name} - Rp ${new Intl.NumberFormat('id-ID').format(room.harga)}`;
                                    roomSelect.appendChild(option);
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Gagal memuat data kamar.');
                        });
                }
            });
        });
    </script>
@endsection
