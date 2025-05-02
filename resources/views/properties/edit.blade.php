@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">Edit Properti</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{ route('properties.update', $property->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Properti</label>
                        <input type="text" name="nama" class="form-control" id="nama" value="{{ $property->nama }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" name="alamat" class="form-control" id="alamat" value="{{ $property->alamat }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="kota" class="form-label">Kota</label>
                        <input type="text" name="kota" class="form-control" id="kota" value="{{ $property->kota }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="jeniskost_id" class="form-label">Jenis Kost</label>
                        <select name="jeniskost_id" class="form-select" id="jeniskost_id" required>
                            @foreach ($jenisKosts as $jenis)
                                <option value="{{ $jenis->id }}" {{ $property->jeniskost_id == $jenis->id ? 'selected' : '' }}>{{ $jenis->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" name="foto" class="form-control" id="foto">
                        @if($property->foto)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $property->foto) }}" class="img-fluid" alt="Foto Properti">
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" id="deskripsi" rows="3">{{ $property->deskripsi }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection