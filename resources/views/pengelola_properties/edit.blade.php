@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Pengelola Properti</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pengelola_properties.update', $pengelolaProperty->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Pengelola:</label>
            <select name="pengelola_id" class="form-control" required>
                <option value="">Pilih Pengelola</option>
                @foreach ($pengelolas as $pengelola)
                    <option value="{{ $pengelola->id }}" {{ $pengelola->id == $pengelolaProperty->pengelola_id ? 'selected' : '' }}>
                        {{ $pengelola->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Properti:</label>
            <select name="properti_id" class="form-control" required>
                <option value="">Pilih Properti</option>
                @foreach ($propertis as $properti)
                    <option value="{{ $properti->id }}" {{ $properti->id == $pengelolaProperty->properti_id ? 'selected' : '' }}>
                        {{ $properti->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('pengelola_properties.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection

