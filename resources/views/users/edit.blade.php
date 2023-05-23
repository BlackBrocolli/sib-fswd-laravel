@extends('layouts.main')

@section('title', 'Edit Data User')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('users.index') }}" class="text-dark">&#60; kembali</a>
                        <br><br>
                        <h1>Edit User</h1>
                        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="font-weight-bold">Avatar</label>
                                <input type="file" class="form-control" name="avatar">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name', $user->name) }}" placeholder="Masukkan nama user">

                                <!-- error message untuk name -->
                                @error('name')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email', $user->email) }}" placeholder="Masukkan email">

                                <!-- error message untuk email -->
                                @error('email')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" value="{{ old('password', $user->password) }}"
                                        placeholder="Masukkan password" id="password-input">

                                    <div class="input-group-append">
                                        <button id="password-visibility-button" type="button" class="btn btn-secondary"
                                            onclick="togglePasswordVisibility()">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- error message untuk password -->
                                @error('password')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Role</label>
                                <select class="form-control @error('role') is-invalid @enderror" name="role">
                                    <option value="">Pilih role</option>
                                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>
                                        Admin</option>
                                    <option value="staff" {{ old('role', $user->role) === 'staff' ? 'selected' : '' }}>
                                        Staff</option>
                                </select>

                                <!-- error message untuk role -->
                                @error('role')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" value="{{ old('phone', $user->phone) }}"
                                    placeholder="Masukkan nomor telepon">

                                <!-- error message untuk phone -->
                                @error('phone')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Address</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" name="address" rows="5"
                                    placeholder="Masukkan Konten Post">{{ old('address', $user->address) }}</textarea>

                                <!-- error message untuk address -->
                                @error('address')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-md btn-primary">Update</button>
                            <button type="reset" class="btn btn-md btn-secondary">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    @parent

    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password-input");
            var passwordVisibilityButton = document.getElementById("password-visibility-button");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordVisibilityButton.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                passwordInput.type = "password";
                passwordVisibilityButton.innerHTML = '<i class="fas fa-eye"></i>';
            }
        }
    </script>
@endsection
