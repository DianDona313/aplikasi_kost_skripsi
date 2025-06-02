@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 style="color: #FDE5AF;">Create New Role</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary btn-sm mb-2" href="{{ route('roles.index') }}"><i class="fa fa-arrow-left"></i>
                    Back</a>
            </div>
        </div>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('roles.store') }}">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong style="color: #FDE5AF;">Name:</strong>
                    <input type="text" name="name" placeholder="Name" class="form-control">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                @php
                    $chunkedPermissions = $permission->chunk(ceil(count($permission) / 3)); // Bagi jadi 3 kolom vertikal
                @endphp

                <div class="card" style="background-color: #F6BE68; border: none;">
                    <div class="card-body">
                        <div class="form-group">
                            <strong style="color: #246D15;">Permission:</strong>
                            <div class="row">
                                @foreach ($chunkedPermissions as $column)
                                    <div class="col-md-4">
                                        @foreach ($column as $value)
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input"
                                                    name="permission[{{ $value->id }}]" value="{{ $value->id }}"
                                                    id="permission{{ $value->id }}">
                                                <label class="form-check-label" for="permission{{ $value->id }}"
                                                    style="color: #246D15;">
                                                    {{ $value->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
        <br>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary btn-sm mb-3"><i class="fa-solid fa-floppy-disk"></i>
                Submit</button>
        </div>
    </form>

@endsection
