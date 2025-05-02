@extends('layouts.app') 

@section('content')
<div class="container">
    <h2 class="mb-4" style="color: #FDE5AF;">Daftar Properti</h2>
    
    {{-- Tampilkan pesan sukses jika ada --}}
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <a href="{{ route('properties.create') }}" class="btn btn-custom-orange mb-3">
        <i class="fas fa-plus me-1"></i> Tambah Kost Baru
    </a>

    <div class="card mt-4">
        <div class="card-body">
            <table class="table ">
                <thead>
                    <tr class="text-center">
                        <th >No</th>
                        <th >Nama</th>
                        <th >Alamat</th>
                        <th >Kota</th>
                        <th >Foto</th>
                        <th   width="200px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($properties as $property)
                        <tr >
                            <td class="text-center">{{ ++$i }}</td>
                            <td>{{ $property->nama }}</td>
                            <td>{{ $property->alamat }}</td>
                            <td>{{ $property->kota }}</td>
                            <td class="text-center">
                                @if($property->foto)
                                    <img src="{{ asset('storage/' . $property->foto) }}" width="100">
                                @else
                                    <span class="text-muted">Tidak ada foto</span>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-info btn-sm" href="{{ route('properties.show', $property->id) }}">Lihat</a>
                                <a class="btn btn-primary btn-sm" href="{{ route('properties.edit', $property->id) }}">Edit</a>
                                <form action="{{ route('properties.destroy', $property->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    {!! $properties->links() !!}
</div>
@endsection
