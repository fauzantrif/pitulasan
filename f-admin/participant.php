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
  <title> Peserta </title>
  <?php include_once("./comps/script.header.php"); ?>
</head>

<body class="g-sidenav-show   bg-gray-100">
  <?php
    $limit = 10;
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
        case "tim":
          $prefix_search = intval($prefix_search);
          if(!$prefix_search) $prefix_search = "NULL";
          $search_query = "WHERE team = {$prefix_search}";
          $orderBy_query = "ORDER BY grouping DESC";
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
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Peserta</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Daftar Peserta</h6>
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
                  <h4 class="mb-0">Daftar Peserta</h4>
                  <small class="d-block mb-3"><?= number_format($total_participant) ?> data ditemukan</small>
                </div>
                <div>
                  <a href="./participant.forms.php?action=add" class="btn btn-icon btn-3 btn-outline-primary">
                    Tambah
                  </a>
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
              
              <ul class="list-group list-group-flush list-group-striped" id="list-participant">

                <?php /*
                  $listParticipant = $database->query("SELECT * FROM participant ORDER BY id ASC");
                  if($listParticipant['total']){
                    foreach($listParticipant['data'] as $participant){
                      $participantTeam = ($participant['team'] === NULL) ? "-" : $participant['team'];
                */ ?>
                <?php
                    if($total_participant){
                      foreach($participants['data'] as $participant){
                ?>

                <li class="list-group-item px-0">
                  <div class="d-flex align-items-center">
                    <div class="me-3 ms-2">
                      <div class="d-flex align-items-center justify-content-center p-1">
                        <div class="flex-fill">
                          <i class="far fa-user" style="font-size: 1.5em;"></i>
                        </div>
                      </div>
                    </div>
                    <div class="flex-fill list-group-item-main cursor-pointer">
                      <small class="d-block"><?= $participant['callname']; ?></small>
                      <div><?= $participant['fullname']; ?></div>
                      <div style="font-size: .75rem; display: none;" class="ps-2 my-2 blockquote-footer">
                        ditambahkan <abbr title="<?= $functions->getDateTime( $participant['date_added'] ) ?>"><?= $timeago->inWordsFromStrings( $participant['date_added'] ) . " yang lalu" ?></abbr>
                        oleh <strong><?= $functions->getAdmin( $participant['added_by'] )['fullname'] ?></strong>
                      </div>
                    </div>
                    <div class="mx-3 text-end">
                      <div>
                        <span class="badge bg-primary rounded-pill" style="font-size: .65em;">
                          <?= $participant['grouping']; ?>
                        </span>
                      </div>

                      <?php
                        if($participant['team'] !== null){
                          $team_name = $database->query("SELECT * FROM teams WHERE id = {$participant['team']}")['data'][0]['name'];
                      ?>

                      <div>
                        <span class="badge bg-gradient-success rounded-pill" style="font-size: .65em;">
                          <?= $team_name; ?>
                        </span>
                      </div>

                      <?php } ?>

                    </div>

                    <div class="dropdown me-2">
                      <button class="btn btn-icon-only btn-sm btn-outline-primary btn-circle mb-0" type="button" data-bs-toggle="dropdown">
                        <span class="btn-inner--icon"><i class="fas fa-ellipsis-v"></i></span>
                      </button>
                      <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                          <a href="./participant.forms.php?action=edit&id=<?= $participant['id'] ?>" class="dropdown-item">Ubah</a>
                        </li>

                        <?php if($user['superuser']){ ?>
                          
                        <li>
                          <a href="./processor/participant.php?action=delete&id=<?= $participant['id'] ?>" class="dropdown-item link-danger" data-confirm="true" data-confirm-text="Anda yakin akan menghapus peserta <?= $participant['fullname'] ?>? Sekali dihapus harus menambahkannya lagi.">Hapus</a>
                        </li>

                        <?php } ?>

                      </ul>
                    </div>

                  </div>
                </li>

                <?php
                    }
                  } else {
                    echo '<li class="list-group-item text-center">Peserta tidak ditemukan.</li>';
                  }
                ?>

              </ul>
              <div class="mt-4">
                <?php
                    $link = "./participant.php?_lookup";
                    if(isset($_GET['search'])) $link .= "&search=" . urlencode($_GET['search']);
                    $pages = ceil($total_participant / $limit); // Total number of pages
                    $paginations = $functions->get_pagination_links($page, $pages);
                    // $paginations = $functions->get_pagination_links(3, 19);

                    echo "<ul class=\"pagination justify-content-center pagination-primary\">";
                    foreach($paginations as $pagination){
                        $active = ($page === $pagination) ? "active" : "";
                        $ellipsis = (!is_int($pagination));
                        $disabled = ($ellipsis) ? "disabled" : "";
                        $border0 = ($ellipsis) ? "border-0" : "";
                        $link2page = $link . "&page=" . $pagination;
                        echo "<li class=\"page-item {$active} {$disabled}\">";
                            echo "<a href=\"{$link2page}\" class=\"page-link {$border0}\">{$pagination}</a>";
                        echo "</li>";
                    }
                    echo "</ul>";
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-sm-12 mb-xl-0 mb-4">
          <div class="card mb-4">
            <div class="card-body p-3">
              <h4>Kelompok</h4>
              <hr class="horizontal dark mt-3 mb-2">
              <div class="list-group list-group-flush">
                <a class="list-group-item list-group-item-action" href="<?= "./participant.php?_" ?>">
                  <div class="d-flex align-items-center">
                    <div class="flex-fill">
                      Semua Peserta
                    </div>
                    <div>
                      <span class="badge bg-secondary" style="font-size: .65em;">
                        <?= $database->numRows("participant") ?>
                      </span>
                    </div>
                  </div>
                </a>

                <?php
                  $listGrouping = $database->query("SELECT `grouping`, COUNT(*) AS total FROM participant GROUP BY `grouping` ORDER BY `grouping` ASC");
                  foreach($listGrouping['data'] as $grouping){
                    $grouping_encoded = urlencode($grouping['grouping']);
                    if((isset($prefix_search_criteria)) && ($prefix_search_criteria === "kel")){
                      if ($prefix_search === $grouping['grouping']){
                        $listSelected = "bg-gradient-secondary text-white font-weight-bold rounded";
                        $badgeSelected = true;
                      } else {
                        $listSelected = "";
                        $badgeSelected = false;
                      }
                    }
                ?>

                <a class="list-group-item list-group-item-action <?= $listSelected ?>" href="<?= "./participant.php?search=kel:{$grouping_encoded}" ?>">
                  <div class="d-flex align-items-center">
                    <div class="flex-fill">
                      <?= $grouping['grouping'] ?>
                    </div>
                    <div>
                      <span class="badge <?= ($badgeSelected) ? "bg-light text-primary" : "bg-secondary" ?>" style="font-size: .65em;">
                        <?= $grouping['total'] ?>
                      </span>
                    </div>
                  </div>
                </a>

                <?php } ?>

              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-body p-3">
              <div class="d-flex align-items-center">
                <div class="flex-fill">
                  <h4>Regu</h4>
                </div>
                <div>
                  <a href="./participant.teamlist.php?_" class="btn btn-icon-only btn-outline-primary mb-0">
                    T
                  </a>
                </div>
              </div>
              <hr class="horizontal dark mt-3 mb-2">
              <div class="list-group list-group-flush">

                <?php
                  $listTeam = $database->query("SELECT * FROM teams ORDER BY `name` ASC");
                  foreach($listTeam['data'] as $team){
                    $totalMember = $database->numRows("participant", "team = {$team['id']}");
                    if(isset($prefix_search_criteria))
                      $activatedSelect = (($prefix_search_criteria === "tim") && ($prefix_search === intval($team['id']))) ? "active rounded" : "";
                      else $activatedSelect = "";
                      // var_dump($team['id']);
                ?>

                <a class="list-group-item list-group-item-action <?= $activatedSelect ?>" href="<?= "./participant.php?search=tim:{$team['id']}" ?>">
                  <div class="d-flex align-items-center">
                    <div class="me-3">
                      <img class="border border-light rounded-circle shadow-sm" src="../assets/img/teams/<?= $team['logo'] ?>" alt="Tim <?= $team['name'] ?>" width="48" height="48">
                    </div>
                    <div class="flex-fill">
                      <?= $team['name'] ?>
                      <small class="description">
                        <ul class="list-inline mb-0">
                          <li class="list-inline-item">
                            <?= $totalMember ?> anggota
                          </li>
                        </ul>
                      </small>
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