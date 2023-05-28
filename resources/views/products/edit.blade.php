@extends('layouts.dashboardlayout')

@section('title', 'Edit Produk')

@section('content')
    <div class="pagetitle">
        <h1>Edit Produk</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item">Produk</li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Daftar Produk</a></li>
                <li class="breadcrumb-item active">Edit Produk</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">

                        <br>
                        <a href="{{ route('products.index') }}" class="btn btn-primary btn-sm"><i
                                class="bi bi-arrow-left"></i>
                            Kembali</a>

                        <br><br>

                        <form action="{{ route('products.update', $product->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="image" class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                    <input class="form-control @error('image') is-invalid @enderror" type="file"
                                        id="image" name="image">
                                    <!-- error message untuk image -->
                                    @error('image')
                                        <div class="alert alert-danger mt-2 small">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>{{-- End Image Input --}}

                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name', $product->name) }}" id="name">
                                    <!-- error message untuk nama -->
                                    @error('name')
                                        <div class="alert alert-danger mt-2 small">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>{{-- End Name Input --}}

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-10">
                                    <select class="form-select @error('category') is-invalid @enderror"
                                        aria-label="Default select example" name="category">
                                        <option value="">-- Pilih Category --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <!-- error message untuk category -->
                                    @error('category')
                                        <div class="alert alert-danger mt-2 small">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>{{-- End Category Select --}}

                            <div class="row mb-3">
                                <label for="price" class="col-sm-2 col-form-label">Price</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control @error('price') is-invalid @enderror"
                                            aria-label="Amount (to the nearest dollar)" name="price"
                                            value="{{ old('price', number_format($product->price, 0, ',', '')) }}"
                                            id="price">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                    <!-- error message untuk price -->
                                    @error('price')
                                        <div class="alert alert-danger mt-2 small">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            {{-- End Price Input --}}

                            <div class="row mb-3">
                                <label for="description" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" style="height: 100px"
                                        name="description">{{ old('description', $product->description) }}</textarea>
                                    <!-- error message untuk description -->
                                    @error('description')
                                        <div class="alert alert-danger mt-2 small">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>{{-- End Description Textarea --}}

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.ckeditor.com/4.20.2/basic/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
@endsection
