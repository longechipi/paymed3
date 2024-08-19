<?php
session_start();
$usuario = $_SESSION['usuario'];
require('../../conexion.php');
$paso=0;



if(isset($_GET['pac'])){
   $paso=1;
   $idcita = $_GET['pac'];
   $sqldatos = ("SELECT * FROM citas WHERE idcita='".$idcita."'");
      $objdatos = $mysqli->query($sqldatos); $arrdatos = $objdatos->fetch_array();
         $idpaci = $arrdatos['idpaci']; 
      }

if (isset($_POST['submit'])) {
   $idpaci = $_POST['idpaci'];
   $diagno = $_POST['diagno'];

      $str="UPDATE citas SET diagnostico='".strtoupper($diagno)."', idestatus='5'
            WHERE idcita ='".$idpaci."'";
       //echo $str;exit();
            $conexion=$mysqli->query($str);
               echo '<script language="javascript">alert("¡Actualizacion Exitosa!");
                                                      window.location.href="rpt_citas.php"; </script>';

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
   <script type="text/javascript">
      $(document).ready(function() {
         $("#idpais").change(function() {
            $.get("pais_js.php", "idpais=" + $("#idpais").val(), function(data) {
               $("#id_estado").html(data);
               console.log(data);
            });
         });

         $("#id_estado").change(function() {
            $.get("estados_js.php", "id_estado=" + $("#id_estado").val(), function(data) {
               $("#id_municipio").html(data);
               console.log(data);
            });
         });

         $("#id_municipio").change(function() {
            $.get("munic_js.php", "id_municipio=" + $("#id_municipio").val(), function(data) {
               $("#id_parroquia").html(data);
               console.log(data);
            });
         });


      });

      //*validacion de fecha
      function calcedad(fecha) {
         //alert(fecha);return false;
         jQuery.ajax({
            type: "POST",
            url: "caledad_js.php",
            data: {
               fecha: fecha
            },
            success: function(data) {
               var edad = parseInt(data);
               if (edad < 25 || edad > 80 || isNaN(edad)) {
                  document.getElementById("edad").value = 'Error';
                  return false;
               } else {
                  document.getElementById("edad").value = data;
               }
            },
            error: function() {}
         });
      }
   </script>
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
                     <h1>Pacientes</h1>
                  </div>
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../../index.php?usr=1">Home</a></li>
                        <li class="breadcrumb-item active">Registro</li>
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
                  <h3 class="card-title">Registro</h3>

                  <div class="card-tools">
                     <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                  </div>
               </div>
               <div class="card-body">
                  <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return validacion()">
                     <div class="row">
                        <!-- 1ra -->
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="correo">Nro de Historia:</label>
                              <input type="email" name="correo" id="correo" class="form-control form-control-sm " readonly value="<?php if($paso==1){echo $arrdatos['historia'];}?>">
                           </div>
                        </div>

                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="apellido1">1er Apellido </label>
                              <input type="text" name="apellido1" id="apellido1" style="text-transform:uppercase;" onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;" class="form-control form-control-sm " readonly 
                              value="<?php if($paso==1){echo $arrdatos['apellido'];}?>">
                           </div>
                        </div>
                        
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="nombre1">1er Nombre </label>
                              <input type="text" name="nombre1" id="nombre1" style="text-transform:uppercase;" onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;" class="form-control form-control-sm " readonly 
                              value="<?php if($paso==1){echo $arrdatos['nombre'];}?>">
                           </div>
                        </div>
                              
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="correo">Fecha Cita:</label>
                              <input type="email" name="correo" id="correo" class="form-control form-control-sm " readonly value="<?php if($paso==1){echo $arrdatos['fechacita'];}?>">
                           </div>
                        </div>

                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="correo">Hora Cita:</label>
                              <input type="email" name="correo" id="correo" class="form-control form-control-sm " readonly value="<?php if($paso==1){echo $arrdatos['horacita'];}?>">
                           </div>
                        </div>

                        
                        <!-- 2da -->
                        <div class="col-md-12">
                           <div class="form-group">
                              <label for="correo">Motivo de Consulta:</label>
                              <textarea class="form-control form-control-sm " rows="5" readonly>
                                 <?php if($paso==1){echo $arrdatos['motivo'];}?></textarea>
                           </div>
                        </div>

                        <!-- 3era -->
                        <div class="col-md-12">
                           <div class="form-group">
                              <label for="correo">Diagnostico:</label>
                              <textarea name="diagno" class="form-control form-control-sm " rows="8" style="text-transform:uppercase;"></textarea>
                              <input type="hidden" name="idpaci" value="<?php echo $idpaci;?>">
                           </div>
                        </div>      

                        <!-- 4ta -->
                        <div class="col-md-12">
                           <div class="form-group">
                              <label for="correo">Informes/Examenes/Documentos:</label>
                              <input type="file" class="form-control form-control-sm " name="imagen_des" multiple>
                           </div>
                        </div>                   
                        <div align="right" class="col-md-12">
                           <input style="background: #F89921;border-color: #F89921" type="submit" name="submit" value="Guardar..." class="btn btn-main btn-primary btn-lg uppercase">
                        </div>
                  </form>
                  <!-- /.card-body -->
               </div>
               <!-- /.card -->
            </div>
      </div>
      <div class="row">
         <div align="center" class="col-12">
            <a href="rpt_citas.php" class="btn btn-secondary">Atrás</a>
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