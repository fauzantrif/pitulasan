<?php
  require_once("./inc/config.inc.php");
  if (!$user){
    header("Location: ./?error=unauthorized"); exit();
  }
  $total_participant = $database->numRows("participant");
  $total_team = $database->numRows("teams");
  $total_competition = $database->numRows("competitions");
  $total_points = $database->query("SELECT SUM(`point`) AS total_points FROM competition_transactions");
  $total_points = $total_points['data'][0]['total_points'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title> Dasbor </title>
  <?php include_once("./comps/script.header.php"); ?>
</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <?php include_once("./comps/navbar.menu.php"); ?>
  </aside>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Dasbor</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Dasbor</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <?php include_once("./comps/navbar.top.php"); ?>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Peserta</p>
                    <h5 class="font-weight-bolder">
                      <?= $total_participant ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="fas fa-user text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
              <hr class="horizontal dark">
              <a href="" class="btn btn-sm d-block text-primary mb-0">Tambah Peserta</a>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Regu Peserta</p>
                    <h5 class="font-weight-bolder">
                      <?= $total_team ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                    <i class="fas fa-users text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
              <hr class="horizontal dark">
              <a href="" class="btn btn-sm d-block text-danger mb-0">Peserta</a>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Lomba</p>
                    <h5 class="font-weight-bolder">
                      <?= number_format($total_competition) ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                    <i class="ni ni-user-run text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
              <hr class="horizontal dark">
              <a href="" class="btn btn-sm d-block text-success mb-0">Lomba</a>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Poin Terhitung</p>
                    <h5 class="font-weight-bolder">
                      <?= number_format($total_points) ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                    <i class="ni ni-trophy text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
              <hr class="horizontal dark">
              <a href="" class="btn btn-sm d-block text-warning mb-0">Klasemen</a>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-lg-7 mb-lg-0 mb-4">
          <div class="card ">
            <div class="card-header pb-0 p-3">
              <div class="d-flex justify-content-between">
                <h6 class="mb-2">Peserta Terbaik</h6>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center ">
                <tbody>
                  <?php
                    $topten_query = "SELECT `participant`.*, (SELECT IFNULL(SUM(`competition_transactions`.point), 0) FROM `competition_transactions` WHERE `competition_transactions`.`id_participant` = `participant`.id) AS total_points FROM `participant` WHERE `team` IS NOT NULL AND `grouping` = 'SD - Junior' ORDER BY `total_points` DESC LIMIT 10";
                    $toptens = $database->query($topten_query);
                    foreach($toptens['data'] as $topten){
                      $topten_name_encoded = urlencode($topten['fullname']);
                      $team = $database->query("SELECT * FROM teams WHERE id = {$topten['team']}");
                      $team = $team['data'][0];
                  ?>
                  <tr>
                    <td class="w-30">
                      <div class="d-flex px-2 py-1 align-items-center">
                        <div>
                          <img class="border border-light rounded-circle shadow-sm" src="../assets/img/teams/<?= $team['logo'] ?>" alt="Tim <?= $team['name'] ?>" width="40" height="40">
                        </div>
                        <div class="ms-4">
                          <p class="text-xs font-weight-bold mb-0"><?= $topten['callname'] ?></p>
                          <h6 class="text-sm mb-0"><?= $topten['fullname'] ?></h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <?php
                        $count_tanding = $database->query("SELECT *, CONCAT(`grouping`, `copy`) AS grouping_2 FROM competition_transactions WHERE id_participant = {$topten['id']}");
                        $count_win = $database->query("SELECT * FROM competition_transactions WHERE id_participant = {$topten['id']} AND `point` >= 95");

                      ?>
                      <div class="text-center">
                        <p class="text-xs font-weight-bold mb-0">Tanding:</p>
                        <h6 class="text-sm mb-0"><?= $count_tanding['total'] ?></h6>
                      </div>
                    </td>
                    <td>
                      <div class="text-center">
                        <p class="text-xs font-weight-bold mb-0">Menang:</p>
                        <h6 class="text-sm mb-0"><?= $count_win['total'] ?></h6>
                      </div>
                    </td>
                    <td class="align-middle text-sm">
                      <div class="col text-center">
                        <p class="text-xs font-weight-bold mb-0">Total Poin:</p>
                        <h6 class="text-sm mb-0"><?= number_format($topten['total_points']) ?></h6>
                      </div>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="card">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-0">Klasemen Sementara</h6>
            </div>
            <div class="card-body p-3">
              <div class="list-group list-group-flush">

                <?php
                  $leaderboard_query = "SELECT teams.id AS team_id, teams.name AS team_name, teams.logo AS team_logo, SUM(`point`) AS total_points FROM `competition_transactions` AS ct LEFT JOIN teams ON teams.id = ct.id_team GROUP BY id_team ORDER BY total_points DESC";
                  // echo $leaderboard_query;
                  $leaderboards = $database->query($leaderboard_query);
                  foreach($leaderboards['data'] as $leaderboard){
                    // $totalMember = $database->numRows("participant", "team = {$team['id']}");
                      // var_dump($team['id']);
                      /*
                      SELECT teams.name AS team_name, SUM(competition_transactions.point) AS points FROM teams
                LEFT JOIN participant ON participant.team = teams.id
                LEFT JOIN competition_transactions ON competition_transactions.id_parteam = participant.id OR competition_transactions.id_parteam = participant.team
                ORDER BY points DESC
                */
                ?>

                <a class="list-group-item list-group-item-action" href="<?= "./participant.php?search=tim:{$leaderboard['team_id']}" ?>">
                  <div class="d-flex align-items-center">
                    <div class="me-3">
                      <img class="border border-light rounded-circle shadow-sm" src="../assets/img/teams/<?= $leaderboard['team_logo'] ?>" alt="Tim <?= $leaderboard['team_name'] ?>" width="48" height="48">
                    </div>
                    <div class="flex-fill">
                      <?= $leaderboard['team_name'] ?>
                    </div>
                    <div>
                      <?= number_format($leaderboard['total_points']) ?>
                    </div>
                  </div>
                </a>

                <?php } ?>

                </div>
            </div>
          </div>
        </div>
      </div>
      <?php include_once("./comps/footer.php"); ?>
    </div>
  </main>
  <?php include_once("./comps/script.footer.php"); ?>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
</body>

</html>

<?php
  $database->close();
?>