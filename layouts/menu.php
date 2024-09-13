<?php 
    session_start();
	date_default_timezone_set('America/Caracas');
	if (!isset($_SESSION['usuario'])) {
		echo '<script language="javascript">window.location.href="../index.html";</script>';
	}
	$idlogin=$_SESSION['idlogin'];
	$usuario=$_SESSION['usuario'];
	$privilegios = $_SESSION['privilegios'];
	$cargo = $_SESSION['cargo'];
?>
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <!-- LOGO E INF DEL USUARIO -->
    <div class="app-brand demo">
            <img class="img-fluid" src="../assets/img/logos/logoP.svg" alt="LOGO" srcset="" >
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
       
    </div>
    <!-- FIN LOGO E INF DEL USUARIO -->
    <?php $host = basename($_SERVER['PHP_SELF']);
    if($privilegios==1){
        include('../layouts/nav/menu-admin.php'); //Administrador
    }else if($privilegios==2){
        include('../layouts/nav/menu-medico.php'); //Medicos
    }else if($privilegios==3){
        include('../layouts/nav/menu-asegu.php'); //Aseguradora
    }else if($privilegios==4){
        include('../layouts/nav/menu-proveedor.php'); //Proveedor
    }else if($privilegios==7){
        include('../layouts/nav/menu-asistente.php'); //asistente
    }
    ?>

</aside>