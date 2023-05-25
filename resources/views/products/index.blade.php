@extends('layouts.dashboardlayout')

@section('title', 'Daftar Produk')

@section('content')
    <div class="pagetitle">
        <h1>Daftar Produk</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item">Produk</li>
                <li class="breadcrumb-item active">Daftar Produk</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center my-2">
                            <h5 class="card-title">Produk</h5>
                            <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm py-2 px-3"><i
                                    class="bi bi-person-plus-fill"></i> Tambah produk</a>
                        </div>
                        {{-- <p>Add lightweight datatables to your project with using the <a
                                href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple
                                DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to
                            conver to a datatable</p> --}}

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" data-sortable="false">Image</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Nama Kategori</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col" data-sortable="false">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($viewproducts as $product)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td class="text-center">
                                            <img src="assets-landing/img/portfolio/{{ $product->image }}" class="rounded"
                                                style="width: 80px">
                                        </td>
                                        <td>{{ $product->nama_produk }}</td>
                                        <td>{{ $product->nama_kategori }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('products.destroy', $product->id) }}" method="POST">
                                                <a href="{{ route('products.show', $product->id) }}"
                                                    class="btn btn-sm btn-primary btn-block"><i class="bi bi-eye-fill"></i>
                                                    Detail</a>
                                                <a href="{{ route('products.edit', $product->id) }}"
                                                    class="btn btn-sm btn-success btn-block"><i
                                                        class="bi bi-pencil-fill"></i> Edit</a>

                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger btn-block"><i
                                                        class="bi bi-trash-fill"></i> Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Produk belum Tersedia.
                                    </div>
                                @endforelse

                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
