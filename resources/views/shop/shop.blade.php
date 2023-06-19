@extends('layouts.main')

@section('title', 'Shop')

@section('link')
    <!-- Favicons -->
    <link href="{{ asset('assets-dashboard/img/bag-logo.png') }}" rel="icon">
    <link href="{{ asset('assets-dashboard/img/bag-logo.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Muli:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets-landing/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-landing/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-landing/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-landing/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-landing/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-landing/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-landing/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets-landing/css/style.css') }}" rel="stylesheet">
@endsection

@section('style')
    <style>
        #portfolio-flters a:hover {
            cursor: pointer;
        }
    </style>
@endsection

<!-- =======================================================
  * Template Name: Flattern
  * Updated: Mar 10 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/flattern-multipurpose-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

@section('content')

    <!-- ======= Top Bar ======= -->
    <section id="topbar" class="d-flex align-items-center">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope d-flex align-items-center"><a
                        href="mailto:contact@example.com">mnovaldayat@gmail.com</a></i>
                <i class="bi bi-phone d-flex align-items-center ms-4"><span>+62 831 8465 5468</span></i>
            </div>
            <div class="social-links d-none d-md-flex align-items-center">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
            </div>
        </div>
    </section>

    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex justify-content-between">

            <div class="logo d-flex align-items-center">
                <!-- Uncomment below if you prefer to use an image logo -->
                <a href="/"><img src="{{ asset('assets-dashboard/img/bag-logo.png') }}" alt=""
                        class="img-fluid"></a>
                <h1 class="text-light ms-2"><a href="index.html">Buy All Goods</a></h1>
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    {{-- <li><a class="active" href="/dashboard">Back to Admin</a></li> --}}
                    {{-- <li><a href="about.html">About</a></li>
                    <li><a href="services.html">Services</a></li> --}}
                    {{-- <li><a href="testimonials.html">Testimonials</a></li> --}}
                    {{-- <li><a href="pricing.html">Pricing</a></li> --}}
                    {{-- <li><a href="/shop">Shop</a></li> --}}
                    {{-- <li><a href="blog.html">Blog</a></li> --}}
                    {{-- <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="#">Drop Down 1</a></li>
                            <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i
                                        class="bi bi-chevron-right"></i></a>
                                <ul>
                                    <li><a href="#">Deep Drop Down 1</a></li>
                                    <li><a href="#">Deep Drop Down 2</a></li>
                                    <li><a href="#">Deep Drop Down 3</a></li>
                                    <li><a href="#">Deep Drop Down 4</a></li>
                                    <li><a href="#">Deep Drop Down 5</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Drop Down 2</a></li>
                            <li><a href="#">Drop Down 3</a></li>
                            <li><a href="#">Drop Down 4</a></li>
                        </ul>
                    </li> --}}
                    {{-- <li><a href="contact.html">Contact</a></li> --}}
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

            @php
                use Illuminate\Support\Facades\Auth;
            @endphp

            @if (Auth::user()->role == 1 || Auth::user()->role == 4)
                <a href="/dashboard" class="btn btn-sm text-white my-auto px-3 btn-secondary">Back to Dashboard</a>
            @elseif (Auth::user()->role == 2)
                <a href="{{ route('sliders.index') }}" class="btn btn-sm text-white my-auto px-3 btn-secondary">Back to
                    Slider</a>
            @elseif(Auth::user()->role == 3)
                {{-- Logout BUTTON --}}
                <a href="/logout" class="btn btn-sm text-white my-auto px-3 btn-danger">LOGOUT</a>
            @endif

        </div>
    </header><!-- End Header -->

    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Shop</h2>
                    {{-- <ol>
                        <li><a href="index.html">Home</a></li>
                        <li>Blog</li>
                    </ol> --}}
                </div>

            </div>
        </section>
        <!-- End Breadcrumbs -->

        <!-- ======= Blog Section ======= -->
        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">

                <div class="row">

                    <div class="col-lg-9 entries">

                        <!-- ======= Portfolio Section ======= -->
                        <section id="portfolio" class="portfolio">
                            <div class="container">

                                <div class="row portfolio-container" data-aos="fade-up">
                                    @forelse ($products as $product)
                                        {{-- {{ dd($product->image) }} --}}
                                        <div class="col-lg-4 col-md-6 portfolio-item filter-{{ $product->category_id }}">
                                            <img src="{{ asset('assets-landing/img/portfolio/' . $product->image) }}"
                                                class="img-fluid" alt="gambar produk">
                                            <div class="portfolio-info">
                                                <h4>{{ $product->name }}</h4>
                                                <p>Rp{{ number_format($product->price, 2, ',', '.') }}</p>
                                                <a href="assets-landing/img/portfolio/{{ $product->image }}"
                                                    data-gallery="portfolioGallery" class="portfolio-lightbox preview-link"
                                                    title="{{ $product->name }}"><i class="bx bx-plus"></i></a>
                                                <a href="portfolio-details.html" class="details-link"
                                                    title="More Details"><i class="bx bx-link"></i></a>
                                            </div>
                                        </div>
                                        {{-- {{ dd($product) }} --}}
                                    @empty
                                        <p>Maaf, produk tidak tersedia.</p>
                                    @endforelse

                                </div>

                            </div>
                        </section>
                        <!-- End Portfolio Section -->

                        {{-- <div class="blog-pagination">
                            <ul class="justify-content-center">
                                <li><a href="#">1</a></li>
                                <li class="active"><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                            </ul>
                        </div> --}}

                    </div><!-- End blog entries list -->

                    <div class="col-lg-3">

                        <div class="sidebar">

                            @if (isset($searching))
                                <div class="sidebar-item reset-button">
                                    <a href="{{ route('shop') }}" class="btn btn-danger">Reset Filters</a>
                                </div><!-- End sidebar reset-button -->
                            @endif

                            <h3 class="sidebar-title">Search by Name</h3>
                            <div class="sidebar-item search-form">
                                <form action="{{ route('shop.search') }}" method="POST" id="search-form">
                                    @csrf
                                    <input type="text" id="search-input" name="search" placeholder="Search...">
                                    <button type="submit"><i class="bi bi-search"></i></button>
                                </form>
                            </div><!-- End sidebar search formn-->

                            <h3 class="sidebar-title">Categories</h3>
                            <div class="sidebar-item categories">
                                <ul id="portfolio-flters">
                                    @php
                                        $totalAllProducts = $products->count();
                                    @endphp
                                    <li data-filter="*" class="filter-active">
                                        <a>
                                            All <span>({{ $totalAllProducts }})</span>
                                        </a>
                                    </li>
                                    @foreach ($products->unique('category_id') as $product)
                                        @php
                                            $totalProducts = $products->where('category_id', $product->category_id)->count();
                                        @endphp
                                        <li data-filter=".filter-{{ $product->category_id }}">
                                            <a>
                                                @foreach ($categories as $category)
                                                    @if ($category->id == $product->category_id)
                                                        {{ $category->name }}
                                                    @endif
                                                @endforeach
                                                <span>({{ $totalProducts }})</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div><!-- End sidebar categories-->

                            <h3 class="sidebar-title">Price</h3>
                            <div class="sidebar-item price-filter">
                                <form action="{{ route('shop.search') }}" method="POST">
                                    @csrf
                                    <label for="min-price">Minimum Price:</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control" id="min-price" name="min_price"
                                            value="{{ old('min_price') }}">
                                    </div>

                                    <label for="max-price">Maximum Price:</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control" id="max-price" name="max_price"
                                            value="{{ old('max_price') }}">
                                    </div>

                                    <button type="submit" class="btn btn-primary" name="submit_price"
                                        style="background-color: #fd4509; border-color: #fff;">Search by Price</button>

                                </form>
                            </div><!-- End sidebar price-filter -->


                        </div>
                        <!-- End sidebar -->

                    </div><!-- End blog sidebar -->

                </div>

            </div>
        </section><!-- End Blog Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">

        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h3>Buy All Goods</h3>
                        <p>
                            A108 Adam Street <br>
                            New York, NY 535022<br>
                            United States <br><br>
                            <strong>Phone:</strong> +1 5589 55488 55<br>
                            <strong>Email:</strong> info@example.com<br>
                        </p>
                    </div>

                    <div class="col-lg-2 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Our Services</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-newsletter">
                        <h4>Join Our Newsletter</h4>
                        <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
                        <form action="" method="post">
                            <input type="email" name="email"><input type="submit" value="Subscribe">
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <div class="container d-md-flex py-4">

            <div class="me-md-auto text-center text-md-start">
                <div class="copyright">
                    &copy; Copyright <strong><span>Flattern</span></strong>. All Rights Reserved
                </div>
                <div class="credits">
                    <!-- All the links in the footer should remain intact. -->
                    <!-- You can delete the links only if you purchased the pro version. -->
                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/flattern-multipurpose-bootstrap-template/ -->
                    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                </div>
            </div>
            <div class="social-links text-center text-md-right pt-3 pt-md-0">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

@endsection

@section('js')
    <!-- Vendor JS Files -->
    <script src="{{ asset('assets-landing/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets-landing/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets-landing/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets-landing/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets-landing/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets-landing/vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('assets-landing/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets-landing/js/main.js') }}"></script>

    {{-- <script>
        // Ambil elemen form pencarian
        const searchForm = document.getElementById('search-form');
        // Ambil input pencarian
        const searchInput = document.getElementById('search-input');
        // Ambil semua item portfolio
        const portfolioItems = document.querySelectorAll('.portfolio-item');

        // Tambahkan event listener pada form pencarian saat submit
        searchForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah form submit

            const searchTerm = searchInput.value.toLowerCase(); // Ambil nilai input pencarian

            portfolioItems.forEach(function(item) {
                const title = item.querySelector('.portfolio-info h4').innerText.toLowerCase();

                if (title.indexOf(searchTerm) > -1) {
                    item.style.display = 'block'; // Tampilkan item jika ada kata kunci yang cocok
                } else {
                    item.style.display = 'none'; // Sembunyikan item jika tidak ada kata kunci yang cocok
                }
            });
        });
    </script> --}}

@endsection
