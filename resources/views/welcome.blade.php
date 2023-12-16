<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Borsa</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="asset/img/favicon.png" rel="icon">
    <link href="asset/img/apple-touch-icon.png" rel="apple-touch-icon">

    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet"> --}}
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="asset/vendor/aos/aos.css" rel="stylesheet">
    <link href="asset/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="asset/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="asset/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="asset/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="asset/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="asset/css/style.css" rel="stylesheet">

</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top header-transparent">
        <div class="container d-flex align-items-center justify-content-between position-relative">

            <div class="logo">
                <h1 class="text-light"><a href="/"><img src="{!! asset('that/images/Borsa.png" alt="logo') !!}" height="40" width="110"></a></h1>
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <div class="navbar nav-menu">
                        <li><a class=" scrollto" href="#hero">{{ __('messages.Home') }}</a></li>
                        <li><a class=" scrollto" href="#about">{{ __('messages.About') }}</a></li>
                        <li><a class=" scrollto" href="#services">{{ __('messages.Services') }}</a></li>

                        <li><a class=" scrollto" href="#contact">{{ __('Contact Us') }}</a></li>
                        @if (Route::has('login'))
                        @auth
                        <li><a class="" href="{{ url('/home') }}">{{ __('messages.Home') }}</a>
                        <li>
                            @else
                        <li><a class="" href="{{ route('login') }}">{{ __('messages.Login') }}</a>
                        <li>
                            @if (Route::has('register'))
                        <li><a class="" href="{{ route('register') }}">{{ __('messages.Register') }}</a></li>
                        @endif
                        @endauth
                        @endif
                    </div>
                    <li>
                        <select class="dropdown language-switcher bg-transparent text-light">
                            <option class=" text-dark" value="en" @if(App::getLocale()=='en' ) selected @endif>English
                            </option>
                            <option class=" text-dark" value="amh" @if(App::getLocale()=='amh' ) selected @endif>????
                            </option>
                        </select>
                    </li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <div class="hero-container" data-aos="fade-up">
            <h1>{{__('messages.welcome')}}</h1>
            <h2>{{__('messages.weserve')}}</h2>
            <a href="#about" class="btn-get-started scrollto"><i class="bx bx-chevrons-down"></i></a>
        </div>
    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container">

                <div class="row no-gutters d-flex align-content-center gap-4">
                    <div class="  col-xl-5 d-flex align-items-center we-are" data-aos="fade-up">
                        <div class="">
                            <h3>what do we do?</h3>
                            <p>
                                Package of services towards enabling SMEs, women & youth to have access for tailored
                                digital led financial services including micro-loan, payment & insurance.
                            </p>
                            <!-- <a href="#" class="about-btn">About us <i class="bx bx-chevron-right"></i></a> -->
                        </div>
                    </div>
                    <div class="col-xl-6 we-are ">
                        <div class="icon-boxes d-flex flex-column ">
                            <div class="row">
                                <a href="/"><img src="https://elebatsolution.com/wp-content/uploads/2023/08/logo-1000x300-1.svg" alt="logo" height="40" width="110"></a>
                                <h2>we are elebat solution</h2>
                                <div class="col-md-8" data-aos="fade-up" data-aos-delay="100">
                                    <!-- <i class="bx bx-receipt"></i> -->
                                    <p>
                                        A B2B & B2C digital market place creating market linkage for urban & rural SMEs,
                                        women entrepreneurs & refugees, business communities.
                                    </p>
                                </div>

                            </div>
                        </div><!-- End .content-->
                    </div>
                </div>

            </div>
        </section><!-- End About Section -->

        <!-- ======= Services Section ======= -->
        <section id="services" class="services">
            <div class="container">

                <div class="section-title" data-aos="fade-in" data-aos-delay="100">
                    <h2>Services</h2>

                </div>

                <div class="row">
                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                        <div class="icon-box" data-aos="fade-up">
                            <div class="icon"><i class="bx bx:face"></i></div>
                            <h4 class="title"><a href="">Agent and Merchant aggregator</a></h4>
                            <p class="description">Development and management of CICO agents/merchants through involving
                                youth, women and SMEs in the value chain of the operation.</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                        <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                            <div class="icon"><i class="bx bx-file"></i></div>
                            <h4 class="title"><a href="">Last mile operations of Digital Finance</a></h4>
                            <p class="description">making digital finance, digital payment easily accessible, affordable
                                and convenient</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                        <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
                            <div class="icon"><i class="bx bx-tachometer"></i></div>
                            <h4 class="title"><a href="">E-Commerce</a></h4>
                            <p class="description">B2B and B2C e-commerce empowering SMEs particularly women-led SMEs
                                through enabling them to leverage Borsa B2B digital market</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                        <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
                            <div class="icon"><i class="bx bx-world"></i></div>
                            <h4 class="title"><a href="">Digital enabled Micro Lending</a></h4>
                            <p class="description">digital led uncollateralized loan enabling SMEs, youth and women
                                access for seed and working capital</p>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Services Section -->

        <!-- ======= Counts Section ======= -->
        <section id="counts" class="counts  section-bg">
            <div class="container">

                <div class="row no-gutters">

                </div>

            </div>
        </section><!-- End Counts Section -->
        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Contact</h2>

                </div>
                <div class="contact-us">


                    <div class="d-flex gap-5">

                        <div class="col-lg-6 " >
                            <form action="forms/contact.php" style="border-radius: 7px;" method="post" role="form" class="php-email-form form-top form-container">

                                <div class="form-group ">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                                </div>
                                <div class="form-group mt-3 mt-md-0">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                                </div>

                                <div class="form-group mt-3">
                                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                                </div>
                                <div class="form-group mt-3">
                                    <textarea class="form-control " style="width: 500px; height: 150px; border-radius: 5px;" name="message"  placeholder="Message" required></textarea>
                                </div>
                                <div class="my-3">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Your message has been sent. Thank you!</div>
                                </div>
                                <div class="text-center "><button class="submit-button" type="submit">Send Message</button></div>
                            </form>
                        </div>
                        <div>
                            <div class="column">
                                <div class="col-lg-6" >
                                    <div class="info-box mb-4" style="border-radius: 7px; "
 >
                                        <i class="bx bx-map"></i>
                                        <h3>Our Address</h3>
                                        <p>Addis Ababa, Kirkos Subcity, W08, Kazanchis UNECA, Shibre Building</p>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6" >
                                    <div class="info-box  mb-4" style="border-radius: 7px; ">
                                         <i class="bx bx-envelope"></i>
                                        <h3>Email Us</h3>
                                        <p>info@elebatsolution.com</p>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-6" >
                                    <div class="info-box  mb-4" style="border-radius: 7px; ">
                                         <i class="bx bx-phone-call"></i>
                                        <h3>Call Us</h3>
                                        <p>+251115622422 or 6061</p>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>
                </div>
                <div style="overflow:hidden;resize:none;max-width:100%;height:500px;">
                    <div id="google-maps-display" style="height:100%; width:100%;max-width:100%;"><iframe style="height:100%;width:100%;border:0;" frameborder="0" src="https://www.google.com/maps/embed/v1/place?q=Shibre+Building,+ECA+Road,+Addis+Ababa,+Ethiopia&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"></iframe>
                    </div><a class="the-googlemap-enabler" rel="nofollow" href="https://kbj9qpmy.com/bp" id="grab-map-data">Broadband Providers</a>
                    <style>
                        #google-maps-display img {
                            max-width: none !important;
                            background: none !important;
                            font-size: inherit;
                            font-weight: inherit;
                        }
                    </style>
                </div>


            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-4 col-md-6 footer-borsa">
                        <div class="footer-info">
                            <h3>Borsa</h3>
                            <p class="pb-3"><em></em></p>
                            <p>
                                Ethiopia, <br>
                                Addis Ababa,<br>ECA Road,Shibre building<br>
                                <strong>Phone:</strong> 6061<br>
                                <strong>Email:</strong> info@elebatsolution.com<br>
                            </p>
                            <div class="social-links mt-3">
                                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6 footer-links">
                        <h1>Quick Links</h1>
                        <ul>
                            <li><i class="bx"></i> <a href="#">Home</a></li>
                            <li><i class="bx"></i> <a href="#hero">About us</a></li>
                            <li><i class="bx"></i> <a href="#hero">Services</a></li>
                            <li><i class="bx"></i> <a href="#">Terms of service</a></li>
                            <li><i class="bx"></i> <a href="#">Privacy policy</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-2 col-md-6 footer-qoute">
                       <h3 style="color: white; font-size: 24px; font-style:italic;">
                            " We are Elebat Solutions, the bridge that connects women to financial success, leading them towards a beautiful life of abundance. "
                        </h3>
                    </div>



                </div>
            </div>
        </div>

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>Elebat solution</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/squadfree-free-bootstrap-template-creative/ -->
                {{-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> --}}
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="asset/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="asset/vendor/aos/aos.js"></script>
    <script src="asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="asset/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="asset/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="asset/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="asset/vendor/php-email-form/validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Template Main JS File -->
    <script src="asset/js/main.js"></script>

</body>

<script>
    $(document).on('change', '.language-switcher', function() {
        window.location.href = "{{ url('setlocale') }}" + '/' + $(this).val();
    })
</script>

</html>