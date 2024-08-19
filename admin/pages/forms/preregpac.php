<?php
session_start();
date_default_timezone_set('America/Caracas');
$hoy=date('Y-m-d');
$usuario = $_SESSION['usuario'];
$idlogin = $_SESSION['idlogin'];

require('../../conexion.php');
/*Capturo Variables _SESSION que vienen de selecciones dia y hora de consulta */
if (isset($_GET['iid'])) {
    $valores=$_GET['iid'];
    //$fechacita=substr($valores, 0,10);$horacita=substr($valores, 19,5);$idclinica=substr($valores,24);
    $_SESSION['sefechacita']=substr($valores, 0,10);
    $_SESSION['sehoracita']=substr($valores, 19,5);
    $_SESSION['seidclinica']=substr($valores,24);
}
if (isset($_POST['submit'])) {
  /*Asigno variables*/
  $tprif = $_POST['tprif'];
  $rif   = $tprif.''.$_POST['rif'];
  $_SESSION['tipodoc']=$_POST['tprif'];
  $_SESSION['nrodoc']=$_POST['rif'];

  $sqlpaci = ("SELECT count(idpaci) as numero, idpaci FROM pacientes WHERE cedula='".$rif."'");
  $arrpaci=$mysqli->query($sqlpaci); $rowpaci = mysqli_fetch_array($arrpaci);
  $cuan =$rowpaci['numero']; $pac =$rowpaci['idpaci'];

  if($cuan>0){  // Paciente registrado
      /* Comentado, no debe validar si el paciente es de un Dr X o Y, puede tomar citas con cualquier Dr.
      Cuando estaba activo faltaba esto "Valido que el Paciente sea del Dr Logeado (falta cuando es Asistente)" * /
      $sqlesdeldr = ("SELECT count(*) as es FROM pacientes a, medicos b
                      WHERE a.idmed=b.idmed 
                      AND b.idlogin ='".$_SESSION['idlogin']."'
                      AND cedula='".$rif."';");
      //echo $sqlesdeldr; exit();
      $arresdeldr=$mysqli->query($sqlesdeldr); $rowesdeldr = mysqli_fetch_array($arresdeldr);
      $esonoesdeldr =$rowesdeldr['es'];
      if($esonoesdeldr=='0'){
        echo '<script language="javascript">alert("Paciente De Otro Medico!!!");window.location.href="preregpac.php"; </script>';
      }  */

      /* Primera validacion solicitada: Valido que no tengo cita para el mismo dia y hora.*/
      $fechacita=$_SESSION['sefechacita'];$horacita=$_SESSION['sehoracita'];
      //$sqlbuscita = ("SELECT count(*) as hay FROM citas a, pacientes b WHERE a.idpaci=b.idpaci AND b.cedula ='".$rif."' AND a.horacita='".$horacita."' AND a.fechacita='".$fechacita."'; ");
      /* Segunda validacion solicitada: Valido que no tengo cita para el mismo dia con el mismo medico.*/
      // Ori $sqlbuscita = ("SELECT count(*) as hay FROM citas a, pacientes b, medicos c WHERE a.idpaci=b.idpaci  and b.idmed=c.idmed and c.idlogin='".$idlogin."' AND b.cedula ='".$rif."'AND a.fechacita>='".$fechacita."'; ");
      $sqlbuscita = ("SELECT count(*) as hay FROM citas a, pacientes b, medicos c
                      WHERE a.idpaci=b.idpaci 
                      and b.idmed=c.idmed
                      AND b.cedula ='".$rif."'
                      AND a.fechacita>='".$hoy."'; ");
      //echo $sqlbuscita; exit();
      $arrbuscita=$mysqli->query($sqlbuscita); $rowbuscita = mysqli_fetch_array($arrbuscita);
      $hay =$rowbuscita['hay'];
      if($hay>0){
        //echo '<script language="javascript">alert("Paciente Con Cita Registrada Para La Fecha!!!");window.location.href="preregpac.php"; </script>';
        echo '<script language="javascript">window.location.href="showcitas.php?idpc='.$pac.'"; </script>';
      }
      //echo '<script language="javascript">window.location.href="regpac.php?idpac='.$pac.'"; </script>';
      echo '<script language="javascript">window.location.href="regcitapac.php?idpc='.$pac.'"; </script>';
  }else{
      echo '<script language="javascript">window.location.href="regpac.php?ced='.$rif.'"; </script>';
  }

} ?>
                                      
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard | PayMed</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="../../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">

    <!-- Main Sidebar Container -->
    <!-- -->
    <?php include("menuppal.php"); ?>
    <!-- -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Paciente</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../../index.php?usr=1">Home</a></li>
                <li class="breadcrumb-item active">CI</li>
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
            <h3 class="card-title">Paciente</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
          </div>
          <div class="card-body">
            <!--form id="FormSolCita" action="< ?php echo $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return validacion(this)"-->  
            <form id="FormSolCita" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">  
              <div align="center" class="row">
                <div class="col-md-4"></div>
                <div class="col-md-1">
                  <div class="form-group">
                    <label for="rif">Tipo:</label>
                    <select class="form-control form-control-sm" id="tprif" name="tprif">
                      <option value="V">V</option>
                      <option value="J">J</option>
                      <option value="E">E</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <label for="rif">Nro de Documento</label>
                  <div class="form-group">
                    <input type="text" name="rif" id="rif" minlength="6" maxlength="9" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" class="form-control form-control-sm " required>
                  </div>
                </div>
              </div>
              <div align="center" class="col-md-12">
                <input style="background: #F89921;border-color: #F89921" type="submit" name="submit" 
                       value="Consultar" class="btn btn-main btn-primary btn-lg uppercase">
              </div>
            </form>
            <!-- /.card-body -->

          </div>
          <!-- /.card -->
        </div>
        <div class="row">
          <div align="center" class="col-12">
            <a href="rpt_citpac.php" class="btn btn-secondary">Atrás</a>
            <!--a href="javascript: history.go(-1)" class="btn btn-secondary">Atrás</a-->
          </div>
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
  <!-- jquery-validation new -->
  <script src="../../plugins/jquery-validation/jquery.validate.min.js"></script>
  <script src="../../plugins/jquery-validation/additional-methods.min.js"></script>
  <!-- Select2 -->
  <script src="../../plugins/select2/js/select2.full.min.js"></script>
  <!-- Bootstrap4 Duallistbox -->
  <script src="../../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
  <!-- InputMask -->
  <script src="../../plugins/moment/moment.min.js"></script>
  <script src="../../plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
  <!-- date-range-picker -->
  <script src="../../plugins/daterangepicker/daterangepicker.js"></script>
  <!-- bootstrap color picker -->
  <script src="../../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Bootstrap Switch -->
  <script src="../../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
  <!-- Sweetalert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../../dist/js/demo.js"></script>
  <!-- Page script -->
  <script>
    $(function() { //alert();

    })
  </script>

</body>

</html>