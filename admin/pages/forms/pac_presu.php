<?php

session_start();
$usuario = $_SESSION['usuario'];
$hoy=date('Y-m-d');

require('../../conexion.php');

if(isset($rif)){$rif=$_GET['ced'];}

if(isset($_GET['idpac'])){
   
   $idpaci=$_GET['idpac'];
   $sqldatos = ("SELECT apellido1, apellido2, nombre1, nombre2, cedula, fnacimiento
                 FROM pacientes 
                 WHERE cedula='".$idpaci."'");
   $objdatos = $mysqli->query($sqldatos); $arrdatos = $objdatos->fetch_array();
   $objdatos    = $mysqli->query($sqldatos); $arrdatos = $objdatos->fetch_array();
   $apellido1   = $arrdatos['apellido1'];
   $apellido2   = $arrdatos['apellido2'];
   $nombre1     = $arrdatos['nombre1'];
   $nombre2     = $arrdatos['nombre2'];
   $cedula      = $arrdatos['cedula'];
   $fnacimiento = $arrdatos['fnacimiento'];

}

if (isset($_POST['submit'])) {
      //datos 
      $idpaci    =$_POST['idpaci'];
      $tpresu    =$_POST['tpresu'];
      $idclinica =$_POST['idclinica'];
      $idmed     =$_POST['idmed'];
      $fdi       =$_POST['fdi'];
      $hdi       =$_POST['hdi'];
      $ddh       =$_POST['ddh'];
      $tdp       =$_POST['tdp'];
      $dti       =$_POST['dti'];
      $teh       =$_POST['teh'];
      $tem       =$_POST['tem'];
      
      $str="INSERT INTO presupuesto 
                          (idtipopresu,
                           idmed,
                           idpaci,
                           idclinica,
                           fec_creacion,
                           cirug_dia,
                           cirug_hora,
                           cirug_diashost,
                           cirug_dias_uci,
                           cirug_tiempo_h,
                           cirug_tiempo_m,
                           idestatus) 
                   VALUES ('".$tpresu."', 
                           '".$idmed."', 
                           '".$idpaci."',
                           '".$idclinica."',
                           '".$hoy."',
                           '".$fdi."', 
                           '".$hdi."', 
                           '".$ddh."',
                           '".$dti."',
                           '".$teh."',
                           '".$tem."',
                           '3')";
         $conexion=$mysqli->query($str);

      echo '<script language="javascript">
                  alert("¡PASO 1. Creado exitosamente!");
                  window.location.href="updpresu_seguros.php?idpac='.$idpaci.'"; 
            </script>';
   }
?>
<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>PAYMED GLOBAL, LLC</title>
   <!-- Tell the browser to be responsive to screen width -->
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- Font Awesome -->
   <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
   <!-- Ionicons -->
   <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
   <!-- overlayScrollbars -->
   <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
   <!-- Google Font: Source Sans Pro -->
   <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
   <script src="jquery/jquery-3.2.1.min.js"></script>
</head>

<body class="hold-transition sidebar-mini">
   <!-- Site wrapper -->
   <div class="wrapper">
      <!-- -->
      <?php include("menuppal.php"); ?>
      <!--  -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-6">
                     <h1>Creacion de Presupuesto</h1>
                  </div>
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../../index.php?usr=1">Home</a></li>
                        <li class="breadcrumb-item active">Presupuesto</li>
                     </ol>
                  </div>
               </div>
            </div><!-- /.container-fluid -->
         </section>

         <!-- Main content -->
         <section class="content">
            <!--div class="row">
        <div class="col-md-12"-->
            <div class="card card-primary">
               <div style="background: #F89921" class="card-header">
                  <h3 class="card-title">Paso 1/4</h3>

                  <div class="card-tools">
                     <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                  </div>
               </div>
               <div class="card-body">
                  <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                     <input type="hidden" id="idpaci" name="idpaci" value="<?php echo $idpaci;?>">
                     <div class="row">
                        <!-- 1ra -->
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="apellido1">1er Apellido:</label>
                              <input type="text" style="text-transform:uppercase;" class="form-control form-control-sm " value="<?php echo $apellido1; ?>" disabled>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="apellido2">2do Apellido: </label>
                              <input type="text" style="text-transform:uppercase;" class="form-control form-control-sm" value="<?php echo $apellido2;?>" disabled>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="nombre1">1er Nombre: </label>
                              <input type="text" style="text-transform:uppercase;" class="form-control form-control-sm " value="<?php echo $nombre1;?>" disabled>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="mombre2">2do Nombre: </label>
                              <input type="text" style="text-transform:uppercase;" class="form-control form-control-sm" value="<?php echo $nombre2;?>" disabled>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="fnacimiento">Fec.Nacimiento:</label>
                              <input type="date" class="form-control form-control-sm " value="<?php echo $fnacimiento;?>" disabled>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="fnacimiento">CI de Identidad:</label>
                              <input type="text" value="<?php echo $cedula; ?>" class="form-control form-control-sm" disabled
                               >
                           </div>
                        </div>                           
                        <!-- 2da -->
                        <hr>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="apellido1">Tipo de Presupuesto:</label>
                              <select class="form-control form-control-sm" name="tpresu" required>
                                 <option value="">-- Seleccione --</option>
                                 <?php
                                 $querytpr = $mysqli->query("SELECT idtipopresu, tipopresu 
                                                             FROM presupuesto_tipo 
                                                             WHERE idestatus='1'");
                                 while ($valtpr = mysqli_fetch_array($querytpr)) {
                                    echo '<option value="'.$valtpr['idtipopresu'].'">'.$valtpr['tipopresu'].'</option>';
                                 } ?>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="apellido1">Clinica:</label>
                              <select id="idsexo" class="form-control form-control-sm" name="idclinica" required>
                                 <option value="" style="font-weight: bold;">-- Registradas --</option>
                                 <?php
                                 $querycl = $mysqli->query("SELECT a.idclinica,a.idmed, b.idmed, b.idlogin, c.idclinica,c.nombrecentrosalud FROM clinicamedico a, medicos b, clinicas c WHERE b.idlogin='".$idlogin."' AND a.idmed=b.idmed AND a.idclinica=c.idclinica");
                                 while ($valcl = mysqli_fetch_array($querycl)) {
                                    echo '<option value="'.$valcl['idclinica'].'">'.$valcl['nombrecentrosalud'].'</option>';
                                 } ?>
                                 <option value="" style="font-weight: bold;">-- Otras --</option>
                                 <?php
                                 $querycll = $mysqli->query("SELECT idclinica,clinica FROM clinicass");
                                 while ($valcll = mysqli_fetch_array($querycll)) {
                                    echo '<option value="'.$valcll['idclinica'].'">'.$valcll['clinica'].'</option>';
                                 } ?>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="apellido1">Medico:</label>
                              <?php if($privilegios==1){ ?>
                                 <select id="idsexo" class="form-control form-control-sm" name="idmed" required>
                                    <option value="">-- Seleccione --</option>
                                    <?php
                                    $querymed = $mysqli->query("SELECT idmed, idlogin, nombre1, apellido1 
                                                                FROM medicos 
                                                                WHERE idestatus='1'");
                                    while ($valmed = mysqli_fetch_array($querymed)) {
                                       echo '<option value="'.$valmed['idlogin'].'">'.$valmed['nombre1'].' '.$valmed['apellido1'].'</option>';
                                    } ?>
                                 </select>
                              <?php }elseif($privilegios==2){ ?>
                                 <select id="idsexo" name="idmed" 
                                         class="form-control form-control-sm" required>
                                    <option value="<?php echo $idlogin;?>"><?php echo $namedr;?></option>
                                 </select>
                              <?php } ?>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="fnacimiento">Fecha Intervención*:</label>
                              <input type="date" name="fdi" min="<?php echo $hoy;?>" value="<?php echo $hoy;?>" class="form-control form-control-sm ">
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="fnacimiento">Hora Intervención*:</label>
                              <input type="time" name="hdi" value="07:20:00" class="form-control form-control-sm " >
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="fnacimiento">Días Hospitalización:</label>
                              <input type="number" name="ddh" value="0" class="form-control form-control-sm " >
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="fnacimiento">Días UCI:</label>
                              <input type="number" name="dti" value="0" class="form-control form-control-sm " >
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="fnacimiento">Tiempo (Horas):</label>
                              <select name="teh" id="teh" class="form-control form-control-sm ">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                              </select>
                              
                           </div>
                        </div>
                         <div class="col-md-2">
                           <div class="form-group">
                              <label for="fnacimiento">Tiempo (Min):</label>
                              <select name="tem" id="tem" class="form-control form-control-sm ">
                                <option value="0">0</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                                <option value="30">30</option>
                                <option value="35">35</option>
                                <option value="40">40</option>
                                <option value="45">45</option>
                                <option value="50">50</option>
                                <option value="55">55</option>
                              </select>
                              
                           </div>
                        </div>
                        <div align="right" class="col-md-12">
                           <input style="background: #F89921;border-color: #F89921" type="submit" name="submit" value="Siguiente" class="btn btn-main btn-primary btn-lg uppercase">
                        </div>
                  </form>
                  <!-- /.card-body -->
               </div>
               <!-- /.card -->
            </div>
      </div>
      <div class="row">
         <div align="center" class="col-12">
            <a href="prefilterpacpresu.php" class="btn btn-secondary">Atrás</a>
         </div>
      </div>
      </section>
      <!-- /.content -->
   </div>
   <!-- /.content-wrapper -->

   <?php include("foo_admin.php"); ?>

   <!-- Control Sidebar -->
   <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
   </aside>
   <!-- /.control-sidebar -->
   </div>
   <!-- ./wrapper -->

   <!-- jQuery -->
   <script src="../../plugins/jquery/jquery.min.js"></script>
   <!-- Bootstrap 4 -->
   <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
   <!-- AdminLTE App -->
   <script src="../../dist/js/adminlte.min.js"></script>
   <!-- AdminLTE for demo purposes -->
   <script src="../../dist/js/demo.js"></script>
   <script>
      function validacion() {
         costo = document.getElementById("costo").value;
         if (isNaN(costo)) {
            alert('Error Costo!!!');
            return false;
         }
      }
   </script>

</body>

</html>