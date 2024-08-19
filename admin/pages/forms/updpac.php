<?php
//ALTER TABLE `pacientes` ADD `dirnovzla` VARCHAR(200) NOT NULL COMMENT 'Direccion Fuera de Vzla' AFTER `codpostal`, ADD `codpostalnovzla` VARCHAR(5) NOT NULL COMMENT 'Cod Postal Fuera de Vzla' AFTER `dirnovzla`;
session_start();
$usuario = $_SESSION['usuario'];
//echo $tpdoc.'-'.$nrodoc; exit();

require('../../conexion.php');

if(isset($rif)){$rif=$_GET['ced'];}

if(isset($_GET['i'])){
   
   $idpaci=$_GET['i'];
   $sqldatos = ("SELECT apellido1, apellido2, nombre1, nombre2, cedula, fnacimiento, edad, idsexo, idestcivil, correo, codarea, telefono, operadora, movil, idpais, idestado, idmunicipio, idparroquia, calleav, casaedif, piso, urbanizacion, codpostal, dirnovzla, codpostalnovzla, estatus
      FROM pacientes WHERE idpaci='".$idpaci."';");
   //echo $sqldatos; exit();
   $objdatos = $mysqli->query($sqldatos); $arrdatos = $objdatos->fetch_array();
   //$idpaci = $arrdatos['idpaci'];
   $apellido1= $arrdatos['apellido1'];
   $apellido2= $arrdatos['apellido2'];
   $nombre1= $arrdatos['nombre1'];
   $nombre2= $arrdatos['nombre2'];
   $cedula= $arrdatos['cedula'];
   $fnacimiento= $arrdatos['fnacimiento'];
   $edad= $arrdatos['edad'];
   $idsexo= $arrdatos['idsexo'];
      $sql = ("SELECT sexo from sexo WHERE idsexo='".$idsexo."';");
      $obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
      $sexo=$arr[0];
   $idestcivil= $arrdatos['idestcivil'];
   $correo= $arrdatos['correo'];
   $codarea= $arrdatos['codarea'];
   $telefono= $arrdatos['telefono'];
   $operadora= ''; //$arrdatos['operadora'];
   $movil= $arrdatos['movil'];
   
   $idpais=$arrdatos['idpais'];
      $sql = ("SELECT pais from paises WHERE idpais='".$idpais."';");
      $obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
      $pais=$arr[0];
   $idestado=$arrdatos['idestado'];
      $sql = ("SELECT estado from estado WHERE idestado='".$idestado."';");
      $obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
      $estado=$arr[0];
   $idmunicipio=$arrdatos['idmunicipio'];
      $sql = ("SELECT municipio from municipios WHERE idmunicipio='".$idmunicipio."';");
      $obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
      $municipio=$arr[0];
   $idparroquia=$arrdatos['idparroquia'];
      $sql = ("SELECT parroquia from parroquias WHERE idparroquia='".$idparroquia."';");
      $obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
      $parroquia=$arr[0];

   $calleav= $arrdatos['calleav'];
   $casaedif= ''; //$arrdatos['casaedif'];
   $piso= ''; //$arrdatos['piso'];
   $urbanizacion=''; // $arrdatos['urbanizacion'];
   $codpostal= ''; //$arrdatos['codpostal'];
   $dirnovzla= $arrdatos['dirnovzla'];
   $codpostalnovzla= $arrdatos['codpostalnovzla'];
   $estatus= $arrdatos['estatus'];

}

if (isset($_POST['submit'])) {
   //datos 

   $idpaci    = $_POST['idpaci'];
   $apellido1 = $_POST['apellido1'];
   $apellido2 = $_POST['apellido2'];
   $nombre1   = $_POST['nombre1'];
   $nombre2   = $_POST['nombre2'];

   $tpdoc  = $_POST['tpdoc'];
   $cedula = $tpdoc.''.$_POST['cedula'];

   $fnacimiento = $_POST['fnacimiento'];
   $edad        = $_POST['edad'];
   $idsexo      = $_POST['idsexo'];

   
   $operadora = ''; //$_POST['operadora'];
   $movil     = $_POST['movil'];
   $correo    = $_POST['correo'];

   $idpais = $_POST['idpais'];
   $idestado = $_POST['idestado'];
   $idmunicipio = $_POST['idmunicipio'];
   $idparroquia = $_POST['idparroquia'];

   $urbanizacion = ''; //$_POST['urbanizacion'];
   $calleav = $_POST['calleav'];
   $casaedif = ''; //$_POST['casaedif'];
   $piso = ''; //$_POST['piso'];
   $codpostal = ''; //= $_POST['codpostal'];

   if (isset($_POST['dirnovzla'])) {$dirnovzla=$_POST['dirnovzla'];} else{$dirnovzla='N/A';}
   if (isset($_POST['codpostalnovzla'])) {$codpostalnovzla=$_POST['codpostalnovzla'];} else{$codpostalnovzla='N/A';}

   $str="UPDATE pacientes SET apellido1='".strtoupper($apellido1)."',apellido2='".strtoupper($apellido2)."',nombre1='".$nombre1."',nombre2='".$nombre2."',cedula='".$cedula."',fnacimiento='".$fnacimiento."',edad='".$edad."',idsexo='".$idsexo."',correo='".strtolower($correo)."', operadora='".$operadora."', movil='".$movil."', idpais='".$idpais."',idestado='".$idestado."',idmunicipio='".$idmunicipio."',idparroquia='".$idparroquia."', calleav='".strtoupper($calleav)."',casaedif='".strtoupper($casaedif)."',piso='".strtoupper($piso)."',urbanizacion='".strtoupper($urbanizacion)."',codpostal='".$codpostal."', dirnovzla ='".$dirnovzla."', 
           codpostalnovzla ='".$codpostalnovzla."'  WHERE idpaci='".$idpaci."'";
       //echo $str;exit();
   $conexion=$mysqli->query($str);
   echo '<script language="javascript">alert("¡Actualizacion Exitosa!");
                                       window.location.href="rpt_pacxmed.php"; </script>';
   //echo '<script language="javascript">alert("¡Actualizacion Exitosa!"); window.location.href="regcitapac.php?idpc='.$idpaci.'"; </script>';   
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
            //$("#div-urbaniza").hide();
            $("#div-caav").hide();
            //$("#div-caed").hide();
            //$("#div-piso").hide();
            //$("#div-codpos").hide();
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
               
               //$("#urbanizacion").val('');
               $("#calleav").val('');
               //$("#casaedif").val('');
               //$("#piso").val('');
               //$("#codpostal").val('');

               //$("#div-urbaniza").hide();
               $("#div-caav").hide();
               //$("#div-caed").hide();
               //$("#div-piso").hide();
               //$("#div-codpos").hide();

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

               //$("#div-urbaniza").show();
               $("#div-caav").show();
               //$("#div-caed").show();
               //$("#div-piso").show();
               //$("#div-codpos").show();
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
               if (edad < 9 || edad > 90 || isNaN(edad)) {
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
                     <input type="hidden" id="idpaci" name="idpaci" value="<?php echo $idpaci;?>">
                     <div class="row">
                        <!-- 1ra -->
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="apellido1">1er Apellido:</label>
                              <input type="text" name="apellido1" id="apellido1" style="text-transform:uppercase;" onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;" required class="form-control form-control-sm " required 
                              value="<?php echo $apellido1; ?>">
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="apellido2">2do Apellido: </label>
                              <input type="text" name="apellido2" id="apellido2" style="text-transform:uppercase;" onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;" class="form-control form-control-sm" 
                              value="<?php echo $apellido2;?>">
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="nombre1">1er Nombre: </label>
                              <input type="text" name="nombre1" id="nombre1" style="text-transform:uppercase;" onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;" required class="form-control form-control-sm " required 
                              value="<?php echo $nombre1;?>">
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="mombre2">2do Nombre: </label>
                              <input type="text" name="nombre2" id="nombre2" style="text-transform:uppercase;" onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;" class="form-control form-control-sm" 
                              value="<?php echo $nombre2;?>">
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="fnacimiento">Fec.Nacimiento:</label>
                              <input type="date" name="fnacimiento" id="fnacimiento" class="form-control form-control-sm " onchange="calcedad(this.value)" 
                                 value="<?php echo $fnacimiento;?>">
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="edad">Edad:</label>
                              <input type="text" name="edad" id="edad" class="form-control form-control-sm " 
                                     value="<?php echo $edad;?>" readonly>
                           </div>
                        </div>
                        <!-- 2da  -->
                        <div class="col-md-1">
                           <div class="form-group">
                              <label for="tpdoc">Cédula:</label>
                              <select class="form-control form-control-sm " id="tpdoc" name="tpdoc" >
                                 <option value="<?php echo substr($cedula, 0,1);?>"><?php echo substr($cedula, 0,1); ?></option>
                                 <option value="V">V</option>
                                 <option value="E">E</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="cedula" style="visibility:hidden ;">.</label>
                              <input type="text" name="cedula" id="cedula"  minlength="7" maxlength="8" value="<?php echo substr($cedula, 1); ?>" class="form-control form-control-sm" 
                               onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;">
                           </div>
                        </div>                           
                        <div class="col-md-2">
                        <div class="form-group">
                           <label for="idsexo">Sexo:</label>
                           <select id="idsexo" class="form-control  form-control-sm" name="idsexo" required>
                              <option value="<?php echo $idsexo ?>"><?php echo substr($sexo, 0,9); ?></option>
                              <?php
                              //require('admin/conexion.php');
                              $query = $mysqli -> query ("select idsexo, sexo from sexo WHERE idestatus='1'; ");
                              while ($valores = mysqli_fetch_array($query)) {
                              echo '<option value="'.$valores['idsexo'].'">'.substr($valores['sexo'], 0,9).'</option>';
                           } ?>
                           
                           </select>
                        </div>
                        </div>
                        
                        <!-- 3ra -->
                        <!--
                        <div class="col-md-1">
                           <div class="form-group">
                              <label for="operadora">Móvil:</label>
                              <select class="form-control form-control-sm" id="operadora" name="operadora">
                                 <option value="< ?php echo $operadora;?>">< ?php echo $operadora;?></option>
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
                              <!--label for="movil" style="visibility: hidden;">.</label-->
                              <label for="movil">Móvil:</label>
                              <input type="text" name="movil" id="movil" maxlength="11" minlength="7" class="form-control form-control-sm" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required 
                                 value="<?php echo $movil;?>">
                           </div>
                        </div> 
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="correo">Correo:</label>
                              <input type="email" name="correo" id="correo" class="form-control form-control-sm" required value="<?php echo $correo;?>">
                           </div>
                        </div>
                        <!-- 4ta -->

                        <!-- Pais / Estado / Municipio / Parroquia -->
                        <div class="col-md-3">
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
                        <div id="div-dirnovzla" class="col-md-8">
                           <div class="form-group">
                              <label for="dirnovzla">Dirección:</label>
                              <input type="text" name="dirnovzla" id="dirnovzla" class="form-control form-control-sm " style="text-transform:uppercase;"  value="<?php echo $dirnovzla;?>">
                           </div>
                        </div>
                        <div id="div-codposnovzla" class="col-md-1">
                           <div class="form-group">
                              <label for="codpostalnovzla">Cod.Postal:</label>
                              <input type="text" maxlength="5" minlength="5" name="codpostalnovzla" id="codpostalnovzla" class="form-control form-control-sm "  value="<?php echo $codpostalnovzla;?>">
                           </div>
                        </div>
                        <!-- -->
                        <div id="div-estado" class="col-md-3">
                           <div class="form-group">
                              <label for="correo">Estado:</label>
                              <select id="id_estado" class="form-control form-control-sm" name="idestado">
                                    <option value="<?php echo $idestado;?>"><?php echo $estado;?></option>
                              </select>
                              <!--span class="help-block" data-valmsg-for="mtitu" data-valmsg-replace="true"></span-->
                           </div>
                        </div>
                        <div id="div-municipio" class="col-md-3">
                           <div class="form-group">
                              <label for="correo">Municipio:</label>
                              <select id="id_municipio" class="form-control form-control-sm" name="idmunicipio" >
                                    <option value="<?php echo $idmunicipio;?>"><?php echo $municipio;?></option>
                              </select>
                              <!--span class="help-block" data-valmsg-for="mtitu" data-valmsg-replace="true"></span-->
                           </div>
                        </div>
                        <div  id="div-parroquia" class="col-md-3">
                           <div class="form-group">
                              <label for="correo">Parroquia:</label>
                              <select id="id_parroquia" class="form-control form-control-sm " name="idparroquia" >
                                    <option value="<?php echo $idparroquia;?>"><?php echo $parroquia;?></option>
                              </select>
                              <!--span class="help-block" data-valmsg-for="mtitu" data-valmsg-replace="true"></span-->
                           </div>
                        </div>
                        <!-- 7ta  -->
                        <!--
                        <div id="div-urbaniza" class="col-md-4">
                           <div class="form-group">
                              <label for="urbanizacion">Urbanización:</label>
                              <input type="text" name="urbanizacion" id="urbanizacion" style="text-transform:uppercase;" class=" form-control form-control-sm" 
                                 value="< ?php echo $urbanizacion;?>">
                           </div>
                        </div>
                        -->
                        <div id="div-caav" class="col-md-12">
                           <div class="form-group">
                              <label for="calleav">Dirección:</label>
                              <input type="text" name="calleav" style="text-transform:uppercase;" id="calleav" style="text-transform:uppercase;" class="form-control form-control-sm "  
                                 value="<?php echo $calleav;?>">
                           </div>
                        </div>
                        <!--
                        <div id="div-caed" class="col-md-3">
                           <div class="form-group">
                              <label for="casaedif">Casa/Edif.:</label>
                              <input type="text" maxlength="88" name="casaedif" id="casaedif" style="text-transform:uppercase;" class="form-control form-control-sm "
                                 value="< ?php echo $casaedif;?>">
                           </div>
                        </div>
                        <div id="div-piso" class="col-md-1">
                           <div class="form-group">
                              <label for="piso">Piso:</label>
                              <input type="text" maxlength="2" name="piso" id="piso" class="form-control form-control-sm " value="< ?php echo $piso;?>">
                           </div>
                        </div>

                        <div id="div-codpos" class="col-md-1">
                           <div class="form-group">
                              <label for="codpostal">Cod.Postal:</label>
                              <input type="text" maxlength="4" minlength="4" name="codpostal" id="codpostal" class="form-control form-control-sm "  
                                 value="< ?php echo $codpostal;?>">
                           </div>
                        </div>
                        -->
                        <!-- 8va  -->
                        <div align="right" class="col-md-12">
                           <input style="background: #F89921;border-color: #F89921" type="submit" name="submit" value="Actualizar" class="btn btn-main btn-primary btn-lg uppercase">
                        </div>
                  </form>
                  <!-- /.card-body -->
               </div>
               <!-- /.card -->
            </div>
      </div>
      <div class="row">
         <div align="center" class="col-12">
            <a href="rpt_pacxmed.php" class="btn btn-secondary">Atrás</a>
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