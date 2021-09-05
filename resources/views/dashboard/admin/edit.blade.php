@extends('adminlte::page')

@section('title', 'Edit Admin')

@section('content_header')
<h1 class="m-0 text-dark">Edit Admin</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('dashboard.admin.update', ['id' => $adminData->id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nama</label>
                        <input type="text" class="form-control" name="name" value="{{ $adminData->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ $adminData->email }}" required>
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
