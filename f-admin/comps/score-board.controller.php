<?php
require_once("../inc/config.inc.php");
if (!$user) {
    header("Location: ../?error=unauthorized");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> Score Board Controller </title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../assets/img/favicon.ico">

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/argon-dashboard.css" rel="stylesheet" />
    <link id="pagestyle" href="../assets/css/tripath.style.css?v=1.0" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body class="" style="overflow-x: hidden;">

    <div class="bg-primary mb-3">
        <div class="row">
            <div class="col-12 p-3 text-center">
                <h3 class="text-white">Score Board Controller</h3>
            </div>
        </div>
    </div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general-tab-pane" type="button" role="tab" aria-controls="general-tab-pane" aria-selected="true">Umum</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="timer-tab" data-bs-toggle="tab" data-bs-target="#timer-tab-pane" type="button" role="tab" aria-controls="timer-tab-pane" aria-selected="true">Timer</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="teams-tab" data-bs-toggle="tab" data-bs-target="#teams-tab-pane" type="button" role="tab" aria-controls="teams-tab-pane" aria-selected="true">Tim Skor</button>
        </li>
    </ul>
    <div class="row">
        <div class="col-11 mx-auto mb-3">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="general-tab-pane" role="tabpanel" aria-labelledby="general-tab" tabindex="0">
                    <div class="my-4 w-100"> </div>
                    <div class="form-group">
                        <label class="form-control-label" for="tx_matchname">Nama Pertandingan</label>
                        <input type="text" class="form-control" name="tx_matchname" id="tx_matchname" value="">
                        <div class="form-text text-danger"></div>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="tx_matchsubtitle">Subtitle</label>
                        <input type="text" class="form-control" name="tx_matchsubtitle" id="tx_matchsubtitle" value="">
                        <div class="form-text text-danger"></div>
                    </div>
                    <button class="btn btn-primary mt-3 w-100" id="btn_sync_general">Sync</button>
                </div>
                <div class="tab-pane fade" id="timer-tab-pane" role="tabpanel" aria-labelledby="timer-tab" tabindex="0">
                    <div class="my-4 w-100"> </div>
                    <div class="d-flex align-items-end">
                        <div class="flex-fill me-2">
                            <div class="form-group">
                                <label class="form-control-label" for="tx_matchstartmin">Timer Mulai (menit ke-)</label>
                                <input type="number" class="form-control" name="tx_matchstartmin" id="tx_matchstartmin" value="">
                                <div class="form-text text-danger"></div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-primary" id="btn_set_timerstartmin">Set</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <button class="btn btn-secondary mt-3 w-100" id="btn_timer_reset">Reset</button>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-primary mt-3 w-100" id="btn_timer_start_pause">Start</button>
                        </div>
                    </div>
                    <div class="d-flex align-items-end mt-4">
                        <div class="flex-fill me-2">
                            <div class="form-group">
                                <label class="form-control-label" for="tx_matchextratime">Waktu Tambahan (menit)</label>
                                <input type="number" class="form-control" name="tx_matchextratime" id="tx_matchextratime" value="">
                                <div class="form-text text-danger"></div>
                            </div>
                        </div>
                        <div class="me-2">
                            <button class="btn btn-outline-primary" id="btn_extratime_hide">Sembunyikan</button>
                        </div>
                        <div>
                            <button class="btn btn-primary" id="btn_extratime_set">Set</button>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="teams-tab-pane" role="tabpanel" aria-labelledby="teams-tab" tabindex="0">
                    <div class="my-4 w-100"> </div>
                    <?php
                        $maxScoreBoard = 2;
                        for($x=1;$x<=8;$x++){
                            $additionalClass = ($x <= $maxScoreBoard) ? "" : "d-none";
                    ?>
                    <div class="d-flex align-items-end <?= $additionalClass ?>" id="panel_team_<?= $x ?>">
                        <div class="flex-fill me-2">
                            <div class="form-group">
                                <label class="form-control-label" for="tx_teamname_<?= $x ?>">Nama Tim <?= $x ?></label>
                                <input type="text" class="form-control" name="tx_teamname_<?= $x ?>" id="tx_teamname_<?= $x ?>" value="">
                                <div class="form-text text-danger"></div>
                            </div>
                        </div>
                        <div class="me-2">
                            <div class="form-group">
                                <label class="form-control-label" for="tx_teamscore_<?= $x ?>">Skor</label>
                                <input type="number" class="form-control text-end" name="tx_teamscore_<?= $x ?>" id="tx_teamscore_<?= $x ?>" value="0" style="width: 100px;">
                                <div class="form-text text-danger"></div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-outline-primary" data-team="<?= $x ?>" data-action="set-score">Set</button>
                        </div>
                    </div>
                    
                    <?php } ?>
                    <div class="d-flex mt-4">
                        <div class="me-2">
                            <select name="tx_teams_count" id="tx_teams_count" class="form-select" style="width: 96px;">
                                <?php
                                    for($y=2;$y<=8;$y++){
                                        echo "<option value=\"{$y}\">{$y} tim</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="flex-fill">
                            <button class="btn btn-primary w-100">Set Sekaligus</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<!--   Core JS Files   -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>

<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../assets/js/argon-dashboard.js"></script>
<script>
    const opener = window.opener;
    const animDuration = 500;

    $("#tx_matchname").val( opener.$("#tx_matchname").text() );
    $("#tx_matchsubtitle").val( opener.$("#tx_matchsubtitle").text() );
    $("#btn_sync_general").on("click", function(e){
        $(this).prop("disabled", true);
        opener.$("#tx_matchname").text( $("#tx_matchname").val() );
        opener.$("#tx_matchsubtitle").text( $("#tx_matchsubtitle").val() );
        $(this).prop("disabled", false).blur();
    });

    $("#tx_matchstartmin").val( opener.$("#tx_timer").attr("data-timer-start") );
    $("#btn_set_timerstartmin").on("click", function(e){
        if(opener.timerOn){
            alert("Timer sedang berjalan!\n Timer harus berhenti dahulu!"); return;
        }
        var startMin = $("#tx_matchstartmin").val();
        var startMinText = (startMin.length === 1) ? "0" + startMin : startMin;
        opener.$("#tx_timer").attr("data-timer-start", startMin).text( startMinText + " : 00" );
        $(this).blur();
    });

    if(opener.timerOn) $("#btn_timer_start_pause").text("Pause");
    $("#btn_timer_start_pause").on("click", function(e){
        var curLabel = $(this).text();
        switch(curLabel.toLowerCase()){
            case "start": 
                opener.startTimer();
                $(this).text("Pause");
                break;
            case "pause": 
                opener.timerOn = false;
                $(this).text("Resume");
                break;
            case "resume": 
                opener.timerOn = true;
                $(this).text("Pause");
                break;
        }
    });
    $("#btn_timer_reset").on("click", function(e){
        if( confirm("Yakin untuk reset timer?\n Timer yang sedang berjalan akan dihentikan.") ){
            opener.timerOn = false;
            opener.resetTimer();
            opener.currentTimerSecs = null;
            $("#btn_set_timerstartmin").click();
            $("#btn_timer_start_pause").text("Start");
        }
        $(this).blur();
    });

    $("#tx_matchextratime").val( opener.$("#tx_extratime").attr("data-extratime") );
    $("#btn_extratime_set").on("click", function(e){
        var extratime = parseInt( $("#tx_matchextratime").val() );
        opener.$("#tx_extratime").attr("data-extratime", extratime).text("+" + extratime).show( animDuration );
    });
    $("#btn_extratime_hide").on("click", function(e){
        opener.$("#tx_extratime").hide( animDuration );
    });

    $("#tx_teams_count option").each(function(){
        if($(this).attr("value") === opener.$("#tx_maxScoreBoard").val()){
            $(this).prop("selected", true); return;
        }
    });

    function initScoreBoard(){
        var countScoreBoard = opener.$("#tx_maxScoreBoard").val();
        for(var x=1;x<=8;x++){
            if(x <= countScoreBoard){
                $("#panel_team_" + x).removeClass("d-none");
                opener.$("#scoreboard-team-" + x).removeClass("d-none");
            } else {
                $("#panel_team_" + x).addClass("d-none");
                opener.$("#scoreboard-team-" + x).addClass("d-none");
            }
            $("#tx_teamname_" + x).val( opener.$("#scoreboard-team-"+x).find("[data-team-name]").text() );
            $("#tx_teamscore_" + x).val( opener.$("#scoreboard-team-"+x).find("[data-team-score]").text() );
        }
    }
    initScoreBoard();

    $("button[data-action=set-score]").on("click", function(e){
        var currentTeam = $(this).attr("data-team");
        var currentTeam_name = $("#tx_teamname_" + currentTeam).val();
        var currentTeam_score = $("#tx_teamscore_" + currentTeam).val();
        opener.$("#scoreboard-team-"+currentTeam).find("[data-team-score]").fadeOut().text(currentTeam_score).fadeIn();
        opener.$("#scoreboard-team-"+currentTeam).find("[data-team-name]").text(currentTeam_name);
        $(this).blur();
    });

    $("#tx_teams_count").on("change", function(e){
        var countScoreBoard = parseInt( $(this).val() );
        opener.$("#tx_maxScoreBoard").val( countScoreBoard );
        initScoreBoard();
        $(this).blur();
    });
</script>

</html>

<?php
$database->close();
?>