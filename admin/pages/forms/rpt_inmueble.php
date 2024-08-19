<?php
	session_start();
	$usuario=$_SESSION['usuario'];
	$privilegios = $_SESSION['privilegios'];

	require('../../conexion.php');

		$sqlasesor = ("SELECT idasesor FROM asesor WHERE correo='".$_SESSION['correouso']."'");	
			$resultado=$mysqli->query($sqlasesor);	
				$roww = mysqli_fetch_array($resultado);
				
	if($privilegios=='6'){
		$sql = ("SELECT idinmueble, idtipo, categoria, idneg, tnegocio, codinm, titulo, idestado, estado, fechahora_sist
				 FROM inmuebles WHERE salerent<>'S' AND idasesor='".$roww['idasesor']."' order by fechahora_sist DESC");
		//echo $sql;exit();
	}else{
		$sql = ("SELECT idinmueble, idtipo, categoria, idneg, tnegocio, codinm, titulo, idestado, estado, fechahora_sist
				 FROM inmuebles WHERE salerent<>'S' order by fechahora_sist DESC");		
	}

	$result=$mysqli->query($sql);	
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard </title>
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
  background-color: #F89921; /* Orange */
  border: #F89921;
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
<!-- Modal -->
        <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
		  <h4 class="modal-title">CIERRE DE NEGOCIACIÓN</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
          <div align="center"><h2 style="font-size: 18px;font-weight: bold">¿Cuál es el monto de la mediación de la venta?</h2></div>
		  <h2 id="titulo" style="font-size: 22px;color: #3E3E3E"></h2>
		  <input type="hidden" id="id_inmueble" name="id_inmueble" value="">
		  <input type="number" id="precioventa" name="precioventa" class="form-control" value="">
		  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="confir()" >Confirmar</button>
		  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		  
        </div>
      </div>
      
    </div>
  </div>
<!-- -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Listado Inmuebles</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../../index.php?usr=1">Home</a></li>
              <li class="breadcrumb-item active">Rep. Inmueble</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
  <section class="content">
	<div align="center" class="col-md-12">
		<boton class="buttonr"><a style="color: #FFFFFF;font-family: 'Lato', sans-serif;font-size: 18px;font-weight: bold;" href="udpinmueble.php">Añadir</a></boton>
	</div><br>
      <!-- Default box -->
      <div class="card">
        <div style="background: #F89921"  class="card-header">
          <h3 class="card-title">Inmueble</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 1%">
                          COD
                      </th>
                      <th >
                          Titulo
                      </th>
                      <th >
						  Categoria
                      </th>
                      <th>
                          Negocio
                      </th>
                      <th class="text-center">
                          Estado
                      </th>
                      <th></th>
                  </tr>
              </thead>
              <tbody>
				  <?php
					while($row = mysqli_fetch_array($result)) { 
					$idneg=$row['idneg'];
					//echo $ruta;  exit();
					?>
                  <tr>
                      <td><?php echo $row['codinm']; ?></td>
                      <td class="project_progress"><?php echo $row['titulo']; ?></td>
					  <td class="project_progress"><?php echo $row['categoria']; ?></td>
					  <td class="project_progress"><?php echo $row['tnegocio']; ?></td>
                      <td class="project-state"><?php echo $row['estado']; ?></td>
                      <td class="project-actions text-right">
						<?php if($idneg=='1'){ ?>
                          <a style="background: #F89921; border: #F89921" class="btn btn-info btn-sm" href="moddocven.php?idinmueble=<?php echo $row['idinmueble'];?>">
                          <?php $cuentame=0;
								$sqlnum = ("SELECT * FROM inmuebleven_docs WHERE idinmueble='".$row['idinmueble']."'");	
									$deanum=$mysqli->query($sqlnum); $deanume=$deanum->fetch_array();
									if(!empty($deanume['docpropiedad'])){$cuentame=$cuentame+1;}
									if(!empty($deanume['cedula'])){$cuentame=$cuentame+1;}
									if(!empty($deanume['cedcatastral'])){$cuentame=$cuentame+1;}
									if(!empty($deanume['solvdefrente'])){$cuentame=$cuentame+1;}
									if(!empty($deanume['libhipoteca'])){$cuentame=$cuentame+1;}
									if(!empty($deanume['actsucesoral'])){$cuentame=$cuentame+1;}
									if(!empty($deanume['sepvienes'])){$cuentame=$cuentame+1;}
									if(!empty($deanume['poder'])){$cuentame=$cuentame+1;}
									if(!empty($deanume['otros'])){$cuentame=$cuentame+1;} ?>
                          <i class="fas fa-file-alt"></i> Docs (<?php echo $cuentame; ?>)</a>
						<?php }else{ ?>
						  <a style="background: #F89921; border: #F89921" class="btn btn-info btn-sm" href="moddocalq.php?idinmueble=<?php echo $row['idinmueble'];?>">
                          <?php $cuentame=0;
								$sqlnum = ("SELECT * FROM inmueblealq_docs WHERE idinmueble='".$row['idinmueble']."'");	
									$deanum=$mysqli->query($sqlnum); $deanume=$deanum->fetch_array();
									if(!empty($deanume['docpropiedad'])){$cuentame=$cuentame+1;}
									if(!empty($deanume['cedula'])){$cuentame=$cuentame+1;}
									if(!empty($deanume['actsucesoral'])){$cuentame=$cuentame+1;}
									if(!empty($deanume['sepvienes'])){$cuentame=$cuentame+1;}
									if(!empty($deanume['poder'])){$cuentame=$cuentame+1;}
									if(!empty($deanume['otros'])){$cuentame=$cuentame+1;} ?>
                          <i class="fas fa-file-alt"></i> Docs (<?php echo $cuentame; ?>)</a>						  
						<?php } ?>                      
						<a style="background: #23BC43; border: #23BC43" class="btn btn-danger btn-sm" href="rpt_fotos.php?idinmueble=<?php echo $row['idinmueble'];?>"><i class="fas fa-photo-video" title="Agregar Fotos"></i> </a>
						<!--a class="btn btn-info btn-sm" href="vender.php?idinmueble=< ?php echo $row['idinmueble'];?>"><i class="fas fa-comment-dollar" title="Vendido"></i> </a-->
						<button style="background: #004103; border: #004103" type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="fvender(<?php echo $row['idinmueble'];?>)"><i class="fas fa-dollar-sign" title="Vender?"></i></button>
						<!--button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal"><i class="fas fa-comment-dollar" title="Vendido"></i></button-->
						<?php if($privilegios == '1' || $privilegios == '3'){ ?>
						<a style="background: #060eb0; border: #060eb0" class="btn btn-info btn-sm" href="timeline.php?idinmueble=<?php echo $row['idinmueble'];?>"><i class="fas fa-backward" title="Ver timeline"></i> </a>
            <?php } ?>
            <a style="background: #F53D00; border: #F53D00" class="btn btn-info btn-sm" href="selpropuesta.php?idinmueble=<?php echo $row['idinmueble'];?>"><i class="fas fa-envelope" title="Enviar Propuesta"></i> </a>
						<a class="btn btn-info btn-sm" href="modinmue.php?idinmueble=<?php echo $row['idinmueble'];?>"><i class="fas fa-pencil-alt" title="Editar"></i> </a>
						<a class="btn btn-danger btn-sm" href="src_del_inmueble.php?idinmueble=<?php echo $row['idinmueble'];?>"><i class="fas fa-trash" title="Eliminar"></i> </a>
                      </td>
                  </tr>
				<?php } ?>
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
<script>
/* $( document ).ready(function() {
	alert('sñslkñsl');
}) */
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
  function fvender(id){

	jQuery.ajax({
		type: "POST",	
		url: "busven.php",
		data: {id_inmueble: id},	
		success:function(data){
			
			var arrdata = data.split(';');
			var titulo =arrdata[0];
			var titulo = titulo.replace("'", "");
			var titulo = titulo.replace("'", "");
			var precio =arrdata[1];
			var precio = precio.replace("'", "");
			var precio = precio.replace("'", "");
			document.getElementById("titulo").innerHTML =titulo;
			document.getElementById("precioventa").value =precio;
		},
		error:function (){}
	});
	document.getElementById("id_inmueble").value=id;
  }
  function confir(){
	var idinmueble=document.getElementById("id_inmueble").value;
	var precioventa=document.getElementById("precioventa").value;
	//alert(idinmueble);
	jQuery.ajax({
		type: "POST",	
		url: "confirma.php",
		data: {idinmueble: idinmueble, precioventa: precioventa},	
		success:function(data){
			alert('Venta Satisfactoriamente!!! ');
			window.location.reload();
			//document.getElementById("titulo").innerHTML =data;	
		},
		error:function (){}
	});
	
  }
</script>

</body>
</html>