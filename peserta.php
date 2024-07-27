<?php
    require_once("./f-admin/inc/Database.php");
    require_once("./f-admin/inc/Functions.php");

    $database = new Database();
    $functions = new Functions();
    date_default_timezone_set("Asia/Jakarta");
    error_reporting(1);
?>

<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <title> FORMASI 103: Calon Peserta </title>
    <?php include_once("comps/head.scripts.php"); ?>
</head>
<body>
    <!-- ? Preloader Start -->
    <?php include_once("comps/body.preloader.php"); ?>
    <!-- Preloader Start -->
<?php include_once("comps/body.navbar.php"); ?>
<main>
    <section class="work-company py-5" style="background: #2e0e8c;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12" style="height: 102px;"></div>
                <div class="col-12 text-center">
                    <h1 class="text-white text-uppercase">Calon Peserta</h1>
                    <p class="text-white">Daftar calon peserta lomba Semarak Kemerdekaan Republik Indonesia ke-79.</p>
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
                            <button class="nav-link active" id="peserta-tab" data-bs-toggle="tab" data-bs-target="#pane-peserta" type="button" role="tab" aria-controls="home" aria-selected="true">Calon Peserta</button>
                        </li>
                    </ul>
                    <div class="tab-content pt-4" id="myTabContent">
                        <div class="tab-pane fade show active" id="pane-peserta" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="col mx-auto" style="max-width: 800px;">
                                <?php
                                    $participant_groups = $database->query("SELECT `grouping` FROM participant GROUP BY `grouping` ORDER BY `grouping` ASC");
                                    foreach($participant_groups['data'] as $participant_group){
                                ?>
                                <h4 class="my-4 mt-5"><?= $participant_group['grouping'] ?></h4>
                                <div class="list-group shadow">
                                    <?php
                                            $participant_ranks = $database->query("SELECT participant.*, teams.name AS team_name, teams.logo AS team_logo, COALESCE(SUM(competition_transactions.point), 0) AS total_points, COUNT(competition_transactions.id) AS matches_count FROM participant LEFT JOIN competition_transactions ON participant.id = competition_transactions.id_participant LEFT JOIN teams ON teams.id = participant.team WHERE participant.grouping = '{$participant_group['grouping']}' GROUP BY participant.id ORDER BY total_points DESC");
                                            $p = 0;
                                            if($participant_ranks['total']){
                                                foreach($participant_ranks['data'] as $participant_rank){
                                                    $p++;
                                    ?>
                                    <a class="list-group-item list-group-item-action">
                                        <div class="d-flex align-items-center">
                                            <div class="me-4 text-end" style="width: 40px;">
                                                <span class="fs-2"><?= $p ?></span>
                                            </div>
                                            <div class="flex-fill me-4">
                                                <div><?= $participant_rank['fullname'] ?></div>
                                                <small class="opacity-75">
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item"><?= $participant_rank['callname'] ?></li>
                                                        <li class="list-inline-item">&bull;</li>
                                                        <li class="list-inline-item">Tim: <?= ($participant_rank['team_name'] !== null) ? $participant_rank['team_name'] : "-" ?></li>
                                                    </ul>
                                                </small>
                                            </div>
                                            <div class="fs-5 me-2 text-end">
                                                <div class="small" style="font-size: 0.75rem; line-height: 1.10;">Terdaftar</div>
                                                <span class="momentjs small" data-tgl="<?= $participant_rank['date_added'] ?>">
                                                    <i class="fa-solid fa-circle-notch fa-spin"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                    <?php
                                            }
                                        } else {
                                    ?>
                                    <div class="text-center">
                                        <div class="alert alert-warning mb-0">
                                            Belum ada peserta di grup ini.
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    ?>
                                </div>
                                <?php } ?>
                                <div class="mt-5">
                                    <small>
                                        <div class="d-flex mt-1">
                                            <div class="me-1 text-end">
                                                <span class="text-danger" style="display: inline-block; width: 20px;">*)</span>
                                            </div>
                                            <div class="flex-fill">
                                                Pengkategorian peserta SD:
                                                <ul>
                                                    <li><b>SD Baru</b>: Kelas 1 - Kelas 2</li>
                                                    <li><b>SD Junior</b>: Kelas 3 - Kelas 4</li>
                                                    <li><b>SD Senior</b>: Kelas 5 - Kelas 6</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </small>
                                </div>
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