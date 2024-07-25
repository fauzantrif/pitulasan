<?php
  require_once("./inc/config.inc.php");
  if (!$user){
    header("Location: ./?error=unauthorized"); exit();
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title> Score Board </title>
  <?php include_once("./comps/script.header.php"); ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body class="" style="overflow-x: hidden;">
  <div class="d-flex flex-column align-items-start w-75 vh-100 mx-auto py-4">
      <div class="mb-3 w-100">
        <div class="d-flex align-items-center justify-content-between">
          <div>
            <img src="../assets/img/logo/logo.png" alt="Logo FORMASI 103" class="cursor-pointer" onclick="openController()">
          </div>
          <div>
            <img src="./assets/img/hut-ri-79.color.png" alt="Logo 79 Indonesiaku" height="60">
          </div>
        </div>
      </div>
      <div class="w-100 screens py-3">
        <div class="screen collapse show" data-screen="home">
          <div class="text-center mb-4">
              <h2 id="tx_matchname">PAPAN SKOR</h2>
              <h4 id="tx_matchsubtitle">Perlombaan HUT ke-79 Republik Indonesia</h4>
              <div class="d-flex align-items-center justify-content-center mt-3">
                <h3 class="px-3 border rounded" id="tx_timer" data-timer-start="0">00 : 00</h3>
                <h3 class="px-2 bg-dark text-white rounded ms-1" style="display: none;" id="tx_extratime" data-extratime="0">+0</h3>
              </div>
          </div>
          <div class="row mt-5">
            <?php
              $maxScoreBoard = 2;
              for($x=1;$x<=8;$x++){
                $additionalClass = ($x <= $maxScoreBoard) ? "" : "d-none";
            ?>
            <div class="col my-2 <?= $additionalClass ?>" id="scoreboard-team-<?= $x ?>">
              <div class="card border text-center">
                <div class="card-body">
                  <h1 class="display-1 mb-0" style="font-size: 7rem;" data-team-score>0</h1>
                </div>
                <div class="card-footer">
                  <h3 data-team-name></h3>
                </div>
              </div>
            </div>
            <?php } ?>
            <input type="hidden" id="tx_maxScoreBoard" value="<?= $maxScoreBoard ?>">
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
  var timerOn = false;
  var timerInterval, currentTimerSecs;

  $(window).on("keyup", function(e){
    switch(e.keyCode){
      case 49:
        remotePress1();
        break;
      case 48:
        changeScreen("home");
        break;
    }
  });

  function openController(){
    window.open("./comps/score-board.controller.php?_", "score-board-controller", "width=500, height=500");
    // window.open("./comps/footer.php", "score-board-controller", "width=500, height=500");
  }

  function startTimer(){
    currentTimerSecs = parseInt( $("#tx_timer").attr("data-timer-start") ) * 60;
    timerOn = true;
    var timerFunction =function(){
      if(!timerOn) return;
      var xMinute = Math.floor( currentTimerSecs / 60 );
      var xSecond = currentTimerSecs - (xMinute * 60);
      var stMinute = (xMinute < 10) ? "0" + xMinute : xMinute.toString();
      var stSecond = (xSecond < 10) ? "0" + xSecond : xSecond.toString();
      $("#tx_timer").text( stMinute + " : " + stSecond );
      currentTimerSecs++;
    }
    timerInterval = setInterval(timerFunction, 1000);
    timerFunction();
  }

  function resetTimer(){
    clearInterval( timerInterval );
  }
</script>

</html>

<?php
  $database->close();
?>