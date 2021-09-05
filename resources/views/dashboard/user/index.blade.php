@extends('adminlte::page')

@section('title', 'Daftar Pengguna')

@section('content_header')
<h1 class="m-0 text-dark">Daftar Pengguna <a href="{{ route('dashboard.user.add') }}"
        class="btn btn-primary float-right">Tambah Pengguna</a></h1>
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
                            <th scope="col">Nama Pengguna</th>
                            <th scope="col">Email Pengguna</th>
                            <th scope="col" colspan="2" class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allUsers as $user)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="text-center"><a href="{{ route('dashboard.user.edit', ['id' => $user->id]) }}"
                                    class="btn btn-primary">Edit</a></td>
                            <td class="text-center"><a href="{{ route('dashboard.user.delete', ['id' => $user->id]) }}"
                                    class="btn btn-danger">Hapus</a></td>
                        </tr>
                        @endforeach
            </div>
        </div>
    </div>
</div>
@stop
