<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Data User - Arkatama</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body style="background: lightgray">
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('users.index') }}" class="text-dark">&#60; kembali</a>
                        <br><br>
                        <div class="text-center">
                            <img src="{{ asset('storage/' . $user->avatar) }}" class="rounded" style="width: 200px">
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
                                <td>{{ $user->role }}</td>
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
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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

</body>

</html>
