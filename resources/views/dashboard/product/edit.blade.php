@extends('adminlte::page')

@section('title', 'Edit Produk')

@section('content_header')
<h1 class="m-0 text-dark">Edit Produk</h1>
@stop

@section('css')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }

</style>
@endsection

@section('js')
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="{{ asset('js/quill-textarea.js') }}"></script>

<!-- Initialize Quill editor -->
<script>
    var quill = new Quill('#editor', {
        theme: 'snow'
    });

</script>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('dashboard.product.update', ['id' => $productData->id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nama Produk</label>
                        <input type="text" class="form-control" name="name" value="{{ $productData->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Harga Produk</label>
                        <input type="number" class="form-control" value="{{ $productData->price }}" min="0" name="price"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Stok Produk</label>
                        <input type="number" class="form-control" value="{{ $productData->stock }}" min="0" name="stock"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Kategori Produk</label>
                        <select class="form-control" name="category">
                            <option value="Makanan dan Minuman"
                                <?php if($productData->category == 'Makanan dan Minuman'){ echo 'selected'; } ?>>Makanan
                                dan Minuman</option>
                            <option value="Perlengkapan Rumah Tangga"
                                <?php if($productData->category == 'Perlengkapan Rumah Tangga'){ echo 'selected'; } ?>>
                                Perlengkapan Rumah Tangga</option>
                            <option value="Sandal dan Sepatu"
                                <?php if($productData->category == 'Sandal dan Sepatu'){ echo 'selected'; } ?>>Sandal
                                dan
                                Sepatu</option>
                            <option value="Pakaian"
                                <?php if($productData->category == 'Pakaian'){ echo 'selected'; } ?>>
                                Pakaian</option>
                            <option value="Perabotan Rumah Tangga"
                                <?php if($productData->category == 'Perabotan Rumah Tangga'){ echo 'selected'; } ?>>
                                Perabotan Rumah Tangga</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Upload Foto Produk</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="validatedCustomFile" name="file" required>
                            <label class="custom-file-label" for="validatedCustomFile">{{ $productData->file }}</label>
                            <div class="invalid-feedback">Example invalid custom file feedback</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Deskripsi Produk</label>
                        <textarea data-quilljs placeholder="Please enter text" name="description">
                            {{ $productData->description }}
                        </textarea>
                    </div>
                    <input type="submit" value="Simpan" class="btn btn-primary float-right">
                </form>
            </div>
        </div>
    </div>
</div>
@stop
