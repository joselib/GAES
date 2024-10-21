<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky d-flex flex-column justify-content-between pt-3 h-100">
        <div>
          <a href="<?php echo APP_URL; ?>dashboard/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <img src="<?php echo APP_URL; ?>app/views/img/gaes_logo.png" alt="Logo" width="160" height="80" class="d-inline-block align-top">
          </a>
          <hr>
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="<?php echo APP_URL; ?>dashboard/">
                <i class="bi bi-speedometer2"></i>
                Dashboard
              </a>
            </li>
            <?php if(isset($_SESSION['id']) && $_SESSION['id'] == 1): ?>
            <li class="nav-item">
              <a class="nav-link" href="#userSubmenu" data-bs-toggle="collapse" aria-expanded="false">
                <i class="bi bi-people"></i>
                Usuarios
              </a>
              <ul class="collapse nav flex-column ms-1" id="userSubmenu">
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo APP_URL; ?>userNew/">Nuevo</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo APP_URL; ?>userList/">Lista</a>
                </li>
              </ul>
            </li>
              <?php endif; ?>
          </ul>
        </div>
        <div class="dropdown pb-4">
          <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="<?php echo APP_URL; ?>app/views/photos/photo_default_user.svg" alt="User Photo" width="32" height="32" class="rounded-circle me-2">
            <strong><?php echo $_SESSION['user']; ?></strong>
          </a>
          <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="<?php echo APP_URL."userUpdate/".$_SESSION['id']."/"; ?>">Mi cuenta</a></li>
            <li><a class="dropdown-item" href="<?php echo APP_URL."userPhoto/".$_SESSION['id']."/"; ?>">Mi foto</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?php echo APP_URL."logOut/"; ?>" id="btn_exit">Salir</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Main content -->
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <!-- Your main content goes here -->
    </main>
  </div>
</div>
