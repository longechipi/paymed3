<?php
//ALTER TABLE `pacientes` ADD `dirnovzla` VARCHAR(200) NOT NULL COMMENT 'Direccion Fuera de Vzla' AFTER `codpostal`, ADD `codpostalnovzla` VARCHAR(5) NOT NULL COMMENT 'Cod Postal Fuera de Vzla' AFTER `dirnovzla`;
session_start();
date_default_timezone_set('America/Caracas');
$usuario = $_SESSION['usuario'];
$idlogin = $_SESSION['idlogin'];

require('../../conexion.php');
//if(isset($rif)){$rif=$_GET['ced'];}
if(isset($_GET['cit'])){
   $idcita=$_GET['cit'];  //$idcli=$_GET['idcli'];$idmed=$_GET['idmed'];
   $sqldatos = ("SELECT fechacita, horacita, idclinica, idmed FROM citas WHERE idcita='".$idcita."'");
   $objdatos = $mysqli->query($sqldatos); $arrdatos = $objdatos->fetch_array();
   $fechacita = $arrdatos['fechacita']; $horacita = $arrdatos['horacita']; 
   $idclinica = $arrdatos['idclinica']; $idmed = $arrdatos['idmed']; 

   $fechacitatitulo = $arrdatos['fechacita']; // Fecha Solo para el titulo que se pidio con formato dd/mm/AAAA
   $fechacitatitulo=date_create($fechacitatitulo);
   $fechaactual=date('d-m-Y');

   $sqlpacxdia=("SELECT concat(apellido,' ',nombre) as allname, fechacita, horacita FROM citas 
   WHERE idmed='".$idmed."' AND idclinica='".$idclinica."' AND fechacita='".$fechacita."';");
   $objpacxdia=$mysqli->query($sqlpacxdia);
   /*Busco hora de inicio de consulta para  */
   $sqlhora=("SELECT desde FROM horariomed WHERE idmed='".$idmed."' AND idclinica='".$idclinica."' LIMIT 1;");
   //echo $sqlhora; exit();
   $objhora=$mysqli->query($sqlhora); $arrhora=$objhora->fetch_array(); $desde=$arrhora[0];
   $desde=strtotime($desde); $desde = strtotime ( '-30 minute' , $desde );

}

if (isset($_POST['submit'])) {
   //datos 

   $idcita = $_POST['idcita'];
   $fechacita = $_POST['fechacita'];
   $horacita = $_POST['horacita'];  

   $str="UPDATE citas SET fechacita='".$fechacita."', horacita='".$horacita."' WHERE idcita='".$idcita."'";
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
   <!-- SweetAlert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <!-- Google Font: Source Sans Pro -->
   <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
   <script src="jquery/jquery-3.2.1.min.js"></script>
   <script type="text/javascript">
      $(document).ready(function() { });
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
                     <h4>.</h4>
                  </div>
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../../index.php?usr=1">Home</a></li>
                        <li class="breadcrumb-item active">Reagendar</li>
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
                  <h3 class="card-title">Re-Agendar Cita</h3>

                  <div class="card-tools">
                     <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                  </div>
               </div>
               <div class="card-body">
                  <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return validacion()">
                     <input type="hidden" name="idcita" value="<?php echo $idcita;?>">
                     <input type="hidden" id="idlogin" value="<?php echo $idlogin;?>">
                     <input type="hidden" id="idmed" value="<?php echo $idmed;?>">
                     <center> <h1>Re-Agendar Cita</h1></center><hr>
                     <div class="row">
                        <!-- 1ra -->
                        <div class="col-md-4">
                           <div class="form-group">
                              
                              <p style="font-family:bold; font-size:26px;">Fecha Actual: <strong> <?php echo $fechaactual; ?> </strong> </p>
                              <label for="fechacita">Nueva Fecha Cita:</label>
                              <input type="date" name="fechacita" id="fechacita" class="form-control form-control-sm" required>
                           </div>
                        </div>
                        
                        <div class="col-md-4">
                           <div class="form-group">
                              <p style="font-family:bold; font-size:26px;">Hora Actual:<strong> <?php echo $horacita; ?> </strong> </p>
                              <label for="horacita">Hora Cita:</label>
                              <!--input type="time" name="horacita" id="horacita" min="08:00" max="18:00" step="1800" class="form-control form-control-sm " value="08:00" required-->
                              <select id="horacita" name="horacita" class="form-control form-control-sm " required>
                                 <?php
                                 
                                 for ($x = 0; $x <= 22; $x++) {
                                    $desde = strtotime ( '+30 minute' , $desde );
                                    $desde   = date ( 'H:i' , $desde );

                                    //$desde=strtotime($desde);
                                    echo '<option value="'.$desde.'">'.$desde.'</option>';
                                    $desde=strtotime($desde);
                                 }
                                 ?>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <p style="font-family:bold; font-size:26px;">Citas del Dia: <strong> <?php echo date_format($fechacitatitulo,"d-m-Y"); ?> </strong> </p>
                           <ul class="list-group">
                           <?php while ($row = mysqli_fetch_array($objpacxdia)) { ?>
                              <li class="list-group-item d-flex justify-content-between align-items-center">
                                 <?php echo $row['allname'];?>
                                 <span class="badge badge-primary badge-pill"><?php echo $row['horacita'];?></span>
                              </li>
                           <?php } ?>
                        </ul><br>
                        </div>
                        <!-- 8da  -->
                        <div align="right" class="col-md-12">
                           <input style="background: #F89921;border-color: #F89921" type="submit" name="submit" value="Actualizar" class="btn btn-main btn-primary btn-lg uppercase">
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
   <!-- Admin LTE App -->
   <script src="../../dist/js/adminlte.min.js"></script>
   <!-- AdminLTE for demo purposes -->
   <script src="../../dist/js/demo.js"></script>
   <script>
      function validacion() {
         const fechacita = document.getElementById("fechacita").value;
         const horacita = document.getElementById("horacita").value;
         const idlogin = document.getElementById("idlogin").value;
         const idmed = document.getElementById("idmed").value;
         var hoy     = new Date();
         var ffechacita = new Date(fechacita+'T00:00:00');

         // Compara solo las fechas => no las horas!!
         hoy.setHours(0,0,0,0);

         if (ffechacita < hoy) {
           alert("Error Fecha, menor de hoy");
           return false;
         }
         /*if (isNaN(costo)) { alert('Error Costo!!!'); return false; }*/
         jQuery.ajax({
                 type: "POST",  
                 url: "versihaycita_js.php",
                 async: false,
                  data: {idlogin: idlogin, idmed: idmed, fechacita: fechacita, horacita: horacita},
                 success:function(data){
                    //alert(data);
                    no='0';
                    if (data=='0') {
                        no='1';
                        Swal.fire(
                          'Dia No Hay ',
                          'Consulta',
                          'error'
                        )
                    }else if(data=='99'){
                        no='1';
                        Swal.fire(
                          'Fecha y Hora ',
                          'Ocupada...',
                          'error'
                     )
                    }

                 },
                  error:function (){}
         });
         if (no=='1') {
            return false;
         }
      }
   </script>

</body>

</html>