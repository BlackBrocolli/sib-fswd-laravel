@extends('layouts.dashboardlayout')

@section('title', 'Slider')

@section('content')

    @php
        use Illuminate\Support\Facades\Auth;
    @endphp

    <div class="pagetitle">
        <h1>Slider</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item active">Slider</li>
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
                                <h5 class="card-title">Slider</h5>
                                <a href="{{ route('sliders.create') }}" class="btn btn-primary btn-sm py-2 px-3"><i
                                        class="bi bi-person-plus-fill"></i> Tambah slider</a>
                            </div>
                        @else
                            <h5 class="card-title">Slider</h5>
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
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" data-sortable="false">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    use Illuminate\Support\Str;
                                @endphp
                                @forelse ($sliders as $slider)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td class="text-center">
                                            <img src="assets-landing/img/slide/{{ $slider->image }}" class="rounded"
                                                style="width: 80px">
                                        </td>
                                        <td>{{ Str::limit($slider->title, 25) }}</td>
                                        <td>{{ Str::limit($slider->description, 20) }}</td> {{-- Menampilkan maksimal 20 karakter --}}
                                        <td><span
                                                class="badge rounded-pill {{ $slider->is_active == '1' ? 'bg-success' : 'bg-danger' }}">{{ $slider->is_active == '1' ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('sliders.destroy', $slider->id) }}" method="POST">
                                                <a href="{{ route('sliders.show', $slider->id) }}"
                                                    class="btn btn-sm btn-primary btn-block"><i class="bi bi-eye-fill"></i>
                                                    Detail</a>

                                                @if (Auth::user()->role == 1 || Auth::user()->role == 2)
                                                    <a href="{{ route('sliders.edit', $slider->id) }}"
                                                        class="btn btn-sm btn-success btn-block"><i
                                                            class="bi bi-pencil-fill"></i> Edit</a>

                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger btn-block"><i
                                                            class="bi bi-trash-fill"></i> Hapus</button>
                                                @endif

                                                @if (Auth::user()->role == 4)
                                                    @if ($slider->is_active == 0)
                                                        <a href="{{ route('sliders.activate', $slider->id) }}"
                                                            onclick="return confirmAction(event, 'Apakah Anda yakin ingin mengaktifkan slider ini?')"
                                                            class="btn btn-sm btn-success btn-block">
                                                            <i class="bi bi-check-circle-fill"></i> Activate
                                                        </a>
                                                    @else
                                                        <a href="{{ route('sliders.deactivate', $slider->id) }}"
                                                            onclick="return confirmAction(event, 'Apakah Anda yakin ingin menonaktifkan slider ini?')"
                                                            class="btn btn-sm btn-danger btn-block">
                                                            <i class="bi bi-x-circle-fill"></i> Deactivate
                                                        </a>
                                                    @endif
                                                @endif

                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Slider belum Tersedia.
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
