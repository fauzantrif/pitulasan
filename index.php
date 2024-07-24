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
    <title> FORMASI 103: Perayaan HUT Republik Indonesia ke-79 </title>
    <?php include_once("comps/head.scripts.php"); ?>
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
<?php include_once("comps/body.navbar.php"); ?>
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
                                    <a data-animation="fadeInLeft" data-delay="1.0s" href="#start-explore" class="btn hero-btn">Mulai Jelajah</a>
                                    <a data-animation="fadeInRight" data-delay="1.0s" class="popup-video video-btn"  href="https://www.youtube.com/watch?v=up68UAfH0d0">
                                        <i class="fas fa-play"></i></a>
                                    <p class="video-cap d-none d-sm-blcok" data-animation="fadeInRight" data-delay="1.0s">Story Vidoe<br> Watch</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>          
            </div>
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
    <section class="about-low-area section-padding2" id="start-explore">
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
                            <div class="single-caption mb-20 align-items-start">
                                <div class="caption-icon pt-3">
                                    <span class="fas fa-location-dot"></span>
                                </div>
                                <div class="caption">
                                    <h5>Tempat</h5>
                                    <p>Jalan Protokol RT.001 / RW.003<br>Kel. Kembaran Kulon, Purbalingga<br>Jawa Tengah, Indonesia</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-10">
                            <div class="single-caption mb-20 align-items-start">
                                <div class="caption-icon pt-3">
                                    <span class="fas fa-calendar-days"></span>
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
                            <img src="assets/img/about.png" alt="">
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
                        <h2>Tim Siap Tanding.</h2>
                        <p>Beberapa tim sudah siap untuk bertanding demi menyemarakkan kemerdekaan Republik Indonesia.</p>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="logo-area">
                        <div class="row">
                            <?php
                                $teams = $database->query("SELECT * FROM teams");
                                foreach($teams['data'] as $team){
                            ?>
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="single-logo mb-5 text-center">
                                    <img src="assets/img/teams/<?= $team['logo'] ?>" class="img-fluid rounded-circle" style="height: 128px;" alt="<?= $team['name'] ?>">
                                </div>
                            </div>
                            <?php } ?>
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
                        <h2>Tunggu apa lagi?</h2>
                        <p>Ayo bentuk tim dan berlomba untuk kemerdekaan!</p>
                        <a href="https://forms.gle/PwsLRz85nXzgUN7Y7" class="btn mt-3 d-block d-lg-inline-block">Daftar Lomba Sekarang</a>
                    </div>
                </div>
            </div>
            <div class="row d-none">
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
    <?php include_once("comps/body.footer.php"); ?>
    <!-- Scroll Up -->
    <div id="back-top" >
        <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
    </div>

    <!-- JS here -->

    <?php include_once("comps/footer.scripts.php"); ?>

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