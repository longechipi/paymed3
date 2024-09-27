<?php
	session_start();
	$usuario=$_SESSION['usuario'];
	//$idlogin = $_SESSION['idlogin'];
	require('../../conexion.php');
	
	if (isset($_GET['gp1'])) {
		$idasist=$_GET['gp1'];
		//$sql = ("SELECT fullname, cedula, correo, movil,  cargo, nombrecargo, clave, privilegios, idtrabajacon, trabajacon, estatus FROM loginn	WHERE idlogin='".$idlogin1."'"); 
		$sql = ("SELECT idasist, idlogin, nrodoc, apellidos, nombres, movil, correo, cargo, tpasist, idestatus 
			FROM asistentes	WHERE idasist='".$idasist."'"); 	
		$obj = $mysqli->query($sql); $row = mysqli_fetch_array($obj);
		$idlogin1  =$row['idlogin'];
		$apellidos =$row['apellidos'];
		$nombres 	 =$row['nombres'];
		$nrodoc 	 =$row['nrodoc'];
		$correo 	 =$row['correo'];
		//$fullname =$row['fullname'];
		$movil 		 =$row['movil'];
		//$movil 		=substr($row['movil'],4);
		//$operadora=substr($row['movil'],0,4);
		$tpasist 	 =$row['tpasist'];
		$nombrecargo 	=$row['cargo'];
		$idestatus 	=$row['idestatus'];
		if ($idestatus=='1') {$estatus='Activo';}else{$estatus='Inactivo';}
	}
	/*$iddr ='000'.$idlogin;*/
	if(isset($_POST['submit'])){
		//datos 
		$idlogin1 =$_POST['idlogin1'];
		$apellidos =$_POST['apellidos'];
		$nombres 	 =$_POST['nombres'];
		$nrodoc =$_POST['nrodoc'];
		$correo =$_POST['correo'];
		//$cargo =$_POST['cargo'];
		$tpasist 	=$_POST['tpasist'];
		$nombrecargo =$_POST['nombrecargo'];
		$movil =$_POST['movil'];
		$idestatus =$_POST['idestatus'];
		$fullname =strtoupper($apellidos).' '.strtoupper($nombres);
		$str="UPDATE loginn SET apellidos ='".$apellidos."', nombres ='".$nombres."', fullname ='".$fullname."', 
		cedula='".$nrodoc."',correo='".$correo."',movil='".$movil."',cargo='".$tpasist."',nombrecargo= '".$nombrecargo."'
		WHERE idlogin='".$idlogin1."'; ";
    $conexion=$mysqli->query($str);
    
    /*  Actualizo en Tbl Asistentes  */
    $str="UPDATE asistentes SET nrodoc='".$nrodoc."',apellidos='".$apellidos."',nombres='".$nombres."',movil='".$movil."',
    						correo='".$correo."',cargo='".$nombrecargo."',tpasist='".$tpasist."',idestatus='".$idestatus."'
    						WHERE idlogin= '".$idlogin1."'; ";
		$conexion1=$mysqli->query($str);
		
		//include("sendregasist.php");  //Envio de correo al Asistente Regostrado

		echo '<script language="javascript">alert("Actualizacion Exitoso!");window.location.href="rpt_asist.php"; </script>';
        //echo '<script language="javascript">alert("¡Actualización Exitosa!");window.location.href="medctas.php?id='.$idmed.'"; </script>';
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
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<script src="jquery/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
	
		$(document).ready(function(){
			
		});
	/*	
	function valdoc(quees,nro){
		
		if (quees=='1') {
			var nroriginal=document.getElementById("rifpval").value;
			var tprif=document.getElementById("tprif").value;
			var nro=tprif+nro;
		}else if (quees=='2') {
			var nroriginal=document.getElementById("nrodocpval").value;
			var tpdoc=document.getElementById("tpdoc").value;
			var nro=tpdoc+nro;
		}
		
		jQuery.ajax({
         type: "POST",  
         url: "valnro_js.php",
         data: {quees: quees, nro: nro, nroriginal: nroriginal},
         success:function(data){
        	console.log(data);
         	hay = parseInt(data);
         	if (hay!=0) {
         		Swal.fire({
  				icon: 'error',
  				title: 'Nro Ya Registrado'
				})
         	}
         },
          error:function (){}
        });
	}*/
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
          <!--div class="col-sm-8">
            <h1>Medicos (La dirección debe ser tal cual su RIF)</h1>
          </div-->
          <div class="col-sm-12">
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
        	<!--div class="row" align="right">
            	<div class="w-15 p-1 col-md-12" style="font-family:courier; background-color: #eee;"><strong> ID : < ?php echo $iddr; ?></strong></div>
            	<div class="w-15 p-1 col-md-12" style="font-family:courier; background-color: #eee;"><strong>Fecha Registro: < ?php echo $fecha; ?></strong></div>
            </div-->
          <div class="card card-primary">
            <div style="background: #F89921"  class="card-header">
            	<h4>Consulta Asistentes</h4>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
			<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return validacion()">
			<input type="hidden" name="idlogin1" value="<?php echo $idlogin1;?>">
			<input type="hidden" id="correooriginal" value="<?php echo $correo;?>">

			<div class="row">
				<!-- 1ra -->
				<div class="col-md-3">
					<div class="form-group">
						<label for="apellidos">Apellidos: </label>
						<input type="text" name="apellidos" id="apellidos" value="<?php echo $apellidos; ?>"  class="form-control form-control-sm" style="text-transform:uppercase;"  readonly>
						 <!--input type="text" name="nombre" id="nombre" value=""  class="form-control form-control-sm" style="text-transform:uppercase;" 
						 onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122 ) event.returnValue = false;" required-->
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="nombres">Nombres: </label>
						<input type="text" name="nombres" id="nombres" value="<?php echo $nombres; ?>"  class="form-control form-control-sm" style="text-transform:uppercase;"  readonly>
						 <!--input type="text" name="nombre" id="nombre" value=""  class="form-control form-control-sm" style="text-transform:uppercase;" 
						 onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122 ) event.returnValue = false;" required-->
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="nrodoc">Cedula:</label>
						<input type="text" name="nrodoc" id="nrodoc" value="<?php echo $nrodoc; ?>" onblur="valdoc('2',this.value)" maxlength="8" minlength="7" class="form-control form-control-sm"
						onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" readonly>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="nombrecargo">Cargo:</label>
						<input type="text" name="nombrecargo"  value="<?php echo $nombrecargo;?>"  class="form-control form-control-sm" readonly>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="tpasist">Nivel Asist.:</label>
						<select class="form-control form-control-sm" id="tpasist" name="tpasist" disabled>
							<option value="<?php echo $tpasist; ?>"><?php echo substr($tpasist,-1); ?></option>
            </select>
					</div>
				</div>


				<!-- 2da  -->
				<!--
				<div class="col-md-1">
					<div class="form-group">
						<label for="operadora">Movil:</label>
						<select class="form-control form-control-sm" id="operadora" name="operadora">
               	<option value="< ?php echo $operadora; ?>">< ?php echo $operadora;?></option>
               	<option value="0412">0412</option>
                <option value="0414">0414</option>
                <option value="0424">0424</option>
                <option value="0416">0416</option>
                <option value="0426">0426</option>
            </select>
					</div>
				</div>
					-->
				<div class="col-md-3">
					<div class="form-group">
						<!--label for="movil" style="visibility: hidden;">Movil:</label-->
						<label for="movil">Movil:</label>
						<input type="text" name="movil" id="movil" value="<?php echo $movil;?>" maxlength="7" minlength="7" class="form-control form-control-sm"
						onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;"  readonly>
					</div>
				</div>

				<div class="col-md-8">
					<div class="form-group">
						<label for="correo">Correo:</label>
						<input type="email" name="correo"  value="<?php echo $correo;?>" id="correo" class="form-control form-control-sm" readonly>
					</div>
				</div>	
				<div class="col-md-1">
					<div class="form-group">
						<label for="tpasist">Estatus:</label>
						<select class="form-control form-control-sm" id="idestatus" name="idestatus" disabled>
    <?php if ($idestatus == 1) { ?>
        <option value="1" selected>Activo</option>
    <?php } else if ($idestatus == 2) { ?>
        <option value="2" selected>Inactivo</option>
    <?php } else { ?>
        <option value="1">Activo</option>
        <option value="2">Inactivo</option>
    <?php } ?>
</select>
					</div>
				</div>

				<div  class="col-md-12" align="right">
					<input style="background: #F89921;border-color: #F89921" type="submit" name="submit" value="Actualizar" class="btn btn-main btn-primary btn-lg uppercase" disabled>
				</div>
		</form> 
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
	  <div class="row">
        <div align="center" class="col-6">
          <a href="rpt_asist.php?" class="btn btn-secondary">Atrás</a>
        </div>

        <div align="center" class="col-6">
          <a href="../../index.php?usr=1" class="btn btn-warning">Salir</a>
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
	function validacion(){
		/* _______   ____________*/
		var correo=document.getElementById("correo").value;
		var correooriginal=document.getElementById("correooriginal").value;
		if (correo==correooriginal) {return true;}

		jQuery.ajax({
         type: "POST",  
          async: false, 
         url: "validmail_js.php",
         data: {correo: correo},
         success:function(data){
         	hay=data;
        	console.log(data);
         	if (data!=0) {
         		Swal.fire({
  						icon: 'error',
  						title: 'Correo Ya Registrado'
							});return false;
         	}
         },
          error:function (){}
        });
				if (hay!='0') {return false;}
	}
</script>

</body>
</html>
