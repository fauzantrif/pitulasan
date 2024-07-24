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
    <title> FORMASI 103: 103 CUP </title>
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
    <section class="work-company py-5" style="background: #2e0e8c;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12" style="height: 102px;"></div>
                <div class="col-12 text-center">
                    <h1 class="text-white text-uppercase">103 CUP</h1>
                    <p class="text-white">Pertandingan sepak bola antar tim ronda dengan sistem gugur.</p>
                </div>
            </div>
        </div>
    </section>
    <!--? About Law Start-->
    <section class="about-low-area py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul class="nav nav-pills justify-content-center" id="myTab" role="tablist" style="--bs-link-color: #2e0e8c; --bs-nav-pills-link-active-bg: #2e0e8c;">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="klasemen-timnlomba-tab" data-bs-toggle="tab" data-bs-target="#klasemen-timnlomba" type="button" role="tab" aria-controls="home" aria-selected="true">Pertandingan</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="klasemen-peserta-tab" data-bs-toggle="tab" data-bs-target="#klasemen-peserta" type="button" role="tab" aria-controls="profile" aria-selected="false">Hasil</button>
                        </li>
                    </ul>
                    <div class="tab-content pt-4" id="myTabContent">
                        <div class="tab-pane fade show active" id="klasemen-timnlomba" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <img src="./assets/img/Grafik-Pertandingan.png" class="img-fluid" alt="Grafik pertandingan">
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                <div>
                                    <a href="" class="btn bg-primary">Peraturan Pertandingan</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="klasemen-peserta" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="col mx-auto" style="">
                                <?php
                                    $json_file = __DIR__ . "/assets/json/103-cup.json";
                                    $matches = json_decode(file_get_contents($json_file), true);
                                    foreach($matches as $match){
                                ?>
                                <div class="text-center my-4 mt-5">
                                    <h4 class="my-0"><?= $match['name'] ?></h4>
                                    <small><?= $match['date'] ?></small>
                                </div>
                                <div class="row">
                                    <?php 
                                        $match_count = count($match['matches']);
                                        foreach($match['matches'] as $indiv_match){
                                            $maxMatchTime = 20;
                                            $maxExtraTime = 10;
                                            $currentTime = $indiv_match['current-time'];
                                            $matchStatus = function(){
                                                global $maxExtraTime, $maxMatchTime, $currentTime;
                                                $currentTimeOnExtra = $currentTime - $maxMatchTime;
                                                if($currentTime === 0) return "";
                                                if($currentTime){
                                                    if(($maxMatchTime / $currentTime) === 2) return "Half Time";
                                                    if($currentTime == $maxMatchTime) return "Full Time";
                                                    if(($currentTime > $maxMatchTime) && (($maxExtraTime / $currentTimeOnExtra) === 2)) return "Half Extra Time";
                                                    if(($currentTime > $maxMatchTime) && ($currentTimeOnExtra >= $maxExtraTime)) return "Full Time";
                                                    if(($currentTime > $maxMatchTime) && ($currentTimeOnExtra < $maxExtraTime)) return "In Extra Time";
                                                    return "In Match";
                                                }
                                            };
                                            if($indiv_match['penalty']) $matchStatus = function(){ return "Penalty"; };
                                    ?>
                                    <div class="col-md-6 my-2 mx-auto">
                                        <div class="card">
                                            <div class="card-header text-center">
                                                <div class="fw-bold"><?= $indiv_match['match-name'] ?></div>
                                                <small><?= $indiv_match['match-time'] ?></small>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="" data-avatar>
                                                        <span class="avatar"></span>
                                                    </div>
                                                    <div class="flex-fill" data-team-name><?= $indiv_match['team-1-name'] ?></div>
                                                    <div class="fs-3 ms-2" data-team-score><?= ($indiv_match['current-time']) ? $indiv_match['team-1-score'] : "" ?></div>
                                                    <div class="fw-bold mx-3 text-center text-white rounded" style="width: 30px; background-color: #331391;">VS</div>
                                                    <div class="fs-3 me-2" data-team-score><?= ($indiv_match['current-time']) ? $indiv_match['team-2-score'] : "" ?></div>
                                                    <div class="flex-fill text-end" data-team-name><?= $indiv_match['team-2-name'] ?></div>
                                                    <div class="text-end" data-avatar>
                                                        <span class="avatar"></span>
                                                    </div>
                                                </div>
                                                <div class="text-center small mb-2"><?= $matchStatus() ?></div>
                                                <?php
                                                    if(count($indiv_match['match-events'])){
                                                        echo '<hr class="my-3">';
                                                        foreach($indiv_match['match-events'] as $match_event){
                                                            $teamOneClass = ($match_event['team'] === 1) ? "" : "invisible";
                                                            $teamTwoClass = ($match_event['team'] === 2) ? "" : "invisible";
                                                            $teamEvents = array(
                                                                "yellow-card" => "<i class=\"fas fa-square text-warning fa-xs\"></i>",
                                                                "red-card" => "<i class=\"fas fa-square text-danger fa-xs\"></i>",
                                                                "goal" => "<i class=\"fas fa-futbol fa-xs\"></i>",
                                                            );
                                                ?>
                                                <div class="d-flex align-items-center" data-match-event>
                                                    <div class="flex-fill text-end me-2 <?= $teamOneClass ?>" data-player-team-1><?= $match_event['player'] ?></div>
                                                    <div class="<?= $teamOneClass ?> me-2" data-player-team-1-event><?= $teamEvents[$match_event['event']] ?></div>
                                                    <div class="<?= $teamOneClass ?>" data-player-team-1-time><?= $match_event['minute'] . "'" ?></div>
                                                    <div class="mx-3" style="width: 21px; height: 5px;"> </div>
                                                    <div class="<?= $teamTwoClass ?>" data-player-team-2-time><?= $match_event['minute'] . "'" ?></div>
                                                    <div class="<?= $teamTwoClass ?> ms-2" data-player-team-2-event><?= $teamEvents[$match_event['event']] ?></div>
                                                    <div class="flex-fill text-start ms-2 <?= $teamTwoClass ?>" data-player-team-2><?= $match_event['player'] ?></div>
                                                </div>
                                                <?php
                                                        }
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Law End-->
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
        setInterval(getUpdateTime, 3000);
        getUpdateTime();
    </script>
    
    </body>
</html>

<?php $database->close(); ?>