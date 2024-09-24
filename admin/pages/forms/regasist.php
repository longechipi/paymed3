<?php
	session_start();
	$usuario=$_SESSION['usuario'];
	$idlogin = $_SESSION['idlogin'];


	require('../../conexion.php');
	if(isset($_POST['submit'])){
		$correo =strtolower($_POST['correo']);
		/* Busco id del medico para registrarlo en medicosxasist    */
		$sqlmed = ("SELECT idmed FROM medicos WHERE idlogin='".$idlogin."';");
    $resultmed=$mysqli->query($sqlmed); $rowmed = mysqli_fetch_array($resultmed);
    $idmed = $rowmed['idmed'];
    /* Busco en Asistentes a ver si esta registrado */
    $sqlasist = ("SELECT count(*) as hay1, idasist FROM asistentes  WHERE correo='".$correo."';");
    $objasist=$mysqli->query($sqlasist); $arrasist=$objasist->fetch_array(); $hayasist=$arrasist[0]; $idasist=$arrasist[1];
    if ($hayasist!='0') { // Si existe, registro solo en medicosxasist, ya que los datos estan 
    		$str1="INSERT INTO medicosxasist( idasist, idmed) VALUES('".$idasist."', '".$idmed."')";
    			//echo $str1; exit();
				$conexion1=$mysqli->query($str1);
    	}else{
    		//echo $idmed; exit();
				//datos
				$apellidos =strtoupper($_POST['apellidos']);
				$nombres =strtoupper($_POST['nombres']);
				$cedula =$_POST['cedula'];
				$tpasist =$_POST['tpasist'];
				$nombrecargo =$_POST['nombrecargo'];
		    $correo =strtolower($_POST['correo']);
				//$movil =$_POST['operadora'].$_POST['movil'];
				$movil =$_POST['movil'];
				$idestatus ='1'; // Por definir $_POST['idestatus'];
				$str="INSERT INTO loginn(idlogin, fullname, cedula, correo, movil, cargo, nombrecargo, clave, privilegios, idtrabajacon, trabajacon, estatus) 
		        VALUES(null, '".$nombres."', '".$cedula."', '".$correo."', '".$movil."','".$tpasist."','".$nombrecargo."','123', '7', '".$idlogin."', '".$usuario."','A')";
				$conexion=$mysqli->query($str);
				/* Busco el idlogin para registrar el asistente  */
				$sqlmaxid = ("SELECT max(idlogin) FROM loginn;");
		    $resultmaxid=$mysqli->query($sqlmaxid); $rowmaxid = mysqli_fetch_array($resultmaxid);
		    $idlogin = $rowmaxid[0];
		    /* Inserto en tbl asistentes */
		    $str1="INSERT INTO asistentes(idasist, idlogin, nrodoc, apellidos, nombres, movil, correo, cargo, tpasist, idestatus) 
		    VALUES (null,'".$idlogin."','".$cedula."','".$apellidos."','".$nombres."','".$movil."','".$correo."','".$nombrecargo."',
		    	'".$tpasist."','1')";
				$conexion1=$mysqli->query($str1);

				/* Busco el idasist del ultimo asistente registrado */
				$sqlmaxida = ("SELECT max(idasist) FROM asistentes;");
		    $resultmaxida=$mysqli->query($sqlmaxida); $rowmaxida = mysqli_fetch_array($resultmaxida);
		    $idasist = $rowmaxida[0];

				$str1="INSERT INTO medicosxasist( idasist, idmed) VALUES('".$idasist."', '".$idmed."')";
				$conexion1=$mysqli->query($str1);
				//exit();
				include("sendregasist.php");  //Envio de correo al Asistente Regostrado
		}
		echo '<script language="javascript">alert("¡Registro Exitoso!");window.location.href="rpt_asist.php"; </script>';
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
			document.getElementById('title-existe').style.visibility = "hidden";
			
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
        	<!--div class="row" align="right">
            	<div class="w-15 p-1 col-md-12" style="font-family:courier; background-color: #eee;"><strong> ID : < ?php echo $iddr; ?></strong></div>
            	<div class="w-15 p-1 col-md-12" style="font-family:courier; background-color: #eee;"><strong>Fecha Registro: < ?php echo $fecha; ?></strong></div>
            </div-->
          <div class="card card-primary">
            <div style="background: #F89921"  class="card-header">
            	<h4>Registro Asistente</h4>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
			<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return validacion()">
			<input type="hidden" name="usuario" value="<?php echo $usuario;?>">
			<input type="hidden" id="idlogin" value="<?php echo $idlogin;?>">

			<div class="row">
				<!-- 1ra -->
				<div class="col-md-6">
					<div class="form-group">
						<label for="correo">Correo:</label>
						<input type="email" name="correo" value="" id="correo" class="form-control form-control-sm" onblur="existmail(this.value)" required>
					</div>
				</div>	
				<div class="col-md-3">
					<div class="form-group">
						<label for="apellidos">Apellidos: </label>
						<input type="text" name="apellidos" id="apellidos" value=""  class="form-control form-control-sm" style="text-transform:uppercase;"  required>
						 <!--input type="text" name="nombre" id="nombre" value=""  class="form-control form-control-sm" style="text-transform:uppercase;" 
						 onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122 ) event.returnValue = false;" required-->
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="nombres">Nombres: </label>
						<input type="text" name="nombres" id="nombres" value=""  class="form-control form-control-sm" style="text-transform:uppercase;"  required>
						 <!--input type="text" name="nombre" id="nombre" value=""  class="form-control form-control-sm" style="text-transform:uppercase;" 
						 onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122 ) event.returnValue = false;" required-->
					</div>
				</div>
				<!-- 2da  -->
				<div class="col-md-2">
					<div class="form-group">
						<label for="cedula">Cedula:</label>
						<input type="text" name="cedula" id="cedula" value="" onblur="valdoc('2',this.value)" maxlength="8" minlength="7" class="form-control form-control-sm"
						onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="nombrecargo">Cargo:</label>
						<input type="text" name="nombrecargo" id="nombrecargo" value=""  class="form-control form-control-sm" required>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="tpasist">Nivel:</label>
						<select class="form-control form-control-sm" id="tpasist" name="tpasist">
							<option value="">Selec.</option>
              <option value="Asistente1">1</option>
              <option value="Asistente2">2</option>
            </select>
					</div>
				</div>

				<!--div class="col-md-1">
					<div class="form-group">
						<label for="operadora">Movil:</label>
						<select class="form-control form-control-sm" id="operadora" name="operadora">
               	<option value="0412">0412</option>
                <option value="0414">0414</option>
                <option value="0424">04241111111</option>
            </select>
					</div>
				</div-->

				<div class="col-md-4">
					<div class="form-group">
						<label for="movil">Movil:</label>
						<!--label for="movil" style="visibility: hidden;">.</label-->
						<input type="text" name="movil" id="movil" value="" maxlength="12" minlength="7" class="form-control form-control-sm"
						onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;"  required>
					</div>
				</div>
				<div class="col-md-12 text-center">
					<small id="title-existe" style="background-color: yellow;">Asistente Ya Registrado. Desea Que Sea Pare de su Equipo? Pulse Guardar</small>
				</div>

				<div  class="col-md-12" align="right">
					<input id="btn-guardar" style="background: #F89921;border-color: #F89921" type="submit" name="submit" value="Guardar" class="btn btn-main btn-primary btn-lg uppercase">
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
		var idlogin=document.getElementById("idlogin").value;  //id del Medico

		jQuery.ajax({
         type: "POST",  
          async: false, 
         url: "validmail_js.php",
         data: {correo: correo, idlogin: idlogin},
         success:function(data){
         	console.log(data);
         	hay=data;
        	console.log(data);
         	if (data!=0) {
         		Swal.fire({
  						icon: 'error',
  						title: 'Usuario Ya Registrado'
							});return false;
         	}
         },
          error:function (){}
        });
				if (hay!='0') {return false;}
	}
	//
	function existmail(correo) {
		arreglo=[];
		jQuery.ajax({
         type: "POST",  
          async: false, 
         url: "existmail_js.php",
         data: {correo: correo},
         success:function(data){
         		const arreglo = data.split("|");
         		const lenarreglo=arreglo.length;
        		console.log(arreglo[1]);
         		if (data=='99') {
         			Swal.fire({
  							icon: 'error',
  							title: 'Usuario Ya Registrado'
							});return false;
         		}else if (lenarreglo!='1') {
         			document.getElementById('title-existe').style.visibility = "visible";

         			document.getElementById("cedula").value=arreglo[0];
         			document.getElementById("apellidos").value=arreglo[1];
         			document.getElementById("nombres").value=arreglo[2];
         			document.getElementById("movil").value=arreglo[3];
         			document.getElementById("nombrecargo").value=arreglo[4];
         			document.getElementById("tpasist").value=arreglo[5];

         			document.getElementById("cedula").readOnly = true;
         			document.getElementById("apellidos").readOnly = true;
         			document.getElementById("nombres").readOnly = true;
         			document.getElementById("movil").readOnly = true;
         			document.getElementById("nombrecargo").readOnly = true;
         			document.getElementById("tpasist").readOnly = true;

         			//document.getElementById("btn-guardar").disabled = true;
         		}
         },
          error:function (){}
        });
				//if (hay!='0') {return false;}
	}
</script>

</body>
</html>
