<?php 
$a="SELECT CONCAT(M.apellido1, ' ' ,M.nombre1) AS nom_med, M.idlogin, L.cargo
FROM medicos M
INNER JOIN loginn L ON M.idlogin = L.idlogin
WHERE idmed = $idmedico";
$ares=$mysqli->query($a);
$row=$ares->fetch_assoc();
?>


<nav class="layout-navbar container-fluid navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
<div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0   d-xl-none ">
        <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
          <i class="bx bx-menu bx-md"></i>
        </a>
      </div>

  <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
    <!-- Identidad -->
    <div class="navbar-nav align-items-center">
      <div class="nav-item d-flex align-items-center">Dashboard PayMed Global</div>
    </div>
    <!-- /Identidad -->

    <ul class="navbar-nav flex-row align-items-center ms-auto">
    
      <div class="form-check form-switch">
        
        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
        <label class="form-check-label" for="flexSwitchCheckDefault"><span><i class="bx bx-sun bx-sm me-3"></i></span></label>
        
      </div>
      <?php include('../layouts/notifica.php')?>
      <!-- User -->
      <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
          <div class="avatar avatar-online">
            <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
          </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <a class="dropdown-item" href="#">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar avatar-online">
                    <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                  </div>
                </div>
                <div class="flex-grow-1">
                  <span class="fw-semibold d-block"><?php echo $row['nom_med'];?></span>
                  <small class="text-muted"><?php echo $row['cargo']?></small>
                </div>
              </div>
            </a>
          </li>
          <li>
            <div class="dropdown-divider"></div>
          </li>
          <li>
            <a class="dropdown-item" href="../html/perfil.php">
              <i class="bx bx-user me-2"></i>
              <span class="align-middle">Mi Perfil</span>
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="#">
              <i class="bx bx-cog me-2"></i>
              <span class="align-middle">Opciones</span>
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="#">
              <span class="d-flex align-items-center align-middle">
                <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                <span class="flex-grow-1 align-middle">Balance</span>
                <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
              </span>
            </a>
          </li>
          <li>
            <div class="dropdown-divider"></div>
          </li>
          <li>
            <a class="dropdown-item" href="../auth/salir.php">
              <i class="bx bx-power-off me-2"></i>
              <span class="align-middle">Salir</span>
            </a>
          </li>
        </ul>
      </li>
      <!--/ User -->
    </ul>
  </div>
</nav>