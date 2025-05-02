@extends('layouts.app')
@section('content')
    <div class="container">
        <h2 class="mb-4">Edit Penyewa</h2>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('penyewas.update', $penyewa->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" value="{{ $penyewa->nama }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ $penyewa->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="nohp" class="form-label">No HP</label>
                        <input type="text" name="nohp" class="form-control" id="nohp" value="{{ $penyewa->nohp }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" name="alamat" class="form-control" id="alamat" value="{{ $penyewa->alamat }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select" id="jenis_kelamin" required>
                            <option value="Laki-laki" {{ $penyewa->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ $penyewa->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
