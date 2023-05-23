@extends('layouts.main')

@section('title', 'Data Pengguna')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h1>Data Pengguna</h1>
                            <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary mt-2 mb-3"><i
                                    class="fa fa-plus"></i> Tambah
                                user</a>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Avatar</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Role</th>
                                    <th style="width: 15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td class="text-center">
                                            <img src="{{ asset('storage/' . $user->avatar) }}" class="rounded"
                                                style="width: 100px">
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                <a href="{{ route('users.show', $user->id) }}"
                                                    class="btn btn-sm btn-primary btn-block"><i class="fa fa-eye"></i>
                                                    Lihat</a>
                                                <a href="{{ route('users.edit', $user->id) }}"
                                                    class="btn btn-sm btn-success btn-block"><i
                                                        class="fa fa-pencil-alt"></i> Edit</a>

                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger btn-block mt-2"><i
                                                        class="fa fa-trash"></i> Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Post belum Tersedia.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                        {!! $users->links('pagination::bootstrap-4') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
