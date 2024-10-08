<?php 
    session_start();
	date_default_timezone_set('America/Caracas');
	if (!isset($_SESSION['usuario'])) {
		echo '<script language="javascript">window.location.href="../index.html";</script>';
	}
	$idlogin=$_SESSION['idlogin'];
	$usuario=$_SESSION['usuario'];
	$privilegios = $_SESSION['privilegios'];
  // if($privilegios==2){
  //   $a="SELECT idmed FROM medicos WHERE correo = '$usuario'";
	// 		$ares=$mysqli->query($a);
	// 		$resarray=$ares->fetch_array();
	// 		$idmedico=$resarray[0];
  // }else{
  //   $idmedico=0;
  // }
	$cargo = $_SESSION['cargo'];
?>
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <!-- LOGO E INF DEL USUARIO -->
    <div class="app-brand demo ">
    <a href="index2.php" class="app-brand-link">
    <span class="app-brand-logo demo">
        <img src="../assets/img/logos/logos.png" alt="Brand" width="50px">
    </span>
    
      <span class="app-brand-text demo menu-text fw-bold ms-2">
        <!-- <img src="../assets/img/logos/logoP.svg" alt=""> -->
        <img src="../assets/img/logos/logopng.png" alt="PayMedGlobal" width="150px">
      </span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="bx bx-chevron-left bx-sm d-flex align-items-center justify-content-center"></i>
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