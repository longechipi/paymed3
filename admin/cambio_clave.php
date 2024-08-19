<?php
session_start();
$usuario = $_SESSION['usuario']; //echo $usuario; exit();
require('conexion.php');
if (isset($usuario)) {

  $sql = ("SELECT * FROM loginn WHERE correo = '".$usuario."'");
    $arrcli = $mysqli->query($sql); $rowcli = mysqli_fetch_array($arrcli);
      $correo = $rowcli['correo'];

}
// * * * * * * * * * * * * * * * * * * * * * * * * * * *
if (isset($_POST['submit'])) {
  //datos 
  $userr    = $_POST['userr'];
  $nclave   = $_POST['nclave'];
  $rnclave  = $_POST['rnclave'];

  if($nclave==$rnclave){
    $str = "UPDATE loginn SET clave='".strtoupper($nclave)."' WHERE correo='".$userr."'";
      $conexion = $mysqli->query($str);
        echo '<script language="javascript">alert("¡Actualizado Con Exito!");
                                            window.location.href="index.php?usr=1"; </script>';    
  }else{
        echo '<script language="javascript">alert("Las contraseñas no coinciden");
                                             </script>';}
} ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PAYMED GLOBAL, LLC</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- -->
    <?php include("menu-clave.php"); ?>
    <!--  -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Modificación de Clave</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../../index.php?usr=1">Home</a></li>
                <li class="breadcrumb-item active">Actualizar</li>
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
            <h3 class="card-title">Actualización de Clave </h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
          </div>
          <div class="card-body">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return validacion()">
              <input type="hidden" name="idclinica" value="<?php echo $idclinica; ?>">
              <div class="row">
                <div class="col-md-4">
                  <label for="rif">Clave Anterior</label>
                  <div class="form-group">
                    <input type="text" value="123" class="form-control form-control-sm " disabled>
                    <input type="hidden" value="<?php echo $correo;?>" name="userr"
                           class="form-control form-control-sm">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="razsocial">Nueva Clave:</label>
                    <input type="text" name="nclave" minlength="6" maxlength="8" 
                           class="form-control form-control-sm">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="razsocial">Repita Clave:</label>
                    <input type="text" name="rnclave" minlength="6" maxlength="8" 
                           class="form-control form-control-sm">
                  </div>
                </div>

                <div align="right" class="col-md-12">
                  <input style="background: #F89921;border-color: #F89921" type="submit" name="submit" value="Actualizar & Continuar" class="btn btn-main btn-primary btn-lg uppercase">
                </div>
            </form>

            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
    </div>
    <div class="row">
      <div align="center" class="col-12">
        <a href="../login.html" class="btn btn-secondary">Salir</a>
      </div>
    </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include("pages/forms/foo_admin.php"); ?>

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
    function validacion(){
      costo = document.getElementById("costo").value;
      if( isNaN(costo) ) {
        alert('Error Costo!!!');
        return false;
      }
    }
  </script>

</body>

</html>