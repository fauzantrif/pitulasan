<?php
ini_set('display_errors', 1);
require_once("./f-admin/inc/Database.php");
require_once("./f-admin/inc/Functions.php");

$database = new Database();
date_default_timezone_set("Asia/Jakarta");
$last_competition = $database->query("SELECT date_added FROM competition_transactions ORDER BY date_added DESC LIMIT 1");
$last_competition = $last_competition['data'][0]['date_added'];
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> FORMASI 103: Klasemen Sementara </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/gijgo.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="d-flex flex-column mx-auto py-5" style="max-width: 1024px; width: 90%;">
        <div class="row">
            <div class="col-12">
                <div class="mb-3 text-center">
                    <a href="./?_">
                        <img src="./assets/img/logo/logo.png" alt="Logo FORMASI 103">
                    </a>
                    <h2>HASIL PERLOMBAAN</h2>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="card mb-2">
                    <div class="card-body">
                        <h5>Klasemen Tim</h5>
                        <div class="list-group list-group-flush">

                            <?php
                            $leaderboard_query = "SELECT teams.id AS team_id, teams.name AS team_name, teams.logo AS team_logo, SUM(`point`) AS total_points FROM `competition_transactions` AS ct LEFT JOIN teams ON teams.id = ct.id_team GROUP BY id_team ORDER BY total_points DESC";
                            // echo $leaderboard_query;
                            $leaderboards = $database->query($leaderboard_query);
                            // echo $leaderboard_query;
                            foreach ($leaderboards['data'] as $leaderboard) {
                                $count_tanding = $database->query("SELECT *, CONCAT(`grouping`, `copy`) AS grouping_2 FROM competition_transactions WHERE id_team = {$leaderboard['team_id']}");
                                $count_win = $database->query("SELECT * FROM competition_transactions WHERE id_team = {$leaderboard['team_id']} AND `point` >= 95");
                                $best_member = $database->query("SELECT participant.*, SUM(`point`) AS total_points FROM `competition_transactions` AS ct LEFT JOIN participant ON participant.id = ct.id_participant WHERE participant.team = {$leaderboard['team_id']} GROUP BY participant.id ORDER BY total_points DESC LIMIT 1");
                            ?>

                                <a class="list-group-item list-group-item-action">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <img class="border border-light rounded-circle shadow-sm" src="./assets/img/teams/<?= $leaderboard['team_logo'] ?>" alt="Tim <?= $leaderboard['team_name'] ?>" width="48" height="48">
                                        </div>
                                        <div class="flex-fill">
                                            <?= $leaderboard['team_name'] ?>
                                            <div class="d-none d-lg-flex align-items-center opacity-50 mt-1" style="font-size: 0.75rem; line-height: 1.25;">
                                                <div class="me-2">
                                                    <i class="fas fa-medal text-warning"></i>
                                                </div>
                                                <div class="flex-fill">
                                                    <?= $best_member['data'][0]['fullname'] ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-end mx-4">
                                            <p class="font-weight-bold mb-0" style="font-size: 0.75rem; line-height: 1.10;">Menang</p>
                                            <h6 class="text-sm my-0" style="font-size: 1rem; line-height: 1.5;"><?= $count_win['total'] . " / " . $count_tanding['total'] ?></h6>
                                        </div>
                                        <div class="text-end">
                                            <p class="font-weight-bold mb-0" style="font-size: 0.75rem; line-height: 1.10;">Total Poin</p>
                                            <h6 class="text-sm my-0" style="font-size: 1rem; line-height: 1.5;"><?= number_format($leaderboard['total_points']) ?></h6>
                                        </div>
                                    </div>
                                </a>

                            <?php } ?>

                        </div>
                    </div>
                </div>
                <div class="mt-0 mb-4 opacity-50" style="font-size: .9em;">
                    <div class="d-flex">
                        <div class="">
                            <small>
                                <div class="d-flex mt-1">
                                    <div class="me-1 text-end">
                                        <span class="text-danger" style="display: inline-block; width: 20px;">*)</span>
                                    </div>
                                    <div class="flex-fill">
                                        Tim dianggap menang apabila mendapat urutan peringkat ke-1 dan ke-2.
                                    </div>
                                </div>
                                <div class="d-flex mt-1">
                                    <div class="me-1 text-end">
                                        <span class="text-danger" style="display: inline-block; width: 20px;">**)</span>
                                    </div>
                                    <div class="flex-fill">
                                        Skor kemungkinan akan ada perubahan dikarenakan sedang proses <i>crosscheck</i>.
                                    </div>
                                </div>
                            </small>
                        </div>
                        <?php /*
                        <div>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <i class="far fa-clock"></i>
                                </li>
                                <li class="list-inline-item">
                                    <small class="momentjs" data-tgl="<?= $last_competition ?>">...</small>
                                </li>
                            </ul>
                        </div>
                        */ ?>
                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <?php
                $finit = 0;
                $lombas = $database->query("SELECT * FROM competitions ORDER BY `type` ASC, `name` ASC");
                foreach ($lombas['data'] as $lomba) {
                    $isRan = $database->numRows("competition_transactions", "`id_comp` = {$lomba['id']} AND `point` > 0");
                    if (!$isRan) continue;
                    $finit++;
                    $isTeamMode = ($lomba['type'] === "team");
                    $generate_team_comp_id = "list-competition-{$finit}";
                ?>
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-fill">
                                    <h5 class="mb-1"><?= $lomba['name'] ?></h5>
                                    <small>
                                        <ul class="list-inline">
                                            <li class="list-inline-item me-1">
                                                <?php if ($isTeamMode) { ?>

                                                    <span class="badge bg-success rounded-pill">
                                                        Regu
                                                    </span>

                                                <?php } else { ?>

                                                    <span class="badge bg-primary rounded-pill">
                                                        Individu
                                                    </span>

                                                <?php } ?>
                                            </li>
                                            <?php
                                            $listTerms = explode("\n", $lomba['terms']);
                                            foreach ($listTerms as $term) {
                                                $term = trim($term);
                                                echo "<li class=\"list-inline-item\"><span class=\"me-1\">&bull;</span> $term</li>";
                                            }
                                            ?>
                                        </ul>
                                    </small>
                                </div>
                                <div>
                                    <?php if ($isTeamMode) { ?>
                                        <button class="btn header-btn p-2" data-bs-toggle="collapse" data-bs-target="<?= "#" . $generate_team_comp_id ?>">
                                            <i class="fas fa-chevron-down"></i>
                                        </button>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="" id="">
                                <?php
                                if ($isTeamMode) {
                                    $matches = $database->query("SELECT ct.*, teams.name AS team_name, teams.logo AS team_logo FROM competition_transactions AS ct LEFT JOIN teams ON ct.id_team = teams.id WHERE id_comp = {$lomba['id']} AND `point` > 0 ORDER BY `point` DESC");
                                    $peringkat = 0;
                                ?>

                                    <div class="list-group list-group-flush collapse" id="<?= $generate_team_comp_id ?>">
                                        <hr class="border-dark mt-3 mb-3">
                                        <?php foreach ($matches['data'] as $match) {
                                            $peringkat++; ?>
                                            <div class="list-group-item">
                                                <div class="d-flex align-items-center">
                                                    <div style="font-size: 1.5em;">
                                                        <?= $peringkat ?>
                                                    </div>
                                                    <div class="mx-3">
                                                        <img class="border border-light rounded-circle shadow-sm" src="./assets/img/teams/<?= $match['team_logo'] ?>" alt="Tim <?= $match['team_name'] ?>" width="48" height="48">
                                                    </div>
                                                    <div class="flex-fill">
                                                        <?= $match['team_name'] ?>
                                                    </div>
                                                    <div>
                                                        <?= number_format($match['point']) ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>

                                <?php } else { ?>

                                    <hr class="border-dark mt-3 mb-3">

                                    <?php
                                    $matches = $database->query("SELECT *, CONCAT(`grouping`, `copy`) AS `grouping_2` FROM `competition_transactions` WHERE `id_comp` = {$lomba['id']} AND `point` > 0 GROUP BY `grouping_2`");
                                    foreach ($matches['data'] as $match) {
                                        if ($match['copy'] >= 2) {
                                            $match_grouping = $match['grouping'] . " - " . $match['copy'];
                                        } else {
                                            $match_grouping = $match['grouping'];
                                        }
                                        $generate_list_id = preg_replace('/\s+/', '_', $match['grouping_2']);
                                        $generate_list_id = "list-competition-{$generate_list_id}-{$finit}";
                                        $finit++;
                                    ?>

                                        <div class="px-1 mt-3">
                                            <h6 class="" style="cursor: pointer;" data-bs-toggle="collapse" data-bs-target="<?= "#" . $generate_list_id ?>">
                                                <div class="d-flex">
                                                    <div class="flex-fill"><?= $match_grouping ?></div>
                                                    <div>
                                                        <i class="fas fa-chevron-down"></i>
                                                    </div>
                                                </div>
                                            </h6>
                                            <ol class="list-group mt-3 collapse" id="<?= $generate_list_id ?>">
                                                <?php
                                                $scores = $database->query("SELECT * FROM `competition_transactions` WHERE `id_comp` = {$lomba['id']} AND `grouping` = '{$match['grouping']}' AND `copy` = {$match['copy']} ORDER BY `point` DESC");
                                                if ($scores['total']) {
                                                    $f = 0;
                                                    foreach ($scores['data'] as $score) {
                                                        $participant = $database->query("SELECT `participant`.*, `teams`.logo, `teams`.name AS `team_name` FROM `participant` LEFT JOIN `teams` ON `participant`.`team` = `teams`.id WHERE `participant`.id = {$score['id_participant']}");
                                                        $participant = $participant['data'][0];
                                                        $f++;
                                                ?>
                                                        <li class="list-group-item">
                                                            <div class="d-flex align-items-center">
                                                                <div style="font-size: 1.3em;">
                                                                    <?= $f ?>
                                                                </div>
                                                                <div class="flex-fill mx-3">
                                                                    <small class="d-block">
                                                                        <?= $participant['callname'] ?>
                                                                    </small>
                                                                    <?= $participant['fullname'] ?>
                                                                </div>
                                                                <div>
                                                                    <img class="border border-light rounded-circle shadow-sm" src="./assets/img/teams/<?= $participant['logo'] ?>" alt="Tim <?= $participant['team_name'] ?>" width="48" height="48">
                                                                </div>
                                                            </div>
                                                        </li>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </ol>
                                        </div>

                                    <?php } ?>
                                <?php } ?>
                            </div>

                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <footer>
        <div class="border-top text-center px-2 py-3">
            <small>
                &copy; Copyright 2023 <a href="//www.tripath.my.id/" class="text-primary" target="_blank">Tripath Projects</a>. All rights reserved.
            </small>

        </div>
    </footer>

    <!-- JS here -->

    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
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
        setInterval(getUpdateTime, 3000);
        getUpdateTime();
    </script>

</body>

</html>

<?php
$database->close();
?>