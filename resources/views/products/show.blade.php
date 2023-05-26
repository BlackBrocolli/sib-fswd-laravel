@extends('layouts.dashboardlayout')

@section('title', 'Detail Produk')

@section('content')
    <div class="pagetitle">
        <h1>Detail Produk</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item">Produk</li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Daftar Produk</a></li>
                <li class="breadcrumb-item active">Detail Produk</li>
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
                        <div class="text-center">
                            <img src="../../assets-landing/img/portfolio/{{ $viewProduct->image }}"
                                class="rounded shadow-sm" style="width: 320px">
                        </div>
                        <hr>

                        <table>
                            <tr class="font-weight-bold">
                                <td style="width: 120px">Name</td>
                                <td style="width: 24px">:</td>
                                <td>{{ $viewProduct->nama_produk }}</td>

                            </tr>
                            <tr>
                                <td>Kategori</td>
                                <td>:</td>
                                <td>{{ $viewProduct->nama_kategori }}</td>
                            </tr>
                            <tr>
                                <td>Price</td>
                                <td>:</td>
                                <td>Rp{{ number_format($viewProduct->price, 2, ',', '.') }}</td>
                            </tr>

                            <tr>
                                <td style="vertical-align: top;">Description</td>
                                <td style="vertical-align: top;">:</td>
                                <td style="vertical-align: top;">{!! $viewProduct->description !!}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td><span
                                        class="badge rounded-pill {{ $viewProduct->status == 'waiting' ? 'bg-warning text-dark' : ($viewProduct->status == 'accepted' ? 'bg-success' : 'bg-danger') }}">{{ $viewProduct->status }}</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
