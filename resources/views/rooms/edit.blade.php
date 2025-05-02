@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Kamar</h1>
    <form action="{{ route('rooms.update', $room->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nama Kamar</label>
            <input type="text" name="room_name" class="form-control" value="{{ $room->room_name }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="room_deskription" class="form-control">{{ $room->room_deskription }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="harga" class="form-control" value="{{ $room->harga }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Ketersediaan</label>
            <select name="is_available" class="form-control">
                <option value="Ya" {{ $room->is_available == 'Ya' ? 'selected' : '' }}>Ya</option>
                <option value="Tidak" {{ $room->is_available == 'Tidak' ? 'selected' : '' }}>Tidak</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Fasilitas</label>
            <input type="text" name="fasilitas" class="form-control" value="{{ $room->fasilitas }}">
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection
