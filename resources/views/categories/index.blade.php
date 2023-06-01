@extends('layouts.dashboardlayout')

@section('title', 'Produk | Kategori')

@section('content')

    @php
        use Illuminate\Support\Facades\Auth;
    @endphp

    <div class="pagetitle">
        <h1>Kategori</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item">Produk</li>
                <li class="breadcrumb-item active">Kategori</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Kategori</h5>
                        @if (Auth::user()->role == 1)
                            <div class="d-flex justify-content-between align-items-center my-2">
                                <h5 class="card-title">Kategori</h5>
                                <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm py-2 px-3"><i
                                        class="bi bi-person-plus-fill"></i> Tambah kategori</a>
                            </div>
                        @endif

                        {{-- <p>Add lightweight datatables to your project with using the <a
                                href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple
                                DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to
                            conver to a datatable</p> --}}

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama kategori</th>
                                    @if (Auth::user()->role == 1)
                                        <th scope="col" data-sortable="false">Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $category->name }}</td>
                                        @if (Auth::user()->role == 1)
                                            <td class="text-center">
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                    action="{{ route('categories.destroy', $category->id) }}"
                                                    method="POST">
                                                    <a href="{{ route('categories.edit', $category->id) }}"
                                                        class="btn btn-sm btn-success btn-block"><i
                                                            class="bi bi-pencil-fill"></i> Edit</a>

                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger btn-block"><i
                                                            class="bi bi-trash-fill"></i> Hapus</button>
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Kategori belum Tersedia.
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
