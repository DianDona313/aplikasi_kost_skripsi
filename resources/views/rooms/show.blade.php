@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <!-- Detail Ruangan Utama -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h2 class="h5 mb-0">Detail Ruangan</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <dl class="row">
                            <dt class="col-sm-4">ID Ruangan:</dt>
                            <dd class="col-sm-8">{{ $room->id }}</dd>

                            <dt class="col-sm-4">Nama Ruangan:</dt>
                            <dd class="col-sm-8">{{ $room->room_name }}</dd>

                            <dt class="col-sm-4">Kapasitas:</dt>
                            <dd class="col-sm-8">{{ $room->capacity ?? 'Belum diisi' }}</dd>
                        </dl>
                    </div>
                    <div class="col-md-6">
                        <dl class="row">
                            <dt class="col-sm-4">Lokasi:</dt>
                            <dd class="col-sm-8">{{ $room->location ?? 'Belum diisi' }}</dd>

                            <dt class="col-sm-4">Fasilitas:</dt>
                            <dd class="col-sm-8">{{ $room->facilities ?? 'Belum diisi' }}</dd>

                            <dt class="col-sm-4">Status:</dt>
                            <dd class="col-sm-8">
                                <span class="badge bg-{{ $room->is_active ? 'success' : 'secondary' }}">
                                    {{ $room->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Ruangan dengan Nama yang Sama -->
        <div class="card">
            <div class="card-header bg-info text-white">
                <h2 class="h5 mb-0">Ruangan dengan Nama "{{ $room->room_name }}"</h2>
            </div>
            <div class="card-body">
                @if ($roomsWithSameName->count() > 1)
                    <div class="alert alert-info">
                        Terdapat {{ $roomsWithSameName->count() }} ruangan dengan nama ini
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nama Ruangan</th>
                                <th>Lokasi</th>
                                <th>Kapasitas</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roomsWithSameName as $r)
                                <tr class="{{ $r->id == $room->id ? 'table-active' : '' }}">
                                    <td>{{ $r->id }}</td>
                                    <td>
                                        {{ $r->room_name }}
                                        @if ($r->id == $room->id)
                                            <span class="badge bg-primary">Ruangan Ini</span>
                                        @endif
                                    </td>
                                    <td>{{ $r->location ?? '-' }}</td>
                                    <td>{{ $r->capacity ?? '-' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $r->is_active ? 'success' : 'secondary' }}">
                                            {{ $r->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('rooms.show', $r->id) }}" class="btn btn-sm btn-outline-primary">
                                            Lihat
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="mt-3">
            <a href="{{ route('rooms.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Ruangan
            </a>
        </div>
    </div>
@endsection
