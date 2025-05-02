@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Kategori Pengeluaran</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('kategori_pengeluarans.update', $kategoriPengeluaran->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" name="nama" class="form-control" value="{{ $kategoriPengeluaran->nama }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3">{{ $kategoriPengeluaran->deskripsi }}</textarea>
                </div>
                <button type="submit" class="btn btn-success">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
