<?php
	session_start();
	$usuario=$_SESSION['usuario'];
	//$idlogin=$_SESSION['idlogin'];
	require('../../conexion.php');
	//datos 
	if(isset($_POST['rif'])) {
			$fecha        = date('d/m/Y');
			$idlogin      =$_POST['idlogin'];
			$idprov      =$_POST['idprov'];
			$idcateg      =$_POST['idcateg'];
			//$rif          =$_POST['tprif'].$_POST['rif'];
			$rif          =$_POST['rif'];
			$razsocial    =$_POST['razsocial'];
			$dencomercial =$_POST['dencomercial'];
			$codarea	  =$_POST['codarea'];
			$telefono	  =$_POST['telefono'];
			$movil		  =$_POST['operadora'].$_POST['movil'];
			$correo  	  =$_POST['correo'];

			/*
			$idtipo      =$_POST['idtipo'];
			$idtipoprov  =$_POST['idtipoprov'];
			$descripcion =$_POST['descripcion'];*/

			$idpais      =$_POST['idpais'];
			//$idestado    =$_POST['idestado'];
			if (isset($_POST['idestado'])) {$idestado=$_POST['idestado'];} else{$idestado='0';}
			//$idmunicipio =$_POST['idmunicipio'];
			if (isset($_POST['idmunicipio'])) {$idmunicipio=$_POST['idmunicipio'];} else{$idmunicipio='0';}
			//$idparroquia =$_POST['idparroquia'];
			if (isset($_POST['idparroquia'])) {$idparroquia=$_POST['idparroquia'];} else{$idparroquia='0';}

			$urbanizacion =$_POST['urbanizacion'];
			$calleav      =$_POST['calleav'];
			$casaedif     =$_POST['casaedif'];
			$piso         =$_POST['piso'];
			$oficina      =$_POST['oficina'];
			$codpostal    =$_POST['codpostal'];
   		if (isset($_POST['dirnovzla'])) {$dirnovzla=$_POST['dirnovzla'];} else{$dirnovzla='N/A';}
   		if (isset($_POST['codpostalnovzla'])) {$codpostalnovzla=$_POST['codpostalnovzla'];} else{$codpostalnovzla='N/A';}

			/* Inserto en Login para luego leer el idlogin   OJO aclarar tema del privilegio??????????? */
			/*
			$str="INSERT INTO loginn (idlogin, correo, cargo, cedula, clave, privilegios) 
			VALUES (NULL, '".$correo."', 'Proveedor', '".$rif."','123','5' );";
			$conexion=$mysqli->query($str);
			*/
			/*$sqllast = ("SELECT max(idlogin) from loginn;");
		  $objlast=$mysqli->query($sqllast); $arrlast=$objlast->fetch_array();  
			$idlogin=$arrlast[0];
			  */
			if (isset($_FILES['imagen1'])){

		        if ($_FILES['imagen1']['type']=='image/png' || $_FILES['imagen1']['type']=='application/pdf'){
		        //Subimos el fichero al servidor
		            $fileName = $_FILES['imagen1']['name'];
		            $sourcePath = $_FILES['imagen1']['tmp_name'];
		            //$targetPath = "drdocument/".$fileName;
		            $targetPath = "proveedocument/"."RIF".$rif.'.pdf';
		            if(move_uploaded_file($sourcePath,$targetPath)){
		              $rifimg = "RIF".$rif.'.pdf';     //$fileName;
		              $str= "UPDATE proveedores SET rifimg='".$rifimg."' WHERE idlogin='".$idlogin."'; ";
		              $conexion=$mysqli->query($str);
		              $validar=true;
		            }
		            //$str="INSERT INTO drdocument(iddocument, idmed, imagen) VALUES(null, '".$idmed."','".$imagen."');";
		            //$conexion=$mysqli->query($str);
		        }else{ $validar=false;
		      }
		    }
		    if (isset($_FILES['imagen2'])){

		        if ($_FILES['imagen2']['type']=='image/png' || $_FILES['imagen2']['type']=='application/pdf'){
		        //Subimos el fichero al servidor
		            $fileName = $_FILES['imagen2']['name'];
		            $sourcePath = $_FILES['imagen2']['tmp_name'];
		            //$targetPath = "drdocument/".$fileName;
		            $targetPath = "proveedocument/"."RM".$rif.'.pdf';
		            if(move_uploaded_file($sourcePath,$targetPath)){
		              $rmimg = "RM".$rif.'.pdf'; //$fileName;
		              $str= "UPDATE proveedores SET rmimg='".$rmimg."' WHERE idlogin='".$idlogin."'; ";
		              $conexion=$mysqli->query($str);
		              $validar=true;
		            }
		            //$str="INSERT INTO drdocument(iddocument, idmed, imagen) VALUES(null, '".$idmed."','".$imagen."');";
		            //$conexion=$mysqli->query($str);
		        }else{ $validar=false;
		      }
		    }
		    if (isset($_FILES['imagen3'])){

		        if ($_FILES['imagen3']['type']=='image/png' || $_FILES['imagen3']['type']=='application/pdf'){
		        //Subimos el fichero al servidor
		            $fileName = $_FILES['imagen3']['name'];
		            $sourcePath = $_FILES['imagen3']['tmp_name'];
		            //$targetPath = "drdocument/".$fileName;
		            $targetPath = "proveedocument/"."ci1".$rif.'.pdf';
		            if(move_uploaded_file($sourcePath,$targetPath)){
		              $cedsocio1 = "ci1".$rif.'.pdf'; //$fileName;
		              $str= "UPDATE proveedores SET cedsocio1='".$cedsocio1."' WHERE idlogin='".$idlogin."'; ";
		              $conexion=$mysqli->query($str);
		              $validar=true;
		            }
		            //$str="INSERT INTO drdocument(iddocument, idmed, imagen) VALUES(null, '".$idmed."','".$imagen."');";
		            //$conexion=$mysqli->query($str);
		        }else{ $validar=false;
		      }
		    }
			if (isset($_FILES['imagen4'])){

		        if ($_FILES['imagen4']['type']=='image/png' || $_FILES['imagen4']['type']=='application/pdf'){
		        //Subimos el fichero al servidor
		            $fileName = $_FILES['imagen4']['name'];
		            $sourcePath = $_FILES['imagen4']['tmp_name'];
		            //$targetPath = "drdocument/".$fileName;
		            $targetPath = "proveedocument/"."ci2".$rif.'.pdf';
		            if(move_uploaded_file($sourcePath,$targetPath)){
		              $cedsocio2 = "ci2".$rif.'.pdf'; //$fileName;
		              $str= "UPDATE proveedores SET cedsocio2='".$cedsocio2."' WHERE idlogin='".$idlogin."'; ";
		              $conexion=$mysqli->query($str);
		              $validar=true;
		            }
		            //$str="INSERT INTO drdocument(iddocument, idmed, imagen) VALUES(null, '".$idmed."','".$imagen."');";
		            //$conexion=$mysqli->query($str);
		        }else{ $validar=false;
		      }
		    }
		  $str= "UPDATE proveedores SET rif='".$rif."', 
		  idcateg='".$idcateg."', 
		  razsocial='".$razsocial."', 
		  dencomercial='".$dencomercial."', 
		  codarea='".$codarea."', 
		  telefono='".$telefono."', 
		  movil='".$movil."', 
		  correo='".$correo."',
		  idpais='".$idpais."',
		  idestado='".$idestado."',
		  idmunicipio='".$idmunicipio."',
		  idparroquia='".$idparroquia."',
		  calleav='".$calleav."',
		  casaedif='".$casaedif."',
		  piso='".$piso."',
		  oficina='".$oficina."',
		  urbanizacion='".$urbanizacion."',
		  codpostal='".$codpostal."',
		  dirnovzla='".$dirnovzla."',
		  codpostalnovzla='".$codpostalnovzla."'
		  WHERE idlogin='".$idlogin."'; ";
		  //echo $str; exit();
			$conexion=$mysqli->query($str);
			/*......................................................................................................................*/
			/*$str="INSERT INTO proveedores(idprov, idlogin, rif, razsocial, dencomercial, telefono, movil, correo, idpais, idestado, idmunicipio, idparroquia, calleav, casaedif, piso, oficina, urbanizacion, codpostal, rifimg, rmimg, cedsocio1, cedsocio2, idestatus) 
			VALUES (null, '".$idlogin."','".strtoupper($rif)."','".strtoupper($razsocial)."', '".strtoupper($dencomercial)."', '".$telefono."','".$movil."', '".$correo."','".$idpais."','".$idestado."','".$idmunicipio."','".$idparroquia."','".strtoupper($calleav)."', '".strtoupper($casaedif)."','".strtoupper($piso)."','".strtoupper($oficina)."','".strtoupper($urbanizacion)."','".$codpostal."','".$rifimg."','".$rmimg."', '".$cedsocio1."', '".$cedsocio2."','3')";*/
			/* Busco idlogin en datbconac / datbcoint, si no found, insert else asigno variables */
			$sqlestan = ("SELECT count(*) as hay, titular, nrodoc, idbco, idtipocuenta, nrocuenta, idestatus 
				FROM datbconac WHERE idlogin='".$idlogin."';");
  		$objestan=$mysqli->query($sqlestan); $arrestan=$objestan->fetch_array();  
			$hay=$arrestan['hay'];
			if ($hay=='0') {
				$str="INSERT INTO datbconac(iddatbco, idlogin, idestatus)	VALUES (null,'".$idlogin."','1')";
				$conexion=$mysqli->query($str);
				$titular='';
				$nrodoc='';
				$idbco='';
				$idtipocuenta='';
				$nrocuenta='';
			}else{
				$titular=$arrestan['titular'];
				$nrodoc=$arrestan['nrodoc'];
				$idbco=$arrestan['idbco'];
					$sqlbco = ("SELECT banco FROM bancos WHERE idbco='".$idbco."';");
	    		$obj=$mysqli->query($sqlbco); $arr=$obj->fetch_array();  
    			$banco=$arr[0];
				$idtipocuenta=$arrestan['idtipocuenta'];
					$sqltpcta = ("SELECT tipocuenta FROM tipocuenta WHERE idestatus='1';");
	    		$objtpcta=$mysqli->query($sqltpcta); $arrtpcta=$objtpcta->fetch_array();  
    			$tipocuenta=$arrtpcta[0];

				$nrocuenta=$arrestan['nrocuenta'];
				$idestatus=$arrestan['idestatus'];
			}

			/* Bco Internacional */
			$sqlestai = ("SELECT count(*) as hayi, idpais, nrodoc, idbco, ach, nrocuenta, swit, aba, dircta, telefono, codpostal, idestatus
				FROM datbcoint WHERE idlogin='".$idlogin."';");
  		$objestai=$mysqli->query($sqlestai); $arrestai=$objestai->fetch_array();  
			$hayi=$arrestai['hayi'];
			if ($hayi=='0') {
				$str="INSERT INTO datbcoint(iddatbcoint, idlogin, idestatus) VALUES (null,'".$idlogin."','1')";
				$conexion=$mysqli->query($str);
			}else{
				$idpais=$arrestai['idpais'];
				//$nrodoc=$arrestai['nrodoc'];
				$idbcoint=$arrestai['idbco'];
				if ($idbcoint=='0') {
					$idbcoint='';
					$bcoint='Seleccione';
				}else{
					$sqlbcoi = ("SELECT banco FROM bancos WHERE idbco='".$idbcoint."';");
	    		$obji=$mysqli->query($sqlbcoi); $arri=$obji->fetch_array();  
    			$bcoint=$arri[0];
  			}
				$ach=$arrestai['ach'];
				$nrocuentaint=$arrestai['nrocuenta'];
				$swit=$arrestai['swit'];
				$aba=$arrestai['aba'];
				$dircta=$arrestai['dircta'];
				$telefono=$arrestai['telefono'];
				$codpostalint=$arrestai['codpostal'];
			}
			
	}else if(isset($_POST['submit'])) {
			$idlogin				=$_POST['idlogin'];
			$idprov					=$_POST['idprov'];
			$titular				=$_POST['titular'];
			$nrodoc 				=$_POST['nrodoc'];
			$idbco 					=$_POST['idbco'];
			$idtipocuenta 	=$_POST['idtipocuenta'];
			$nrocuenta 			=$_POST['nrocuenta'];
			$idpais 				=$_POST['idpais'];
			$idbcoint 			=$_POST['idbcoint'];
			$nrocuentaint 	=$_POST['nrocuentaint'];
			$ach 						=$_POST['ach'];
			$swit 					=$_POST['swit'];
			$aba 						=$_POST['aba'];
			$dircta 				=$_POST['dircta'];
			$telefono 			=$_POST['telefono'];
			$codpostalint 	=$_POST['codpostalint'];
			/* Actualizo datos Bco Nacional */
			$str="UPDATE datbconac SET titular='".$titular."',nrodoc='".$nrodoc."',idbco='".$idbco."',idtipocuenta='".$idtipocuenta."',
			nrocuenta='".$nrocuenta."' WHERE idlogin='".$idlogin."'; ";
			 
			$conexion=$mysqli->query($str);
			/*$str="INSERT INTO datbconac(iddatbco, idlogin, titular, nrodoc, idbco, idtipocuenta, nrocuenta, idestatus) 
			VALUES (null,'".$idlogin."','".strtoupper($titular)."','".strtoupper($nrodoc)."','".$idbco."','".$idtipocuenta."','".$nrocuenta."','3')";
			*/
			/* Actualizo datos Bco Internacional */
			$str="UPDATE datbcoint SET titular='".$titular."',idpais='".$idpais."',nrodoc='".$nrodoc."',idbco='".$idbcoint."',ach='".$ach."',
			nrocuenta='".$nrocuentaint."',swit='".$swit."',aba='".$aba."',dircta='".$dircta."',telefono='".$telefono."',codpostal='".$codpostalint."' 
			WHERE idlogin='".$idlogin."';";			
			$conexion=$mysqli->query($str);

			/*$str="INSERT INTO datbcoint(iddatbcoint, idlogin, titular, idpais, nrodoc, idbco, ach, nrocuenta, swit, aba, dircta, telefono, codpostal, idestatus)
			VALUES (null,'".$idlogin."','".strtoupper($titular)."','".$idpais."','".$nrodoc."','".$idbcoint."','".$ach."','".$nrocuentaint."','".$swit."','".$aba."','".$dircta."','".$telefono."','".$codpostalint."','1')";*/
			

			//echo '<script language="javascript">alert("¡Actualizaciòn Exitoso!"); window.location.href="../../index.php?usr=1"; </script>';	
			echo '<script language="javascript">alert("¡Registro Exitoso!");
                                                   window.location.href="updespec.php?idprov='.$idprov.'"; </script>';
	}
	//echo '<script language="javascript">alert("¡Registro Exitoso!"); window.location.href="rpt_prov.php"; </script>';	
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
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<script src="jquery/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
		$(document).ready(function(){
						
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
            <h1>Proveedores</h1>
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
              <h3 class="card-title"><span><img width="799px" height="37" src="img/linea2.png"> </span></h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
			<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return validacion()">
			<input type="hidden" id="idlogin" name="idlogin" value="<?php echo $idlogin;?>">
			<input type="hidden" name="idprov" value="<?php echo $idprov;?>">
			<!--input type="hidden" name="idmed" value="< ?php echo $idmed;?>"-->
			<div class="row">
				<div align="center" class="col-md-12">
					<h3><em><strong>Datos Transferencia Nacionales</strong></em></h3>
				</div>
				<!-- 1ra -->
				<div class="col-md-9">
					<div class="form-group">
						<label for="titular">Titular </label>
						<input type="text" name="titular" id="titular" value="<?php echo $razsocial;?>" class="form-control form-control-sm" readonly >
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="nrodoc">Nro. Documento:</label>
						<input type="text" name="nrodoc" id="nrodoc" value="<?php echo $rif;?>" class="form-control form-control-sm" readonly >
					</div>
				</div>
				
				<!-- 2da  -->
				<div class="col-md-3">
					<div class="form-group">
						<label for="idbco">Banco:</label>
						<select id="idbco" class="form-control form-control-sm " name="idbco" required>
							<option value="<?php echo $idbco;?>"><?php echo $banco;?></option>
							<?php
							//require('admin/conexion.php');
							$query = $mysqli -> query ("SELECT idbco, banco FROM bancos WHERE tipo='1' AND idestatus='1' AND idbco!='".$idbco."';");
							while ($valores = mysqli_fetch_array($query)) {
							echo '<option value="'.$valores['idbco'].'">'.$valores['banco'].'</option>';
						} ?>
						
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="idtipocuenta">Tipo Cta:</label>
						<select id="idtipocuenta" class="form-control form-control-sm " name="idtipocuenta" required>
							<option value="<?php echo $idtipocuenta;?>"><?php echo $tipocuenta;?></option>
						<?php
							//require('admin/conexion.php');
							$query=$mysqli->query ("SELECT idtipocuenta, tipocuenta FROM tipocuenta WHERE idestatus='1' AND idtipocuenta!='".$idtipocuenta."'; ");
							while ($valores = mysqli_fetch_array($query)) {
							echo '<option value="'.$valores['idtipocuenta'].'">'.$valores['tipocuenta'].'</option>';
						} ?>
						
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="nrocuenta">Nro. Cuenta: <span><small>(Solo Nùmeros, 20 Digitos)</small></span> </label>
						<input type="text" name="nrocuenta" id="nrocuenta" value="<?php echo $nrocuenta;?>" minlength="24" maxlength="24" value="" class="form-control form-control-sm input-cta" 
						onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;"  required>
					</div>
				</div>
				<!-- * * * * * * * * * * * * * * * * * * * * * * * *  -->
				<div align="center" class="col-md-12">
					<hr>
					<h3><em><strong>Datos Transferencia Internacional</strong></em></h3>
				</div>
				<!-- 
				<input type="hidden" name="titularint" value="< ?php echo $allnombre;?>">
				<input type="hidden" name="nrodocint" id="nrodocint" value="< ?php echo $nrodocint;?>">
				-->
				<!-- Por preguntar si quedan o no, ya que redundan 

				<div class="col-md-9">
					<div class="form-group">
						<label for="titularint">Titular </label>
						<input type="text" name="titularint" id="titularint" value="< ?php echo $allnombre;?>" class="form-control form-control-sm " readonly>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="nrodocint">Nro. Documento:</label>
						<input type="text" name="nrodocint" id="nrodocint" value="< ?php echo $nrodocint;?>" class="form-control form-control-sm " required>
					</div>
				</div>
				-->
				<!-- 2da  -->
				<div class="col-md-3">
					<div class="form-group">
						<label for="idpais" class="control-label mb-1">Pais:</label>
						<select id="idpais" class="form-control form-control-sm " name="idpais" required>
							
							<?php
							//require('admin/conexion.php');
							$query = $mysqli -> query ("SELECT idpais, pais FROM paises WHERE idestatus='1' AND idpais!='232';");
							while ($valores = mysqli_fetch_array($query)) {
							echo '<option value="'.$valores['idpais'].'">'.$valores['pais'].'</option>';
							} ?>
						</select>
						<!--span class="help-block" data-valmsg-for="mtitu" data-valmsg-replace="true"></span-->
					</div>
				</div> 

				<div class="col-md-3">
					<div class="form-group">
						<label for="idbcoint">Banco:</label>
						<select id="idbcoint" class="form-control form-control-sm " name="idbcoint" required>
							<option value="<?php echo $idbcoint;?>"><?php echo $bcoint;?></option>
							<?php
							//require('admin/conexion.php');
							$query = $mysqli -> query ("SELECT idbco, banco FROM bancos WHERE tipo='2' AND idestatus='1' ; ");
							while ($valores = mysqli_fetch_array($query)) {
							echo '<option value="'.$valores['idbco'].'">'.$valores['banco'].'</option>';
						} ?>
						
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="nrocuentaint">Nro. Cuenta:</label>
						<input type="text" name="nrocuentaint" id="nrocuentaint" value="<?php echo $nrocuentaint;?>" minlength="8" maxlength="20"  value="" class="form-control form-control-sm " 
						onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>
					</div>
				</div>
				<!-- 3ra -->
				<div class="col-md-4">
					<div class="form-group">
						<label for="ach">ACH:</label>
						<input type="text" name="ach" id="ach" value="<?php echo $ach;?>" class="form-control form-control-sm ">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="swit">SWIT:</label>
						<input type="text" name="swit" id="swit" value="<?php echo $swit;?>" class="form-control form-control-sm" required>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="aba">ABA:</label>
						<input type="text" name="aba" id="aba" value="<?php echo $aba;?>" class="form-control form-control-sm" required>
					</div>
				</div>
				<!-- 4ta -->
				<div class="col-md-8">
					<div class="form-group">
						<label for="dircta">Dirección Cuenta:</label>
						<input type="text" name="dircta" id="dircta" value="<?php echo $dircta;?>" class="form-control form-control-sm " 
						minlength="7" style="text-transform:uppercase;" required>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="telefono">Teléfono:</label>
						<!--input type="text" name="telefono" id="telefono" value="< ?php echo $telefono;?>" class="form-control form-control-sm " required-->
						<input type="text" name="telefono" id="telefono" minlength="11" maxlength="11" value="<?php echo $telefono;?>" class="form-control form-control-sm" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="codpostalint">Cod.Postal:</label>
						<!--input type="text" name="codpostalint" id="codpostalint" value="< ?php echo $codpostalint;?>" class="form-control form-control-sm " required-->
						<input type="text" name="codpostalint" id="codpostalint" maxlength="5" minlength="5" value="<?php echo $codpostalint;?>" class="form-control form-control-sm " onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>
					</div>
				</div>
				<!-- * * * * * * * * * * * * * * * * * * * * * * * *  -->

			<div align="right" class="col-md-12">
				<input style="background: #F89921;border-color: #F89921" type="submit" name="submit" value="Guardar" class="btn btn-main btn-primary btn-lg uppercase" title="Guardar Informaciòn">
			</div>	
		</form> 
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
	  <div class="row">
        <div align="center" class="col-6">
          <a href="javascript: history.go(-1)" class="btn btn-secondary">Atrás</a>
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
<!-- Cleave -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.0.2/cleave.min.js"></script>
<script src="js/clevejsds.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<script>
	function validacion(){
		/*costo = document.getElementById("costo").value;
		if( isNaN(costo) ) {
			alert('Error Costo!!!');
			return false;
		}*/
	}

</script>

</body>
</html>
