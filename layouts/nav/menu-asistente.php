<?php
$host = basename($_SERVER['PHP_SELF']);
?>

<ul class="menu-inner py-1">
    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Módulos</span>
    </li>
    <!-- INICIO -->
    <li class="menu-item 
        <?php if ($host === "index.php") { echo 'active'; } ?>">
            <a href="../html/index2.php?usr=1" class="menu-link">
                <i class="menu-icon tf-icons bx bx-clinic"></i>
                <div data-i18n="Analytics">INICIO</div>
            </a>
    </li>

    <!-- PRIMER NIVEL -->
    <li class="menu-item">
    <a href="javascript:void(0)" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-wrench"></i>
        <div id="menu-hono" data-i18n="User interface">AGENDA</div>
    </a>
        <ul class="menu-sub">
            <!-- Ver Citas -->
            <li class="menu-item">
                <a href="pages/forms/rpt_citas.php" id="sidebar-hono" class="menu-link empty">
                    <div data-i18n="Accordion">Ver Citas</div>
                </a>
            </li>
            <!-- Citas -->
            <li class="menu-item">
                <a href="pages/forms/rpt_citpac.php" id="sidebar-hono" class="menu-link empty">
                    <div data-i18n="Accordion">Citas</div>
                </a>
            </li>
        </ul>
    </li>
    <!-- FIN PRIMER NIVEL -->

    <!-- SEGUNDO NIVEL -->
    <li class="menu-item">
    <a href="javascript:void(0)" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-wrench"></i>
        <div id="menu-hono" data-i18n="User interface">HISTORIA MEDICA</div>
    </a>
        <ul class="menu-sub">
            <!-- Ver -->
            <li class="menu-item">
                <a href="pages/forms/prefilterpac.php" id="sidebar-hono" class="menu-link empty">
                    <div data-i18n="Accordion">Ver</div>
                </a>
            </li>
           
        </ul>
    </li>
    <!-- FIN SEGUNDO NIVEL -->

    <!-- TERCER NIVEL -->
    <li class="menu-item">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-wrench"></i>
            <div id="menu-hono" data-i18n="User interface">PACIENTES</div>
        </a>
        <ul class="menu-sub">
            <!-- Actualizar Paciente -->
            <li class="menu-item">
                <a href="pages/forms/rpt_pacxmed.php" id="sidebar-hono" class="menu-link empty">
                    <div data-i18n="Accordion">Actualizar</div>
                </a>
            </li>
        </ul>
    </li>
    <!-- FIN TERCER NIVEL -->

    <li class="menu-item 
        <?php if ($host === "index.php") { echo 'active'; } ?>">
            <a href="../auth/salir.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-clinic"></i>
                <div data-i18n="Analytics">SALIR</div>
            </a>
    </li>
    
</ul>