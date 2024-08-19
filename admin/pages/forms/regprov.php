<?php
	session_start();
	require('../../conexion.php');
	$usuario=$_SESSION['usuario'];
	$idlogin=$_SESSION['idlogin'];
	
	$sqldata = ("SELECT idprov, idcateg, rif, razsocial, dencomercial, codarea, telefono, movil, correo, idpais, idestado, idmunicipio, idparroquia, calleav, casaedif, piso, oficina, urbanizacion, codpostal, dirnovzla, codpostalnovzla, rifimg, rmimg, cedsocio1, cedsocio2 
							FROM proveedores WHERE idlogin='".$idlogin."';");
  $objdata=$mysqli->query($sqldata); $arrdata=$objdata->fetch_array();  
	
	$idprov=$arrdata['idprov'];
	$idcateg=$arrdata['idcateg'];
	$sql = ("SELECT categoria from categprove WHERE idcateg='".$idcateg."';");
	$obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
  $categoria=$arr[0];

	$rif=$arrdata['rif'];
	//$tprif = substr($arrdata['rif'], 0,1);
  //$rif = substr($arrdata['rif'], 1,9);
	
	$razsocial=$arrdata['razsocial'];
	$dencomercial=$arrdata['dencomercial'];
	$codarea=$arrdata['codarea'];
	$telefono=$arrdata['telefono'];
	
	//$tprif = substr($arrdata['rif'], 0,1);
  //$rif = substr($arrdata['rif'], 1,9);
	$operadora=substr($arrdata['movil'], 0,4);
	$movil=substr($arrdata['movil'],4);
	$correo=$arrdata['correo'];

	$idpais=$arrdata['idpais'];
	$sql = ("SELECT pais from paises WHERE idpais='".$idpais."';");
	$obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
  $pais=$arr[0];
	$idestado=$arrdata['idestado'];
	$sql = ("SELECT estado from estado WHERE idestado='".$idestado."';");
	$obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
  $estado=$arr[0];
	$idmunicipio=$arrdata['idmunicipio'];
	$sql = ("SELECT municipio from municipios WHERE idmunicipio='".$idmunicipio."';");
	$obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
  $municipio=$arr[0];
	$idparroquia=$arrdata['idparroquia'];
	$sql = ("SELECT parroquia from parroquias WHERE idparroquia='".$idparroquia."';");
	$obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
  $parroquia=$arr[0];

	/*$idpais=$arrdata['idpais'];
	$idestado=$arrdata['idestado'];
	$idmunicipio=$arrdata['idmunicipio'];
	$idparroquia=$arrdata['idparroquia'];*/

	$calleav=$arrdata['calleav'];
	$casaedif=$arrdata['casaedif'];
	$piso=$arrdata['piso'];
	$oficina=$arrdata['oficina'];
	$urbanizacion=$arrdata['urbanizacion'];
	$codpostal=$arrdata['codpostal'];

	$dirnovzla=$arrdata['dirnovzla'];
	$codpostalnovzla=$arrdata['codpostalnovzla'];

	$rifimg=$arrdata['rifimg'];
	$rmimg=$arrdata['rmimg'];
	$cedsocio1=$arrdata['cedsocio1'];
	$cedsocio2=$arrdata['cedsocio2'];

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
  <!-- Theme SweetAlert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<script src="jquery/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
	
		$(document).ready(function(){
			/*- - - - - - - - - - - - - - - - - - - - - - - - - - */
			$("#rifimg").on('change', function() {
				var fileName = $(this).val().split("\\").pop();
				$(this).siblings(".custom-file-label").addClass("selected").html(fileName);        
			})
			
			$("#rmimg").on('change', function() {
				var fileName = $(this).val().split("\\").pop();
				$(this).siblings(".custom-file-label").addClass("selected").html(fileName);        
			})
			$("#cedimg1").on('change', function() {
				var fileName = $(this).val().split("\\").pop();
				$(this).siblings(".custom-file-label").addClass("selected").html(fileName);        
			})
			$("#cedimg2").on('change', function() {
				var fileName = $(this).val().split("\\").pop();
				$(this).siblings(".custom-file-label").addClass("selected").html(fileName);        
			})
			/* - - - - - - - - - - - - - - - - - - - - - - - - -  */
			if ($("#idpais").val()!='232') {
            $("#div-estado").hide();
            $("#div-municipio").hide();
            $("#div-parroquia").hide();
            $("#div-urbaniza").hide();
            $("#div-caav").hide();
            $("#div-caed").hide();
            $("#div-piso").hide();
            $("#div-oficina").hide();
            $("#div-codpos").hide();
         }else{
            $("#div-dirnovzla").hide();
            $("#div-codposnovzla").hide();
         }
         $("#idpais").change(function() {
            if ($("#idpais").val()!='232') {
               $("#id_municipio").html("<option value=''>-- NO HAY DATOS --</option>");
               $("#id_parroquia").html("<option value=''>-- NO HAY DATOS --</option>");
               $("#id_estado").prop( "disabled", true );
               $("#id_municipio").prop( "disabled", true );
               $("#id_parroquia").prop( "disabled", true );

               $("#div-estado").hide();
               $("#div-municipio").hide();
               $("#div-parroquia").hide();
               
               $("#urbanizacion").val('');
               $("#calleav").val('');
               $("#casaedif").val('');
               $("#piso").val('');
               $("#codpostal").val('');

               $("#div-urbaniza").hide();
               $("#div-caav").hide();
               $("#div-caed").hide();
               $("#div-piso").hide();
               $("#div-oficina").hide();
               $("#div-codpos").hide();

               $("#div-dirnovzla").show();
               $("#div-codposnovzla").show();
            }else{
               $("#div-dirnovzla").hide();
               $("#div-codposnovzla").hide();

               $("#div-estado").show();
               $("#div-municipio").show();
               $("#div-parroquia").show();
               $("#id_estado").prop( "disabled", false );
               $("#id_municipio").prop( "disabled", false );
               $("#id_parroquia").prop( "disabled", false );

               $("#div-urbaniza").show();
               $("#div-caav").show();
               $("#div-caed").show();
               $("#div-piso").show();
               $("#div-oficina").show();
               $("#div-codpos").show();
            }
						$.get("pais_js.php", "idpais=" + $("#idpais").val(), function(data) {
               $("#id_estado").html(data);
               console.log(data);
            });
			/*-- - - - - - - - - - - - - - - - - - - - - - - - -  
			$("#idpais").change(function(){				
				$.get("pais_js.php","idpais="+$("#idpais").val(), function(data){
					$("#id_estado").html(data);
					console.log(data);
				});
			});*/

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
			});
		}); // End Ready
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
            <h1>Actualizar Proveedor</h1>
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
              <h3 class="card-title"><span><img width="799px" height="37" src="img/linea1.png"> </span></h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
      <!--
			<form enctype="multipart/form-data" action="< ?php echo $_SERVER['PHP_SELF'] ?>" 
			--> 
			<form enctype="multipart/form-data" action="updprovctas.php" method="post" onsubmit="return validacion()">
				<input type="hidden" name="idlogin" id="idlogin" value="<?php echo $idlogin; ?>">
				<input type="hidden" name="idprov" id="idprov" value="<?php echo $idprov; ?>">
			<div class="row">
				<!--
				<div class="col-md-1">
					<div class="form-group">
						<label for="tprif">Tipo</label>
						<select class="form-control form-control-sm"  id="tprif" name="tprif" readonly >
							<option value="< ?php echo $rif;?>">< ?php echo $tprif;?></option>
            </select>
					</div>
				</div>
				-->
				<div class="col-md-2">
					<div class="form-group">
						<label for="idcateg">Categoria:</label>
						<select id="idcateg" class="form-control form-control-sm " name="idcateg" required>
							<option value="<?php echo $idcateg;?>"><?php echo $categoria;?></option>
							<?php
							//require('admin/conexion.php');
							$query = $mysqli -> query ("SELECT idcateg, categoria FROM categprove WHERE idcateg!='".$idcateg."' AND idestatus='1' ; ");
							while ($valores = mysqli_fetch_array($query)) {
							echo '<option value="'.$valores['idcateg'].'">'.$valores['categoria'].'</option>';
						} ?>
						
						</select>
					</div>
				</div>
				<div class="col-md-2">
					<label for="rif">RIF:</label>
					<div class="form-group">
					<input type="text" name="rif" id="rif"  value="<?php echo $rif;?>" maxlength="9" minlength="9" class="form-control form-control-sm " onblur="fvalidrif(this.value)"
						onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" readonly >
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="razsocial">Razón Social:</label>
						<input type="text" name="razsocial" id="razsocial" value="<?php echo $razsocial;?>" class="form-control form-control-sm " style="text-transform:uppercase;" 
						 readonly>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="dencomercial">Denominacòn Comercial:</label>
						<input type="text" name="dencomercial" id="dencomercial" value="<?php echo $dencomercial;?>" class="form-control form-control-sm "style="text-transform:uppercase;" 
						readonly>
					</div>
				</div>
				<!-- 2da -->
				<div class="col-md-1">
					<div class="form-group">
						<label for="codarea">Cod:</label>
						<input type="text" name="codarea" id="codarea" minlength="3" maxlength="5" value="<?php echo $codarea;?>" class="form-control form-control-sm" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="telefono">Telefono Local:</label>
						<input type="text" name="telefono" id="telefono" maxlength="7" minlength="7" value="<?php echo $telefono;?>" class="form-control form-control-sm" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>
					</div>
				</div>
				<div class="col-md-1">
           <div class="form-group">
              <label for="operadora">Operadora:</label>
              <select class="form-control form-control-sm" id="operadora" name="operadora">
              	<option value="<?php echo $operadora;?>"><?php echo $operadora;?></option>
                <option value="0412">0412</option>
                <option value="0414">0414</option>
                <option value="0424">0424</option>
                <option value="0416">0416</option>
                <option value="0426">0426</option>
              </select>
           </div>
        </div>

        <div class="col-md-2">
           <div class="form-group">
              <!--label for="movil" style="visibility: hidden;">.</label-->
              <label for="movil">Telefono</label>
              <input type="text" name="movil" id="movil" maxlength="7" minlength="7" value="<?php echo $movil;?>" class="form-control form-control-sm" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>
           </div>
        </div> 
        <div class="col-md-6">
           <div class="form-group">
              <label for="correo">Correo:</label>
              <input type="email" name="correo" id="correo" value="<?php echo $correo;?>" class="form-control form-control-sm " required>
           </div>
        </div>
				
				<!--
				<div class="col-md-3">
					<div class="form-group">
						<label for="idtipo">Tipo de Empresa:</label>
						<select class="form-control form-control-sm" id="idtipo" name="idtipo">
							<option value="">-- Seleccione --</option>
               < ?php
							$query = $mysqli -> query ("SELECT idtipoempresa, tipoempresa FROM tipoempresa  WHERE idestatus='1'");
							while ($valores = mysqli_fetch_array($query)) {
							echo '<option value="'.$valores['idtipoempresa'].'">'.$valores['tipoempresa'].'</option>';
						} ?>
            </select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="idtipo">Tipo de Proveedor:</label>
						<select class="form-control form-control-sm" id="idtipoprov" name="idtipoprov">
							<option value="">-- Seleccione --</option>
              < ?php
							$srtsql = $mysqli -> query ("SELECT idtppr, tipoprov FROM tipoproveedor  WHERE idestatus='1'");
							while ($valsql = mysqli_fetch_array($srtsql)) {
							echo '<option value="'.$valsql['idtppr'].'">'.$valsql['tipoprov'].'</option>';
						} ?>
                		</select>
					</div>
				</div>
				-->
				<div class="col-md-3">
					<h6><strong>Rif:</strong></h6>
					<div class="custom-file">
						<input type="file" id="rifimg" name="imagen1" class="custom-file-input" accept="application/pdf" title="Formato PDF" >
						<label id="rifimg" class="custom-file-label" for="rifimg"></label>
						<?php if($rifimg!=''){?>
							<center> <a href="proveedocument/<?php echo $rifimg;?>" target="_blank" rel="noopener noreferrer" >Ver Rif</a></center>
						<?php }else{?>
							<center><small style="color:red" >N/A</small></center>
						<?php }?>
						
					</div>
				</div>
				<div class="col-md-3">
					<h6><strong>Reg.Mercantil:</strong></h6>
					<div class="custom-file">
						<input type="file" id="rmimg" name="imagen2" class="custom-file-input" accept="application/pdf" title="Formato PDF" >  
						<label id="rmimg"  class="custom-file-label" for="rmimg"></label> 
						<?php if($rmimg!=''){?>
							<center> <a href="proveedocument/<?php echo $rmimg;?>" target="_blank" rel="noopener noreferrer" >Ver Reg.Mercantil</a></center>
						<?php }else{?>
							<center><small style="color:red" >N/A</small></center>
						<?php }?>
					</div>
				</div>
				
				<div class="col-md-3">
					<h6><strong>Cedula Socio:</strong></h6>
					<div class="custom-file">
						<input type="file" id="cedimg1"  name="imagen3"  class="custom-file-input" accept="application/pdf" title="Formato PDF" >
						<label id="cedimg1" class="custom-file-label" for="cedimg1"></label> 
						<?php if($cedsocio1!=''){?>
							<center> <a href="proveedocument/<?php echo $cedsocio1;?>" target="_blank" rel="noopener noreferrer" >Ver CI</a></center>
						<?php }else{?>
							<center><small style="color:red" >N/A</small></center>
						<?php }?>
					</div>
				</div>
				<div class="col-md-3">
					<h6><strong>Cedula Socio:</strong></h6>
					<div class="custom-file">
						<input type="file" id="cedimg2"  name="imagen4"  class="custom-file-input" accept="application/pdf" title="Formato PDF" >
						<label id="cedimg2" class="custom-file-label" for="cedimg2"></label> 
						<?php if($cedsocio2!=''){?>
							<center> <a href="proveedocument/<?php echo $cedsocio2;?>" target="_blank" rel="noopener noreferrer" >Ver CI</a></center>
						<?php }else{?>
							<center><small style="color:red" >N/A</small></center>
						<?php }?>
						
					</div>
				</div>
				<!-- -->
				<!--
				<div class="col-md-12">
					<div class="form-group">
						<label for="descripcion">Descripción (breve):</label>
						<input type="text" name="descripcion" id="descripcion" style="text-transform:uppercase;" 
						onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;" class="form-control form-control-sm " required>
					</div>   
				</div>
				-->
				<!-- 3ra -->			
				<!-- Pais / Estado / Municipio / Parroquia -->
							<div class="col-md-3"><br>
                           <div class="form-group">
                              <label for="idpais">País:</label>
                              <select id="idpais" class="form-control form-control-sm" name="idpais" required>
                                <option value="<?php echo $idpais; ?>"><?php echo $pais; ?></option>
                                 <?php
                                 //require('admin/conexion.php');
                                 $query = $mysqli->query("SELECT idpais, pais FROM paises WHERE idestatus='1';");
                                 while ($valores = mysqli_fetch_array($query)) {
                                    echo '<option value="' . $valores['idpais'] . '">' . $valores['pais'] . '</option>';
                                 } ?>
                              </select>
                              <!--span class="help-block" data-valmsg-for="mtitu" data-valmsg-replace="true"></span-->
                           </div>
                        </div>
                        <!-- -->
                        <div id="div-dirnovzla" class="col-md-8"><br>
                           <div class="form-group">
                              <label for="dirnovzla">Dirección:</label>
                              <input type="text" name="dirnovzla" id="dirnovzla" class="form-control form-control-sm " style="text-transform:uppercase;"  value="<?php echo $dirnovzla;?>">
                           </div>
                        </div>
                        <div id="div-codposnovzla" class="col-md-1"><br>
                           <div class="form-group">
                              <label for="codpostalnovzla">Cod.Postal:</label>
                              <input type="text" maxlength="5" minlength="5" name="codpostalnovzla" id="codpostalnovzla" class="form-control form-control-sm "  value="<?php echo $codpostalnovzla;?>">
                           </div>
                        </div>
                        <!-- -->
                        <div id="div-estado" class="col-md-3"><br>
                           <div class="form-group">
                              <label for="correo">Estado:</label>
                              <select id="id_estado" class="form-control form-control-sm" name="idestado">
                                    <option value="<?php echo $idestado; ?>"><?php echo $estado; ?></option>
                              </select>
                              <!--span class="help-block" data-valmsg-for="mtitu" data-valmsg-replace="true"></span-->
                           </div>
                        </div>
                        <div id="div-municipio" class="col-md-3"><br>
                           <div class="form-group">
                              <label for="correo">Municipio:</label>
                              <select id="id_municipio" class="form-control form-control-sm" name="idmunicipio" >
                                 <option value="<?php echo $idmunicipio; ?>"><?php echo $municipio; ?></option>
                              </select>
                              <!--span class="help-block" data-valmsg-for="mtitu" data-valmsg-replace="true"></span-->
                           </div>
                        </div>
                        <div  id="div-parroquia" class="col-md-3"><br>
                           <div class="form-group">
                              <label for="correo">Parroquia:</label>
                              <select id="id_parroquia" class="form-control form-control-sm " name="idparroquia" >
                                    <option value="<?php echo $idparroquia; ?>"><?php echo $parroquia; ?></option>
                              </select>
                              <!--span class="help-block" data-valmsg-for="mtitu" data-valmsg-replace="true"></span-->
                           </div>
                        </div>
                        <!-- 7ta  -->
                        <div id="div-urbaniza" class="col-md-4">
                           <div class="form-group">
                              <label for="urbanizacion">Urbanización:</label>
                              <input type="text" name="urbanizacion" id="urbanizacion" style="text-transform:uppercase;" class=" form-control form-control-sm" 
                                 value="<?php echo $urbanizacion;?>">
                           </div>
                        </div>
                        <div id="div-caav" class="col-md-3">
                           <div class="form-group">
                              <label for="calleav">Calle/Avenida:</label>
                              <input type="text" name="calleav" style="text-transform:uppercase;" id="calleav" style="text-transform:uppercase;" class="form-control form-control-sm "  
                                 value="<?php echo $calleav;?>">
                           </div>
                        </div>
                        <div id="div-caed" class="col-md-2">
                           <div class="form-group">
                              <label for="casaedif">Casa/Edif.:</label>
                              <input type="text" maxlength="88" name="casaedif" id="casaedif" style="text-transform:uppercase;" class="form-control form-control-sm "
                                 value="<?php echo $casaedif;?>">
                           </div>
                        </div>
                        <div id="div-piso" class="col-md-1">
                           <div class="form-group">
                              <label for="piso">Piso:</label>
                              <input type="text" maxlength="2" name="piso" id="piso" class="form-control form-control-sm " value="<?php echo $piso;?>">
                           </div>
                        </div>
                        <div id="div-oficina" class="col-md-1">
                           <div class="form-group">
                              <label for="oficina">Ofc.:</label>
                              <input type="text" maxlength="2" name="oficina" id="oficina" class="form-control form-control-sm " value="<?php echo $oficina;?>">
                           </div>
                        </div>
                        <div id="div-codpos" class="col-md-1">
                           <div class="form-group">
                              <label for="codpostal">Cod.Postal:</label>
                              <input type="text" maxlength="4" minlength="4" name="codpostal" id="codpostal" class="form-control form-control-sm "  
                                 value="<?php echo $codpostal;?>">
                           </div>
                        </div>

				<!-- 8va  -->
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
          <a href="../../index.php?usr=1" class="btn btn-secondary">Atrás</a>          
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
<!-- AdminLTE ds -->
<script src="js/ds.js"></script>
<script>
	function validacion(){
		//costo = document.getElementById("costo").value;
			//return false;
	}
</script>
</body>
</html>
