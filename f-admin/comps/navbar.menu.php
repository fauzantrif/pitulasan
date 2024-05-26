    <?php
      $current_page = strtolower(basename($_SERVER["SCRIPT_FILENAME"], '.php'));
    ?>
    
    <div class="d-flex flex-column h-100">
      <div>
        <div class="sidenav-header">
          <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
          <a class="navbar-brand m-0" href=" ../?_ " target="_blank">
            <!-- <img src="./assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo"> -->
            <div class="text-center">
              <img src="../assets/img/logo/logo.png" alt="Logo FORMASI 103">
              <small class="d-block">Administrasi Acara HUT RI ke-78</small>
            </div>
            <!-- <span class="ms-1 font-weight-bold">FORMASI 103</span> -->
          </a>
        </div>
        <hr class="horizontal dark mt-2">
      </div>
      <div class="flex-fill">
        <div class="w-auto " id="sidenav-collapse-main">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link <?= ($current_page === "dashboard") ? "active" : "" ?>" href="./dashboard.php?_">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Dasbor</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= (in_array($current_page, array("participant", "participant.forms", "participant.teamlist"))) ? "active" : "" ?>" href="./participant.php?_">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="ni ni-single-02 text-warning text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Peserta</span>
              </a>
            </li>

            <?php if($user['superuser']){ ?>

            <li class="nav-item">
              <a class="nav-link <?= (in_array($current_page, array("competitions", "competitions.details"))) ? "active" : "" ?>" href="./competitions.php?_">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="ni ni-user-run text-success text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Lomba</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= ($current_page === "admins") ? "active" : "" ?>" href="./admins.php?_">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="ni ni-badge text-info text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Admin</span>
              </a>
            </li>

            <?php } ?>
            
            
            <li class="nav-item mt-3">
              <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Hasil</h6>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="./live-score.php?_">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="ni ni-trophy text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Live Score</span>
              </a>
            </li>
            <?php /*
            
            <li class="nav-item">
              <a class="nav-link " href="./pages/rtl.html">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">RTL</span>
              </a>
            </li>
            <li class="nav-item mt-3">
              <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="./pages/profile.html">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Profile</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="./pages/sign-in.html">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="ni ni-single-copy-04 text-warning text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Sign In</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="./pages/sign-up.html">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                  <i class="ni ni-collection text-info text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Sign Up</span>
              </a>
            </li>
            */ ?>
          </ul>
        </div>
      </div>
      <div class="pb-3">
        <div class="sidenav-footer mx-3 ">
          <a class="btn btn-primary btn-sm mb-0 w-100" href="./processor/logout.php?_" type="button">Keluar</a>
        </div>
      </div>
    </div>