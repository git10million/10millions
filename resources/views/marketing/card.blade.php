<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{$data->NombrePersona}} {{$data->ApellidosPersona}} - Novae Affiliate</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <meta name="description" content="A determined and visionary entrepreneur. With a passion for innovation and a hunger for success, I have embarked on a journey of launching and growing successful ventures.">
    <meta content="Valcorp" name="author">
    <!-- favicon -->
    <link rel="shortcut icon" href="{{url('')}}/assets-card/images/favicon.ico">
    <!-- Bootstrap -->
    <link href="{{url('')}}/assets-card/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <!-- Lightbox -->
    <link href="{{url('')}}/assets-card/css/tobii.min.css" rel="stylesheet" type="text/css">
    <!-- Icon -->
    <link href="{{url('')}}/assets-card/css/materialdesignicons.min.css" rel="stylesheet" type="text/css">
    <!-- SLIDER -->
    <link rel="stylesheet" href="{{url('')}}/assets-card/css/tiny-slider.css"/>   
    <!-- Custom Css -->
    <link href="{{url('')}}/assets-card/css/style.min.css" rel="stylesheet" type="text/css" id="theme-opt">
    <link href="{{url('')}}/assets-card/css/colors/default.css" rel="stylesheet" id="color-opt">

    <link rel="manifest" href="{{url('')}}/assets-card/manifest.json">
    <link rel="icon" type="image/png" href="{{url('')}}/assets-card/images/icons/icon-512x512.png">
    <meta property="og:site_name" content="https://johanna-morales-novae.digicard.club" />
    <meta property="og:title" content="{{$data->NombrePersona}} {{$data->ApellidosPersona}}" />
    <meta property="og:description" content="A determined and visionary entrepreneur. With a passion for innovation and a hunger for success, I have embarked on a journey of launching and growing successful ventures." />
    <meta property="og:updated_time" content="2021-11-06T10:20:00+02:00" />
    <meta property="og:image" content="https://johanna-morales-novae.digicard.club/opengraph.jpg" />
    <meta property="og:url" content="https://johanna-morales-novae.digicard.club" />
    <meta property="og:type" content="article" />
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="{{$data->NombrePersona}} {{$data->ApellidosPersona}}">
    <link rel="shortcut icon" sizes="16x16" href="{{url('')}}/assets-card/images/icons/icon-16x16.png">
    <link rel="shortcut icon" sizes="196x196" href="{{url('')}}/assets-card/images/icons/icon-196x196.png">
    <link rel="apple-touch-icon-precomposed" href="{{url('')}}/assets-card/images/icons/icon-512x512.png">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">

    <link rel="stylesheet" href="https://admincard.mybcard.net/public/js/plugindigito.css?v=1233238882sd12337hjkasd123">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        
        .compartir__share_flotante{

            background-color: #000000;

            color: #fff !important;

            width: 42px;

            height: 42px;

            padding-top: 10px;

            right: 9px;
            top: 77px;


        }

        .compartir__share_flotante span{

            color:#fff !important;    

        }

    </style>


</head>

