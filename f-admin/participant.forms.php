<?php
  require_once("./inc/config.inc.php");
  
  if (!$user){
    header("Location: ./?error=unauthorized"); exit();
  }

  $allowed_action = array("add", "edit");

  if((!isset($_GET['action'])) && (!in_array($_GET['action'], $allowed_action))){
    header("Location: ./participant.php?error=invalid.argument"); exit();
  } else {
    $action = $_GET['action'];
  }

  if($action === "edit"){
    $participant_id = intval($_GET['id']);
    $participant = $database->query("SELECT * FROM participant WHERE `id` = {$participant_id}");
    if($participant['total'] !== 1){
      header("Location: ./participant.php?error=idnotfound"); exit();
    } else {
      $participant_data = $participant['data'][0];
      $label_action = "Ubah Peserta";
    }
  } else {
    $label_action = "Tambah Peserta";
  }

  // $label_action = ($action === "edit") ? "Edit Peserta: {}" : "Tambah Peserta";

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title> <?= $label_action; ?> </title>
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
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="./participant.php?_">Peserta</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page"><?= $label_action ?></li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0"><?= $label_action ?></h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <?php include_once("./comps/navbar.top.php"); ?>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-lg-8 col-sm-12 offset-lg-2 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3" style="min-height: 300px;">
              <div class="d-flex align-items-center">
                <div class="flex-fill">
                  <h4>
                    <?= $label_action ?>
                    <?= ($action === "edit") ? ": {$participant_data['fullname']}" : "" ?>
                  </h4>
                </div>
              </div>

              <?php if(isset($_GET['_success'])){ ?>

              <div class="my-3">
                <div class="alert alert-success text-white alert-dismissible">
                  <div>Data peserta telah disimpan. <a href="./participant.php?_list"><small>Lihat Data</small></a></div>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>

              <?php } ?>
              
              <form method="post" action="./processor/participant.php" id="form_participant">
                <div class="form-group mt-3">
                  <label class="form-control-label" for="tx_fullname">Nama Lengkap</label>
                  <input type="text" class="form-control" name="tx_fullname" id="tx_fullname" value="<?= ($action === "edit") ? $participant_data['fullname'] : "" ?>" placeholder="<?= ($action === "edit") ? $participant_data['fullname'] : "" ?>">
                  <div class="form-text text-danger"></div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-control-label" for="tx_callname">Nama Panggilan</label>
                      <input type="text" class="form-control" name="tx_callname" id="tx_callname" value="<?= ($action === "edit") ? $participant_data['callname'] : "" ?>" placeholder="<?= ($action === "edit") ? $participant_data['callname'] : "" ?>">
                      <div class="form-text text-danger"></div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-control-label" for="tx_grouping">Kelompok Peserta</label>
                      <div class="d-flex align-items-center">
                        <select class="form-control me-2" name="tx_grouping" id="tx_grouping">
                          <option value="">- Pilih Kelompok -</option>
                          <?php
                            $list_grouping = $database->query("SELECT `grouping` FROM participant GROUP BY `grouping` ORDER BY `grouping` ASC");
                            if($list_grouping['total']){
                              foreach($list_grouping['data'] as $grouping){
                                $grouping_name = $grouping['grouping'];
                                if($action === "edit"){
                                  $grouping_label = ($grouping_name === $participant_data['grouping']) ? $grouping_name . " (Dipilih)" : $grouping_name;
                                  $grouping_selected = ($grouping_name === $participant_data['grouping']) ? "selected" : "";
                                } else {
                                  $grouping_label = $grouping_name;
                                  $grouping_selected = "";
                                }
                                
                                echo "<option value=\"{$grouping_name}\" {$grouping_selected}>{$grouping_label}</option>";
                              }
                            }
                          ?>
                        </select>
                        <button class="btn btn-outline-primary btn-icon-only btn-circle mb-0" type="button" id="add_grouping">
                          <i class="fas fa-plus"></i>
                        </button>
                      </div>
                      <div class="form-text text-danger"></div>
                    </div>
                  </div>
                </div>

                <?php if(($action === "edit") && ($user['superuser'])){ ?>

                <div class="form-group mb-5">
                  <label class="form-control-label" for="tx_team">Regu</label>
                  <div class="input-group">
                    <select class="form-control" name="tx_team" id="tx_team">
                      <option value="">- Pilih Regu -</option>
                      <?php
                        $list_team = $database->query("SELECT * FROM teams ORDER BY `name` ASC");
                        foreach($list_team['data'] as $team){
                          if($action === "edit"){
                            $team_label = ($team['id'] === $participant_data['team']) ? $team['name'] . " (Dipilih)" : $team['name'];
                            $team_selected = ($team['id'] === $participant_data['team']) ? "selected" : "";
                          } else {
                            $team_label = $team['name'];
                            $team_selected = "";
                          }
                          echo "<option value=\"{$team['id']}\" {$team_selected}>{$team_label}</option>";
                        }
                      ?>
                    </select>
                  </div>
                </div>

                <?php } ?>

                <div class="form-group mt-4 mb-1">
                  <input type="hidden" name="tx_action" id="tx_action" value="<?= $action ?>">
                  <?php if($action === "edit"){ ?>
                    <input type="hidden" name="tx_id" id="tx_id" value="<?= $participant_id ?>">
                  <?php } ?>
                  <button type="submit" class="btn btn-primary w-100 mb-0" id="btn_save">Simpan</button>
                  <?php /*
                  <button class="btn btn-primary">
                    <div class="spinner-border spinner-border-sm"></div>
                  </button>
                  */ ?>
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

    $("#add_grouping").on("click", function(e){
      let new_grouping = prompt("Ketikkan nama kelompok baru:");
      if((new_grouping === '') || (new_grouping === null)) return false;
      
      const arr = new_grouping.split(" ");
      for (var i = 0; i < arr.length; i++) {
        arr[i] = arr[i].charAt(0).toUpperCase() + arr[i].slice(1);
      }
      new_grouping = arr.join(" ");

      $("#tx_grouping option").removeAttr("selected");
      $('<option selected="selected" value="'+new_grouping+'">'+new_grouping+'</option>').appendTo("#tx_grouping");

    });

    $("#form_participant").on("submit", function(e){
      let $txFullname = $("#tx_fullname");
      let $txCallname = $("#tx_callname");
      let $txGrouping = $("#tx_grouping");
      let $txTeam = $("#tx_team");
      let errorOccured = false;

      $(this).find("input, select").removeClass("is-invalid");
      $(this).find(".form-text").text("");

      if ($txFullname.val().length < 2){
        errorOccured = true;
        $txFullname.addClass("is-invalid");
        $txFullname.next().text("Nama Lengkap wajib diisi!");
      }

      if ($txCallname.val().length < 2){
        errorOccured = true;
        $txCallname.addClass("is-invalid");
        $txCallname.next().text("Nama Panggilan wajib diisi! Untuk memudahkan pencarian data peserta.");
      }

      if ($txGrouping.val() === ""){
        errorOccured = true;
        $txGrouping.addClass("is-invalid");
        $txGrouping.parent().next().text("Kelompok harus dipilih sesuai kriteria!");
      }

      if(errorOccured){
        e.preventDefault();
        return false;
      }

      // e.preventDefault();
      $this = $(this);
      setTimeout(function(){
        $("#btn_save").html("<div class=\"spinner-border spinner-border-sm text-light\"></div>");
        $this.find("input, select, button").prop("disabled", true);
      }, 10);
    });
  </script>
</body>

</html>

<?php
  $database->close();
?>