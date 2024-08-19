<?php
	session_start();
	$usuario=$_SESSION['usuario'];
	require('../../conexion.php');
	if(isset($_POST['submit'])){
		/*Asigno variables*/
		$idneg         =$_POST['idneg'];
		// busco nombre tipo de negicio
			$sql="SELECT nombre FROM negociacion where idneg='".$idneg."' ";
			$query=$mysqli->query($sql);	
			$arr_negocio = mysqli_fetch_array($query);
			$categoria=$arr_negocio[0];
		
		$idtipo        =$_POST['idtipo'];
		// busco nombre tipo de negicio
			$sql="SELECT tipologia FROM tiposinm where idtipo='".$idtipo."' ";
			$query=$mysqli->query($sql);	
			$arr_tipo = mysqli_fetch_array($query);
			$tnegocio=$arr_tipo[0];
		//$tnegocio      =$_POST['tnegocio'];
		
		$codinm        =$_POST['codinm'];
		$idasesor      =$_POST['idasesor'];
		    // Busco nombre de Asesor
			$sql="SELECT apellido1, apellido2, nombre1, nombre2, porcentaje FROM asesor where idasesor='".$idasesor."' ";
			$query=$mysqli->query($sql);	
			$arr_asesor = mysqli_fetch_array($query);
			$asesor=$arr_asesor[0].' '.$arr_asesor[1].' '.$arr_asesor[2].' '.$arr_asesor[3];
			$porcentaje=$arr_asesor[4];
		$titulo        =$_POST['titulo'];
		$ubicacion     =$_POST['ubicacion'];
		$idestado	   =$_POST['idestado'];
			// busco nombre Estado
			$sql="SELECT estado FROM estado where idestado='".$idestado."' ";
			$query=$mysqli->query($sql);	
			$arr_estado = mysqli_fetch_array($query);
			$estado=$arr_estado['0'];
		$idmunicipio	=$_POST['idmunicipio'];	
			// busco nombre Municipio
			$sql="SELECT municipio FROM municipios where idmunicipio='".$idmunicipio."' ";
			$query=$mysqli->query($sql);	
			$arr_municipio = mysqli_fetch_array($query);
			$municipio=$arr_municipio['0'];
		//echo $idestado.'->'.$estado.'--'.$idmunicipio.'->'.$municipio; exit();

		$areatotal     =$_POST['areatotal'];
		$areaconst     =$_POST['areaconst'];
		$antiguedad    =$_POST['antiguedad'];
		$cocina        =$_POST['cocina'];
		$sala          =$_POST['sala'];
		$habitacion    =$_POST['habitacion'];
		$habitacionserv=$_POST['habitacionserv'];
		$banio         =$_POST['banio'];
		$mediobano     =$_POST['mediobano'];
		$banoserv      =$_POST['banoserv'];
		$aire          =$_POST['aire'];
		$tvcable       =$_POST['tvcable'];
		$wifi          =$_POST['wifi'];
		$parrillera    =$_POST['parrillera'];
		$piscina       =$_POST['piscina'];
		$maletero      =$_POST['maletero'];
		$lavadero      =$_POST['lavadero'];
		$gimnasio      =$_POST['gimnasio'];
		$parking       =$_POST['parking'];
		$idparq        =$_POST['idparq'];
			// busco descripcion de estacionamiento
			$sql="SELECT idparq, tipo FROM parqueo where idparq='".$idparq."' ";
			$query=$mysqli->query($sql);	
			$arr_estacio = mysqli_fetch_array($query);
			$parking_det=$arr_estacio[1];
		//$parking_det   =$_POST['parking_det'];
		$precio        =$_POST['precio'];
		$describelo    =$_POST['describelo'];
		//$asesor        =$_POST['asesor']; va solo en idasesor
		$destacado     =$_POST['destacado'];
		$instalacion1  =$_POST['instalacion1'];
		$instalacion2  =$_POST['instalacion2'];
		$instalacion3  =$_POST['instalacion3'];
		$instalacion4  =$_POST['instalacion4'];
		$instalacion5  =$_POST['instalacion5'];
		$instalacion6  =$_POST['instalacion6'];
		$instalacion7  =$_POST['instalacion7'];
		//$instalacion8  =$_POST['instalacion8'];
		//$instalacion9  =$_POST['instalacion9'];
		
		$str="INSERT INTO inmuebles(idtipo, categoria, idneg, tnegocio, codinm, idasesor, titulo, idestado, estado, idmunicipio, municipio, ubicacion, areatotal, areaconst, cocina, sala, habitacion, habitacionserv, banio, mediobano, banoserv, aire, tvcable, wifi, parrillera, piscina, maletero, lavadero, gimnasio, parking, idparq, parking_det, precio, describelo, antiguedad, asesor, destacado, instalacion1, instalacion2, instalacion3, instalacion4, instalacion5, instalacion6, instalacion7, porcentaje) VALUES ('".$idtipo."','".$tnegocio."','".$idneg."','".$categoria."','".$codinm."','".$idasesor."','".$titulo."','".$idestado."', '".$estado."', '".$idmunicipio."', '".$municipio."', '".$ubicacion."','".$areatotal."','".$areaconst."','".$cocina."','".$sala."','".$habitacion."','".$habitacionserv."','".$banio."','".$mediobano."','".$banoserv."','".$aire."','".$tvcable."','".$wifi."','".$parrillera."','".$piscina."','".$maletero."','".$lavadero."','".$gimnasio."','".$parking."','".$idparq."','".$parking_det."','".$precio."','".$describelo."','".$antiguedad."','".$asesor."','".$destacado."','".$instalacion1."','".$instalacion2."','".$instalacion3."','".$instalacion4."','".$instalacion5."','".$instalacion6."','".$instalacion7."','".$porcentaje."');";
		$conexion=$mysqli->query($str);
		// Busco ultimo inserta para Insertar en tabla de auditoria(inmuebles_r)
		$sql="SELECT max(idinmueble) idinmueble FROM inmuebles";
		$query=$mysqli->query($sql);	
		$arridmax = mysqli_fetch_array($query);
		$idinmueble=$arridmax['idinmueble'];
		$str="INSERT INTO inmuebles_r(id, codinm, titulo, modulo, usuario, accion) VALUES ('".$idinmueble."','".$codinm."','".$titulo."','INMUEBLE','".$usuario."', 'I');";
		$conexion=$mysqli->query($str);
		echo '<script language="javascript">alert("Registro Exitoso !!!");window.location.href="rpt_inmueble.php"; </script>';
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
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<script src="jquery/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
	
		$(document).ready(function(){
			$("#id_estado").change(function(){				
				$.get("estados_js.php","id_estado="+$("#id_estado").val(), function(data){
					$("#id_municipio").html(data);
					console.log(data);
				});
			});

			/*$("#id_municipio").change(function(){
				$.get("parro_js.php","id_municipio="+$("#id_municipio").val(), function(data){
					$("#id_parroquia").html(data);
					console.log(data);
				});
			})*/;
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
            <h1>Registro Inmueble</h1>
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
              <h3 class="card-title">General</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
			<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return validacion()">
			<div class="row">
			<div class="col-md-2">
              <div class="form-group">
                <label for="inputName">Cod.Inmueble</label>
                <input type="text" value="" id="codinm" name="codinm" class="form-control">
              </div>
			</div>
			<div class="col-md-6">
              <div class="form-group">
                <label for="inputName">Título</label>
                <input type="text" name="titulo" id="titulo" class="form-control">
              </div>
			</div>
			<div class="col-md-2">
             <div class="form-group">
                <label for="inputStatus">Tipo Negocio</label>
                <select class="form-control custom-select" name="idneg">
                  <option value="" selected>Seleccione</option>
								<?php
									$query = $mysqli -> query ("SELECT * FROM negociacion WHERE estatus ='A'");
										while ($valores = mysqli_fetch_array($query)) {
											echo '<option value="'.$valores['idneg'].'">'.$valores['nombre'].'</option>';
												}
										?>                   
                </select>
              </div>
			</div>
			<div class="col-md-2">
             <div class="form-group">
                <label for="inputStatus">Categoría</label>
                <select class="form-control custom-select" name="idtipo" required>
                  <option value="" selected>Seleccione</option>
								<?php
									$query = $mysqli -> query ("SELECT * FROM tiposinm WHERE estatus ='A'");
										while ($valores = mysqli_fetch_array($query)) {
											echo '<option value="'.$valores['idtipo'].'">'.$valores['tipologia'].'</option>';
												}
										?>               
                </select>
              </div>
			</div>
			<!-- Estado / Municipio / GPS -->
			<div class="col-md-6">
				<div class="form-group">
					<!--label for="cc-exp" class="control-label mb-1">Estado</label-->
					<select id="id_estado" class="form-control mtitu" name="idestado" required>
						<option value="">-- Estado --</option>
						<?php
						//require('admin/conexion.php');
						$query = $mysqli -> query ("select idestado, estado from estado");
						while ($valores = mysqli_fetch_array($query)) {
						echo '<option value="'.$valores['idestado'].'">'.$valores['estado'].'</option>';
					} ?>
					</select>
					<!--span class="help-block" data-valmsg-for="mtitu" data-valmsg-replace="true"></span-->
				</div>
			</div> 
			<div class="col-md-6">
				<div class="form-group">
					<!--label for="cc-exp" class="control-label mb-1">Municipio</label-->
					<select id="id_municipio" class="form-control" name="idmunicipio" required>
						<option value="">-- Municipio --</option>
					</select>	
					<!--span class="help-block" data-valmsg-for="mtitu" data-valmsg-replace="true"></span-->
				</div>
			</div>
			
			<!-- -->
			<div class="col-md-12">
			  <div class="form-group">
                <label for="inputName">Ubicación</label>
                <input type="text" name="ubicacion" id="ubicacion" class="form-control">
              </div>
			</div>
			<!-- -->
			<div class="col-md-2">
              <div class="form-group">
                <label for="inputName">Área Terreno</label>
                <input type="text" name="areatotal"  class="form-control">
              </div>
			</div>
			<div class="col-md-2">
              <div class="form-group">
                <label for="inputName">Área Construción</label>
                <input type="text" name="areaconst" class="form-control">
              </div>
			</div>
			<div class="col-md-2">
              <div class="form-group">
                <label for="inputName">Antiguedad</label>
                <input type="text" name="antiguedad" class="form-control">
              </div>
			</div>
			
			<div class="col-md-1">
              <div class="form-group">
                <label for="inputStatus">Cocina(s)</label>
                <select class="form-control custom-select" name="cocina">
                  <option value="0">0</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
				  <option value="4">4</option>
				  <option value="5">5</option>
				  <option value="6">6</option>
				  <option value="7">7</option>
				  <option value="8">8</option>
				  <option value="9">9</option>
				  <option value="10">10</option>
				  <option value="11">11</option>
                </select>
              </div>
			</div>
			<div class="col-md-1">
              <div class="form-group">
                <label for="inputStatus">Sala(s)</label>
                <select class="form-control custom-select" name="sala">
                  <option value="0">0</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
				  <option value="4">4</option>
				  <option value="5">5</option>
				  <option value="6">6</option>
				  <option value="7">7</option>
				  <option value="8">8</option>
				  <option value="9">9</option>
				  <option value="10">10</option>
				  <option value="11">11</option>
                </select>
              </div>
			</div>
			<div class="col-md-1">
              <div class="form-group">
                <label for="inputStatus">Habit/Cubi</label>
                <select class="form-control custom-select" name="habitacion">
                  <option value="0">0</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
				  <option value="4">4</option>
				  <option value="5">5</option>
				  <option value="6">6</option>
				  <option value="7">7</option>
				  <option value="8">8</option>
				  <option value="9">9</option>
				  <option value="10">10</option>
				  <option value="11">11</option>
                </select>
              </div>
			</div>
			<div class="col-md-1">
              <div class="form-group">
                <label for="inputStatus">Habit. S.</label>
                <select class="form-control custom-select" name="habitacionserv">
                  <option value="0">0</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
				  <option value="4">4</option>
				  <option value="5">5</option>
				  <option value="6">6</option>
				  <option value="7">7</option>
				  <option value="8">8</option>
				  <option value="9">9</option>
				  <option value="10">10</option>
				  <option value="11">11</option>
                </select>
              </div>
			</div>
			<div class="col-md-1">
              <div class="form-group">
                <label for="inputStatus">Baños</label>
                <select class="form-control custom-select" name="banio">
                  <option value="0">0</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
				  <option value="4">4</option>
				  <option value="5">5</option>
				  <option value="6">6</option>
				  <option value="7">7</option>
				  <option value="8">8</option>
				  <option value="9">9</option>
				  <option value="10">10</option>
				  <option value="11">11</option>
                </select>
              </div>
			</div>
			<div class="col-md-1">
              <div class="form-group">
                <label for="inputStatus">Baño. S.</label>
                <select class="form-control custom-select" name="banoserv">
                  <option value="0">0</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
				  <option value="4">4</option>
				  <option value="5">5</option>
				  <option value="6">6</option>
				  <option value="7">7</option>
				  <option value="8">8</option>
				  <option value="9">9</option>
				  <option value="10">10</option>
				  <option value="11">11</option>
                </select>
              </div>
			</div>
			<!-- -->
			<div class="col-md-1">
              <div class="form-group">
                <label for="inputStatus">1/2 Baño</label>
                <select class="form-control custom-select" name="mediobano">
                  <option value="0">0</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
				  <option value="4">4</option>
				  <option value="5">5</option>
				  <option value="6">6</option>
				  <option value="7">7</option>
				  <option value="8">8</option>
				  <option value="9">9</option>
				  <option value="10">10</option>
				  <option value="11">11</option>
                </select>
              </div>
			</div>
			<div class="col-md-1">
              <div class="form-group">
                <label for="inputStatus">A/A</label>
                <select class="form-control custom-select" name="aire">
                  <option value="0">0</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
				  <option value="4">4</option>
				  <option value="5">5</option>
				  <option value="6">6</option>
				  <option value="7">7</option>
				  <option value="8">8</option>
				  <option value="9">9</option>
				  <option value="10">10</option>
				  <option value="11">11</option>
                </select>
              </div>
			</div>
			<div class="col-md-1">
              <div class="form-group">
                <label for="inputStatus">Tv.Cable</label>
                <select class="form-control custom-select" name="tvcable">
                  <option value="0">0</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
				  <option value="4">4</option>
                </select>
              </div>
			</div>
			<div class="col-md-1">
              <div class="form-group">
                <label for="inputStatus">Wi-fi</label>
                <select class="form-control custom-select" name="wifi">
                  <option value="0">0</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                </select>
              </div>
			</div>
			<div class="col-md-1">
              <div class="form-group">
                <label for="inputStatus">Parrillera</label>
                <select class="form-control custom-select" name="parrillera">
                  <option value="0">0</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                </select>
              </div>
			</div>
			<div class="col-md-1">
              <div class="form-group">
                <label for="inputStatus">Piscina</label>
                <select class="form-control custom-select" name="piscina">
                  <option value="0">0</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                </select>
              </div>
			</div>
			<div class="col-md-1">
              <div class="form-group">
                <label for="inputStatus">Maletero</label>
                <select class="form-control custom-select" name="maletero">
                  <option value="0">0</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                </select>
              </div>
			</div>
			<div class="col-md-1">
              <div class="form-group">
                <label for="inputStatus">Lavadero</label>
                <select class="form-control custom-select" name="lavadero">
                  <option value="0">0</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                </select>
              </div>
			</div>
			<div class="col-md-1">
              <div class="form-group">
                <label for="inputStatus">Gimnasio</label>
                <select class="form-control custom-select" name="gimnasio">
                  <option value="0">0</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                </select>
              </div>
			</div>
			<div class="col-md-1">
              <div class="form-group">
                <label for="inputStatus">Estac.</label>
                <select class="form-control custom-select" name="parking">
                  <option value="0">0</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
				  <option value="4">4</option>
				  <option value="5">5</option>
				  <option value="6">6</option>
				  <option value="7">7</option>
				  <option value="8">8</option>
				  <option value="9">9</option>
				  <option value="10">10</option>
				  <option value="11">11</option>
                </select>
              </div>
			</div>
			<div class="col-md-2">
              <div class="form-group">
					<label for="cc-exp" class="control-label mb-1">Tipo Estac.</label>
					<select class="form-control mtitu" name="idparq" required>
						<option value="">-- Tipo Estacionamiento --</option>
						<?php
						//require('admin/conexion.php');
						$query = $mysqli -> query ("select idestac, tipo from tiposest where estatus='A'");
						while ($valores = mysqli_fetch_array($query)) {
						echo '<option value="'.$valores['idestac'].'">'.$valores['tipo'].'</option>';
					} ?>
					</select>
					<!--span class="help-block" data-valmsg-for="mtitu" data-valmsg-replace="true"></span-->
				</div>
			</div>
			<!-- -->
			<div class="col-md-12">
              <div class="form-group">
                <label for="inputDescription">Descripción</label>
                <textarea name="describelo" class="form-control" rows="4"></textarea>
              </div>
			</div>
			<!-- -->
			<div class="col-md-6">
              <!--div class="form-group">
                <label for="inputName">Asesor</label>
                <input type="text" name="asesor" id="asesor" class="form-control">
              </div-->
			  <div class="form-group">
					<label for="cc-exp" class="control-label mb-1">Asesor</label>
					<select id="id_estado" class="form-control mtitu" name="idasesor" required>
						<option value="">-- Asesor --</option>
						<?php
						//require('admin/conexion.php');
						$query = $mysqli -> query ("select idasesor, apellido1, apellido2, nombre1, nombre2 from asesor where estatus='A'");
						while ($valores = mysqli_fetch_array($query)) {
						echo '<option value="'.$valores['idasesor'].'">'.$valores[1].' '.$valores[2].' '.$valores[3].' '.$valores[4].'</option>';
					} ?>
					</select>
					<!--span class="help-block" data-valmsg-for="mtitu" data-valmsg-replace="true"></span-->
				</div>
			</div>
			<div class="col-md-2">
              <div class="form-group">
                <label for="inputStatus">Destacado</label>
                <select class="form-control custom-select" name="destacado">
                  <option selected>Seleccione</option>
                  <option value="No">No</option>
                  <option value="Si">Si</option>
                </select>
              </div>
			</div>
			<div class="col-md-4">
              <div class="form-group">
                <label for="inputName">Costo</label>
                <input type="text" name="precio" id="costo" class="form-control">
              </div>
			</div>
			<div class="col-md-12">
				<h2><center>Instalaciones Cercanas</center></h2>
			</div>
			<!-- 1ra Linea de Instalaciones Cercanas            -->
			<div class="col-md-4">
             <div class="form-group">
                <label for="inputStatus">Supermercado</label>
                <select class="form-control custom-select" name="instalacion1" id="instalacion1">
                  <option value="No" selected>Seleccione</option>
                  <option value="Si" selected>Si</option>
                  <option value="No" selected>No</option>
                </select>
              </div>
			</div>
			
			
			<div class="col-md-4">
             <div class="form-group">
                <label for="inputStatus">Clínica/Hospital</label>
                <select class="form-control custom-select" name="instalacion2" id="instalacion2">
                  <option value="No" selected>Seleccione</option>
                  <option value="Si" selected>Si</option>
                  <option value="No" selected>No</option>
                </select>
              </div>
			</div>

			
			<div class="col-md-4">
             <div class="form-group">
                <label for="inputStatus">Farmacia</label>
                <select class="form-control custom-select" name="instalacion3" id="instalacion3">
                  <option value="No" selected>Seleccione</option>
                  <option value="Si" selected>Si</option>
                  <option value="No" selected>No</option>
                </select>
              </div>
			</div>

			<!-- 2da Linea de Instalaciones Cercanas            -->
			<div class="col-md-4">
             <div class="form-group">
                <label for="inputStatus">Colegios</label>
                <select class="form-control custom-select" name="instalacion4" id="instalacion4">
                  <option value="No" selected>Seleccione</option>
                  <option value="Si" selected>Si</option>
                  <option value="No" selected>No</option>
                </select>               
              </div>
			</div>
			
			<div class="col-md-4">
             <div class="form-group">
                <label for="inputStatus">Estación Metro</label>
                <!--select class="form-control custom-select" name="instalacion1" id="instalacion1">
                  <option value="No" selected>Seleccione</option>
                  <option value="Si" selected>Si</option>
                  <option value="No" selected>No</option>
                </select-->                
                <input type="text" id="instalacion5" name="instalacion5" value="1"  class="form-control">                
              </div>
			</div>	
			
			<div class="col-md-4">
             <div class="form-group">
                <label for="inputStatus">Parada de autobús</label>
                <select class="form-control custom-select" name="instalacion6" id="instalacion6">
                  <option value="No" selected>Seleccione</option>
                  <option value="Si" selected>Si</option>
                  <option value="No" selected>No</option>
                </select>                
              </div>
			</div>													

			<!-- 3ra Linea de Instalaciones Cercanas            -->
			<div class="col-md-4">
             <div class="form-group">
                <label for="inputStatus">Centro Comercial</label>
                <select class="form-control custom-select" name="instalacion7" id="instalacion7">
                  <option value="No" selected>Seleccione</option>
                  <option value="Si" selected>Si</option>
                  <option value="No" selected>No</option>
                </select>                
              </div>
			</div>				
			<!-- -->			
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
          <a href="rpt_inmueble.php" class="btn btn-secondary">Atrás</a>          
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
		costo = document.getElementById("costo").value;
		if( isNaN(costo) ) {
			alert('Error Costo!!!');
			return false;
		}
	}
</script>

</body>
</html>
