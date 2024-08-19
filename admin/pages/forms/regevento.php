<?php
	session_start();
	$usuario=$_SESSION['usuario'];
	$privilegios = $_SESSION['privilegios'];
	require('../../conexion.php');
	if(isset($_POST['submit'])){
		/*Asigno variables*/
		$nomevento    =$_POST['nomevento']; 
		$fechaori     =$_POST['fechacita'];
		$originalDate = str_replace("/","-","$fechaori");
		$fechacita    = date("Y-m-d", strtotime($originalDate));
		$horacita     =$_POST['horacita'];
		$ampm         = substr("$horacita",-2);
		$horacita     = str_replace("PM","","$horacita");
		$horacita     = str_replace("AM","","$horacita");
		$hora = explode(":", $horacita);
		$horav = abs($hora[0]);
		//echo $horav;exit();
		if($horav<9){
			$horaok='0'.$horacita;
		}else{
			$horaok=$horacita;		
		}
		//echo $horaok.$ampm.'<fin...';exit();
		$telefono     =$_POST['telefono'];
		$correo       =$_POST['correo'];
		$importancia  =$_POST['importancia'];
		$tipo         =$_POST['tipo'];
		$descripcion  =$_POST['descripcion'];
		$idasesor     =$_POST['idasesor'];
		
		$str="INSERT INTO citas (nombre, fechacita, horacita, ampm, telefono, correo, comentario, importancia, tipo, estatus, asignadoa)VALUES('".$nomevento."','".$fechacita."','".$horacita."','".$ampm."','".$telefono."','".$correo."','".$descripcion."','".$importancia."','".$tipo."','A','".$idasesor."');";
		$conexion=$mysqli->query($str);	
		// Registro en bitacora
		// Busco ultimo inserta para Insertar en tabla de auditoria(inmuebles_r)
		$sql="SELECT max(idcita) idcita FROM citas";
		$query=$mysqli->query($sql);	
		$arridmax = mysqli_fetch_array($query);
		$idcita=$arridmax['idcita'];
		$str="INSERT INTO inmuebles_r(id, codinm, titulo, modulo, usuario, accion) VALUES ('".$idcita."','0','".$nomevento."','CITAS','".$usuario."', 'I');";
		$conexion=$mysqli->query($str);
		//echo $str; exit();
		echo '<script language="javascript">alert("¡Registro Exitoso!");
	    window.location.href="rpt_agenda.php"; </script>';
	}	
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard</title>
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
<!--  -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Crear Actividad</h1>
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
            <div style="background: #F89921"  class="card-header">
              <h3 class="card-title">Actividad</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
			<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
			<div class="row">
           <!-- -->
			<div class="col-md-8">
			  <div class="form-group">
                <label for="inputName">Nombre de la Actividad:</label>
                <input type="text" id="nomevento" name="nomevento" class="form-control form-control-sm">
              </div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
                  <label>Fecha:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="text"  name="fechacita" class="form-control form-control-sm" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                  </div>
                  <!-- /.input group -->
                </div>
			  <!--div class="form-group">
                <label for="inputName">Fecha:</label>
                <input type="date" name="fecevento" class="form-control">
              </div-->
			</div>
			<div class="col-md-2">
			   <div class="bootstrap-timepicker">
                  <div class="form-group">
                    <label>Hora:</label>

                    <div class="input-group date" id="timepicker" data-target-input="nearest">
                      <input type="text" id="horita" name="horacita" class="form-control form-control-sm datetimepicker-input" data-target="#timepicker"/>
                      <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="far fa-clock"></i></div>
                      </div>
                      </div>
                    <!-- /.input group -->
                  </div>
                  <!-- /.form group -->
                </div>
			  <!--iv class="form-group">
                <label for="inputName">Hora:</label>
                <input type="time" name="horevento" class="form-control">
              </div-->
			</div>
			<!-- -->
			<div class="col-md-4">
			    <div class="form-group">
                  <label>Telefono:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="text" name="telefono" class="form-control form-control-sm" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                  </div>
                  <!-- /.input group -->
                </div>
			</div>
			<div class="col-md-4">
			  <div class="form-group">
                <label for="inputName">Correo:</label>
                <input type="email" name="correo" class="form-control form-control-sm">
              </div>
			</div>
			<div class="col-md-2">
              <div class="form-group">
                <label for="inputStatus">Importancia</label>
                <select class="form-control form-control-sm custom-select" id="importancia" name="importancia">
                  <option value="B">Baja</option>
                  <option value="M">Media</option>
                  <option value="A">Alto</option>
                </select>
              </div>
			</div>
			<div class="col-md-2">
              <div class="form-group">
                <label for="inputStatus">tipo</label>
                <select class="form-control custom-select form-control-sm" name="tipo">
                  <option value="V">Ver Inmueble</option>
                  <option value="M">Mostrar Inmueble</option>
                  <option value="R">Reunión</option>
                </select>
              </div>
			</div>
			<!-- -->
			<div class="col-md-12">
			  <div class="form-group">
                <label for="inputName">Breve Descripción:</label>
                <input type="text" id="descripcion" name="descripcion" class="form-control form-control-sm">
              </div>
			</div>
			
			<!--button type="submit" value="submit" class="btn btn-main btn-primary btn-lg uppercase" id="contact-submit"><span>Registrar...</span></button-->
			<div align="right" class="col-md-12">
				<input style="background: #F89921;border-color: #F89921" type="submit" name="submit" value="Registrar..." class="btn btn-main btn-primary btn-lg uppercase">
			</div>	
		</form> 
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
	  <div class="row">
        <div align="center" class="col-12">
          <a href="rpt_agenda.php" class="btn btn-secondary">Atras</a>          
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
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LTS'
    })
    
    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

  })
</script>
</body>
</html>