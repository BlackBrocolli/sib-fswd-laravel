@extends('layouts.dashboardlayout')

@section('title', 'Pengguna | Grup Pengguna')

@section('content')
    <div class="pagetitle">
        <h1>Grup Pengguna</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item">Pengguna</li>
                <li class="breadcrumb-item active">Grup Pengguna</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center my-2">
                            <h5 class="card-title">Grup Pengguna</h5>
                            {{-- <a href="{{ route('usergroups.create') }}" class="btn btn-primary btn-sm py-2 px-3"><i
                                    class="bi bi-person-plus-fill"></i> Tambah Grup</a> --}}
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
                                    <th scope="col">Nama Grup</th>
                                    {{-- <th scope="col" data-sortable="false">Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($usergroups as $usergroup)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $usergroup->nama_grup }}</td>
                                        <td class="text-center">
                                            {{-- <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('categories.destroy', $usergroup->id) }}" method="POST">
                                                <a href="{{ route('categories.edit', $usergroup->id) }}"
                                                    class="btn btn-sm btn-success btn-block"><i
                                                        class="bi bi-pencil-fill"></i> Edit</a>

                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger btn-block"><i
                                                        class="bi bi-trash-fill"></i> Hapus</button>
                                            </form> --}}
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Grup belum Tersedia.
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
