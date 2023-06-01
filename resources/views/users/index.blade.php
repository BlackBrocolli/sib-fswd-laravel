@extends('layouts.dashboardlayout')

@section('title', 'Pengguna | Daftar Pengguna')

@section('content')

    @php
        use Illuminate\Support\Facades\Auth;
    @endphp

    <div class="pagetitle">
        <h1>Daftar Pengguna</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item">Pengguna</li>
                <li class="breadcrumb-item active">Daftar Pengguna</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pengguna</h5>
                        @if (Auth::user()->role == 1)
                            <div class="d-flex justify-content-between align-items-center my-2">
                                <h5 class="card-title">Pengguna</h5>
                                <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm py-2 px-3"><i
                                        class="bi bi-person-plus-fill"></i> Tambah pengguna</a>
                            </div>
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
                                    <th scope="col" data-sortable="false">Avatar</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col" data-sortable="false">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td class="text-center">
                                            @if (!$user->avatar)
                                                <img src="{{ asset('assets-dashboard/img/default-avatar3.jpg') }}"
                                                    alt="Profile" class="rounded" style="width: 80px">
                                            @else
                                                <img src="{{ asset('storage/' . $user->avatar) }}" class="rounded"
                                                    style="width: 80px">
                                            @endif
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        @foreach ($usergroups as $usergroup)
                                            @if ($usergroup->id == $user->role)
                                                <td>{{ $usergroup->nama_grup }}</td>
                                            @endif
                                        @endforeach
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                <a href="{{ route('users.show', $user->id) }}"
                                                    class="btn btn-sm btn-primary btn-block"><i class="bi bi-eye-fill"></i>
                                                    Detail</a>

                                                @if (Auth::user()->role == 1)
                                                    <a href="{{ route('users.edit', $user->id) }}"
                                                        class="btn btn-sm btn-success btn-block"><i
                                                            class="bi bi-pencil-fill"></i> Edit</a>

                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger btn-block"><i
                                                            class="bi bi-trash-fill"></i> Hapus</button>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data User belum Tersedia.
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
