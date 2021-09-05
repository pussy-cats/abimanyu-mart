@extends('adminlte::page')

@section('title', 'Daftar Admin')

@section('content_header')
<h1 class="m-0 text-dark">Daftar Admin <a href="{{ route('dashboard.admin.add') }}"
        class="btn btn-primary float-right">Tambah Admin</a></h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @include('layouts.flash')
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Admin</th>
                            <th scope="col">Email Admin</th>
                            <th scope="col" colspan="2" class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allAdmins as $admin)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td class="text-center"><a href="{{ route('dashboard.admin.edit', ['id' => $admin->id]) }}"
                                    class="btn btn-primary">Edit</a></td>
                            <td class="text-center"><a
                                    href="{{ route('dashboard.admin.delete', ['id' => $admin->id]) }}"
                                    class="btn btn-danger">Hapus</a></td>
                        </tr>
                        @endforeach
            </div>
        </div>
    </div>
</div>
@stop
