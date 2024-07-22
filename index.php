<?php
    require_once("./f-admin/inc/Database.php");
    require_once("./f-admin/inc/Functions.php");

    $database = new Database();
    $functions = new Functions();
    date_default_timezone_set("Asia/Jakarta");
?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> FORMASI 103: Perayaan HUT Republik Indonesia ke-79 </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

	<!-- CSS here -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/gijgo.css">
	<link rel="stylesheet" href="assets/css/animate.min.css">
	<link rel="stylesheet" href="assets/css/magnific-popup.css">
	<link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
	<link rel="stylesheet" href="assets/css/themify-icons.css">
	<link rel="stylesheet" href="assets/css/slick.css">
	<link rel="stylesheet" href="assets/css/nice-select.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/style.modif.css">
</head>
<body>
    <!-- ? Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo/loder.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
<header>
    <!--? Header Start -->
    <div class="header-area">
        <div class="main-header header-sticky">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <!-- Logo -->
                    <div class="col-xl-2 col-lg-2 col-md-1">
                        <div class="logo">
                            <a href="index.php?_ref=logo"><img src="assets/img/logo/logo.png" alt=""></a>
                        </div>
                    </div>
                    <div class="col-xl-10 col-lg-10 col-md-10">
                        <div class="menu-main d-flex align-items-center justify-content-end">
                            <!-- Main-menu -->
                            <div class="main-menu f-right d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a href="index.html">Beranda</a></li>
                                        <li><a href="spakers.html">Klasemen Lomba</a></li>
                                        <li><a href="schedule.html">Jadwal</a></li>
                                        <li><a href="blog.html">Galeri</a>
                                            <ul class="submenu">
                                                <li><a href="https://photos.app.goo.gl/bnKgpMgVyW4f5fMg6" target="_blank">Agustus 2023</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="contact.html">Kontak</a></li>
                                        <li class="d-block d-lg-none">
                                            <button href="https://forms.gle/PwsLRz85nXzgUN7Y7" class="btn header-btn mt-2 w-100">Daftar Sekarang</button>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="header-right-btn f-right d-none d-lg-block ml-30">
                                <a href="https://forms.gle/PwsLRz85nXzgUN7Y7" class="btn header-btn">Daftar Sekarang</a>
                            </div>
                        </div>
                    </div>   
                    <!-- Mobile Menu -->
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
</header>
<main>
    <!--? slider Area Start-->
    <div class="slider-area position-relative">
        <div class="background-slideshow">
            <div class="background-slideshow-images">
                <img class="opacity-100" src="./assets/img/2023/IMG_20230813_063515.jpeg" alt="Slideshow 1">
                <img src="./assets/img/2023/IMG_20230813_071208.jpeg" alt="Slideshow 2">
                <img src="./assets/img/2023/PXL_20230813_082500654.jpeg" alt="Slideshow 3">
                <img src="./assets/img/2023/PXL_20230816_155948878.MP.jpeg" alt="Slideshow 4">
            </div>
            <div class="background-slideshow-overlay"></div>
        </div>
        <div class="slider-active">
            <!-- Single Slider -->
            <div class="single-slider slider-height d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 col-lg-8 col-md-9 col-sm-10">
                            <div class="hero__caption">
                                <span data-animation="fadeInLeft" data-delay=".1s">Forum Komunikasi Remaja RT.001 / RW.003</span>
                                <h1 data-animation="fadeInLeft" data-delay=".5s">Dirgahayu Republik Indonesia ke-79</h1>
                                <!-- Hero-btn -->
                                <div class="slider-btns">
                                    <a data-animation="fadeInLeft" data-delay="1.0s" href="industries.html" class="btn hero-btn">Download</a>
                                    <a data-animation="fadeInRight" data-delay="1.0s" class="popup-video video-btn"  href="https://www.youtube.com/watch?v=up68UAfH0d0">
                                        <i class="fas fa-play"></i></a>
                                    <p class="video-cap d-none d-sm-blcok" data-animation="fadeInRight" data-delay="1.0s">Story Vidoe<br> Watch</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>          
            </div>
            <!-- Single Slider -->
            <?php /*
            <div class="single-slider slider-height d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8 col-lg-8 col-md-9 col-sm-10">
                            <div class="hero__caption">
                                <span data-animation="fadeInLeft" data-delay=".1s">Committed to success</span>
                                <h1 data-animation="fadeInLeft" data-delay=".5s">Digital Conference For Designers</h1>
                                <!-- Hero-btn -->
                                <div class="slider-btns">
                                    <a data-animation="fadeInLeft" data-delay="1.0s" href="industries.html" class="btn hero-btn">Download</a>
                                    <a data-animation="fadeInRight" data-delay="1.0s" class="popup-video video-btn"  href="https://www.youtube.com/watch?v=up68UAfH0d0">
                                        <i class="fas fa-play"></i></a>
                                    <p class="video-cap d-none d-sm-blcok" data-animation="fadeInRight" data-delay="1.0s">Story Vidoe<br> Watch</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>          
            </div>
            */ ?>
        </div>
        <!-- Counter Section Begin -->
        <div class="counter-section d-none d-sm-block">
            <div class="cd-timer" id="countdown" >
                <div class="cd-item">
                    <span>96</span>
                    <p>Days</p>
                </div>
                <div class="cd-item">
                    <span>15</span>
                    <p>Hrs</p>
                </div>
                <div class="cd-item">
                    <span>07</span>
                    <p>Min</p>
                </div>
                <div class="cd-item">
                    <span>02</span>
                    <p>Sec</p>
                </div>
            </div>
            <div class="card shadow d-none" style="margin-bottom: -200px;">
                <div class="card-body" style="width: 400px;">
                    <h4 class="mb-1">Klasemen Sementara</h4>
                    <div class="opacity-50 mb-1">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <i class="far fa-clock"></i>
                            </li>
                            <li class="list-inline-item">
                                <small class="momentjs" data-tgl="<?= $functions->getTimestamp(); ?>">...</small>
                            </li>
                        </ul>
                    </div>
                    <div class="list-group list-group-flush">

                        <?php
                        $leaderboard_query = "SELECT teams.id AS team_id, teams.name AS team_name, teams.logo AS team_logo, SUM(`point`) AS total_points FROM `competition_transactions` AS ct LEFT JOIN teams ON teams.id = ct.id_team GROUP BY id_team ORDER BY total_points DESC";
                        // echo $leaderboard_query;
                        $leaderboards = $database->query($leaderboard_query);
                        // echo $leaderboard_query;
                        foreach ($leaderboards['data'] as $leaderboard) {
                            $count_tanding = $database->query("SELECT *, CONCAT(`grouping`, `copy`) AS grouping_2 FROM competition_transactions WHERE id_team = {$leaderboard['team_id']}");
                            $count_win = $database->query("SELECT * FROM competition_transactions WHERE id_team = {$leaderboard['team_id']} AND `point` >= 95");
                        ?>

                            <a class="list-group-item list-group-item-action">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <img class="border border-light rounded-circle shadow-sm" src="./assets/img/teams/<?= $leaderboard['team_logo'] ?>" alt="Tim <?= $leaderboard['team_name'] ?>" width="48" height="48">
                                    </div>
                                    <div class="flex-fill">
                                        <?= $leaderboard['team_name'] ?>
                                    </div>
                                    <div class="text-end mx-4">
                                        <p class="font-weight-bold mb-0" style="font-size: 0.75rem; line-height: 1.10;">Menang</p>
                                        <h6 class="text-sm my-0" style="font-size: 1rem; line-height: 1.5;"><?= $count_win['total'] . " / " . $count_tanding['total'] ?></h6>
                                    </div>
                                    <div class="text-end">
                                        <p class="font-weight-bold mb-0" style="font-size: 0.75rem; line-height: 1.10;">Poin</p>
                                        <h6 class="text-sm my-0" style="font-size: 1rem; line-height: 1.5;"><?= number_format($leaderboard['total_points']) ?></h6>
                                    </div>
                                </div>
                            </a>

                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
        <!-- Counter Section End -->
    </div>
    <!-- slider Area End-->
    <!--? About Law Start-->
    <section class="about-low-area section-padding2">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="about-caption mb-50">
                        <!-- Section Tittle -->
                        <div class="section-tittle mb-35">
                            <h2>Sambut HUT Republik Indonesia ke-79!</h2>
                        </div>
                        <p>Dirgahayu Indonesiaku!.<br>Tak terasa sudah 79 tahun negara kita terbebas dari para penjajah. Kita juga harus selalu mengingat akan pahlawan yang sudah mempertaruhkan jiwa dan raga demi masa depan generasi penerus bangsa Indonesia.</p>
                        <p>Dalam memperingati bulan kemerdekaan Indonesia, kami dari <b>FORMASI 103</b> dan dengan seizin Ketua RT.001/RW.003 akan menyelenggarakan kegiatan seperti:</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-10">
                            <div class="single-caption mb-20">
                                <div class="caption-icon">
                                    <span class="flaticon-communications-1"></span>
                                </div>
                                <div class="caption">
                                    <h5>Tempat</h5>
                                    <p>Jalan Protokol RT.001 / RW.003<br>Kel. Kembaran Kulon, Purbalingga<br>Jawa Tengah, Indonesia</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-10">
                            <div class="single-caption mb-20">
                                <div class="caption-icon">
                                    <span class="flaticon-education"></span>
                                </div>
                                <div class="caption">
                                    <h5>Waktu</h5>
                                    <p><b>Perlombaan</b>: 10 - 11 Agustus 2024</p>
                                    <p><b>Panggung Hiburan</b>: 16 Agustus 2024</p>
                                    <p><b>Jalan Sehat</b>: 18 Agustus 2024</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="https://forms.gle/PwsLRz85nXzgUN7Y7" class="btn mt-50 d-block d-lg-inline-block">Daftar Lomba Sekarang</a>
                </div>
                <div class="col-lg-6 col-md-12">
                    <!-- about-img -->
                    <div class="about-img ">
                        <div class="about-font-img d-none">
                            <img src="assets/img/gallery/about2.png" alt="">
                        </div>
                        <div class="about-back-img ">
                            <img src="assets/img/gallery/about1.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Law End-->
    <!--? Brand Area Start-->
    <section class="work-company section-padding30" style="background: #2e0e8c;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-8">
                    <!-- Section Tittle -->
                    <div class="section-tittle section-tittle2 mb-50">
                        <h2>Our Top Genaral Sponsors.</h2>
                        <p>There arge many variations ohf passages of sorem gp ilable, but the majority have ssorem gp iluffe.</p>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="logo-area">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="single-logo mb-30">
                                    <img src="assets/img/gallery/cisco_brand.png" alt="">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="single-logo mb-30">
                                    <img src="assets/img/gallery/cisco_brand2.png" alt="">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="single-logo mb-30">
                                    <img src="assets/img/gallery/cisco_brand3.png" alt="">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="single-logo mb-30">
                                    <img src="assets/img/gallery/cisco_brand4.png" alt="">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="single-logo mb-30">
                                    <img src="assets/img/gallery/cisco_brand5.png" alt="">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="single-logo mb-30">
                                    <img src="assets/img/gallery/cisco_brand6.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Brand Area End-->
    <!--? Blog Area Start -->
    <section class="home-blog-area section-padding30">
        <div class="container">
            <!-- Section Tittle -->
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-8">
                    <div class="section-tittle text-center mb-50">
                        <h2>News From Blog</h2>
                        <p>There arge many variations ohf passages of sorem gp ilable, but the majority have ssorem gp iluffe.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="home-blog-single mb-30">
                        <div class="blog-img-cap">
                            <div class="blog-img">
                                <img src="assets/img/gallery/home-blog1.png" alt="">
                                <!-- Blog date -->
                                <div class="blog-date text-center">
                                    <span>24</span>
                                    <p>Now</p>
                                </div>
                            </div>
                            <div class="blog-cap">
                                <p>|   Physics</p>
                                <h3><a href="blog_details.html">Footprints in Time is perfect House in Kurashiki</a></h3>
                                <a href="blog_details.html" class="more-btn">Read more »</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="home-blog-single mb-30">
                        <div class="blog-img-cap">
                            <div class="blog-img">
                                <img src="assets/img/gallery/home-blog2.png" alt="">
                                <!-- Blog date -->
                                <div class="blog-date text-center">
                                    <span>24</span>
                                    <p>Now</p>
                                </div>
                            </div>
                            <div class="blog-cap">
                                <p>|   Physics</p>
                                <h3><a href="blog_details.html">Footprints in Time is perfect House in Kurashiki</a></h3>
                                <a href="blog_details.html" class="more-btn">Read more »</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Area End -->
    </main>
    <footer>
        <!-- Footer Start-->
        <div class="footer-area footer-padding">
            <div class="container">
                <div class="row d-flex justify-content-between">
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                       <div class="single-footer-caption mb-50">
                         <div class="single-footer-caption mb-30">
                             <div class="footer-tittle">
                                 <h4>About Us</h4>
                                 <div class="footer-pera">
                                     <p>Heaven frucvitful doesn't cover lesser dvsays appear creeping seasons so behold.</p>
                                </div>
                             </div>
                         </div>
                       </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Contact Info</h4>
                                <ul>
                                    <li>
                                        <p>Address :Your address goes here, your demo address.</p>
                                    </li>
                                    <li><a href="#">Phone : +8880 44338899</a></li>
                                    <li><a href="#">Email : info@colorlib.com</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Important Link</h4>
                                <ul>
                                    <li><a href="#"> View Project</a></li>
                                    <li><a href="#">Contact Us</a></li>
                                    <li><a href="#">Testimonial</a></li>
                                    <li><a href="#">Proparties</a></li>
                                    <li><a href="#">Support</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-5">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Newsletter</h4>
                                <div class="footer-pera footer-pera2">
                                 <p>Heaven fruitful doesn't over lesser in days. Appear creeping.</p>
                             </div>
                             <!-- Form -->
                             <div class="footer-form" >
                                 <div id="mc_embed_signup">
                                     <form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                                     method="get" class="subscribe_form relative mail_part">
                                         <input type="email" name="email" id="newsletter-form-email" placeholder="Email Address"
                                         class="placeholder hide-on-focus" onfocus="this.placeholder = ''"
                                         onblur="this.placeholder = ' Email Address '">
                                         <div class="form-icon">
                                             <button type="submit" name="submit" id="newsletter-submit"
                                             class="email_icon newsletter-submit button-contactForm"><img src="assets/img/gallery/form.png" alt=""></button>
                                         </div>
                                         <div class="mt-10 info"></div>
                                     </form>
                                 </div>
                             </div>
                            </div>
                        </div>
                    </div>
                </div>
               <!--  -->
               <div class="row footer-wejed justify-content-between">
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                        <!-- logo -->
                        <div class="footer-logo mb-20">
                        <a href="index.html"><img src="assets/img/logo/logo2_footer.png" alt=""></a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
                    <div class="footer-tittle-bottom">
                        <span>5000+</span>
                        <p>Talented Hunter</p>
                    </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
                        <div class="footer-tittle-bottom">
                            <span>451</span>
                            <p>Talented Hunter</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
                        <!-- Footer Bottom Tittle -->
                        <div class="footer-tittle-bottom">
                            <span>568</span>
                            <p>Talented Hunter</p>
                        </div>
                    </div>
               </div>
            </div>
        </div>
        <!-- footer-bottom area -->
        <div class="footer-bottom-area footer-bg">
            <div class="container">
                <div class="footer-border">
                     <div class="row d-flex justify-content-between align-items-center">
                         <div class="col-xl-10 col-lg-8 ">
                             <div class="footer-copy-right">
                                 <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy; <script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                             </div>
                         </div>
                         <div class="col-xl-2 col-lg-4">
                             <div class="footer-social f-right">
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="https://www.facebook.com/sai4ull"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fas fa-globe"></i></a>
                                <a href="#"><i class="fab fa-behance"></i></a>
                             </div>
                         </div>
                     </div>
                </div>
            </div>
        </div>
        <!-- Footer End-->
    </footer>
    <!-- Scroll Up -->
    <div id="back-top" >
        <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
    </div>

    <!-- JS here -->

    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="./assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/slick.min.js"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/animated.headline.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>

    <!-- Date Picker -->
    <script src="./assets/js/gijgo.min.js"></script>
    <!-- Nice-select, sticky -->
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>
    
    <!-- counter , waypoint -->
    <script src="./assets/js/jquery.counterup.min.js"></script>
    <script src="./assets/js/waypoints.min.js"></script>
    <script src="./assets/js/jquery.countdown.min.js"></script>
    <!-- contact js -->
    <script src="./assets/js/contact.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/mail-script.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>
    
    <!-- Jquery Plugins, main Jquery -->	
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/main.js"></script>

    <script src="./assets/js/moment.min.js"></script>

    <script>
        moment.locale("ID");

        function getUpdateTime() {
            var tgt = $('.momentjs');
            tgt.each(function() {
                var tgl = $(this).attr('data-tgl');
                $(this).text(moment(tgl, "YYYY-MM-DD HH:mm:ss").fromNow());
            });
        }

        backgroundSlideshowDelay = 10000;
        function backgroundSlideshow(){
            var tgt = $(".background-slideshow-images img");
            var curActive = $(".background-slideshow-images img.opacity-100");
            var tgtCount = tgt.length;
            var nextActiveIndex = ((tgt.index( curActive ) + 1) >= tgtCount) ? 0 : tgt.index( curActive ) + 1;
            console.log(curActive.attr("src"));
            console.log(nextActiveIndex, tgtCount);
            curActive.removeClass("opacity-100");
            $(".background-slideshow-images img:nth-child(" + (nextActiveIndex + 1) + ")").addClass("opacity-100");
        }

        setInterval(backgroundSlideshow, backgroundSlideshowDelay);
        setInterval(getUpdateTime, 3000);
        getUpdateTime();
    </script>
    
    </body>
</html>

<?php $database->close(); ?>