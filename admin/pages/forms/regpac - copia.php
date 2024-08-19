<?php
//ALTER TABLE `pacientes` ADD `dirnovzla` VARCHAR(200) NOT NULL COMMENT 'Direccion Fuera de Vzla' AFTER `codpostal`, ADD `codpostalnovzla` VARCHAR(5) NOT NULL COMMENT 'Cod Postal Fuera de Vzla' AFTER `dirnovzla`;
session_start();
$usuario = $_SESSION['usuario'];
$tpdoc   = $_SESSION['tipodoc'];
$nrodoc  = $_SESSION['nrodoc'];
//echo $tpdoc.'-'.$nrodoc; exit();

require('../../conexion.php');
$paso=0;

if(isset($rif)){$rif=$_GET['ced'];}

if(isset($_GET['idpac'])){
   $paso=1;
   $idpac=$_GET['idpac'];
   $sqldatos = ("SELECT * FROM pacientes WHERE idpaci='".$idpac."'");
      $objdatos = $mysqli->query($sqldatos); $arrdatos = $objdatos->fetch_array();
         $idpaci = $arrdatos['idpaci']; 
   }

if (isset($_POST['submit'])) {
   //datos 

   $apellido1 = $_POST['apellido1'];
   $apellido2 = $_POST['apellido2'];
   $nombre1   = $_POST['nombre1'];
   $nombre2   = $_POST['nombre2'];

   $tpdoc  = $_POST['tpdoc'];
   $nrodoc = $tpdoc.''.$_POST['nrodoc'];

   $fnacimiento = $_POST['fnacimiento'];
   $edad        = $_POST['edad'];
   $idsexo      = $_POST['idsexo'];

   
   $operadora = $_POST['operadora'];
   $movil     = $operadora.''.$_POST['movil'];
   $correo    = $_POST['correo'];

   $idpais = $_POST['idpais'];
   $idestado = $_POST['idestado'];
   $idmunicipio = $_POST['idmunicipio'];
   $idparroquia = $_POST['idparroquia'];

   $urbanizacion = $_POST['urbanizacion'];
   $calleav = $_POST['calleav'];
   $casaedif = $_POST['casaedif'];
   $piso = $_POST['piso'];
   $codpostal = $_POST['codpostal'];

   if (isset($_POST['dirnovzla'])) {$dirnovzla=$_POST['dirnovzla'];} else{$dirnovzla='N/A';}
   if (isset($_POST['codpostalnovzla'])) {$codpostalnovzla=$_POST['codpostalnovzla'];} else{$codpostalnovzla='N/A';}
   


   $sqlced = ("SELECT count(cedula) as si FROM pacientes WHERE cedula='".$nrodoc."'");
      $objced = $mysqli->query($sqlced); $arrced = $objced->fetch_array();
         $sisi = $arrced['si'];         

      if($sisi>0){

         $sqlidp = ("SELECT idpaci FROM pacientes WHERE cedula='".$nrodoc."'");
            $objidp = $mysqli->query($sqlidp); $arridp = $objidp->fetch_array();
               $idpaci = $arridp['idpaci']; 

         $str="UPDATE pacientes SET apellido1='".strtoupper($apellido1)."',apellido2='".strtoupper($apellido2)."',nombre1='".$nombre1."',nombre2='".$nombre2."',cedula='".$nrodoc."',fnacimiento='".$fnacimiento."',edad='".$edad."',idsexo='".$idsexo."',correo='".strtolower($correo)."',movil='".$movil."',idpais='".$idpais."',idestado='".$idestado."',idmunicipio='".$idmunicipio."',idparroquia='".$idparroquia."', calleav='".strtoupper($calleav)."',casaedif='".strtoupper($casaedif)."',piso='".strtoupper($piso)."',urbanizacion='".strtoupper($urbanizacion)."',codpostal='".$codpostal."', dirnovzla ='".$dirnovzla."', 
           codpostalnovzla ='".$codpostalnovzla."' ,estatus='".$idestatus."' WHERE idpaci='".$idpaci."'";
       //echo $str;exit();
               $conexion=$mysqli->query($str);
                  echo '<script language="javascript">alert("¡Actualizacion Exitosa!");
                                                      window.location.href="regcitapac.php?idpc='.$idpaci.'"; </script>';

      }else{

            /* Inserto en Login para luego leer el idlogin */
         $str = "INSERT INTO loginn (cedula, correo, cargo, clave, privilegios, estatus) 
                 VALUES ('".$nrodoc."','".$correo."', 'Paciente', '".substr($nrodoc,1)."','4','A')";
            $conexion = $mysqli->query($str);

         $sqllast = ("SELECT max(idlogin) from loginn");
            $objlast = $mysqli->query($sqllast); $arrlast = $objlast->fetch_array();
               $idlogin = $arrlast[0];
         /* Fin */

        /* $sqlmed = ("SELECT idmed, nombre1, apellido1 FROM medicos WHERE correo='".$usuario."'");
               $objmed = $mysqli->query($sqlmed); $arrmed = $objmed->fetch_array();
                  $idmedico = $arrmed['idmed']; */

         $str = "INSERT INTO pacientes (idlogin, apellido1, apellido2, nombre1, nombre2, cedula, fnacimiento, edad, idsexo, correo, movil, idpais, idestado, idmunicipio, idparroquia, calleav, casaedif, piso, urbanizacion, codpostal, estatus) 
            VALUES ('".$idlogin."','".strtoupper($apellido1)."','".strtoupper($apellido2)."','".strtoupper($nombre1)."','".strtoupper($nombre2)."','".$nrodoc."','".$fnacimiento."','".$edad."','".$idsexo."','".$correo."','".$movil."','".$idpais."','".$idestado."','".$idmunicipio."','".$idparroquia."','".$calleav."','".$casaedif."','".$piso."','".$urbanizacion."','".$codpostal."','1')";
            $conexion = $mysqli->query($str);

            $sqlidp = ("SELECT idpaci FROM pacientes WHERE cedula='".$nrodoc."'");
            $objidp = $mysqli->query($sqlidp); $arridp = $objidp->fetch_array();
               $idpaci = $arridp['idpaci']; 

               echo '<script language="javascript">alert("¡Registro Exitoso!");
                                                   window.location.href="regcitapac.php?idpc='.$idpaci.'"; </script>';
      }

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
   <!-- Google Font: Source Sans Pro -->
   <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
   <script src="jquery/jquery-3.2.1.min.js"></script>
   <script type="text/javascript">
      $(document).ready(function() {
         
         if ($("#idpais").val()!='232') {
            $("#div-estado").hide();
            $("#div-municipio").hide();
            $("#div-parroquia").hide();
            $("#div-urbaniza").hide();
            $("#div-caav").hide();
            $("#div-caed").hide();
            $("#div-piso").hide();
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
               $("#div-codpos").show();
            }
            $.get("pais_js.php", "idpais=" + $("#idpais").val(), function(data) {
               $("#id_estado").html(data);
               console.log(data);
            });
         });

         $("#id_estado").change(function() {
            $.get("estados_js.php", "id_estado=" + $("#id_estado").val(), function(data) {
               $("#id_municipio").html(data);
               console.log(data);
            });
         });

         $("#id_municipio").change(function() {
            $.get("munic_js.php", "id_municipio=" + $("#id_municipio").val(), function(data) {
               $("#id_parroquia").html(data);
               console.log(data);
            });
         });


      });

      //*validacion de fecha
      function calcedad(fecha) {
         //alert(fecha);return false;
         jQuery.ajax({
            type: "POST",
            url: "caledad_js.php",
            data: {
               fecha: fecha
            },
            success: function(data) {
               var edad = parseInt(data);
               if (edad < 25 || edad > 80 || isNaN(edad)) {
                  document.getElementById("edad").value = 'Error';
                  return false;
               } else {
                  document.getElementById("edad").value = data;
               }
            },
            error: function() {}
         });
      }
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
                     <h1>Pacientes</h1>
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
               <div style="background: #F89921" class="card-header">
                  <h3 class="card-title">Registro</h3>

                  <div class="card-tools">
                     <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                  </div>
               </div>
               <div class="card-body">
                  <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return validacion()">
                     <div class="row">
                        <!-- 1ra -->
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="apellido1">1er Apellido </label>
                              <input type="text" name="apellido1" id="apellido1" style="text-transform:uppercase;" onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;" required class="form-control form-control-sm " required 
                              value="<?php if($paso==1){echo $arrdatos['apellido1'];}?>">
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="apellido2">2do Apellido </label>
                              <input type="text" name="apellido2" id="apellido2" style="text-transform:uppercase;" onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;" class="form-control form-control-sm" 
                              value="<?php if($paso==1){echo $arrdatos['apellido2'];}?>">
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="nombre1">1er Nombre </label>
                              <input type="text" name="nombre1" id="nombre1" style="text-transform:uppercase;" onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;" required class="form-control form-control-sm " required 
                              value="<?php if($paso==1){echo $arrdatos['nombre1'];}?>">
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="mombre2">2do Nombre </label>
                              <input type="text" name="nombre2" id="nombre2" style="text-transform:uppercase;" onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;" class="form-control form-control-sm" 
                              value="<?php if($paso==1){echo $arrdatos['nombre2'];}?>">
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="fnacimiento">Fec.Nacimiento:</label>
                              <input type="date" name="fnacimiento" id="fnacimiento" class="form-control form-control-sm " onchange="calcedad(this.value)" 
                                 value="<?php if($paso==1){echo $arrdatos['fnacimiento'];}?>">
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="edad">Edad:</label>
                              <input type="text" name="edad" id="edad" class="form-control form-control-sm " 
                                     value="<?php echo $arrdatos['edad'];?>" readonly>
                           </div>
                        </div>
                        <!-- 2da  -->
                        <?php if(isset($rif)){ ?>
                        <div class="col-md-1">
                           <div class="form-group">
                              <label for="nrodoc">Cedula:</label>
                              <select class="form-control form-control-sm " id="tpdoc2" name="tpdoc2" disabled>
                                 <option value="<?php echo substr($rif,0,1);?>">
                                    <?php echo substr($rif,0,1);?></option>
                              </select>
                              <input type="hidden" name="tpdoc" value="<?php echo substr($rif,0,1);?>">
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="tpdoc" style="visibility:hidden ;">.</label>
                              <input type="text" name="nrodoc2" id="nrodoc2" minlength="6" maxlength="8" value="<?php echo substr($rif,1);?>" class="form-control form-control-sm" disabled>
                              <input type="hidden" name="nrodoc" value="<?php echo substr($rif,1);?>">
                           </div>
                        </div>
                        <?php }else{ ?>
                        <div class="col-md-1">
                           <div class="form-group">
                              <label for="nrodoc">Cedula:</label>
                              <select class="form-control form-control-sm " id="tpdoc" name="tpdoc">
                                 <option value="<?php if($paso==1){echo substr($arrdatos['cedula'],0,1);}?>">
                                    <?php if($paso==1){echo substr($arrdatos['cedula'],0,1);}?></option>
                                 <option value="V">V</option>
                                 <option value="E">E</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="tpdoc" style="visibility:hidden ;">.</label>
                              <input type="text" name="nrodoc" id="nrodoc" minlength="6" maxlength="8" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" class="form-control form-control-sm " required 
                                 value="<?php if($paso==1){echo substr($arrdatos['cedula'],1);}?>">
                              
                           </div>
                        </div>                           
                        <?php } ?>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="idsexo">Sexo:</label>
                              <select id="idsexo" class="form-control form-control-sm" name="idsexo" required>
                                 <?php if($paso==1){ ?>
                                    <option value="<?php echo $arrdatos['idsexo'];?>">
                                       <?php 
                                          $sqlgg = ("SELECT sexo FROM sexo 
                                                      WHERE idsexo='".$arrdatos['idsexo']."'");
                                                      $objgg = $mysqli->query($sqlgg); 
                                                      $arrgg = $objgg->fetch_array();
                                             echo $arrgg['sexo'];?></option>
                                 <?php }else{ ?>
                                    <option value="">-- Seleccione --</option>
                                 <?php } ?>
                                 <?php
                                 //require('admin/conexion.php');
                                 $query = $mysqli->query("SELECT idsexo, sexo FROM sexo WHERE idestatus='1'");
                                 while ($valores = mysqli_fetch_array($query)) {
                                    echo '<option value="'.$valores['idsexo'].'">'.$valores['sexo'].'</option>';
                                 } ?>
                              </select>
                           </div>
                        </div>
                        
                        <!-- 3ra -->
                        <div class="col-md-1">
                           <div class="form-group">
                              <label for="movil">Movil:</label>
                              <select class="form-control form-control-sm" id="operadora" name="operadora">
                                 <option value="<?php if($paso==1){echo substr($arrdatos['movil'],0,4);}?>">
                                    <?php if($paso==1){echo substr($arrdatos['movil'],0,4);}?></option>
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
                              <label for="movil" style="visibility: hidden;">.</label>
                              <input type="text" name="movil" id="movil" maxlength="7" minlength="7" class="form-control form-control-sm" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required 
                                 value="<?php if($paso==1){echo substr($arrdatos['movil'],4);}?>">
                           </div>
                        </div> 
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="correo">Correo:</label>
                              <input type="email" name="correo" id="correo" class="form-control form-control-sm " required value="<?php if($paso==1){echo $arrdatos['correo'];}?>">
                           </div>
                        </div>
                        <!-- 4ta -->

                        <!-- Pais / Estado / Municipio / Parroquia -->
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="correo">Pais:</label>
                              <select id="idpais" class="form-control form-control-sm" name="idpais" required>
                                 <?php if($paso==1){ ?>
                                    <option value="<?php echo $arrdatos['idpais'];?>">
                                       <?php 
                                          $sqlgg = ("SELECT pais FROM paises 
                                                      WHERE idpais='".$arrdatos['idpais']."'");
                                                      $objgg = $mysqli->query($sqlgg); 
                                                      $arrgg = $objgg->fetch_array();
                                             echo $arrgg['pais'];?></option>
                                 <?php }else{ ?>
                                    <option value="">-- Pais --</option>
                                 <?php } ?>
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
                        <div id="div-dirnovzla" class="col-md-8">
                           <div class="form-group">
                              <label for="dirnovzla">Direcciòn:</label>
                              <input type="text" name="dirnovzla" id="dirnovzla" class="form-control form-control-sm " style="text-transform:uppercase;"  value="<?php if($paso==1){echo $arrdatos['dirnovzla'];}?>">
                           </div>
                        </div>
                        <div id="div-codposnovzla" class="col-md-1">
                           <div class="form-group">
                              <label for="codpostalnovzla">Cod.Postal:</label>
                              <input type="text" maxlength="5" minlength="5" name="codpostalnovzla" id="codpostalnovzla" class="form-control form-control-sm "  value="<?php if($paso==1){echo $arrdatos['codpostalnovzla'];}?>">
                           </div>
                        </div>
                        <!-- -->
                        <div id="div-estado" class="col-md-3">
                           <div class="form-group">
                              <label for="correo">Estado:</label>
                              <select id="id_estado" class="form-control form-control-sm" name="idestado">
                                 <?php if($paso==1){ ?>
                                    <option value="<?php echo $arrdatos['idestado'];?>">
                                       <?php 
                                          $sqlgg = ("SELECT estado FROM estado 
                                                      WHERE idestado ='".$arrdatos['idestado']."'");
                                                      $objgg = $mysqli->query($sqlgg); 
                                                      $arrgg = $objgg->fetch_array();
                                             if (!isset($arrgg['estado'])) {
                                             echo 'N/A';
                                                }else{
                                             echo $arrgg['estado']; }?></option>
                                 <?php }else{ ?>
                                    <option value="">-- Estado --</option>
                                 <?php } ?>
                              </select>
                              <!--span class="help-block" data-valmsg-for="mtitu" data-valmsg-replace="true"></span-->
                           </div>
                        </div>
                        <div id="div-municipio" class="col-md-3">
                           <div class="form-group">
                              <label for="correo">Municipio:</label>
                              <select id="id_municipio" class="form-control form-control-sm" name="idmunicipio" >
                                 <?php if($paso==1){ ?>
                                    <option value="<?php echo $arrdatos['idmunicipio'];?>">
                                       <?php 
                                          $sqlgg = ("SELECT municipio FROM municipios 
                                                      WHERE idmunicipio  ='".$arrdatos['idmunicipio']."'");
                                                      $objgg = $mysqli->query($sqlgg); 
                                                      $arrgg = $objgg->fetch_array();
                                              if (!isset($arrgg['municipio'])) {
                                             echo 'N/A';
                                                }else{
                                             echo $arrgg['municipio'];}?></option>
                                 <?php }else{ ?>
                                    <option value="">-- Municipio --</option>
                                 <?php } ?>
                              </select>
                              <!--span class="help-block" data-valmsg-for="mtitu" data-valmsg-replace="true"></span-->
                           </div>
                        </div>
                        <div  id="div-parroquia" class="col-md-3">
                           <div class="form-group">
                              <label for="correo">Parroquia:</label>
                              <select id="id_parroquia" class="form-control form-control-sm " name="idparroquia" >
                                 <?php if($paso==1){ ?>
                                    <option value="<?php echo $arrdatos['idparroquia'];?>">
                                       <?php 
                                          $sqlgg = ("SELECT parroquia FROM parroquias 
                                                      WHERE idparroquia  ='".$arrdatos['idparroquia']."'");
                                                      $objgg = $mysqli->query($sqlgg); 
                                                      $arrgg = $objgg->fetch_array();
                                             if (!isset($arrgg['parroquia'])) {
                                             echo 'N/A';
                                                }else{
                                             echo $arrgg['parroquia'];}?></option>
                                 <?php }else{ ?>
                                    <option value="">-- Parroquia --</option>
                                 <?php } ?>
                              </select>
                              <!--span class="help-block" data-valmsg-for="mtitu" data-valmsg-replace="true"></span-->
                           </div>
                        </div>
                        <!-- 7ta  -->
                        <div id="div-urbaniza" class="col-md-4">
                           <div class="form-group">
                              <label for="urbanizacion">Urbanización:</label>
                              <input type="text" name="urbanizacion" id="urbanizacion" style="text-transform:uppercase;" class=" form-control form-control-sm" 
                                 value="<?php if($paso==1){echo $arrdatos['urbanizacion'];}?>">
                           </div>
                        </div>
                        <div id="div-caav" class="col-md-3">
                           <div class="form-group">
                              <label for="calleav">Calle/Avenida:</label>
                              <input type="text" name="calleav" style="text-transform:uppercase;" id="calleav" style="text-transform:uppercase;" class="form-control form-control-sm "  
                                 value="<?php if($paso==1){echo $arrdatos['calleav'];}?>">
                           </div>
                        </div>
                        <div id="div-caed" class="col-md-3">
                           <div class="form-group">
                              <label for="casaedif">Casa/Edif.:</label>
                              <input type="text" maxlength="8" name="casaedif" id="casaedif" style="text-transform:uppercase;" class="form-control form-control-sm "
                                 value="<?php if($paso==1){echo $arrdatos['casaedif'];}?>">
                           </div>
                        </div>
                        <div id="div-piso" class="col-md-1">
                           <div class="form-group">
                              <label for="piso">Piso:</label>
                              <input type="text" maxlength="2" name="piso" id="piso" class="form-control form-control-sm " value="<?php if($paso==1){echo $arrdatos['piso'];}?>">
                           </div>
                        </div>

                        <div id="div-codpos" class="col-md-1">
                           <div class="form-group">
                              <label for="codpostal">Cod.Postal:</label>
                              <input type="text" maxlength="4" minlength="4" name="codpostal" id="codpostal" class="form-control form-control-sm "  
                                 value="<?php if($paso==1){echo $arrdatos['codpostal'];}?>">
                           </div>
                        </div>

                        <!-- 8va  -->
                        <div align="right" class="col-md-12">
                           <input style="background: #F89921;border-color: #F89921" type="submit" name="submit" value="Continuar..." class="btn btn-main btn-primary btn-lg uppercase">
                        </div>
                  </form>
                  <!-- /.card-body -->
               </div>
               <!-- /.card -->
            </div>
      </div>
      <div class="row">
         <div align="center" class="col-12">
            <a href="rpt_pac.php" class="btn btn-secondary">Atrás</a>
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
      function validacion() {
         costo = document.getElementById("costo").value;
         if (isNaN(costo)) {
            alert('Error Costo!!!');
            return false;
         }
      }
   </script>

</body>

</html>