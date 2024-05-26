<?php
  require_once("./inc/config.inc.php");
  require_once("./vendor/Westsworld/TimeAgo.php");
  require_once("./vendor/Westsworld/TimeAgo/Language.php");
  require_once("./vendor/Westsworld/TimeAgo/Translations/Id.php");
  
  if (!$user){
    header("Location: ./?error=unauthorized"); exit();
  }

  if(!$user['superuser']){
    header("Location: ./403.php?error=unauthorized"); exit();
  }

  use \Westsworld\TimeAgo;
  $timeago_lang = new \Westsworld\TimeAgo\Translations\Id();
  $timeago = new \Westsworld\TimeAgo($timeago_lang);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title> Administrator </title>
  <?php include_once("./comps/script.header.php"); ?>
</head>

<body class="g-sidenav-show   bg-gray-100">
  <?php
    $limit = 5;
    $page = (isset($_GET['page'])) ? intval($_GET['page']) : 1;
    $db_table = "admins";
    $search = ((isset($_GET['search'])) && (strlen($_GET['search']) >= 1)) ? $database->sanitizeInput($_GET['search']) : false;
    $search_query = (is_string($search)) ? "WHERE username LIKE '%{$search}%' OR fullname LIKE '%{$search}%'" : "";
    $orderBy = false;
    $orderBy_query = "ORDER BY `fullname` ASC";

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
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Admin</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Daftar Admin</h6>
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
                  <h4 class="mb-0">Daftar Admin</h4>
                  <small class="d-block mb-3"><?= number_format($total_participant) ?> data ditemukan</small>
                </div>
              </div>

              <?php if(isset($_GET['_success'])){ ?>

              <div class="alert alert-success text-white alert-dismissible">
                Admin berhasil ditambah.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                  <i class="fas fa-times"></i>
                </button>
              </div>

              <?php } ?>
              <?php if(isset($_GET['_deleted'])){ ?>

              <div class="alert alert-success text-white alert-dismissible">
                Admin <u><?= $functions->sanitize("code", base64_decode($_GET['_deleted'])) ?></u> berhasil dihapus.
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
                      echo "Admin tidak ditemukan di sistem!";
                      break;
                    case "forbidden":
                      echo "Anda tidak mempunyai hak akses untuk melanjutkan<br>atau tidak bisa menghapus diri sendiri!";
                      break;
                    case "invalid.argument":
                      echo "Terjadi Kesalahan!<br><small>Parameter tidak dikenali sistem.</small>";
                      break;
                    case "duplicate.username":
                      echo "Terjadi Kesalahan!<br><small>Duplikat nama pengguna ditemukan.</small>";
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

                <?php
                    if($total_participant){
                      foreach($participants['data'] as $participant){
                ?>

                <li class="list-group-item px-0 <?= ($user['id'] === $participant['id']) ? "bg-dark text-light rounded-pill px-2": "" ?>">
                  <div class="d-flex align-items-center">
                    <div class="me-3 ms-2">
                      <div class="d-flex align-items-center justify-content-center p-1">
                        <div class="flex-fill">
                          <i class="<?= ($participant['superuser']) ? "fa fa-user-cog" : "far fa-user" ?>" style="font-size: 1.5em;"></i>
                        </div>
                      </div>
                    </div>
                    <div class="flex-fill list-group-item-main">
                      <small class="d-block">
                        <div class="d-flex align-items-center">
                          <div class="me-3"><?= $participant['username']; ?></div>
                        </div>
                        
                        
                      </small>
                      <div><?= $participant['fullname']; ?></div>
                    </div>
                    <div class="mx-2 text-end">
                      <div>

                        <?php if($participant['superuser']){ ?>
                        <span class="badge bg-danger rounded-pill" style="font-size: .65em;">
                          Superuser
                        </span>
                        <?php } ?>

                      </div>
                    </div>

                    <?php if($user['id'] !== $participant['id']){ ?>
                    <div class="me-2">

                        <a href="./processor/admins.php?action=delete&id=<?= $participant['id'] ?>" class="btn btn-icon-only btn-sm btn-outline-danger btn-circle mb-0" data-confirm="true" data-confirm-text="Anda yakin akan menghapus admin <?= $participant['fullname'] ?>?">
                          <span class="btn-inner--icon"><i class="fas fa-trash-alt"></i></span>
                        </a>
                      
                    </div>
                    <?php } ?>

                  </div>
                </li>

                <?php
                    }
                  } else {
                    echo '<li class="list-group-item text-center">Admin tidak ditemukan.</li>';
                  }
                ?>

              </ul>
              <div class="mt-4">
                <?php
                    $link = "./admins.php?_lookup";
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
          
          <?php 
            $tx_fullname = $tx_username = $tx_password = "";
            $tx_superuser = 0;
            
            if(isset($_GET['formdata'])){
              $encoded_formData = $_GET['formdata'];
              $decoded_formData = base64_decode($encoded_formData);
              $formData = json_decode($decoded_formData, true);
              // print_r($decoded_formData);
              if(($encoded_formData === base64_encode($decoded_formData)) && (json_last_error() === JSON_ERROR_NONE)){
                $tx_username = (isset($formData['tx_username'])) ? $formData['tx_username'] : "";
                $tx_fullname = (isset($formData['tx_fullname'])) ? $formData['tx_fullname'] : "";
                $tx_password = (isset($formData['tx_password'])) ? $formData['tx_password'] : "";
                $tx_superuser = (isset($formData['tx_superuser'])) ? intval($formData['tx_superuser']) : 0;

                if($tx_password === "123456") $tx_password = "";
              }
            }
          ?>

          <div class="card mb-4">
            <div class="card-body p-3">
              <h5>Tambah Admin</h5>
              <hr class="horizontal dark mt-3 mb-2">
              <form action="./processor/admins.php" method="post" id="form_admins">
                <div class="form-group">
                  <label class="form-control-label" for="tx_username">Nama Pengguna</label>
                  <input type="text" class="form-control <?= (isset($_GET['error']) && ($_GET['error'] === "duplicate.username")) ? "is-invalid" : "" ?>" name="tx_username" id="tx_username" value="<?= $tx_username ?>">
                  <div class="form-text text-danger"></div>
                </div>
                <div class="form-group">
                  <label class="form-control-label" for="tx_fullname">Nama Lengkap</label>
                  <input type="text" class="form-control" name="tx_fullname" id="tx_fullname" value="<?= $tx_fullname ?>">
                  <div class="form-text text-danger"></div>
                </div>
                <div class="form-group">
                  <label class="form-control-label" for="tx_password">Sandi</label>
                  <input type="text" class="form-control" name="tx_password" id="tx_password" placeholder="123456" value="<?= $tx_password ?>">
                  <div class="form-text text-danger"></div>
                </div>
                <div class="form-check form-switch my-4">
                  <input class="form-check-input" type="checkbox" id="tx_superuser" name="tx_superuser" value="1" <?= ($tx_superuser) ? "checked=\"checked\"" : "" ?>>
                  <label class="form-check-label" for="tx_superuser">
                    <ul class="list-inline mb-0">
                      <li class="list-inline-item">Superuser</li>
                      <li class="list-inline-item">
                        <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip" data-bs-trigger="focus" data-bs-title="Superuser adalah hak akses paling tinggi di sistem (Full Control).">
                          <i class="far fa-question-circle"></i>
                        </a>
                      </li>
                    </ul>
                  </label>
                </div>
                <div class="form-group mt-4 mb-1">
                  <input type="hidden" name="tx_action" id="tx_action" value="add">
                  <button type="submit" class="btn btn-primary w-100 mb-0" id="btn_save">Tambah</button>
                </div>
              </form>
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

    $("[data-confirm=true]").on("click", function(e){
      let confirmText = $(this).attr("data-confirm-text");
      let cfr = confirm(confirmText);
      if(!cfr) e.preventDefault();
    });

    $("#form_admins").on("submit", function(e){
      let $txFullname = $("#tx_fullname");
      let $txUsername = $("#tx_username");
      let $txPassword = $("#tx_password");
      let $txSuperuser = $("#tx_superuser");
      let errorOccured = false;

      $(this).find("input").removeClass("is-invalid");
      $(this).find(".form-text").text("");

      if ($txFullname.val().length < 2){
        errorOccured = true;
        $txFullname.addClass("is-invalid");
        $txFullname.next().text("Nama Lengkap wajib diisi!");
      }

      if ($txUsername.val().length < 2){
        errorOccured = true;
        $txCallname.addClass("is-invalid");
        $txCallname.next().text("Nama Pengguna wajib diisi!");
      }

      if (($txPassword.val().length >= 1) && ($txPassword.val().length < 4)){
        errorOccured = true;
        $txPassword.addClass("is-invalid");
        $txPassword.parent().next().text("Sandi wajib minimal 5 karakter!");
      }

      if(errorOccured){
        e.preventDefault();
        return false;
      }

      // e.preventDefault();
      $this = $(this);
      setTimeout(function(){
        $("#btn_save").html("<div class=\"spinner-border spinner-border-sm text-light\"></div>");
        $this.find("input, button").prop("disabled", true);
      }, 10);
    });
  </script>
</body>

</html>

<?php
  $database->close();
?>