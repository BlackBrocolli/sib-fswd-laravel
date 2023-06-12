@extends('layouts.dashboardlayout')

@section('title', 'Produk | Daftar Produk')

@section('content')

    @php
        use Illuminate\Support\Facades\Auth;
    @endphp

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
                        @if (Auth::user()->role == 1 || Auth::user()->role == 2)
                            <div class="d-flex justify-content-between align-items-center my-2">
                                <h5 class="card-title">Produk</h5>
                                <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm py-2 px-3"><i
                                        class="bi bi-person-plus-fill"></i> Tambah produk</a>
                            </div>
                        @else
                            <h5 class="card-title">Produk</h5>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
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
                                    <th scope="col" data-sortable="false">Image</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Harga</th>
                                    @if (Auth::user()->role == 1 || Auth::user()->role == 2 || Auth::user()->role == 4)
                                        <th scope="col">Status</th>
                                    @endif
                                    <th scope="col" data-sortable="false">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td class="text-center">
                                            <img src="assets-landing/img/portfolio/{{ $product->image }}" class="rounded"
                                                style="width: 80px">
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        @foreach ($categories as $category)
                                            @if ($category->id == $product->category_id)
                                                <td>{{ $category->name }}</td>
                                            @endif
                                        @endforeach

                                        <td>Rp{{ number_format($product->price, 2, ',', '.') }}</td>

                                        @if (Auth::user()->role == 1 || Auth::user()->role == 2 || Auth::user()->role == 4)
                                            <td><span
                                                    class="badge rounded-pill {{ $product->status == 'waiting' ? 'bg-warning text-dark' : ($product->status == 'accepted' ? 'bg-success' : 'bg-danger') }}">{{ $product->status }}</span>
                                            </td>
                                        @endif
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('products.destroy', $product->id) }}" method="POST">
                                                <a href="{{ route('products.show', $product->id) }}"
                                                    class="btn btn-sm btn-primary btn-block"><i class="bi bi-eye-fill"></i>
                                                    Detail</a>

                                                @if (Auth::user()->role == 1 || Auth::user()->role == 2)
                                                    <a href="{{ route('products.edit', $product->id) }}"
                                                        class="btn btn-sm btn-success btn-block"><i
                                                            class="bi bi-pencil-fill"></i> Edit</a>

                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger btn-block"><i
                                                            class="bi bi-trash-fill"></i> Hapus</button>
                                                @endif

                                                @if (Auth::user()->role == 4)
                                                    @if ($product->status == 'waiting')
                                                        <a href="{{ route('products.accept', $product->id) }}"
                                                            onclick="return confirmAction(event, 'Apakah Anda yakin ingin menerima produk ini?')"
                                                            class="btn btn-sm btn-success btn-block">
                                                            <i class="bi bi-check-circle-fill"></i> Accept
                                                        </a>
                                                        <a href="{{ route('products.reject', $product->id) }}"
                                                            onclick="return confirmAction(event, 'Apakah Anda yakin ingin menolak produk ini?')"
                                                            class="btn btn-sm btn-danger btn-block">
                                                            <i class="bi bi-x-circle-fill"></i> Reject
                                                        </a>
                                                    @endif
                                                @endif

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

    <script>
        function confirmAction(event, message) {
            if (!confirm(message)) {
                event.preventDefault();
                return false;
            }
            return true;
        }
    </script>
@endsection
