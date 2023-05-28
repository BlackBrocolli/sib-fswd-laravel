@extends('layouts.dashboardlayout')

@section('title', 'Tambah Slider')

@section('content')
    <div class="pagetitle">
        <h1>Tambah Slider</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('sliders.index') }}">Slider</a></li>
                <li class="breadcrumb-item active">Tambah Slider</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">

                        <br>
                        <a href="{{ route('sliders.index') }}" class="btn btn-primary btn-sm"><i
                                class="bi bi-arrow-left"></i>
                            Kembali</a>

                        <br><br>
                        <form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf
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
                                <label for="title" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        name="title" value="{{ old('title') }}" id="title">
                                    <!-- error message untuk nama -->
                                    @error('title')
                                        <div class="alert alert-danger mt-2 small">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>{{-- End Title Input --}}

                            <div class="row mb-3">
                                <label for="description" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" style="height: 100px"
                                        name="description">{{ old('description') }}</textarea>
                                    <!-- error message untuk description -->
                                    @error('description')
                                        <div class="alert alert-danger mt-2 small">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>{{-- End Description Textarea --}}

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
