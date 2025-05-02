@extends('layouts.app') {{-- Sesuaikan dengan layout yang digunakan --}}

@section('content')
<div class="container">
    <h2>Daftar Properti</h2>
    
    {{-- Tampilkan pesan sukses jika ada --}}
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <a class="btn btn-success" href="{{ route('properties.create') }}">Tambah Properti</a>

    <table class="table table-bordered mt-3">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Kota</th>
            <th>Foto</th>
            <th width="200px">Aksi</th>
        </tr>
        @foreach ($properties as $property)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $property->nama }}</td>
            <td>{{ $property->alamat }}</td>
            <td>{{ $property->kota }}</td>
            <td><img src="{{ asset('storage/' . $property->foto) }}" width="100"></td>
            <td>
                <a class="btn btn-info" href="{{ route('properties.show', $property->id) }}">Lihat</a>
                <a class="btn btn-primary" href="{{ route('properties.edit', $property->id) }}">Edit</a>
                <form action="{{ route('properties.destroy', $property->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    {{-- Pagination --}}
    {!! $properties->links() !!}
</div>
@endsection
