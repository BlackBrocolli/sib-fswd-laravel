<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Register Page</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets-landing/img/favicon-bag.png') }}" rel="icon">
    <link href="{{ asset('assets-landing/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets-dashboard/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-dashboard/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-dashboard/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-dashboard/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-dashboard/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-dashboard/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-dashboard/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets-dashboard/css/style.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Mar 09 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <main>
        <div class="container">

            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <span class="logo d-flex align-items-center w-auto">
                                    <img src="{{ asset('assets-dashboard/img/bag-logo.png') }}"
                                        style="max-width: 50px; max-height: 50px;">
                                    <span class="d-none d-lg-block">Buy All Goods</span>
                                </span>
                            </div>
                            <!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                                        <p class="text-center small">Enter your personal details to create account</p>
                                        @if (session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                    </div>

                                    <form class="row g-3 needs-validation" novalidate action="" method="POST">
                                        @csrf
                                        <div class="col-12">
                                            <label for="name" class="form-label">Your Name</label>
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror" id="name"
                                                required value="{{ old('name') }}">
                                            @error('name')
                                                <div class="mt-2 small text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="invalid-feedback">Please enter your name!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="email" class="form-label">Your Email</label>
                                            <input type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror" id="email"
                                                required value="{{ old('email') }}">
                                            @error('email')
                                                <div class="mt-2 small text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="invalid-feedback">Please enter a valid Email address!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                id="yourPassword" required>
                                            @error('password')
                                                <div class="mt-2 small text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="invalid-feedback">Please enter your password!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPhone" class="form-label">Phone Number</label>
                                            <input type="text" name="phone"
                                                class="form-control @error('phone') is-invalid @enderror" id="yourPhone"
                                                required value="{{ old('phone') }}">
                                            @error('phone')
                                                <div class="mt-2 small text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="invalid-feedback">Please enter your phone number!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourAddress" class="form-label">Address</label>
                                            <input type="text" name="address"
                                                class="form-control @error('address') is-invalid @enderror"
                                                id="yourAddress" required value="{{ old('address') }}">
                                            @error('address')
                                                <div class="mt-2 small text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="invalid-feedback">Please enter your address!</div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" name="terms" type="checkbox"
                                                    value="" id="acceptTerms" required>
                                                <label class="form-check-label" for="acceptTerms">I agree and accept
                                                    the
                                                    <a href="#">terms and conditions</a></label>
                                                <div class="invalid-feedback">You must agree before submitting.</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Create
                                                Account</button>
                                        </div>

                                        <div class="col-12">
                                            <p class="small mb-0">Already have an account? <a
                                                    href="{{ route('login') }}">Log in</a></p>
                                        </div>
                                    </form>

                                </div>
                            </div>

                            <div class="credits">
                                <!-- All the links in the footer should remain intact. -->
                                <!-- You can delete the links only if you purchased the pro version. -->
                                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets-dashboard/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets-dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets-dashboard/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets-dashboard/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets-dashboard/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('assets-dashboard/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets-dashboard/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets-dashboard/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets-dashboard/js/main.js') }}"></script>

</body>

</html>
