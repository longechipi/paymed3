<?php
$sqlestatus = "SELECT estatus FROM loginn WHERE idlogin ='$idlogin'";
  $objestatus = $mysqli->query($sqlestatus);
  $arrestatus = mysqli_fetch_array($objestatus);
  $estatusmedico = $arrestatus['estatus'];
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
    <!-- Verifico si ya pago y tiene estatus Activo, sino solo muestro opccion de actualizar perfil -->
    <?php if ($estatusmedico=='I') { ?> 
        <!-- Perfil -->
        <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-wrench"></i>
                <div id="menu-hono" data-i18n="User interface">PERFIL</div>
            </a>
            <ul class="menu-sub">
                <!-- Actualizar -->
                <li class="menu-item">
                    <a href="pages/forms/updmed.php" id="sidebar-hono" class="menu-link empty">
                        <div data-i18n="Accordion">Actualizar</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item 
        <?php if ($host === "index.php") { echo 'active'; } ?>">
            <a href="../auth/salir.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-clinic"></i>
                <div data-i18n="Analytics">SALIR</div>
            </a>
        </li>
    <?php } else{?> 
        <!-- PRIMER NIVEL -->
        <li class="menu-item 
        <?php
        if (($host === "rpt_pacxmed.php") ) {
            echo 'active' . ' ' . 'open';
        } ?>">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-wrench"></i>
                <div id="menu-hono" data-i18n="User interface">PERFIL</div>
            </a>
            <ul class="menu-sub">
                <!-- Actualizar -->
                <li class="menu-item">
                    <a href="pages/forms/updmed.php" id="sidebar-hono" class="menu-link empty">
                        <div data-i18n="Accordion">Actualizar</div>
                    </a>
                </li>
                <!-- Proveedores -->
                <li class="menu-item">
                    <a href="pages/forms/rpt_prov.php" id="sidebar-hono" class="menu-link empty">
                        <div data-i18n="Accordion">Proveedores</div>
                    </a>
                </li>
                <!-- Pacientes -->
                <li class="menu-item 
                <?php if ($host === "rpt_pacxmed.php") { echo 'active'; } ?>">
                    <a href="../html/rpt_pacxmed.php" id="sidebar-hono" class="menu-link empty">
                        <div data-i18n="Accordion">Pacientes</div>
                    </a>
                </li>
                <!-- Asistente -->
                <li class="menu-item">
                    <a href="../html/rpt_asist.php" id="sidebar-hono" class="menu-link empty">
                        <div data-i18n="Accordion">Asistente</div>
                    </a>
                </li>
                <!-- Horarios -->
                <li class="menu-item">
                    <a href="pages/forms/rpt_horar.php" id="sidebar-hono" class="menu-link empty">
                        <div data-i18n="Accordion">Horarios</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- FIN PRIMER NIVEL -->

        <!-- SEGUNDO NIVEL -->
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
                <!-- Crear Citas -->
                <li class="menu-item">
                    <a href="pages/forms/rpt_citpac.php" id="sidebar-hono" class="menu-link empty">
                        <div data-i18n="Accordion">Crear Citas</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- FIN SEGUNDO NIVEL -->

        <!-- TERCER NIVEL -->
        <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-wrench"></i>
                <div id="menu-hono" data-i18n="User interface">HISTORIA MEDICA</div>
            </a>
            <ul class="menu-sub">
                <!-- Historia Medica -->
                <li class="menu-item">
                    <a href="pages/forms/prefilterpac.php" id="sidebar-hono" class="menu-link empty">
                        <div data-i18n="Accordion">VER</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- FIN TERCER NIVEL -->

        <!-- CUARTO NIVEL -->
        <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-wrench"></i>
                <div id="menu-hono" data-i18n="User interface">PRESUPUESTO</div>
            </a>
            <ul class="menu-sub">
                <!-- Presupuesto -->
                <li class="menu-item">
                    <a href="pages/forms/rpt_presupuestos.php" id="sidebar-hono" class="menu-link empty">
                        <div data-i18n="Accordion">Ver</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- FIN CUARTO NIVEL -->

        <li class="menu-item 
        <?php if ($host === "index.php") { echo 'active'; } ?>">
            <a href="../auth/salir.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-clinic"></i>
                <div data-i18n="Analytics">SALIR</div>
            </a>
        </li>

    <?php }?>
</ul>