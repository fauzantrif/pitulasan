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
    <title> FORMASI 103: Klasemen Lomba </title>
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
                    <h1 class="text-white text-uppercase">Klasemen</h1>
                    <p class="text-white">Klasemen sementara perlombaan.</p>
                </div>
            </div>
        </div>
    </section>
    <!--? About Law Start-->
    <section class="about-low-area py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php /*
                    <ul class="nav nav-pills justify-content-center" id="myTab" role="tablist" style="--bs-link-color: #2e0e8c; --bs-nav-pills-link-active-bg: #2e0e8c;">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="klasemen-timnlomba-tab" data-bs-toggle="tab" data-bs-target="#klasemen-timnlomba" type="button" role="tab" aria-controls="home" aria-selected="true">Tim &amp; Lomba</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="klasemen-peserta-tab" data-bs-toggle="tab" data-bs-target="#klasemen-peserta" type="button" role="tab" aria-controls="profile" aria-selected="false">Peserta</button>
                        </li>
                    </ul>
                    <div class="tab-content pt-4" id="myTabContent">
                        <div class="tab-pane fade show active" id="klasemen-timnlomba" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
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
                                                                                    <div class="me-3" style="font-size: 1.3em;">
                                                                                        <?= $f ?>
                                                                                    </div>
                                                                                    <div class="flex-fill me-3">
                                                                                        <small class="d-block">
                                                                                            <?= $participant['callname'] ?>
                                                                                        </small>
                                                                                        <?= $participant['fullname'] ?>
                                                                                    </div>
                                                                                    <div class="me-3">
                                                                                        <?= $score['point'] ?>
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
                        <div class="tab-pane fade" id="klasemen-peserta" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="col mx-auto" style="max-width: 800px;">
                                <?php
                                    $participant_groups = $database->query("SELECT grouping FROM participant GROUP BY grouping ORDER BY grouping ASC");
                                    foreach($participant_groups['data'] as $participant_group){
                                ?>
                                <h4 class="my-4 mt-5"><?= $participant_group['grouping'] ?></h4>
                                <div class="list-group shadow">
                                    <?php
                                            $participant_ranks = $database->query("SELECT participant.*, teams.name AS team_name, teams.logo AS team_logo, COALESCE(SUM(competition_transactions.point), 0) AS total_points, COUNT(competition_transactions.id) AS matches_count FROM participant LEFT JOIN competition_transactions ON participant.id = competition_transactions.id_participant LEFT JOIN teams ON teams.id = participant.team WHERE participant.grouping = '{$participant_group['grouping']}' GROUP BY participant.id ORDER BY total_points DESC");
                                            $p = 0;
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
                                                <small class="opacity-75"><?= ($participant_rank['team_name'] !== null) ? "Tim " . $participant_rank['team_name'] : "-" ?></small>
                                            </div>
                                            <div class="me-4 fs-5 text-end">
                                                <div class="small" style="font-size: 0.75rem; line-height: 1.10;">Tanding</div>
                                                <?= $participant_rank['matches_count'] ?>
                                            </div>
                                            <div class="fs-5 me-2 text-end">
                                                <div class="small" style="font-size: 0.75rem; line-height: 1.10;">Poin</div>
                                                <?= $participant_rank['total_points'] ?>
                                            </div>
                                        </div>
                                    </a>
                                    <?php } ?>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    */ ?>

                    <div class="text-center">
                        <img src="assets/img/animated/roadblock.gif" class="img-fluid mb-4" alt="Not Available" style="width: 180px;">
                        <h2>Maaf! Belum Tersedia.</h2>
                        <p>Fitur ini belum tersedia atau sedang dalam perbaikan.</p>
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