<?php
  require_once("./inc/config.inc.php");
  if (!$user){
    header("Location: ./?error=unauthorized"); exit();
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title> Live Score </title>
  <?php include_once("./comps/script.header.php"); ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body class="" style="overflow-x: hidden;">
  <div class="d-flex flex-column align-items-start w-75 vh-100 mx-auto py-4">
      <div class="mb-3 w-100">
        <div class="d-flex align-items-center justify-content-between">
          <div>
            <img src="../assets/img/logo/logo.png" alt="Logo FORMASI 103">
          </div>
          <div>
            <img src="../assets/img/logo/logo_78.png" alt="Logo 78 Indonesiaku" height="60">
          </div>
        </div>
      </div>
      <div class="w-100 screens py-3">
        <div class="screen collapse show" data-screen="home">
          <div class="text-center mb-4">
              <h2>LIVE SCORE</h2>
              <h5>Perlombaan HUT ke-78 Republik Indonesia</h5>
          </div>
          <div class="row">
              <div class="col-md-4">
                <div class="card mt-4">
                  <div class="card-body">
                    <div class="d-flex">
                      <div class="me-3 px-2" style="font-size: 3em;">1</div>
                      <div class="flex-fill">
                        <h5>Klasemen Tim</h5>
                        <p>Tekan tombol 1 untuk menampilkan klasemen tim saat ini.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card mt-4">
                  <div class="card-body">
                    <div class="d-flex">
                      <div class="me-3 px-2" style="font-size: 3em;">2</div>
                      <div class="flex-fill">
                        <h5>Hasil Lomba Terbaru</h5>
                        <p>Tekan tombol 2 untuk menampilkan hasil pertandingan terakhir.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card mt-4">
                  <div class="card-body">
                    <div class="d-flex">
                      <div class="me-3 px-2" style="font-size: 3em;">3</div>
                      <div class="flex-fill">
                        <h5>Peserta Terbaik</h5>
                        <p>Tekan tombol 3 untuk menampilkan daftar peserta terbaik (poin tertinggi).</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <div class="mt-5 text-center">
            <small class="opacity-25">
              &copy; Copyright 2023 Fauzan. All Rights Reserved.
            </small>
          </div>
        </div>

        <div class="screen collapse" data-screen="klasemen">
          <div class="text-center mb-4">
              <h2>Klasemen Tim</h2>
          </div>
          <div class="list-group list-group-flush w-50 mx-auto">
            
          </div>
        </div>

      </div>
    </div>
  </div>
  <div class="d-none" data-content="master">
    <div data-master="klasemen">
      <div class="list-group-item border border-primary rounded my-1 animate__animated animate__fadeInRight">
        <div class="d-flex align-items-center">
          <div style="font-size: 1.5em;" data-master-content="place">1</div>
          <div class="mx-3">
              <img data-master-content="team_logo" class="border border-light rounded-circle shadow-sm" src="../assets/img/teams/team_garuda.png" alt="Tim " width="48" height="48">
          </div>
          <div class="flex-fill me-3" data-master-content="team_name"></div>
          <div data-master-content="total_point" class="font-weight-bold"></div>
        </div>
      </div>
    </div>
  </div>
</body>

<?php include_once("./comps/script.footer.php"); ?>
<script>
  $(window).on("keyup", function(e){
    switch(e.which){
      case 49:
        changeScreen("klasemen");
        setTimeout(getKlasemen, 500);
        // getKlasemen();
        break;
      case 48:
        changeScreen("home");
        break;
    }
  });

  function changeScreen(screenName){
    var $screen = $(".screen[data-screen='"+screenName+"']");
    if($screen.length){
      $(".screens .screen").slideUp();
      $screen.slideDown();
    }
  }

  function getKlasemen(){
    var getData = $.getJSON("./processor/live-score.php?action=klasemen");
    getData.done(function(data){
      var currentAnim = 0;
      var stepAnim = 0.4;
      $(".screen[data-screen=klasemen] .list-group").html("");
      for($i=0;$i<data.length;$i++){
        var $elem = $( $("[data-content=master] [data-master=klasemen]").html() );
        $elem.css("animation-delay", currentAnim + "s");
        if($i > 2){
          $elem.removeClass("border-primary");
        }
        $elem.find("[data-master-content=place]").text($i + 1);
        $elem.find("[data-master-content=team_logo]").attr("src", "../assets/img/teams/" + data[$i]['team_logo']);
        $elem.find("[data-master-content=team_name]").text(data[$i]['team_name']);
        $elem.find("[data-master-content=total_point]").text(data[$i]['total_points']);
        $elem.appendTo( $(".screen[data-screen=klasemen] .list-group") );
        currentAnim = currentAnim + stepAnim;

      }
      // $(".screen[data-screen=klasemen] .list-group .list-group-item").each(function(){
      //   var $this = $(this);
      //   setTimeout(function(){
      //     $this.attr("style", "").addClass("animate__animated animate__fadeInRight");
      //   }, 1000);
      // });
    });
  }
</script>

</html>

<?php
  $database->close();
?>