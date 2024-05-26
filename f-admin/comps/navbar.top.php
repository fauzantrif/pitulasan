          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <form action="./participant.php" method="get">
              <div class="input-group">
                <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                
                  <input type="search" name="search" class="form-control" placeholder="Cari peserta..." value="<?= (isset($_GET['search'])) ? $_GET['search'] : "" ?>">
                
              </div>
            </form>
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="./account.php?_" class="nav-link text-white font-weight-bold px-0">
                <div class="d-flex align-items-center">
                  <div class="flex-fill text-end">
                    <span class="d-sm-inline d-none">
                      <div style="line-height: .8em;"><?= $user['fullname']; ?></div>

                      <?php if($user['superuser']){ ?>
                        <small style="opacity: .5;">Superuser</small>
                      <?php } ?>

                    </span>
                  </div>
                  <div class="mx-0 mx-sm-1">
                    <i class="far fa-user-circle ms-sm-1" style="font-size: 1.6em;"></i>
                  </div>
                </div>
                
                
              </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                </div>
              </a>
            </li>
          </ul>