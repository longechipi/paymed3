<?php
	require('../../conexion.php');
	$sql = ("SELECT idtppr, tipoprov, idestatus FROM tipoproveedor");
	$result=$mysqli->query($sql);		
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
<style>
.buttonr {
  background-color: #34358f; /* Orange */
  border: #34358f;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
</style>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

<!--  -->
<?php include("menuppal.php"); ?>
<!-- -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tipos Proveedor</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../../index.php?usr=1">Home</a></li>
              <li class="breadcrumb-item active">Proveedor</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
  <section class="content">
			<div align="center" class="col-md-12">
				<form action="regtpprov.php" method="POST">
					<input style="background: #F89921;border-color: #F89921" type="submit" name="submit1" value="Añadir" class="btn btn-main btn-primary btn-lg uppercase">
					<!--a class="btn btn-info btn-sm" href="reguser.php">Añadir</a-->
					<!--boton class="buttonr"><a style="color: #FFFFFF;font-family: 'Lato', sans-serif;font-size: 18px;font-weight: bold;" href=".php">Añadir</a></boton-->
				</form>
			<!--/div--><br>
      <!-- Default box -->
      <div class="card">
        <div style="background: #F89921;color: #fff;font-weight: bold;" class="card-header">
          <h3 class="card-title">Listado Tipo Proveedores</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <!--button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button-->
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 1%">
                          ID
                      </th>
                      <th style="text-align:center">
                          Proveedor
                      </th>
                      <th >
                          Estatus
                      </th style="text-align:center">
                      <th></th>
                  </tr>
              </thead>
              <tbody>
				  <?php while($row = mysqli_fetch_array($result)) { 
            //if ($row['tipo']=='1') {$tiponombre='Nacional';}elseif ($row['tipo']=='2') {$tiponombre='Internacional';}
            ?>
                  <tr>
                      <td style="text-align:center"><?php echo $row['idtppr']; ?></td>
                      <td style="text-align:center"><?php echo $row['tipoprov']; ?></td>
                      
                      <td><?php 
                            $sqlst = ("SELECT estatus FROM estatus WHERE idestatus = '".$row['idestatus']."'");
                              $respst=$mysqli->query($sqlst); $rowst = mysqli_fetch_array($respst);
                              echo $rowst['estatus']; ?>
                          
                      </td>
                      <td class="project-actions text-right">
                        <?php if ($row['idestatus']=='2') { ?>
						              <a class="btn btn-success btn-sm" href="onoffprov.php?id=<?php echo $row['idtppr'];?>&onoff=x1"><i class="fas fa-pencil-alt"></i> Activar</a>
                        <?php }else if ($row['idestatus']=='1') { ?>
                          <a class="btn btn-light" href="onoffprov.php?id=<?php echo $row['idtppr'];?>&onoff=x9"><i class="fas fa-pencil-alt"></i> Desactivar</a>
                      <?php } ?>
                        <a class="btn btn-danger btn-sm" href="src_del_tpprov.php?id=<?php echo $row['idtppr'];?>"><i class="fas fa-trash"></i> Eliminar</a>
                      </td>
                  </tr>
				<?php
					}
				?>
              </tbody>
          </table>
        </div>
        <!-- /.card-body  -->
      </div>
      <!-- /.card -->
      
      		<div align="center" class="col-md-12">
				<a class="btn btn-danger btn-sm" href="../../index.php?usr=1"><i class="fas fa-backward"></i> Regresar</a>				
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
<!-- Page script -->
<script type="text/javascript">
$(document).ready(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      alert( "Form successful submitted!" );
    }
  });
  $('#quickForm').validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
        minlength: 5
      },
      terms: {
        required: true
      },
    },
    messages: {
      email: {
        required: "Please enter a email address",
        email: "Please enter a vaild email address"
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      terms: "Please accept our terms"
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>
</body>
</html>