<?php
session_start();
$usuario = $_SESSION['usuario'];
require('../../conexion.php');
if (isset($_GET['id'])) {
   $idimage=$_GET['id'];
   $sql = ("SELECT a.idimage, a.servicio, a.zona, a.estudio, a.idestatus, b.estatus FROM servimage a, estatus b
         WHERE a.idestatus=b.idestatus AND idimage= '" . $idimage . "';");   
   $obj = $mysqli->query($sql);
   $row = mysqli_fetch_array($obj);
   $servicio = $row['servicio'];
   $zona = $row['zona'];
   $estudio = $row['estudio'];
   $idestatus = $row['idestatus'];
   $estatus = $row['estatus'];
}
//else{echo '<script language="javascript">alert(" Error!!!");window.location.href="../../index.php?usr=1"; </script>';}
if (isset($_POST['submit'])) {
   /*Asigno variables*/
   $idimage = $_POST['idimage'];
   $x = $_POST['idimage'];
   $servicio = trim($_POST['servicio']);
   $zona = trim($_POST['zona']);
   $estudio = trim($_POST['estudio']);
   $idestatus= $_POST['idestatus'];
   
   $str = "UPDATE servimage SET servicio='".ucfirst($servicio)."',zona='".ucfirst($zona)."',estudio='".ucfirst($estudio)."',idestatus='".$idestatus."' 
            WHERE idimage ='".$idimage."';"; 
   //VALUES (null,'".$codserv."' ,'" .ucfirst( $especialidadmed) . "','" . $estatus . "')";
   
   $conexion = $mysqli->query($str);

   echo '<script language="javascript">alert(" Registro Exitoso !!!");window.location.href="rpt_servimg.php?id='.$x.'"; </script>';
}
?>
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
                     <h1>Registro Estudios Imagenología</h1>
                  </div>
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../../index.php?usr=1">Home</a></li>
                        <li class="breadcrumb-item active">Imagenología</li>
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
                  <h3 class="card-title">Estudios Imagenología</h3>

                  <div class="card-tools">
                     <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                  </div>
               </div>
               <div class="card-body">
                  <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                     <input type="hidden" name="idimage" value="<?php echo $idimage;?>">
                     <div class="row">
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="inputName">Servicio</label>
                              <input type="text" value="<?php echo $servicio;?>" name="servicio" class="form-control">
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="inputName">Zona</label>
                              <input type="text" value="<?php echo $zona;?>" name="zona" class="form-control">
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="inputName">Estudio</label>
                              <input type="text" value="<?php echo $estudio;?>" name="estudio" class="form-control">
                           </div>
                        </div>
                        <div class="col-md-1">
                           <div class="form-group">
                              <label for="inputStatus">Estatus:</label>
                              <select class="form-control custom-select" name="idestatus" required>
                                 <option value="<?php echo $idestatus;?>"><?php echo $estatus;?></option>
                                 <option value="1">Activo</option>
                                 <option value="2">Inactivo</option>
                              </select>
                           </div>
                              </div>
                        
                        <div align="right" class="col-md-12">
                           <input style="background: #F89921;border-color: #F89921" type="submit" name="submit" value="Actualizar..." class="btn btn-main btn-primary btn-lg uppercase">
                        </div>
                  </form>
                  <!-- /.card-body -->
               </div>
               <!-- /.card -->
            </div>

      </div>
      <div class="row">
         <div align="center" class="col-12">
            <a href="rpt_servimg.php" class="btn btn-secondary">Atras</a>
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
   <!-- AdminLTE App -->
   <script src="../../dist/js/adminlte.min.js"></script>
   <!-- AdminLTE for demo purposes -->
   <script src="../../dist/js/demo.js"></script>
</body>

</html>