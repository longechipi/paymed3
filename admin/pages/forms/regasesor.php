<?php
	session_start();
	$usuario=$_SESSION['usuario'];
	require('../../conexion.php');
	if(isset($_POST['submit'])){
		/*Asigno variables*/
		$nombre1     =$_POST['nombre1'];
		$nombre2     =$_POST['nombre2'];
		$apellido1   =$_POST['apellido1'];
		$apellido2   =$_POST['apellido2'];
		$cedula      =$_POST['cedula'];
		$fechaori    =$_POST['fnacimiento'];
		$originalDate = str_replace("/","-","$fechaori");
		$fnacimiento = date("Y-m-d", strtotime($originalDate));
		
		$correo      =$_POST['correo'];
		$telefono    =$_POST['telefono'];
		$movil       =$_POST['movil'];
		$direccion   =$_POST['direccion'];
		$idarea      =$_POST['idarea'];
		// busco nombre del Area
			$sql="SELECT area FROM offer_areas where idarea='".$idarea."' ";
			$query=$mysqli->query($sql);	
			$arr_area = mysqli_fetch_array($query);
			$area=$arr_area['0'];
		// fin 	
		$idpuesto    =$_POST['idpuesto'];
		// busco Tipo de nombre puesto de trabajo
			$sql="SELECT tipo FROM offer_tp where idpuesto='".$idpuesto."' ";
			$query=$mysqli->query($sql);	
			$arr_tipcont = mysqli_fetch_array($query);
			$tipo=$arr_tipcont['0'];
		// fin	
		$anosexp        =$_POST['anosexp'];
		$recomend       =$_POST['recomend'];
		$vehiculo       =$_POST['vehiculo'];
		$lugartrabajo   =$_POST['lugartrabajo'];
		$porcentaje     =$_POST['porcentaje'];
		$totalpercibido =$_POST['totalpercibido'];
		
		$fecreg      =date("Y-m-d");
		
		
		// Carga foto
		$imagen = '';
		if(!empty($_FILES["imagen_des"]["type"])){
			$fileName = time().'_'.$_FILES['imagen_des']['name'];
			$valid_extensions = array("jpg", "png", "jpeg");
			$temporary = explode(".", $_FILES["imagen_des"]["name"]);
			$file_extension = end($temporary);
			if((($_FILES["imagen_des"]["type"] == "image/png") || ($_FILES["imagen_des"]["type"] == "image/jpg") || ($_FILES["imagen_des"]["type"] == "image/jpeg")) && in_array($file_extension, $valid_extensions)){
				$sourcePath = $_FILES['imagen_des']['tmp_name'];
				$targetPath = "img/".$fileName;
				if(move_uploaded_file($sourcePath,$targetPath)){
					$imagen = $fileName;
				}
			}
		}
		//echo $categoria.'--'.$describelo; exit();
		$str="INSERT INTO asesor(idasesor, apellido1, apellido2, nombre1, nombre2, cedula, fnacimiento, correo, telefono, movil, direccion, idarea, area, idpuesto, tipo, anosexp, recomend, vehiculo, lugartrab, porcentaje, estatus, imagen, fecreg) VALUES ('0','".$apellido1."','".$apellido2."','".$nombre1."','".$nombre2."','".$cedula."','".$fnacimiento."','".$correo."','".$telefono."','".$movil."','".$direccion."','".$idarea."','".$area."','".$idpuesto."','".$tipo."','".$anosexp."','".$recomend."','".$vehiculo."','".$lugartrabajo."','".$porcentaje."','A','".$imagen."','".$fecreg."');";
		$conexion=$mysqli->query($str);
		// Registro en bitacora
		// Busco ultimo inserta para Insertar en tabla de auditoria(inmuebles_r)
		$apenom=$apellido1.' '.$nombre1;
		$sql="SELECT max(idasesor) idasesor FROM asesor";
		$query=$mysqli->query($sql);	
		$arridmax = mysqli_fetch_array($query);
		$idasesor=$arridmax['idasesor'];
		$str="INSERT INTO inmuebles_r(id, codinm, titulo, modulo, usuario, accion) VALUES ('".$idasesor."','0','".$apenom."','ASESORES','".$usuario."', 'I');";
		$conexion=$mysqli->query($str);
		//echo $str; exit();
		echo '<script language="javascript">alert("Registro Exitoso !!!");window.location.href="rpt_asesor.php"; </script>';
	}	
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard | Habita Inmueble</title>
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
            <h1>Registro Asesor</h1>
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
              <h3 class="card-title">Datos Personales</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
			<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
			<div class="row">
			<div class="col-md-3">
              <div class="form-group">
                <label for="inputName">Primer Nombre</label>
                <input type="text" value=""  name="nombre1" class="form-control">
              </div>
			</div>
			<div class="col-md-3">
              <div class="form-group">
                <label for="inputName">Segundo Nombre <span style="font-size: 12px;font-weight: normal;color: #828282"><i>(opcional)</i></span></label>
                <input type="text" value=""  name="nombre2" class="form-control">
              </div>
			</div>
			<div class="col-md-3">
              <div class="form-group">
                <label for="inputName">Primer Apellido</label>
                <input type="text" value=""  name="apellido1" class="form-control">
              </div>
			</div>
			<div class="col-md-3">
              <div class="form-group">
                <label for="inputName">Segundo Apellido <span style="font-size: 12px;font-weight: normal;color: #828282"><i>(opcional)</i></span></label>
                <input type="text" value=""  name="apellido2" class="form-control">
              </div>
			</div>

			<!-- -->
			<div class="col-md-3">
              <div class="form-group">
                <label for="inputName">C.I.</label>
                <input type="text" value=""  name="cedula" class="form-control">
              </div>
			</div>
			<div class="col-md-3">
			  <div class="form-group">
                  <label>Fecha Nacimiento:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="text" name="fnacimiento" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                  </div>
                  <!-- /.input group -->
                </div>
              <!--div class="form-group">
                <label for="inputName">Fecha Nacimiento</label>
                <input type="text" value=""  name="fnacimiento" class="form-control">
              </div-->
			</div>
			<div class="col-md-3">
				 <div class="form-group">
                  <label>Telefono(Local):</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="text" name="telefono" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                  </div>
                  <!-- /.input group -->
                </div>
              <!--div class="form-group">
                <label for="inputName">Telefono(Local)</label>
                <input type="text" value=""  name="movil" class="form-control">
              </div-->
			</div>
			<div class="col-md-3">
				 <div class="form-group">
                  <label>Movil:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="text" name="movil" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                  </div>
                  <!-- /.input group -->
                </div>
              <!--div class="form-group">
                <label for="inputName">Movil</label>
                <input type="text" value=""  name="movil" class="form-control">
              </div-->
			</div>
			<!-- -->
			<div class="col-md-6">
			  <div class="form-group">
                <label for="inputName">Porcentaje</label>
                <input type="text" name="porcentaje" class="form-control">
              </div>
			</div>			
			<div class="col-md-6">
			  <div class="form-group">
                <label for="inputName">Lugar Trabajo</label>
				<select class="form-control custom-select" name="lugartrabajo" required>
				  <option value="Gran Caracas" selected>Gran Caracas</option>
                  <option value="Guatire">Guatire</option>
                  <option value="Higuerote">Higuerote</option>
                  <option value="Nueva Esparta">Nueva Esparta</option>
                </select>                
              </div>
			</div>
			<!-- -->
			<div class="col-md-12">
			  <div class="form-group">
                <label for="inputName">Dirección</label>
                <input type="text" name="direccion"  class="form-control">
              </div>
			</div>
			<!-- -->
			<div class="col-md-3">
             <div class="form-group">
                <label for="inputStatus">Área:</label>
                <select class="form-control custom-select" name="idarea" required>
                  <option value="" selected>Seleccione...</option>
								<?php
									$query = $mysqli -> query ("SELECT * FROM offer_areas WHERE estatus ='A'");
										while ($valores = mysqli_fetch_array($query)) {
											echo '<option value="'.$valores['idarea'].'">'.$valores['area'].'</option>';
												}
										?>  
                </select>
              </div>
			</div>
			<div class="col-md-3">
             <div class="form-group">
                <label for="inputStatus">Tipo Contrato:</label>
                <select class="form-control custom-select" name="idpuesto" required>
                  <option value="" selected>Seleccione...</option>
								<?php
									$query = $mysqli -> query ("SELECT * FROM offer_tp WHERE estatus ='A'");
										while ($valores = mysqli_fetch_array($query)) {
											echo '<option value="'.$valores['idpuesto'].'">'.$valores['tipo'].'</option>';
												}
									?>  
                </select>
              </div>
			</div>						
			<div class="col-md-2">
             <div class="form-group">
                <label for="inputStatus">Años Experiencia:</label>
                <select class="form-control custom-select" name="anosexp" required>
                  <option value="" selected>Seleccione...</option>
				  <option value="1 a 3">1 a 3</option>
                  <option value="4 a 7">4 a 7</option>
                  <option value="8 a 10">8 a 10</option>
                  <option value="Mas 10">Mas de 10</option>
                </select>
              </div>
			</div>
			<div class="col-md-2">
             <div class="form-group">
                <label for="inputStatus">Recomendado</label>
                <select class="form-control custom-select" name="recomend" required>
                  <option value="" selected>Seleccione...</option>
                  <option value="No">No</option>
                  <option value="Si">Si</option>
                </select>
              </div>
			</div>
			<div class="col-md-2">
             <div class="form-group">
                <label for="inputStatus">Vehículo</label>
                <select class="form-control custom-select" name="vehiculo" required>
                  <option value="No">No</option>
                  <option value="Si">Si</option>
                </select>
              </div>
			</div>
			<!-- -->
			<div class="col-md-7">
			  <div class="form-group">
                  <label for="inputName">Correo:</label>
                  <input type="email" value=""  name="correo" class="form-control" required>
              </div>
			</div>
			<div class="col-md-5">
				<div class="form-group">
						<label for="exampleInputFile">Foto:</label>
						<input type="file" class="form-control-file" name="imagen_des" required>
				</div>
			</div>

			<!-- -->
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
          <a href="rpt_asesor.php" class="btn btn-secondary">Atras</a>          
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
      format: 'LT'
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
/* viene de Pag validation.html */
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