<?php
$host = basename($_SERVER['PHP_SELF']);
?>
<ul class="menu-inner py-1">
    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Módulos</span>
    </li>
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
            <!-- Ver Actividades -->
            <li class="menu-item">
                <a href="pages/forms/rpt_agenda.php" id="sidebar-hono" class="menu-link empty">
                    <div data-i18n="Accordion">Ver Actividades</div>
                </a>
            </li>
        </ul>
    </li>
    <!-- Clientes -->
    <li class="menu-item">
        <a href="pages/forms/xxx.php" id="sidebar-hono" class="menu-link empty">
            <div data-i18n="Accordion">CLIENTES</div>
        </a>
    </li>
    <!-- Medicos -->
    <li class="menu-item">
        <a href="pages/forms/xxx.php" id="sidebar-hono" class="menu-link empty">
            <div data-i18n="Accordion">MEDICOS</div>
        </a>
    </li>
    <!-- Asegurados -->
    <li class="menu-item">
        <a href="pages/forms/xxx.php" id="sidebar-hono" class="menu-link empty">
            <div data-i18n="Accordion">ASEGURADOS</div>
        </a>
    </li>

    <li class="menu-item 
        <?php if ($host === "index.php") { echo 'active'; } ?>">
            <a href="../auth/salir.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-clinic"></i>
                <div data-i18n="Analytics">SALIR</div>
            </a>
    </li>
    
</ul>