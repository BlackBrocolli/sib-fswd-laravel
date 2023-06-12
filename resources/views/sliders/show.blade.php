@extends('layouts.dashboardlayout')

@section('title', 'Detail Slider')

@section('content')
    <div class="pagetitle">
        <h1>Detail Slider</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('sliders.index') }}">Slider</a></li>
                <li class="breadcrumb-item active">Detail Slider</li>
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
                        <div class="text-center">
                            <img src="../../assets-landing/img/slide/{{ $slider->image }}" class="rounded shadow-sm"
                                style="width: 480px">
                        </div>
                        <hr>

                        <table>
                            <tr class="font-weight-bold">
                                <td style="width: 120px">Title</td>
                                <td style="width: 24px">:</td>
                                <td>{{ $slider->title }}</td>

                            </tr>
                            <tr>
                                <td style="vertical-align: top;">Description</td>
                                <td style="vertical-align: top;">:</td>
                                <td style="vertical-align: top;">{{ $slider->description }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td><span
                                        class="badge rounded-pill {{ $slider->is_active == '0' ? 'bg-danger' : 'bg-success' }}">{{ $slider->is_active == '1' ? 'Active' : 'Inactive' }}</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
