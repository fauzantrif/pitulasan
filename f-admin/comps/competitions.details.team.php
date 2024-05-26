  <div class="card mb-4">
    <div class="card-body">
      <form action="./processor/competition.transact.php" method="post">
        <div class="list-group list-group-flush" id="main-list-team">
          <?php
            $teams = $database->query("SELECT teams.*, IFNULL(competition_transactions.point, 0) AS `point` FROM teams LEFT JOIN competition_transactions ON competition_transactions.id_team = teams.id AND competition_transactions.id_comp = {$competition['id']} ORDER BY `point` DESC");
            foreach($teams['data'] as $team){
              $generate_team_id = "list-team-{$team['id']}";
          ?> 

          <div class="list-group-item" id="<?= $generate_team_id ?>">
            <div class="d-flex align-items-center">
              <div>
                <img class="border border-light rounded-circle shadow-sm" src="../assets/img/teams/<?= $team['logo'] ?>" alt="Tim <?= $team['name'] ?>" width="48" height="48">
              </div>
              <div class="flex-fill mx-3">
                <?= $team['name'] ?>
              </div>
              <div class="mx-3">
                <input type="number" class="form-control" name="tx_point[]" value="<?= $team['point'] ?>" maxlength="4" step="5" style="width: 75px; text-align: right;">
                <input type="hidden" name="tx_id_team[]" value="<?= $team['id'] ?>">
              </div>
              <div>
                <button type="button" class="btn btn-icon-only btn-outline-primary mb-0" onclick="elemMoveUp('#<?= $generate_team_id ?>')">
                  <i class="fas fa-arrow-up"></i>
                </button>
                <button type="button" class="btn btn-icon-only btn-outline-primary mb-0" onclick="elemMoveDown('#<?= $generate_team_id ?>')">
                  <i class="fas fa-arrow-down"></i>
                </button>
              </div>
            </div>
          </div>

          <?php } ?>
          <input type="hidden" name="tx_copy" value="<?= $competition_match['copy'] ?>">
          <input type="hidden" name="tx_id_comp" value="<?= $competition['id'] ?>">
          <input type="hidden" name="tx_action" value="transact_team">
        </div>
        <div class="d-flex justify-content-between mt-3 pt-3">
          <div>
            <button type="button" class="btn btn-outline-primary" onclick="$('#main-list-team').updatePoint()">Hitung Ulang</button>
          </div>
          <div>
            <button type="submit" class="btn bg-gradient-primary" >Simpan</button>
          </div>
        </div>
      </form>
    </div>
  </div>