<body>
    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="logo">
                <img src="{{url('')}}/logo-dark.png" height="95" class="d-block mx-auto" alt="">
            </div>
            <div class="spinner">
                <div class="bounce1"></div>
                <div class="bounce2"></div>
                <div class="bounce3"></div>
            </div>
        </div>
    </div>
    <!-- Loader -->
    <div id="sThemes-layout">
        <div class="sThemesbox">
            <!-- Navbar Start -->
            <nav id="navbar" class="navbar navbar-expand-lg fixed-top navbar-custom boxed-home navbar-light sticky">
                <div class="container">
                    <a class="navbar-brand" href="#">
                        <img src="{{url('')}}/logo-dark.png" class="l-dark" alt="" height="95">
                        <img src="{{url('')}}/logo-white.png" class="l-light" alt=""  height="95">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span data-feather="menu" class="fea icon-md"></span>
                    </button><!--end button-->

                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul id="navbar-navlist" class="navbar-nav mx-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="#home">Profile</a>
                            </li><!--end nav item-->
                            <li class="nav-item">
                                <a class="nav-link" href="#services">Services</a>
                            </li><!--end nav item-->
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="#resume">Resume</a>
                            </li> -->
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="#projects">Projects</a>
                            </li> -->
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="#news">Blog</a>
                            </li> -->
                            <li class="nav-item">
                                <a class="nav-link" href="#contact">Contact</a>
                            </li><!--end nav item-->
                            <!-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pages
                                </a>
                                <div class="dropdown-menu rounded m-0" aria-labelledby="navbarDropdown">
                                    <div class="container mx-0 mx-md-0">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a class="dropdown-item" href="page-blog.html">Blog</a>
                                                <a class="dropdown-item" href="page-blog-detail.html">Blog Detail</a>
                                                <a class="dropdown-item" href="page-portfolio.html">Portfolio</a>
                                                <a class="dropdown-item" href="page-portfolio-detail.html">Portfolio Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li> -->
                        </ul>

                        <ul class="list-unstyled mb-0 mt-2 mt-sm-0 social-icon light-social-icon">
                            @if($data->FacebookPersona!="")
                            <li class="list-inline-item"><a href="{{$data->FacebookPersona}}"><i class="mdi mdi-facebook"></i></a></li>
                            @endif

                            @if($data->YoutubePersona!="")
                            <li class="list-inline-item"><a href="{{$data->YoutubePersona}}" target="_blank"><i class="mdi mdi-youtube"></i></a></li>
                            @endif

                            @if($data->InstagramPersona!="")
                            <li class="list-inline-item"><a href="{{$data->InstagramPersona}}" target="_blank"><i class="mdi mdi-instagram"></i></a></li>
                            @endif                           
                            
                        </ul>
                    </div> 
                </div><!--end container-->
            </nav><!--end navbar-->
            <!-- Navbar End -->

            <!-- HOME START-->
            <section class="bg-half d-table w-100" style="background-image:url('{{url('')}}/assets-card/images/home/04.jpg')" id="home">
                <div class="bg-overlay"></div>
                <div class="container">
                    <div class="row justify-content-center mt-5">
                        <div class="col-lg-12 text-center">
                            <div class="title-heading">
                                <img src="{{url('')}}/assets/images/usuarios/{{$data->FotoPersona}}" class="img-fluid rounded-circle" alt="">
                                <h1 class="heading text-primary mt-3">{{$data->NombrePersona}} {{$data->ApellidosPersona}}</h1>
                                @if($NombreAfiliado=="johanna")
                                <h5 class="sub-title font-weight-normal text-light">I'm a CEO at <span class="typewrite text-primary" data-period="2000" data-type='[ "10 Million$ Club"]'></span></h5>
                                @else
                                <h5 class="sub-title font-weight-normal text-light">I'm a Diamond Member at <span class="typewrite text-primary" data-period="2000" data-type='[ "10 Million$ Club"]'></span></h5>
                                @endif

                                <div class="mt-4">
                                    <a href="./johanna-morales.vcf" class="btn btn-primary">Download Contact <i data-feather="download" class="fea icon-sm"></i></a>
                                </div>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end container--> 
                <a href="#about" data-scroll-nav="1" class="mouse-icon mouse-icon-white rounded-pill mouse-down">
                    <span class="wheel position-relative d-block mover"></span>
                </a>
            </section><!--end section-->
            <!-- HOME END-->
            
            <!-- About Start -->
            <section class="section pb-3" id="about">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-5 col-md-5">
                            <div class="about-hero">
                                <img src="{{url('')}}/assets/images/usuarios/{{$data->FotoPortadaPersona}}" class="img-fluid mx-auto d-block about-tween position-relative" alt="">
                            </div>
                        </div><!--end col-->

                        <div class="col-lg-7 col-md-7 mt-4 pt-2 mt-sm-0 pt-sm-0">
                            <div class="section-title mb-0 ms-lg-5 ms-md-3">
                                <h4 class="title text-primary mb-3">{{$data->NombrePersona}} {{$data->ApellidosPersona}}</h4>
                                <h6 class="designation mb-3">I'm a CEO at <span class="text-primary">10 Million$ Club</span></h6>
                                <p class="text-muted">A determined and visionary entrepreneur. With a passion for innovation and a hunger for success, I have embarked on a journey of launching and growing successful ventures.</p>
                                <!-- <p class="text-muted">The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</p> -->
                                <!-- <img src="images/sign.png" height="22" alt=""> -->
                                <div class="mt-4">
                                    <a href="#" target="_blank" class="btn btn-primary mouse-down">Apply Now!</a>
                                </div>
                                <div class="row" style="padding-top: 16px;">
                                    <div class="col-md-6 col-lg-6">
                                        <div class="interests-desc bg-light position-relative px-2 py-3 rounded">
                                            <div class="hobbies d-flex align-items-center">
                                                <div class="text-center rounded-pill me-4">
                                                    <i data-feather="phone" class="icon fea icon-md-sm"></i>
                                                </div>
                                                <div class="content">
                                                    <h6 class="title mb-0">CALL</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 col-lg-6">
                                        <div class="interests-desc bg-light position-relative px-2 py-3 rounded">
                                            <div class="hobbies d-flex align-items-center">
                                                <div class="text-center rounded-pill me-4">
                                                    <i data-feather="phone" class="icon fea icon-md-sm"></i>
                                                </div>
                                                <div class="content">
                                                    <h6 class="title mb-0">WHATSAPP</h6>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 col-lg-6">
                                        <div class="interests-desc bg-light position-relative px-2 py-3 rounded">
                                            <div class="hobbies d-flex align-items-center">
                                                <div class="text-center rounded-pill me-4">
                                                    <i data-feather="phone" class="icon fea icon-md-sm"></i>
                                                </div>
                                                <div class="content">
                                                    <h6 class="title mb-0">SMS</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-lg-6">
                                        <div class="interests-desc bg-light position-relative px-2 py-3 rounded">
                                            <div class="hobbies d-flex align-items-center">
                                                <div class="text-center rounded-pill me-4">
                                                    <i data-feather="phone" class="icon fea icon-md-sm"></i>
                                                </div>
                                                <div class="content">
                                                    <h6 class="title mb-0">EMAIL</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                    
                </div><!--end container-->

                
            </section>
            <!-- About end -->
                
            <!-- Services Start -->
            <section class="section bg-light" id="services">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 text-center">
                            <div class="section-title">
                                <div class="position-relative">
                                    <h4 class="title text-uppercase mb-4">Services</h4>
                                    <div>
                                    <div class="title-box"></div>
                                    <div class="title-line"></div>
                                </div>
                                </div>
                                <p class="text-muted mx-auto para-desc mt-5 mb-0">Our company offers a wide range of services tailored to meet your financial needs.</p>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->

                    <div class="row">                    
                        <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                            <div class="service-wrapper rounded position-relative text-center border border-footer p-4 pt-5 pb-5">
                                <div class="icon text-primary">
                                    <i data-feather="airplay" class="fea icon-md"></i>
                                </div>
                                <div class="content mt-4">
                                    <h5 class="title">Entrepreneurship</h5>
                                    <p class="text-muted mt-3 mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                </div>
                                <div class="big-icon">
                                    <i data-feather="airplay" class="fea icons"></i>
                                </div>
                                <div class="mt-4">
                                    <a href="#" target="_blank" class="btn btn-primary mouse-down">Contact For More Information</a>
                                </div>
                            </div>
                        </div><!--end col-->

                        <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                            <div class="service-wrapper rounded position-relative text-center border border-footer p-4 pt-5 pb-5">
                                <div class="icon text-primary">
                                    <i data-feather="aperture" class="fea icon-md"></i>
                                </div>
                                <div class="content mt-4">
                                    <h5 class="title">Business Funding</h5>
                                    <p class="text-muted mt-3 mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                </div>
                                <div class="big-icon">
                                    <i data-feather="aperture" class="fea icons"></i>
                                </div>
                                <div class="mt-4">
                                    <a href="#" target="_blank" class="btn btn-primary mouse-down">Contact For More Information</a>
                                </div>
                            </div>
                        </div><!--end col-->
                        
                        <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                            <div class="service-wrapper rounded position-relative text-center border border-footer p-4 pt-5 pb-5">
                                <div class="icon text-primary">
                                    <i data-feather="camera" class="fea icon-md"></i>
                                </div>
                                <div class="content mt-4">
                                    <h5 class="title">Business Credit</h5>
                                    <p class="text-muted mt-3 mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                </div>
                                <div class="big-icon">
                                    <i data-feather="camera" class="fea icons"></i>
                                </div>
                                <div class="mt-4">
                                    <a href="#" target="_blank" class="btn btn-primary mouse-down">Contact For More Information</a>
                                </div>
                            </div>
                        </div><!--end col-->
                        
                        
                    </div><!--end row-->
                </div><!--end container-->
            </section>
            <!-- Services End -->

            

            <!-- Contact Start -->
            <section class="section pb-0" id="contact">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 text-center">
                            <div class="section-title">
                                <div class="position-relative">
                                    <h4 class="title text-uppercase mb-4">Contact Me</h4>
                                    <div>
                                    <div class="title-box"></div>
                                    <div class="title-line"></div>
                                </div>
                                </div>
                                <p class="text-muted mx-auto para-desc mt-5 mb-0">Feel free to get in touch with me using the information below.</p>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->

                    <div class="row">
                        <div class="col-md-4 mt-4 pt-2">
                            <div class="contact-detail text-center">
                                <div class="icon">
                                    <i data-feather="phone" class="fea icon-md"></i>
                                </div>
                                <div class="content mt-4">
                                    <h5 class="title text-uppercase">Phone</h5>
                                    <!-- <p class="text-muted">Promising development turmoil inclusive education transformative community</p> -->
                                    <a href="tel:+{{$data->TelefonoPersona}}" class="text-primary">{{$data->TelefonoPersona}}</a>
                                </div>  
                            </div>
                        </div><!--end col-->
                        
                        <div class="col-md-4 mt-4 pt-2">
                            <div class="contact-detail text-center">
                                <div class="icon">
                                    <i data-feather="mail" class="fea icon-md"></i>
                                </div>
                                <div class="content mt-4">
                                    <h5 class="title text-uppercase">Email</h5>
                                    <!-- <p class="text-muted">Promising development turmoil inclusive education transformative community</p> -->
                                    <a href="mailto:{{$data->EmailPersona}}" class="text-primary">{{$data->EmailPersona}}</a>
                                </div>  
                            </div>
                        </div><!--end col-->
                        
                        <div class="col-md-4 mt-4 pt-2">
                            <div class="contact-detail text-center">
                                <div class="icon">
                                    <i data-feather="map-pin" class="fea icon-md"></i>
                                </div>
                                <div class="content mt-4">
                                    <h5 class="title text-uppercase">SMS</h5>
                                    <!-- <p class="text-muted">C/54 Northwest Freeway, Suite 558, <br>Houston, USA 485</p> -->
                                    <!-- <a href="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d6030.418742494061!2d-111.34563870463673!3d26.01036670629853!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2smx!4v1471908546569" class="video-play-icon text-primary">View on Google map</a> -->
                                    <a href="sms:+{{$data->TelefonoPersona}}" class="text-primary">{{$data->TelefonoPersona}}</a>
                                </div>  
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end container-->
            </section><!--end section-->

            <section class="section pt-5 mt-3">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="custom-form mb-sm-30">
                                <form method="post" name="myForm" onsubmit="return validateForm()">
                                    <p id="error-msg"></p>
                                    <div id="simple-msg"></div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-6">
                                                    <div class="form-group">
                                                        <input name="name" id="name" type="text" class="form-control border rounded" placeholder="First Name :">
                                                    </div>
                                                </div><!--end col-->
                                                <div class="col-lg-12 col-md-6">
                                                    <div class="form-group">
                                                        <input name="email" id="email" type="email" class="form-control border rounded" placeholder="Your email :">
                                                    </div> 
                                                </div><!--end col-->
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <input name="subject" id="subject" class="form-control border rounded" placeholder="Your subject :">
                                                    </div>                                                                               
                                                </div><!--end col-->
                                            </div><!--end row-->
                                        </div><!--end col-->

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <textarea name="comments" id="comments" rows="4" class="form-control border rounded" placeholder="Your Message :"></textarea>
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-sm-12 text-end">
                                            <button type="submit" id="submit" name="send" class="btn btn-primary">Send Message</button>
                                        </div>
                                    </div>
                                </form>
                            </div><!--end custom-form-->
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end container-->
            </section><!--end section-->
            <!-- Contact End -->

            <!-- Footer Start -->
            <footer class="footer bg-dark">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 text-center">
                            <a href="#"><img src="{{url('')}}/logo-white.png" height="95" alt=""></a>                           
                            
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end container-->
            </footer><!--end footer-->
            <footer class="footer footer-bar bg-dark">
                <div class="container text-foot text-center">
                    <!-- <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> Novae. Design with <i class="mdi mdi-heart text-danger"></i> by <a href="http://shreethemes.in/" target="_blank" class="text-reset">Shreethemes</a>.</p> -->
                    <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> 10 Million$ Club - All Rights Reserved</p>
                </div><!--end container-->
            </footer><!--end footer-->
            <!-- Footer End -->
            
            <!-- Back to top -->
            <a href="#" onclick="topFunction()" class="back-to-top rounded text-center" id="back-to-top"> 
                <i class="mdi mdi-chevron-up d-block"> </i> 
            </a>
            <!-- Back to top -->

            <!-- Style switcher -->
            


            <div class="modal fade" id="modal_share" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">        
                    <div class="modal-content">        
                        <div class="modal-header">        
                            <h5 class="modal-title">Share</h5>        
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>        
                        </div>        
                        <div class="modal-body">        
                            <div class="compartir compartir__telefono">        
                                <div class="compartir__fila">        
                                    <div class="compartir__col compartir__col2">        
                                        <select class="compartir__select" id="indicador">
                                        </select>        
                                    </div>
        
                                    <div class="compartir__col compartir__col10">        
                                        <input type="text" class="compartir__input" id="fi_share_celular" placeholder="# Phone" />        
                                    </div>        
                                </div>
        
                                <div class="compartir__fila">        
                                    <div class="compartir__col compartir__col6">
        
                                        <button class="compartir__boton compartir__whatsapp" id="btn_share_whatsapp"
        
                                            type="button"><span class="fa fa-whatsapp"></span> WhatsApp</button>
        
                                    </div>
        
        
        
                                    <div class="compartir__col compartir__col6">
        
                                        <button class="compartir__boton compartir__sms" id="btn_share_sms" type="button"><span
        
                                                class="fa fa-comment"></span> SMS</button>
        
                                    </div>
        
                                </div>
        
                            </div>
        
        
        
        
        
        
        
                            <div class="compartir">
        
                                <div class="compartir__fila">
        
                                    <div class="compartir__col compartir__col6">
        
                                        <button class="compartir__boton compartir__facebook" type="button"><span
        
                                                class="fa fa-facebook"></span> Facebook</button>
        
                                    </div>
        
        
        
                                    <div class="compartir__col compartir__col6">
        
                                        <button class="compartir__boton compartir__twitter" type="button"><span
        
                                                class="fa fa-twitter"></span> Twitter</button>
        
                                    </div>
        
                                </div>
        
        
        
                                <div class="compartir__fila">
        
                                    <div class="compartir__col compartir__col6">
        
                                        <button class="compartir__boton compartir__pinterest" type="button"><span
        
                                                class="fa fa-pinterest"></span> Pinterest</button>
        
                                    </div>
        
        
        
                                    <div class="compartir__col compartir__col6">
        
                                        <button class="compartir__boton compartir__linkedin" type="button"><span
        
                                                class="fa fa-linkedin"></span> Linkedin</button>
        
                                    </div>
        
                                </div>
        
        
        
        
        
                                <div class="compartir__fila">
        
                                    <div class="compartir__col compartir__col6">
        
                                        <button class="compartir__boton compartir__mensaje" type="button"><span
        
                                                class="fa fa-envelope"></span> Email</button>
        
                                    </div>
        
        
        
                                    <div class="compartir__col compartir__col6">
        
                                        <button class="compartir__boton compartir__telegram" type="button"><span
        
                                                class="fa fa-send"></span> Telegram</button>
        
                                    </div>
        
                                </div>
        
        
        
        
        
                                <div class="compartir__fila">
        
                                    <div class="compartir__col compartir__col11">
        
                                        <input type="text" class="compartir__input compartir__texto" readonly value=""
        
                                            id="texto_copiar" />
        
                                    </div>
        
        
        
                                    <div class="compartir__col compartir__col1">
        
                                        <button data-clipboard-target="#texto_copiar" class="compartir__boton compartir__copiar"
        
                                            type="button"><span class="fa fa-files-o"></span></button>
        
                                    </div>
        
                                </div>
        
        
        
                                <div class="compartir__fila">
        
                                    <div class="compartir__col compartir__col2">
        
                                        <button class="compartir__boton compartir__opciones" type="button"> + More
        
                                            Options</button>
        
                                    </div>
        
                                </div>
        
        
        
        
        
                            </div>
        
        
        
                        </div>
        
                    </div>
        
                </div>
        
            </div>

            <!-- end Style switcher -->

            <!-- javascript -->
            <script src="{{url('')}}/assets-card/js/bootstrap.bundle.min.js"></script>
            <script src="{{url('')}}/assets-card/js/gumshoe.js"></script>
            <!-- SLIDER -->
            <script src="{{url('')}}/assets-card/js/tiny-slider.js "></script>
            <!-- Lightbox -->
            <script src="{{url('')}}/assets-card/js/tobii.min.js"></script>
            <script src="{{url('')}}/assets-card/js/shuffle.min.js"></script>
            <!-- Typed -->
            <script src="{{url('')}}/assets-card/js/typed.js"></script>
            <!-- Feather icon -->
            <script src="{{url('')}}/assets-card/js/feather.min.js"></script>
            <!-- Main Js -->
            <script src="{{url('')}}/assets-card/js/plugins.init.js"></script>
            <script src="{{url('')}}/assets-card/js/app.js"></script>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.16/clipboard.min.js"></script>

    

        <script>

            //INICIO VARIABLES QUE SON DINÁMICAS POR CADA TARJETA

            let pais_por_defecto = 1;

            let titulo_compartir = "Johanna Morales";

            let descripcion_compartir = "Novae Affiliate";

            let imagen_compartir = "https://julietabeautyskin.mybcard.net/opengraph.jpg";//imagen del opengraph

            let id_popup_compartir = "172";

            let id_popup_review = 194;

            let id_popup_notificacion = 196;

            let calificacion_estrella = 0;

            let CodigoProducto = "CARD14524SDKQ3233";

            let url_servidor = "https://admincard.mybcard.net/public/";

            let enabledReview = false;

            let enabledNotification = false;

            //FIN VARIABLES QUE SON DINÁMICAS POR CADA TARJETA

        </script>

    

    

        <script src="plugindigitonew.js?v=1233238882sd12337hjkasd123"></script>

        </div><!--end sThemesbox-->
    </div><!--end sThemes-layout-->
</body>

</html>