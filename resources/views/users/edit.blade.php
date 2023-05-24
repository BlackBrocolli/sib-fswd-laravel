@extends('layouts.dashboardlayout')

@section('title', 'Edit Pengguna')

@section('content')
    <div class="pagetitle">
        <h1>Edit Pengguna</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item">Pengguna</li>
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Daftar Pengguna</a></li>
                <li class="breadcrumb-item active">Edit Pengguna</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">

                        <br>
                        <a href="{{ route('users.index') }}" class="btn btn-primary btn-sm"><i class="bi bi-arrow-left"></i>
                            Kembali</a>

                        <br><br>

                        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="avatar" class="col-sm-2 col-form-label">Avatar</label>
                                <div class="col-sm-10">
                                    <input class="form-control @error('avatar') is-invalid @enderror" type="file"
                                        id="avatar" name="avatar">
                                    <!-- error message untuk avatar -->
                                    @error('avatar')
                                        <div class="alert alert-danger mt-2 small">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>{{-- End Avatar Input --}}

                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name', $user->name) }}" id="name">
                                    <!-- error message untuk nama -->
                                    @error('name')
                                        <div class="alert alert-danger mt-2 small">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>{{-- End Name Input --}}

                            <div class="row mb-3">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email', $user->email) }}">
                                    <!-- error message untuk email -->
                                    @error('email')
                                        <div class="alert alert-danger mt-2 small">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div> {{-- End Email Input --}}

                            <div class="row mb-3">
                                <label for="password-input" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input id="password-input" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            value="{{ old('password', $user->password) }}">
                                        <div class="input-group-append">
                                            <button id="password-visibility-button" type="button" class="btn btn-secondary"
                                                onclick="togglePasswordVisibility()">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- error message untuk password -->
                                    @error('password')
                                        <div class="alert alert-danger mt-2 small">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            {{-- End Password Input --}}

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-10">
                                    <select class="form-select @error('role') is-invalid @enderror"
                                        aria-label="Default select example" name="role">
                                        <option value="">Pilih Role</option>
                                        <option value="admin"
                                            {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin
                                        </option>
                                        <option value="staff"
                                            {{ old('role', $user->role) === 'staff' ? 'selected' : '' }}>Staff
                                        </option>
                                    </select>
                                    <!-- error message untuk role -->
                                    @error('role')
                                        <div class="alert alert-danger mt-2 small">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>{{-- End Role Select --}}

                            <div class="row mb-3">
                                <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                                <div class="col-sm-10">
                                    <input id="phone" type="text"
                                        class="form-control @error('phone') is-invalid @enderror" name="phone"
                                        value="{{ old('phone', $user->phone) }}">
                                    <!-- error message untuk phone -->
                                    @error('phone')
                                        <div class="alert alert-danger mt-2 small">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>{{-- End Phone Input --}}

                            <div class="row mb-3">
                                <label for="address" class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <textarea id="address" class="form-control @error('address') is-invalid @enderror" style="height: 100px"
                                        name="address">{{ old('address', $user->address) }}</textarea>
                                    <!-- error message untuk address -->
                                    @error('address')
                                        <div class="alert alert-danger mt-2 small">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>{{-- End Address Textarea --}}

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password-input");
            var passwordVisibilityButton = document.getElementById("password-visibility-button");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordVisibilityButton.innerHTML = '<i class="bi bi-eye-slash"></i>';
            } else {
                passwordInput.type = "password";
                passwordVisibilityButton.innerHTML = '<i class="bi bi-eye"></i>';
            }
        }
    </script>
@endsection
