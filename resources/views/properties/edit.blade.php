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

                    <!-- Field Jenis Kost -->
                    <div class="form-group">
                        <label for="jeniskost_id">Jenis Kost</label>
                        <select name="jeniskost_id" class="form-control">
                            @foreach ($jenisKosts as $jenisKost)
                                <option value="{{ $jenisKost->id }}"
                                    {{ $jenisKost->id == $property->jeniskost_id ? 'selected' : '' }}>
                                    {{ $jenisKost->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Field Peraturan (Checkbox) -->
                    <div class="form-group">
                        <label for="peraturan_id">Peraturan</label><br>
                        @foreach ($peraturan as $peraturanItem)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="peraturans[]"
                                    value="{{ $peraturanItem->id }}"
                                    {{ in_array($peraturanItem->id, $peraturanIds) ? 'checked' : '' }}>
                                <label class="form-check-label">{{ $peraturanItem->nama }}</label>
                                <!-- Menampilkan nama peraturan -->
                            </div>
                        @endforeach
                    </div>

                    <!-- Field Nama, Alamat, etc. -->
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ $property->nama }}">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" name="alamat" class="form-control" value="{{ $property->alamat }}">
                    </div>
                    <div class="form-group">
                        <label for="kota">Kota</label>
                        <input type="text" name="kota" class="form-control" value="{{ $property->kota }}">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control">{{ $property->deskripsi }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" name="foto" class="form-control">
                        <img src="/storage/{{ $property->foto }}" width="100" class="img-thumbnail mt-2"
                            alt="Foto Kost">
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Update</button>
                </form>

            </div>
        </div>
    </div>
@endsection
