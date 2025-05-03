@extends('layouts.app2')

@section('content')
    <div class="container">
        <h2 class="mb-4" style="color: #FDE5AF;">Role Management</h2>

        {{-- Tampilkan pesan sukses jika ada --}}
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        @can('role-create')
            <a class="btn btn-custom-orange mb-3" href="{{ route('roles.create') }}">
                <i class="fa fa-plus me-1"></i> Create New Role
            </a>
        @endcan

        <div class="card mt-4">
            <div class="card-body">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th width="100px">No</th>
                            <th>Name</th>
                            <th width="280px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $key => $role)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="{{ route('roles.show', $role->id) }}">
                                        <i class="fa-solid fa-list me-1"></i> Lihat
                                    </a>
                                    @can('role-edit')
                                        <a class="btn btn-primary btn-sm" href="{{ route('roles.edit', $role->id) }}">
                                            <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                                        </a>
                                    @endcan
                                    @can('role-delete')
                                        <form method="POST" action="{{ route('roles.destroy', $role->id) }}" class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus role ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fa-solid fa-trash me-1"></i> Hapus
                                            </button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Pagination --}}
                {!! $roles->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
@endsection
