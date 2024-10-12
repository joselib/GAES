
<div class="container-fluid p-0">
  <div class="row g-0 full-height">
    <!-- Sidebar -->
    <div class="col-auto px-0 bg-light sidebar" style="width: 250px;"> <!-- Adjust width as needed -->
      <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
        <a href="<?php echo APP_URL; ?>dashboard/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
          <img src="<?php echo APP_URL; ?>app/views/img/gaes_logo.png" alt="Logo" width="200" height="100" class="d-inline-block align-top">
        </a>
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
          <li class="nav-item">
            <a href="<?php echo APP_URL; ?>dashboard/" class="nav-link align-middle px-0">
              <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
            </a>
          </li>
          <li>
            <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
              <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Usuarios</span>
            </a>
            <ul class="collapse nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
              <li class="w-100">
                <a href="<?php echo APP_URL; ?>userNew/" class="nav-link px-0"> <span class="d-none d-sm-inline">Nuevo</span></a>
              </li>
              <li>
                <a href="<?php echo APP_URL; ?>userList/" class="nav-link px-0"> <span class="d-none d-sm-inline">Lista</span></a>
              </li>
              <li>
                <a href="<?php echo APP_URL; ?>userSearch/" class="nav-link px-0"> <span class="d-none d-sm-inline">Buscar</span></a>
              </li>
            </ul>
          </li>
        </ul>
        <hr>
        <div class="dropdown pb-4">
          <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="<?php echo APP_URL; ?>app/views/photos/photo_default_user.svg" alt="hugenerd" width="30" height="30" class="rounded-circle">
            <span class="d-none d-sm-inline mx-1">** <?php /* echo $_SESSION['usuario']; */ ?> **</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="<?php /* echo APP_URL."userUpdate/".$_SESSION['id']."/";  */ ?>">Mi cuenta</a></li>
            <li><a class="dropdown-item" href="<?php /* echo APP_URL."userPhoto/".$_SESSION['id']."/"; */ ?>">Mi foto</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="<?php echo APP_URL."logOut/"; ?>" id="btn_exit">Salir</a></li>
          </ul>
        </div>
      </div>
    </div>