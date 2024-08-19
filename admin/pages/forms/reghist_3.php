<?php
	session_start();
	date_default_timezone_set('America/Caracas');
	$usuario=$_SESSION['usuario'];
	require('../../conexion.php');
	$alta     = date('d/m/Y');

if(isset($_GET['pac'])){
   $paso=1;
   $idcita = $_GET['pac'];
   //$sqldatos = ("SELECT * FROM citas WHERE idcita='".$idcita."'");
   $sqldatos = ("SELECT a.*, b.cedula FROM citas a, pacientes b WHERE a.idpaci=b.idpaci and a.idcita='".$idcita."'");
   $objdatos = $mysqli->query($sqldatos); $arrdatos = $objdatos->fetch_array();
   $idpaci = $arrdatos['idpaci'];
 
   /* Busco Nro Historia  */
   $sqlhist = ("SELECT nrohistoria FROM historias WHERE idpaci='".$idpaci."'");
	 $objhist = $mysqli->query($sqlhist); $arrhist = $objhist->fetch_array();
   $nrohistoria = $arrhist[0];
   // Ori $sqllast = ("SELECT * FROM consultas_trat WHERE idpaci='".$idpaci."' AND fechadia='".$alta."' ");
	 $sqllast = ("SELECT * FROM consultas_trat WHERE idpaci='".$idpaci."' AND fechadia='".$alta."' AND  idcita='".$idcita."';");
	 //echo $sqllast; exit();
	 $objlast=$mysqli->query($sqllast);
	 /* Busco Observaciones, ya que viene de otra tabla consultas_med */
	 $sqlobserv = ("SELECT observaciones FROM consultas_med	WHERE idcita='".$idcita."';");
	 $objobserv = $mysqli->query($sqlobserv); $arrobserv = $objobserv->fetch_array();
	 if (isset($arrobserv['observaciones'])) {$observaciones =$arrobserv['observaciones'];}else{$observaciones ='';}
}
	
			/*
			$sqllast = ("SELECT * FROM consultas_trat WHERE idpaci='".$idpac."' AND fechadia='".$alta."'");
			echo $sqllast; exit();
	    $objlast=$mysqli->query($sqllast);  
		 	*/

	if(isset($_POST['submit'])){
		//datos 		
		$fechadia      = date('d/m/Y'); $fechaconsulta= date('d/m/Y'); $horaconsulta= date("h:i:sa");
		$idpac         =$_POST['idpac'];
		$idcita        =$_POST['idcita'];
		$medicamento   =$_POST['medicamento'];
		$dosis         =$_POST['dosis'];
		$horas         =$_POST['horas'];
		$dias          =$_POST['dias'];

		$str="INSERT INTO consultas_trat (idpaci, idcita, fechadia, medicamento,	dosis,	horas,	dias) 
		VALUES ('".$idpac."','".$idcita."','".$fechadia."','".strtoupper($medicamento)."','".strtoupper($dosis)."','".$horas."','".$dias."')";
		//echo $str; exit();
		$conexion=$mysqli->query($str);
		/* Actualizo Estatus de la Cita, como culminada 
		$sql="UPDATE citas SET idestatus='7' WHERE idcita='".$idcita."';";
		$conexion=$mysqli->query($sql);	*/

		/* Indicador de fin del registro de la consulta 
		$str="UPDATE consultas_med SET fechadia='".$fechaconsulta."', hora='".$horaconsulta."', fin='1'
		WHERE idpaci='".$idpac."' AND idcita='".$idcita."'";*/
		//echo $str.'/'; exit();
		//$conexion=$mysqli->query($str);
		echo '<script language="javascript">window.location.href="reghist_3.php?pac='.$idcita.'";</script>';
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
  <!-- -->
  <style>
  .blink {
    animation: blinker 1s linear infinite;
  }

  @keyframes blinker {
    50% {
      opacity: 0;
    }
  }
</style>
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<script src="jquery/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
	
		$(document).ready(function(){
			$("#idpais").change(function(){				
				$.get("pais_js.php","idpais="+$("#idpais").val(), function(data){
					$("#id_estado").html(data);
					console.log(data);
				});
			});

			$("#id_estado").change(function(){				
				$.get("estados_js.php","id_estado="+$("#id_estado").val(), function(data){
					$("#id_municipio").html(data);
					console.log(data);
				});
			});

			$("#id_municipio").change(function(){
				$.get("munic_js.php","id_municipio="+$("#id_municipio").val(), function(data){
					$("#id_parroquia").html(data);
					console.log(data);
				});
			});
			$("#blink1").hide();
			$("#blink2").hide();
			
		});
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
            <h1>Registro de Tratamiento Medico</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../../index.php?usr=1">Home</a></li>
              <li class="breadcrumb-item active">Registro de Tratamiento Medico</li>
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
              <h3 class="card-title">Registro de Tratamiento Medico</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
       <!--     	
			<form enctype="multipart/form-data" action="< ?php echo $_SERVER['PHP_SELF'] ?>" 
					  method="post" onsubmit="return validacion()">
			-->
			<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
			<div class="row">
				                <div class="col-md-3">
                           <div class="form-group">
                              <label for="correo">Nro de Historia:</label>
                              <input type="hidden" name="idpac" value="<?php echo $idpaci;?>">
                              <input type="hidden" id="idcita" name="idcita" value="<?php echo $idcita;?>">
                              <!--input type="email" name="correo" id="correo" class="form-control form-control-sm " readonly value="< ?php if($paso==1){echo $arrdatos['historia'];}?>"-->
                              <input type="text" name="nrohistoria" id="nrohistoria" class="form-control form-control-sm " readonly value="<?php if($paso==1){echo $nrohistoria;}?>">
                           </div>
                        </div>

                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="cedula">Cédula</label>
                              <input type="text" name="cedula" id="cedula" style="text-transform:uppercase;" onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;" class="form-control form-control-sm " readonly 
                              value="<?php if($paso==1){echo $arrdatos['cedula'];}?>">
                           </div>
                        </div>
                        
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="nombre1">Nombre:</label>
                              <input type="text" name="nombre" id="nombre" style="text-transform:uppercase;" onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;" class="form-control form-control-sm " readonly 
                              value="<?php if($paso==1){echo $arrdatos['apellido'].' '.$arrdatos['nombre'];}?>">
                           </div>
                        </div>

                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="correo">Fecha:</label>
                              <input type="text" class="form-control form-control-sm " readonly 
                              			 value="<?php echo $alta;?>">
                           </div>
                        </div>

				<div class="col-md-3">
					<div class="form-group">
						<label for="razsocial">Medicamento:</label>
						<input type="text" name="medicamento" class="form-control form-control-sm " style="text-transform:uppercase;">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="razsocial">Dosis:</label>
						<input type="text" name="dosis" class="form-control form-control-sm " style="text-transform:uppercase;">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="razsocial">Tiempo Horas:</label>
						<input type="text" name="horas" class="form-control form-control-sm " maxlength="2" minlength="1" style="text-transform:uppercase;" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="razsocial">Tiempo Dias:</label>
						<input type="text" name="dias" class="form-control form-control-sm " maxlength="3" minlength="1" style="text-transform:uppercase;" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group" style="padding-top: 20px">
						<input style="background: #F89921;border-color: #F89921;" type="submit" name="submit" value="+" class="btn btn-main btn-primary btn-lg uppercase">
					</div>
				</div>
				</form> 
				<div class="col-md-12">
					<?php while($row = mysqli_fetch_array($objlast)) { ?>
						<label>
							<button type="button" class="btn btn-danger btn-sm" onclick="fdelmedicina(<?php echo $row['idreg'];?>)" ><i class="fa fa-trash"></i></button>
							- <?php echo $row['medicamento'].' tomar: '.$row['dosis'].' cada: '.$row['horas'].' horas por: '.$row['dias'].'dias';?>
								
							</label><br>
					<?php } ?>
				</div>
				
				</div>  <!-- End div row -->
				<form action="gerinfmed.php"  method="post" onsubmit="return validacion()">
					<input type="hidden" name="idcita_aux" value="<?php echo $idcita;?>">
					<div class="row">
						<div class="col-md-12">
							<!--h5><strong>Observaciones: </strong></h5-->
							<label for="observaciones">Observaciones:</label>
							<textarea name="observaciones" id="observaciones" class="form-control form-control-sm " rows="5"><?php echo $observaciones;?></textarea>
					</div>
					<div class="col-md-12 text-center"><br>
							<h5><strong> Cuentas de Correos Adicionales</strong></h5>
					</div>
					<div class="col-md-6 text-center">
							<div class="form-group">
								<label for="">Correo 1:</label>
								<input type="email" name="correo1" class="form-control form-control-sm " style="text-transform:lowercase;">
							</div>
					</div>
					<div class="col-md-6 text-center">
							<div class="form-group">
								<label for="">Correo 2:</label>
								<input type="email" name="correo2" class="form-control form-control-sm " style="text-transform:lowercase;">
							</div>
					</div>
					<div align="center" class="col-md-12">
						<h1 id="blink1" class="blink" style="color: green;">Procesando Peticiòn...</h1>
						<h4 id="blink2" class="blink" style="color: green;">Espere Por Favor</h4>
					</div>

					<!--div align="right" class="col-md-12"><br>
						<a href="gerinfmed.php" class="btn btn-main btn-primary btn-lg uppercase">Finalizar</a>
					</div-->	
					<div align="right" class="col-md-12">
						<div class="form-group" style="padding-top: 20px">
							<input style="background: #F89921;border-color: #F89921;" type="submit" name="submit" value="Finalizar" class="btn btn-main btn-primary btn-lg uppercase">
						</div>
					</div>
				</form>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>  <!-- End div row -->
	  		<div class="row">
        	<div align="center" class="col-12">
          	<a href="reghist_2.php"  id="btnatras" class="btn btn-secondary">Atrás</a>
          	<!--a href="reghist_2.php?pac=< ?php echo $idcita;?>" class="btn btn-secondary">Atrás</a-->
          	<!--a href="javascript: history.go(-1)" class="btn btn-secondary">Atrás</a-->
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
<!-- Ds Js -->
 <script src="js/ds.js"></script>
<script>
	function validacion(){
		//if( isNaN(costo) ) {
		$("#blink1").show();
		$("#blink2").show();
		//return false;
		//}
	}
	document.getElementById('btnatras').addEventListener('click',function(e){
  e.preventDefault();
  idcita=document.getElementById('idcita').value;
  observaciones=document.getElementById('observaciones').value;
  jQuery.ajax({
              type: "POST",   
              url: "atras_js.php",
              data: {idcita: idcita, observaciones: observaciones},
              success:function(data){
                if (data!='1') {return false;}
                //window.location.href="   adddoc.php?id="+idmed;
                window.location.href="reghist_2.php?pac="+idcita;
              }
        });
});
</script>
</body>
</html>
