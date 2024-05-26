<?php
  require_once("./inc/config.inc.php");
  
  if (!$user){
    header("Location: ./?error=unauthorized"); exit();
  }

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title> Daftar Regu </title>
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
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Peserta</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Regu</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Daftar Regu</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <?php include_once("./comps/navbar.top.php"); ?>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row justify-content-center">

        <?php
          $listTeam = $database->query("SELECT * FROM teams ORDER BY `name` ASC");
          foreach($listTeam['data'] as $team){
            $totalMember = $database->numRows("participant", "team = {$team['id']}");
        ?>

        <div class="col-lg-4 col-sm-12 mb-xl-0 mb-4">
          <div class="card mb-4">
            <div class="card-body p-3">
              <div class="d-flex align-items-center">
                <div class="me-3">
                  <img class="border border-light rounded-circle shadow-sm" src="../assets/img/teams/<?= $team['logo'] ?>" alt="Tim <?= $team['name'] ?>" width="64" height="64">
                </div>
                <div class="flex-fill">
                  <h4 class="mb-0"><?= $team['name'] ?></h4>
                  <small class="d-block mb-0"><?= $totalMember ?> anggota</small>
                </div>
              </div>
              <hr class="horizontal dark mt-3 mb-2">
              <div class="list-group list-group-flush">

                <?php
                  $listParticipant = $database->query("SELECT * FROM participant WHERE team = {$team['id']} ORDER BY `grouping` DESC");
                  $listColoring = array("bg-gradient-danger", "border border-success", "bg-gradient-info", "border border-warning");
                  $listColoringIndex = -1;
                  $listColoringCurrent = "";
                  foreach($listParticipant['data'] as $participant){
                    if($participant['grouping'] !== $listColoringCurrent){
                      $listColoringIndex++;
                      $listColoringCurrent = $participant['grouping'];
                    }
                ?>

                <div class="list-group-item">
                  <div class="d-flex align-items-center">
                    <div class="me-3">
                      <span class="badge <?= $listColoring[$listColoringIndex] ?> rounded-pill p-1 m-0" style="font-size: .65em;">&nbsp;</span>
                    </div>
                    <div class="flex-fill">
                      <?= $participant['fullname'] ?>
                    </div>
                  </div>
                </div>

                <?php } ?>

              </div>
            </div>
          </div>
        </div>

        <?php } ?>

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