<?php
  require_once("./inc/config.inc.php");
  require_once("./vendor/Westsworld/TimeAgo.php");
  require_once("./vendor/Westsworld/TimeAgo/Language.php");
  require_once("./vendor/Westsworld/TimeAgo/Translations/Id.php");
  
  if (!$user){
    header("Location: ./?error=unauthorized"); exit();
  }

  use \Westsworld\TimeAgo;
  $timeago_lang = new \Westsworld\TimeAgo\Translations\Id();
  $timeago = new \Westsworld\TimeAgo($timeago_lang);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title> Perlombaan </title>
  <?php include_once("./comps/script.header.php"); ?>
</head>

<body class="g-sidenav-show   bg-gray-100">
  <?php /*
    $limit = 30;
    $page = (isset($_GET['page'])) ? intval($_GET['page']) : 1;
    $db_table = "participant";
    $search = ((isset($_GET['search'])) && (strlen($_GET['search']) >= 1)) ? $database->sanitizeInput($_GET['search']) : false;
    $search_query = (is_string($search)) ? "WHERE callname LIKE '%{$search}%' OR fullname LIKE '%{$search}%'" : "";
    $orderBy = false;
    $orderBy_query = "ORDER BY `id` ASC";

    if(preg_match("/[a-z]{3}:/", $search)){
      $prefix_search = explode(":", $search, 2);
      $prefix_search_criteria = trim($prefix_search[0]);
      $prefix_search = trim($prefix_search[1]);
      // print_r($prefix_search);
      switch($prefix_search_criteria){
        case "ord":
          if($prefix_search === "last_added"){
            $search_query = "";
            $orderBy_query = "ORDER BY `date_added` DESC";
          }
          break;
        case "kel":
          $search_query = "WHERE grouping = '{$prefix_search}'";
          break;
      }
    }
    
    // $offset = (isset($_GET['offset'])) ? intval($_GET['offset']) - 1 : 0;
    $offset = ($page - 1) * $limit;
    // echo "offset: $offset<br>";
    // echo "page: $page<br>";
    $participant_sql = "SELECT * FROM $db_table $search_query $orderBy_query LIMIT $limit OFFSET $offset";
    // echo $participant_sql;
    $total_participant = $database->numRows($db_table, ltrim($search_query, "WHERE "));
    $participants = $database->query($participant_sql);
    $numRow = $offset + 1;
    // echo $participant_sql;
  */ ?>
  <?php
    $competitions = $database->query("SELECT * FROM competitions ORDER BY `type` ASC, `name` ASC");
  ?>
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
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Lomba</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Daftar Perlombaan</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <?php include_once("./comps/navbar.top.php"); ?>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-lg-8 col-sm-12 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3" style="min-height: 300px;">
              <div class="d-flex align-items-center">
                <div class="flex-fill">
                  <h4 class="mb-0">Daftar Perlombaan</h4>
                  <small class="d-block mb-3"><?= number_format($competitions['total']) ?> perlombaan tersedia</small>
                </div>
              </div>

              <?php if(isset($_GET['_deleted'])){ ?>

              <div class="alert alert-success text-white alert-dismissible">
                Data peserta <u><?= $functions->sanitize("code", base64_decode($_GET['_deleted'])) ?></u> berhasil dihapus.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                  <i class="fas fa-times"></i>
                </button>
              </div>

              <?php } ?>
              <?php if(isset($_GET['error'])){ ?>

              <div class="alert alert-danger text-white alert-dismissible">
                <?php
                  switch($_GET['error']){
                    case "idnotfound":
                      echo "ID Peserta tidak ditemukan di sistem!";
                      break;
                    case "forbidden":
                      echo "Anda tidak mempunyai hak akses untuk melanjutkan!";
                      break;
                    case "invalid.argument":
                      echo "Terjadi Kesalahan!<br><small>Parameter tidak dikenali sistem.</small>";
                      break;
                    default:
                      echo "<b>Terjadi Kesalahan Sistem!</b><br><small>Laporkan ke administrator untuk penanganan lebih lanjut.</small>";
                      break;
                  }
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                  <i class="fas fa-times"></i>
                </button>
              </div>

              <?php } ?>
              
              <div class="list-group list-group-flush" id="">

                <?php /*
                  $listParticipant = $database->query("SELECT * FROM participant ORDER BY id ASC");
                  if($listParticipant['total']){
                    foreach($listParticipant['data'] as $participant){
                      $participantTeam = ($participant['team'] === NULL) ? "-" : $participant['team'];
                */ ?>
                <?php
                    if($competitions['total']){
                      foreach($competitions['data'] as $competition){
                        $isTeamMode = ($competition['type'] === "team");
                ?>

                <a class="list-group-item list-group-item-action px-0" href="<?= "./competitions.details.php?id={$competition['id']}" ?>">
                  <div class="d-flex align-items-center">
                    <div class="me-3 ms-2">
                      <div class="d-flex align-items-center justify-content-center p-1">
                        <div class="flex-fill">
                          <i class="<?= ($isTeamMode) ? "fas fa-users" : "far fa-user" ?> fa-fw" style="font-size: 1.5em;"></i>
                        </div>
                      </div>
                    </div>
                    <div class="flex-fill list-group-item-main">
                      <div>
                        <?= $competition['name']; ?>
                      </div>

                      <?php if(!is_null($competition['terms'])){ ?>

                      <small class="d-block" style="font-size: .8em; opacity: .6;">
                        <ul class="list-inline mb-0">
                          <?php
                            $listTerms = explode("\n", $competition['terms']);
                            foreach($listTerms as $term){
                              $term = trim($term);
                              echo "<li class=\"list-inline-item\">$term</li>";
                            }
                          ?>
                        </ul>
                      </small>

                      <?php } ?>

                    </div>
                    <div class="mx-3 text-end">

                      <?php if ($isTeamMode){ ?>

                      <div>
                        <span class="badge bg-success rounded-pill" style="font-size: .65em;">
                          Regu
                        </span>
                      </div>

                      <?php } else { ?>

                      <div>
                        <span class="badge bg-primary rounded-pill" style="font-size: .65em;">
                          Individu
                        </span>
                      </div>

                      <?php } ?>

                    </div>

                    <div class="me-2 align-self-center">
                      <i class="fas fa-chevron-right"></i>
                    </div>

                  </div>
                </a>

                <?php
                    }
                  } else {
                    echo '<li class="list-group-item text-center">Belum ada perlombaan yang ditambahkan.</li>';
                  }
                ?>

              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-sm-12 mb-xl-0 mb-4">
          <div class="card mb-4">
            <div class="card-body p-3">
              <div class="d-flex align-items-center">
                <div class="flex-fill">
                  <h4>Klasemen Regu</h4>
                </div>
              </div>
              <div class="mt-3 mb-2"></div>
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
          <div class="card mb-4">
            <div class="card-body p-3">
              <h4>5 Peserta Terbaik</h4>
              <hr class="horizontal dark mt-3 mb-2">
              <div class="list-group list-group-flush">

                <?php
                  $topten_query = "SELECT participant.*, (SELECT IFNULL(SUM(competition_transactions.point), 0) FROM competition_transactions WHERE competition_transactions.id_participant = participant.id) AS total_points FROM participant WHERE team IS NOT NULL ORDER BY total_points DESC LIMIT 5";
                  $toptens = $database->query($topten_query);
                  foreach($toptens['data'] as $topten){
                    $topten_name_encoded = urlencode($topten['fullname']);
                ?>

                <a class="list-group-item list-group-item-action" href="<?= "./participant.php?search={$topten_name_encoded}" ?>">
                  <div class="d-flex align-items-center">
                    <div class="flex-fill">
                      <?= $topten['fullname'] ?>
                    </div>
                    <div>
                      <?= $topten['total_points'] ?>
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

    $("#list-participant .list-group-item .list-group-item-main").on("click", function(e){
      $(this).find(".blockquote-footer").toggle(200);
    });

    $("[data-confirm=true]").on("click", function(e){
      let confirmText = $(this).attr("data-confirm-text");
      let cfr = confirm(confirmText);
      if(!cfr) e.preventDefault();
    });
  </script>
</body>

</html>

<?php
  $database->close();
?>