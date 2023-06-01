@extends('layouts.dashboardlayout')

@section('title', 'Detail Pengguna')

@section('content')
    <div class="pagetitle">
        <h1>Detail Pengguna</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                <li class="breadcrumb-item">Pengguna</li>
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Daftar Pengguna</a></li>
                <li class="breadcrumb-item active">Detail Pengguna</li>
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
                        <div class="text-center">
                            @if (!$user->avatar)
                                <img src="{{ asset('assets-dashboard/img/default-avatar3.jpg') }}" alt="Profile"
                                    class="rounded" style="width: 200px">
                            @else
                                <img src="{{ asset('storage/' . $user->avatar) }}" class="rounded" style="width: 200px">
                            @endif

                        </div>
                        <hr>

                        <table>
                            <tr class="font-weight-bold">
                                <td style="width: 100px">Name</td>
                                <td style="width: 20px">:</td>
                                <td>{{ $user->name }}</td>

                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td>:</td>
                                <td>
                                    <span id="password-display" style="display: none;">{{ $user->password }}</span>
                                    <input type="password" id="password-input" value="{{ $user->password }}" disabled>
                                    <button type="button" id="toggle-password-button"
                                        onclick="togglePasswordVisibility()">Tampilkan</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Role</td>
                                <td>:</td>
                                @foreach ($usergroups as $usergroup)
                                    {{-- {{ $usergroup->id == $user->role ? <td>{{$usergroup->nama_grup}}</td> : '' }} --}}
                                    @if ($usergroup->id == $user->role)
                                        <td>{{ $usergroup->nama_grup }}</td>
                                    @endif
                                @endforeach
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>:</td>
                                <td>{{ $user->phone }}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>:</td>
                                <td>{{ $user->address }}</td>
                            </tr>

                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <script>
        function togglePasswordVisibility() {
            var passwordDisplay = document.getElementById("password-display");
            var passwordInput = document.getElementById("password-input");
            var toggleButton = document.getElementById("toggle-password-button");

            if (passwordDisplay.style.display === "none") {
                passwordDisplay.style.display = "inline";
                passwordInput.style.display = "none";
                toggleButton.textContent = "Sembunyikan";
            } else {
                passwordDisplay.style.display = "none";
                passwordInput.style.display = "inline";
                toggleButton.textContent = "Tampilkan";
            }
        }
    </script>
@endsection
