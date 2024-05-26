<?php
  require_once("./inc/config.inc.php");
  
  if (!$user){
    header("Location: ./?error=unauthorized"); exit();
  }

  // $label_action = ($action === "edit") ? "Edit Peserta: {}" : "Tambah Peserta";

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title> Akun &amp; Setelan </title>
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
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="./admins.php?_">Admin</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page"><?= $user['fullname'] ?></li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Akun &amp; Setelan</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <?php include_once("./comps/navbar.top.php"); ?>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-lg-10 col-sm-12 offset-lg-1 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3" style="min-height: 300px;">
              <div class="d-flex m-2 mb-3 align-items-center">
                <div class="me-3">
                  <i class="far fa-user-circle" style="font-size: 3em"></i>
                </div>
                <div class="flex-fill">
                  <h3 class="">
                    <?= $user['fullname'] ?>
                  </h3>
                  <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                      <span class="badge bg-gradient-secondary">@<?= $user['username'] ?></span>
                    </li>

                    <?php if($user['superuser']){ ?>
                      <li class="list-inline-item">
                        <span class="badge bg-gradient-danger">Superuser</span>
                      </li>
                    <?php } ?>
                  </ul>
                </div>
                <div class="d-none d-md-block">
                  <button class="btn btn-outline-primary rounded mb-0">
                    Keluar
                  </button>
                </div>
              </div>

              <?php if(isset($_GET['error'])){ ?>

                <div class="mt-5">
                  <div class="alert bg-danger text-white">
                    <?php
                      switch($_GET['error']){
                        case "invalid.name":
                          echo "Nama harus memuat minimal 5 karakter!";
                          break;
                        case "wrong.pass":
                          echo "Sandi Lama Anda tidak sesuai!";
                          break;
                        case "unmatched.pass":
                          echo "Pastikan sandi baru Anda ketik 2x!";
                          break;
                        case "weak.pass":
                          echo "Sandi Baru Anda terlalu pendek! Minimal 5 karakter.";
                          break;
                        default:
                          echo "Terjadi kesalahan yang tak terduga!";
                          break;
                      }
                    ?>
                  </div>
                </div>
                

              <?php } ?>

              <div class="mt-2">
                <div class="row">
                  <div class="col-md-6">
                    <div class="card shadow-none border my-4">
                      <div class="card-body p-3">
                        <h6>Ubah Nama</h6>
                        <form action="./processor/account.php" method="post" data-form="edit_account">
                          <div class="form-group">
                            <!-- <label class="form-control-label" for="tx_fullname">Nama Lengkap</label> -->
                            <input type="text" class="form-control" name="tx_fullname" id="tx_fullname" value="<?= $user['fullname'] ?>">
                            <div class="form-text text-danger"></div>
                          </div>
                          <div class="form-group mt-4 mb-1">
                            <input type="hidden" name="tx_action" value="edit_name">
                            <button type="submit" class="btn btn-primary w-100 mb-0">Simpan</button>
                          </div>
                        </form>
                      </div>
                    </div>
                    <div class="card shadow-none border my-4">
                      <div class="card-body p-3">
                        <h6>Tema</h6>
                        <div class="form-check form-switch mt-2">
                          <input class="form-check-input" type="checkbox" disabled id="tx_darkmode" name="tx_darkmode" value="1" <?= ($web_darkmode) ? "checked=\"checked\"" : "" ?>>
                          <label class="form-check-label" for="tx_darkmode">
                            Mode Gelap
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="card shadow-none border my-4">
                      <div class="card-body p-3">
                        <h6>Ubah Sandi</h6>
                        <form action="./processor/account.php" method="post" data-form="edit_account">
                          <div class="form-group">
                            <label class="form-control-label" for="tx_oldpass">Sandi Lama</label>
                            <input type="password" class="form-control" name="tx_oldpass" id="tx_oldpass" value="">
                            <div class="form-text text-danger"></div>
                          </div>
                          <div class="form-group">
                            <label class="form-control-label" for="tx_newpass">Sandi Baru</label>
                            <input type="password" class="form-control" name="tx_newpass" id="tx_newpass" value="">
                            <div class="form-text text-danger"></div>
                          </div>
                          <div class="form-group">
                            <label class="form-control-label" for="tx_newpass_verify">Ketik Ulang Sandi Baru</label>
                            <input type="password" class="form-control" name="tx_newpass_verify" id="tx_newpass_verify" value="">
                            <div class="form-text text-danger"></div>
                          </div>
                          <div class="form-check form-switch mt-4">
                            <input class="form-check-input" type="checkbox" id="tx_endsession" name="tx_endsession" value="1" checked>
                            <label class="form-check-label" for="tx_endsession">
                              Akhiri sesi setelah sandi terganti
                            </label>
                          </div>
                          <div class="form-group mt-4 mb-1">
                            <input type="hidden" name="tx_action" value="change_pass">
                            <button type="submit" class="btn btn-primary w-100 mb-0">Ganti</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <?php include_once("./comps/footer.php"); ?>
    </div>
  </main>
  
  <?php include_once("./comps/script.footer.php"); ?>
  <script src="../assets/js/jquery.cookie.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }

    $("#tx_darkmode").on("change", function(e){
      let isEnabled = $(this).prop("checked");
      if(isEnabled){
        $("body").addClass("dark-version");
        $("#sidenav-main").removeClass("bg-white").addClass("bg-default");
      } else {
        $("body").removeClass("dark-version");
        $("#sidenav-main").removeClass("bg-default").addClass("bg-white");
      }
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