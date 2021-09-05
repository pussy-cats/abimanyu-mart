@extends('adminlte::page')

@section('title', 'Edit Pengguna')

@section('content_header')
<h1 class="m-0 text-dark">Edit Pengguna</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('dashboard.user.update', ['id' => $userData->id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nama</label>
                        <input type="text" class="form-control" name="name" value="{{ $userData->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ $userData->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <input type="submit" value="Simpan" class="btn btn-primary float-right">
                </form>
            </div>
        </div>
    </div>
</div>
@stop
