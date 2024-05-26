        <?php
            $competition_matches = $database->query("SELECT *, CONCAT(`grouping`, `copy`) AS `grouping_2` FROM `competition_transactions` WHERE `id_comp` = {$competition['id']} GROUP BY `grouping_2`");
            if($competition_matches['total']){
              $finit = 0;
              foreach($competition_matches['data'] as $competition_match){
                $finit++;
                $added_participant = array();
                $generate_list_id = "list-leaderboard-{$finit}";
                if($competition_match['copy'] >= 2){
                    $competition_grouping = $competition_match['grouping'] . " - " . $competition_match['copy'];
                } else {
                    $competition_grouping = $competition_match['grouping'];
                }
          ?>
          
          <div class="card mb-4">
            <div class="card-body p-3">
              <div class="d-flex align-items-center">
                <div class="flex-fill">
                  <h5><?= $competition_grouping ?></h5>
                </div>
                <div>
                    <a class="btn btn-outline-primary btn-icon-only" href="javascript:;" data-bs-toggle="collapse" data-bs-target="<?= "#col-" . $generate_list_id ?>">
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    <?php 
                        $encoded_grouping = base64_encode($competition_match['grouping']);
                        $linkParam_delete = "action=delete_group&id={$competition['id']}&grouping={$encoded_grouping}&copy={$competition_match['copy']}";

                        $matches = $database->query("SELECT * FROM `competition_transactions` WHERE `id_comp` = {$competition['id']} AND `grouping` = '{$competition_match['grouping']}' AND `copy` = {$competition_match['copy']} AND `id_participant` IS NOT NULL");
                    ?>
                  <a class="btn btn-outline-danger btn-icon-only" href="./processor/competition.transact.php?<?= $linkParam_delete ?>" onclick="confirmLink(this, event)" data-confirm="Anda yakin menghapus daftar kelompok ini? Jumlah poin tiap peserta akan disesuaikan.">
                    <i class="fas fa-trash"></i>
                  </a>
                </div>
              </div>
              <div class="mt-3 mb-2 collapse <?= ($matches['total'] < 1) ? "show" : "" ?>" id="<?= "col-" . $generate_list_id ?>">
                <div class="row">
                  <div class="col-xxl-9 col-lg-8 my-2">
                    <form action="./processor/competition.transact.php" method="post">
                      <div class="list-group list-group-flush" id="<?= $generate_list_id ?>">
                        <?php
                          if($matches['total']){
                            foreach($matches['data'] as $match){
                              $participant_data = $database->query("SELECT participant.*, teams.name, teams.logo FROM participant LEFT JOIN teams ON participant.team = teams.id WHERE participant.id = {$match['id_participant']}");
                              $participant_data = $participant_data['data'][0];
                              array_push($added_participant, $participant_data['id']);
                              $generate_id_elem = "participant-{$competition_match['grouping']}-{$participant_data['id']}";
                              $generate_id_elem = preg_replace('/\s+/', '_', $generate_id_elem);
                        ?>
                        <div class="list-group-item px-0" id="<?= $generate_id_elem ?>">
                          <div class="d-flex align-items-center">
                            <div class="flex-fill">
                              <?= $participant_data['fullname'] ?>
                            </div>
                            <div>
                              <input type="number" class="form-control" name="tx_point[]" value="<?= $match['point'] ?>" maxlength="4" step="5" style="width: 75px; text-align: right;">
                            </div>
                            <div class="ms-2">
                              <button type="button" class="btn btn-icon-only btn-outline-primary mb-0" onclick="elemMoveUp('#<?= $generate_id_elem ?>')">
                                <i class="fas fa-arrow-up"></i>
                              </button>
                              <button type="button" class="btn btn-icon-only btn-outline-primary mb-0" onclick="elemMoveDown('#<?= $generate_id_elem ?>')">
                                <i class="fas fa-arrow-down"></i>
                              </button>
                              <button type="button" class="btn btn-icon-only btn-outline-danger mb-0" onclick="elemDelete('#<?= $generate_id_elem ?>')">
                                <i class="fas fa-times"></i>
                              </button>
                            </div>
                          </div>
                          <div class="d-none">
                            <input type="hidden" name="tx_id_participant[]" value="<?= $participant_data['id'] ?>">
                            <input type="hidden" name="tx_id_team[]" value="<?= $participant_data['team'] ?>">
                          </div>
                        </div>
                        <?php 
                            }
                          }
                        ?>
                      </div>
                      <div class="d-flex justify-content-between mt-4">
                          <div>
                            <button type="button" class="btn btn-outline-danger" onclick="listReset('<?= $generate_list_id ?>')">Atur Ulang</button>
                          </div>
                          <div>
                            <input type="hidden" name="tx_grouping" value="<?= $competition_match['grouping'] ?>">
                            <input type="hidden" name="tx_copy" value="<?= $competition_match['copy'] ?>">
                            <input type="hidden" name="tx_id_comp" value="<?= $competition['id'] ?>">
                            <input type="hidden" name="tx_action" value="transact_individu">
                            <button type="submit" class="btn bg-gradient-primary">Simpan</button>
                          </div>
                      </div>
                    </form>
                  </div>
                  <div class="col-xxl-3 col-lg-4 my-2">
                    <div class="card border">
                      <div class="card-body">
                        <input type="search" class="form-control" placeholder="Cari Peserta" data-sc-mode="participant" data-sc-target="#rec-list-<?= $finit ?>">
                        <div class="list-group list-group-flush mt-3" id="rec-list-<?= $finit ?>">
                          <?php 
                            $recommendedParticipants = $database->query("SELECT participant.* FROM participant LEFT JOIN teams ON participant.team = teams.id WHERE `grouping` = '{$competition_match['grouping']}'");
                            foreach($recommendedParticipants['data'] as $recommendedParticipant){
                              // if(in_array($recommendedParticipant['id'], $added_participant)) continue;
                              $generate_id_elem = "participant-{$competition_match['grouping']}-{$recommendedParticipant['id']}";
                              $generate_id_elem = preg_replace('/\s+/', '_', $generate_id_elem);
                          ?>
                          <a href="javascript:;" class="list-group-item list-group-item-action" onclick="addToList(this, '<?= $generate_list_id ?>')">
                            <div class="d-flex">
                              <div class="flex-fill"><?= $recommendedParticipant['fullname'] ?></div>
                            </div>
                            <div class="d-none" data-list="participant">
                              <div class="list-group-item px-0" data-id="<?= $generate_id_elem ?>">
                                <div class="d-flex align-items-center">
                                  <div class="flex-fill">
                                    <?= $recommendedParticipant['fullname'] ?>
                                  </div>
                                  <div>
                                    <input type="number" class="form-control" name="tx_point[]" value="" maxlength="4" step="5" style="width: 75px; text-align: right;">
                                  </div>
                                  <div class="ms-2">
                                    <button type="button" class="btn btn-icon-only btn-outline-primary mb-0" onclick="elemMoveUp('#<?= $generate_id_elem ?>')">
                                      <i class="fas fa-arrow-up"></i>
                                    </button>
                                    <button type="button" class="btn btn-icon-only btn-outline-primary mb-0" onclick="elemMoveDown('#<?= $generate_id_elem ?>')">
                                      <i class="fas fa-arrow-down"></i>
                                    </button>
                                    <button type="button" class="btn btn-icon-only btn-outline-danger mb-0" onclick="elemDelete('#<?= $generate_id_elem ?>')">
                                      <i class="fas fa-times"></i>
                                    </button>
                                  </div>
                                </div>
                                <div class="d-none">
                                  <input type="hidden" name="tx_id_participant[]" value="<?= $recommendedParticipant['id'] ?>">
                                  <input type="hidden" name="tx_id_team[]" value="<?= $recommendedParticipant['team'] ?>">
                                </div>
                              </div>
                            </div>
                          </a>
                          <?php 
                            }
                          ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <?php
              }
            }
          ?>

          <div class="mt-5 mb-4">
            <button class="btn btn-white btn-lg d-block w-100 py-4" style="border-radius: 1rem;" data-bs-toggle="modal" data-bs-target="#modal-add-match">
              <i class="fas fa-plus"></i>
            </button>
          </div>
          <div class="modal fade" tabindex="-1" id="modal-add-match">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Tambah Pertandingan</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <div class="modal-body">
                    <form action="./processor/competition.transact.php" method="post" id="form_add_grouping">
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
                                    
                                    echo "<option value=\"{$grouping_name}\">{$grouping_name}</option>";
                                    }
                                }
                                ?>
                            </select>
                            </div>
                            <div class="form-text text-danger"></div>
                        </div>
                        <input type="hidden" name="tx_id_comp" value="<?= $competition['id'] ?>">
                        <input type="hidden" name="tx_action" value="add_group">
                    </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="button" class="btn btn-primary" onclick="$(this).parent().find('button').prop('disabled', true); $('#form_add_grouping').submit();">Tambahkan</button>
                </div>
              </div>
            </div>
          </div>