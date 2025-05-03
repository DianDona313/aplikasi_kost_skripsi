@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4" style="color: #FDE5AF;">Users Management</h2>

    {{-- Tampilkan pesan sukses jika ada --}}
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @can('user-create')
        <a class="btn btn-custom-orange mb-3" href="{{ route('users.create') }}">
            <i class="fa fa-plus me-1"></i> Create New User
        </a>
    @endcan

    <div class="card mt-4">
        <div class="card-body">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th width="280px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $user)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if (!empty($user->getRoleNames()))
                                    @foreach ($user->getRoleNames() as $v)
                                        <span class="badge bg-success">{{ $v }}</span>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-info btn-sm" href="{{ route('users.show', $user->id) }}">
                                    <i class="fa-solid fa-list me-1"></i> Lihat
                                </a>
                                @can('user-edit')
                                    <a class="btn btn-primary btn-sm" href="{{ route('users.edit', $user->id) }}">
                                        <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                                    </a>
                                @endcan
                                @can('user-delete')
                                    <form method="POST" action="{{ route('users.destroy', $user->id) }}" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
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
            {!! $data->links('pagination::bootstrap-5') !!}
        </div>
    </div>
</div>
@endsection
