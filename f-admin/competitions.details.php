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

  $id_comp = intval($_GET['id']);
  if(!$id_comp){
    header("Location: ./competitions.php?error=invalid"); exit();
  }
  $competition = $database->query("SELECT * FROM competitions WHERE id = {$id_comp}");
  if($competition['total'] !== 1){
    header("Location: ./competitions.php?error=notfound"); exit();
  }
  $competition = $competition['data'][0];
  $isTeamMode = ($competition['type'] === "team");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title> Perlombaan: <?= $competition['name'] ?> </title>
  <?php include_once("./comps/script.header.php"); ?>
</head>

<body class="g-sidenav-show   bg-gray-100">
  <?php
    
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
            <li class="breadcrumb-item text-sm" aria-current="page"><a class="opacity-5 text-white" href="javascript:;">Lomba</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page"><?= $competition['name'] ?></li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Lomba: <?= $competition['name'] ?></h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <?php include_once("./comps/navbar.top.php"); ?>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12 mb-4">
          <div class="card mb-4">
            <div class="card-body p-3" style="min-height: auto;">
              <div class="d-flex align-items-center">
                <div class="flex-fill">
                  <h4 class="mb-2">Lomba: <?= $competition['name'] ?></h4>
                  <small class="d-block mb-1">
                    <ul class="list-inline mb-0">
                      <li class="list-inline-item me-1">

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

                      </li>
                      <?php
                        $listTerms = explode("\n", $competition['terms']);
                        foreach($listTerms as $term){
                          $term = trim($term);
                          echo "<li class=\"list-inline-item\"><span class=\"me-1\">&bull;</span> $term</li>";
                        }
                      ?>
                    </ul>
                  </small>
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
              
              
            </div>
          </div>

          <?php
            if($isTeamMode) include_once("./comps/competitions.details.team.php"); else include_once("./comps/competitions.details.individual.php");
          ?>
        </div>
      </div>
      
      <?php include_once("./comps/footer.php"); ?>
    </div>
  </main>
  
  <?php include_once("./comps/script.footer.php"); ?>
  <script>
    $.fn.updatePoint = function() {
      return this.each(function(){
        var maxPoint = 100;
        var stepping = 5;
        var minPoint = 15;
        var currentPoint = maxPoint;
        $(this).children(".list-group-item").each(function(){
          $(this).find("input[type=number]").val(currentPoint);
          currentPoint = currentPoint - stepping;
          if(currentPoint <= minPoint) currentPoint = minPoint;
        });

      })
    }
    $.fn.moveDown = function() {
        return this.each(function() {
            var next = $(this).next();
            if ( next.length ) {
                $(next).after(this);
            } else {
              // $(this).parent().append( this );
              console.error("Reached at bottom!");
            }
        })
    }
    $.fn.moveUp = function() {
        return this.each(function() {
            var prev = $(this).prev();
            if ( prev.length ) {
                $(prev).before(this);
            } else {
              // $(this).parent().append( this );
              console.error("Reached at top!");
            }
        })
    }
    function elemMoveDown($idElem){
      $idElem = $($idElem);
      $idElem.moveDown();
      $idElem.parent().updatePoint();
    }
    function elemMoveUp($idElem){
      $idElem = $($idElem);
      $idElem.moveUp();
      $idElem.parent().updatePoint();
    }
    function elemDelete($idElem){
      $idElem = $($idElem);
      $parentElem = $idElem.parent();
      $idElem.remove();
      $parentElem.updatePoint();
    }
    function addToList(elem, target){
      $elem = $(elem);
      $target = $("#" + target);
      $leaderboard_elem = $( $elem.find("div[data-list=participant]").html() );
      $leaderboard_id = $leaderboard_elem.attr("data-id");
      if($target.find("#" + $leaderboard_id).length){
        alert("Data peserta sudah ditambahkan!"); return;
      }
      $leaderboard_elem.removeAttr("data-id").attr("id", $leaderboard_id);
      $target.append( $leaderboard_elem );
      $target.updatePoint();
    }
    function listReset(target){
      var cfr = confirm("Anda yakin mengatur ulang? Semua daftar point diatas akan terhapus.")
      if(cfr){
        $target = $("#" + target);
        $target.html("");
      }
    }
    
    function confirmLink(elem, event){
      $elem = $(elem);
      var cfr = confirm($elem.attr("data-confirm"));
      if(!cfr){
        event.preventDefault();
      }
    }

    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }

    $("#modalopener-add-matchs").on("click", function(e){
      $("#modal-add-match").modal()
    });

    $("[data-sc-mode=participant]").on("keyup", function(e){
      var value = $(this).val().toLowerCase();
      var scTarget = $(this).attr("data-sc-target");
      $(scTarget).find(".list-group-item").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
    
  </script>
</body>

</html>

<?php
  $database->close();
?>