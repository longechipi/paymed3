<!-- Sidebar Menu -->
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
    <li class="menu-item 
        <?php
        if (($host === "rpt_team.php")) {
            echo 'active' . ' ' . 'open';
        } ?>">
        
    <a href="javascript:void(0)" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-wrench"></i>
        <div id="menu-hono" data-i18n="User interface">ACCESOS</div>
    </a>
        <ul class="menu-sub">
            <!-- Usr Clinicas -->
            <li class="menu-item 
                <?php if ($host === "rpt_team.php") {
                    echo 'active';
                } ?>">
                <!-- <a href="pages/forms/rpt_uclin.php" id="sidebar-hono" class="menu-link empty"> -->
                <a href="../html/rpt_team.php" id="sidebar-hono" class="menu-link empty">
                    <div data-i18n="Accordion">Usr Clinicas</div>
                </a>
            </li>
            <!-- Usr Aseguradoras -->
            <li class="menu-item">
                <!-- <a href="../html/rpt_team.php" id="sidebar-hono" class="menu-link empty"> -->
                <a href="../html/rpt_team.php" id="sidebar-hono" class="menu-link empty">
                    <div data-i18n="Accordion">Usr Aseguradoras</div>
                </a>
            </li>
            <!-- Usr Medicos -->
            <li class="menu-item">
                <!-- <a href="pages/forms/rpt_team.php" id="sidebar-hono" class="menu-link empty"> -->
                <a href="../html/rpt_team.php" id="sidebar-hono" class="menu-link empty">
                    <div data-i18n="Accordion">Usr Medicos</div>
                </a>
            </li>
            <!-- Usr Pacientes -->
            <li class="menu-item">
                <!-- <a href="pages/forms/rpt_upac.php" id="sidebar-hono" class="menu-link empty"> -->
                <a href="../html/rpt_team.php" id="sidebar-hono" class="menu-link empty">
                    <div data-i18n="Accordion">Usr Pacientes</div>
                </a>
            </li>
            <!-- Usr Usuarios -->
            <li class="menu-item">
                <!-- <a href="pages/forms/rpt_user.php" id="sidebar-hono" class="menu-link empty"> -->
                <a href="../html/rpt_team.php" id="sidebar-hono" class="menu-link empty">
                    <div data-i18n="Accordion">Usuarios Web</div>
                </a>
            </li>
        </ul>
    </li>
    <!-- FIN PRIMER NIVEL -->

    <!-- SEGUNDO NIVEL -->
    <li class="menu-item 
        <?php
        if (($host === "rpt_clin.php")) {
            echo 'active' . ' ' . 'open';
        } ?>">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-wrench"></i>
            <div id="menu-hono" data-i18n="User interface">MODULOS</div>
        </a>
        <ul class="menu-sub">
            <!-- Clinicas -->
            <li class="menu-item 
                <?php if ($host === "rpt_clin.php") {
                    echo 'active';
                } ?>">
                <a href="../html/rpt_clin.php" id="sidebar-hono" class="menu-link empty">
                    <div data-i18n="Accordion">Clinicas</div>
                </a>
            </li>
            <!-- Proveedores -->
            <li class="menu-item">
                <a href="pages/forms/rpt_prov.php" id="sidebar-hono" class="menu-link empty">
                    <div data-i18n="Accordion">Proveedores</div>
                </a>
            </li>
            <!-- Aseguradoras -->
            <li class="menu-item">
                <a href="pages/forms/rpt_seg.php" id="sidebar-hono" class="menu-link empty">
                    <div data-i18n="Accordion">Aseguradoras</div>
                </a>
            </li>
            <!-- Medicos -->
            <li class="menu-item">
                <a href="pages/forms/rpt_med.php" id="sidebar-hono" class="menu-link empty">
                    <div data-i18n="Accordion">Medicos</div>
                </a>
            </li>
            <!-- Presupuestos -->
            <li class="menu-item">
                <a href="pages/forms/rpt_presupuestos.php" id="sidebar-hono" class="menu-link empty">
                    <div data-i18n="Accordion">Presupuestos</div>
                </a>
            </li>
        </ul>
    </li>
    <!-- FIN SEGUNDO NIVEL -->

    <!-- TERCER NIVEL -->
    <li class="menu-item">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-wrench"></i>
            <div id="menu-hono" data-i18n="User interface">CITAS MEDICAS</div>
        </a>
        <ul class="menu-sub">
            <!-- CITAS -->
            <li class="menu-item">
                <a href="pages/forms/rpt_citas.php" id="sidebar-hono" class="menu-link empty">
                    <div data-i18n="Accordion">Ver Citas</div>
                </a>
            </li>
        </ul>
    </li>
    <!-- FIN TERCER NIVEL -->

    <!-- CUARTO NIVEL -->
    <li class="menu-item">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-wrench"></i>
            <div id="menu-hono" data-i18n="User interface">OPERATIVO</div>
        </a>
        <ul class="menu-sub">
            <!-- Presupuesto -->
            <li class="menu-item">
                <a href="pages/forms/rpt_pres.php" id="sidebar-hono" class="menu-link empty">
                    <div data-i18n="Accordion">Presupuesto</div>
                </a>
            </li>
            <!-- Adminsión/Egreso -->
            <li class="menu-item">
                <a href="pages/forms/rpt_pres.php" id="sidebar-hono" class="menu-link empty">
                    <div data-i18n="Accordion">Adminsión/Egreso</div>
                </a>
            </li>
            <!-- Pagos -->
            <li class="menu-item">
                <a href="pages/forms/rpt_regpago.php" id="sidebar-hono" class="menu-link empty">
                    <div data-i18n="Accordion">Pagos</div>
                </a>
            </li>
            <!-- Baremo Paymed -->
            <li class="menu-item">
                <a href="pages/forms/baremo_paymed.php" id="sidebar-hono" class="menu-link empty">
                    <div data-i18n="Accordion">Baremo Paymed</div>
                </a>
            </li>
            <!-- Junta Medica -->
            <li class="menu-item">
                <a href="pages/forms/rpt_apromed.php" id="sidebar-hono" class="menu-link empty">
                    <div data-i18n="Accordion">Junta Medica</div>
                </a>
            </li>
            <!-- Asistentes Por Médico -->
            <li class="menu-item">
                <a href="pages/forms/rpt_asixmed.php" id="sidebar-hono" class="menu-link empty">
                    <div data-i18n="Accordion">Asistentes Por Médico</div>
                </a>
            </li>
            <!-- Carga Medicos(Excel) -->
            <li class="menu-item">
                <a href="pages/forms/updatmed.php" id="sidebar-hono" class="menu-link empty">
                    <div data-i18n="Accordion">Carga Medicos(Excel)</div>
                </a>
            </li>
        </ul>
    </li>
    <!-- FIN CUARTO NIVEL -->

    <!-- QUINTO NIVEL -->
    <li class="menu-item">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-wrench"></i>
            <div id="menu-hono" data-i18n="User interface">CONFIGURACION</div>
        </a>
        <ul class="menu-sub">
            <!-- Tipo de Empresa -->
            <li class="menu-item">
                <a href="pages/forms/rpt_tipoempresa.php" id="sidebar-hono" class="menu-link empty">
                    <div data-i18n="Accordion">Tipo de Empresa </div>
                </a>
            </li>
            <!-- Tipo de Cuenta -->
            <li class="menu-item">
                <a href="pages/forms/rpt_tipocuenta.php" id="sidebar-hono" class="menu-link empty">
                    <div data-i18n="Accordion">Tipo de Cuenta</div>
                </a>
            </li>
            <!-- Tipo de Contacto -->
            <li class="menu-item">
                <a href="pages/forms/rpt_tipocontacto.php" id="sidebar-hono" class="menu-link empty">
                    <div data-i18n="Accordion">Tipo de Contacto</div>
                </a>
            </li>
            <!-- Tipo de Proveedor -->
            <li class="menu-item">
                <a href="pages/forms/rpt_tpprov.php" id="sidebar-hono" class="menu-link empty">
                    <div data-i18n="Accordion">Tipo de Proveedor</div>
                </a>
            </li>
            <!-- Sexo -->
            <li class="menu-item">
                <a href="pages/forms/rpt_sexo.php" id="sidebar-hono" class="menu-link empty">
                    <div data-i18n="Accordion">Sexo</div>
                </a>
            </li>
            <!-- Servicios Afiliados -->
            <li class="menu-item">
                <a href="pages/forms/rpt_servafafiliados.php" id="sidebar-hono" class="menu-link empty">
                    <div data-i18n="Accordion">Servicios Afiliados</div>
                </a>
            </li>
            <!-- Imagenología -->
            <li class="menu-item">
                <a href="pages/forms/rpt_servimg.php" id="sidebar-hono" class="menu-link empty">
                    <div data-i18n="Accordion">Imagenología</div>
                </a>
            </li>
             <!-- Frecuencia de Pagos -->
             <li class="menu-item">
                <a href="pages/forms/rpt_frecuencia.php" id="sidebar-hono" class="menu-link empty">
                    <div data-i18n="Accordion">Frecuencia de Pagos</div>
                </a>
            </li>
             <!-- Estado Civil -->
             <li class="menu-item">
                <a href="pages/forms/rpt_estadocivil.php" id="sidebar-hono" class="menu-link empty">
                    <div data-i18n="Accordion">Estado Civil</div>
                </a>
            </li>
             <!-- Especialiades Medicas -->
             <li class="menu-item">
                <a href="pages/forms/rpt_espmed.php" id="sidebar-hono" class="menu-link empty">
                    <div data-i18n="Accordion">Especialiades Medicas</div>
                </a>
            </li>
             <!-- Registro de Bancos -->
             <li class="menu-item">
                <a href="pages/forms/rpt_bancos.php" id="sidebar-hono" class="menu-link empty">
                    <div data-i18n="Accordion">Registro de Bancos</div>
                </a>
            </li>
             <!-- Registro de Planes -->
             <li class="menu-item">
                <a href="pages/forms/rpt_planes.php" id="sidebar-hono" class="menu-link empty">
                    <div data-i18n="Accordion">Registro de Planes</div>
                </a>
            </li>
             <!-- Terminos y Condiciones -->
             <li class="menu-item">
                <a href="pages/forms/upd_terms.php" id="sidebar-hono" class="menu-link empty">
                    <div data-i18n="Accordion">Terminos y Condiciones</div>
                </a>
            </li>
            <!-- Paises -->
            <li class="menu-item">
                <a href="pages/forms/rpt_paises.php" id="sidebar-hono" class="menu-link empty">
                    <div data-i18n="Accordion">Paises</div>
                </a>
            </li>
        </ul>
    </li>
    <!-- FIN QUINTO NIVEL -->

    <!-- SEXTO NIVEL -->
    <li class="menu-item">
        <a href="javascript:void(0)" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons bx bx-wrench"></i>
            <div id="menu-hono" data-i18n="User interface">AGENDA</div>
        </a>
        <ul class="menu-sub">
            <!-- Agenda -->
            <li class="menu-item">
                <a href="pages/forms/rpt_agenda.php" id="sidebar-hono" class="menu-link empty">
                    <div data-i18n="Accordion">Ver Actividades</div>
                </a>
            </li>
        </ul>
    </li>
    <!-- FIN SEXTO NIVEL -->

    <li class="menu-item 
        <?php if ($host === "index.php") { echo 'active'; } ?>">
            <a href="../auth/salir.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-clinic"></i>
                <div data-i18n="Analytics">SALIR</div>
            </a>
    </li>
     
</ul>