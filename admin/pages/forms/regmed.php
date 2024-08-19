<?php
session_start();
$usuario = $_SESSION['usuario'];
require('../../conexion.php');
if (isset($_POST['submit'])) {
   //datos 

   $apellido1 = strtoupper($_POST['apellido1']);
   $apellido2 = strtoupper($_POST['apellido2']);
   $nombre1 = strtoupper($_POST['nombre1']);
   $nombre2 = strtoupper($_POST['nombre2']);

   $rif = $_POST['tprif'] . $_POST['rif'];
   $nrodoc = $_POST['tpdoc'] . $_POST['nrodoc'];

   $fnacimiento = $_POST['fnacimiento'];
   $edad = $_POST['edad'];
   $idsexo = $_POST['idsexo'];
   $idestcivil = $_POST['idestcivil'];


   $movil = $_POST['movil'];
   $telefono = $_POST['telefono'];
   $correo = $_POST['correo'];
   $correoalt = $_POST['correoalt'];

   $idpais = $_POST['idpais'];
   $idestado = $_POST['idestado'];
   $idmunicipio = $_POST['idmunicipio'];
   $idparroquia = $_POST['idparroquia'];

   $correoppal = ''; // OJOOOOOO Por Aclarar

   $urbanizacion = strtoupper($_POST['urbanizacion']);
   $calleav = strtoupper($_POST['calleav']);
   $casaedif = $_POST['casaedif'];
   $piso = $_POST['piso'];
   $oficina = $_POST['oficina'];
   $codpostal = $_POST['codpostal'];
   /* Inserto en Login para luego leer el idlogin */
   $str = "INSERT INTO loginn (idlogin, correo, cargo, clave, privilegios, estatus) 
   VALUES (NULL, '" . $correo . "', 'Medico', '123','2', 'A' );";
   $conexion = $mysqli->query($str);

   $sqllast = ("SELECT max(idlogin) from loginn;");
   $objlast = $mysqli->query($sqllast);
   $arrlast = $objlast->fetch_array();
   $idlogin = $arrlast[0];
   /* Fin */

   $str = "INSERT INTO medicos (idmed, idlogin, idcomp, nrodoc, rif, nombre1, nombre2, apellido1, apellido2, fnacimiento, edad, idsexo, idestcivil, movil, telefono, correo, correoalt, idpais, idestado, idmunicipio, idparroquia, correoppal, calleav, casaedif, piso, oficina, urbanizacion, codpostal, idestatus)
    VALUES (NULL, '" . $idlogin . "','99', '" . $nrodoc . "','" . $rif . "', '" . $nombre1 . "', '" . $nombre2 . "', '" . $apellido1 . "', '" . $apellido2 . "', '" . $fnacimiento . "', '" . $edad . "', '" . $idsexo . "', '" . $idestcivil . "', '" . $movil . "','" . $telefono . "', '" . $correo . "', '" . $correoalt . "', 
    '" . $idpais . "', '" . $idestado . "', '" . $idmunicipio . "', '" . $idparroquia . "', '" . $correoppal . "', '" . $calleav . "', '" . $casaedif . "', '" . $piso . "', '" . $oficina . "', '" . $urbanizacion . "', '" . $codpostal . "', '3');";

   $conexion = $mysqli->query($str);
   echo '<script language="javascript">alert("¡Registro Exitoso!");window.location.href="rpt_med.php"; </script>';
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
      $(document).ready(function() {
         $("#idpais").change(function() {
            if($("#idpais").val()=='232'){
               document.getElementById("id_estado").disabled = false;
               document.getElementById("id_municipio").disabled = false;
               document.getElementById("id_parroquia").disabled = false;
            }else{
               document.getElementById("id_estado").value = '';
               document.getElementById("id_municipio").value = '';
               document.getElementById("id_parroquia").value = '';
               document.getElementById("id_estado").disabled = true;
               document.getElementById("id_municipio").disabled = true;
               document.getElementById("id_parroquia").disabled = true;
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
      /* - - - - - - - - - - */
      function valdoc(quees,nro){
		
		if (quees=='1') {
			
			var tprif=document.getElementById("tprif").value;
			var nro=tprif+nro;
		}else if (quees=='2') {
			
			var tpdoc=document.getElementById("tpdoc").value;
			var nro=tpdoc+nro;
		}
		
		jQuery.ajax({
         type: "POST",  
         url: "valnro_js.php",
         data: {quees: quees, nro: nro, nroriginal: '99'},
         success:function(data){
        	console.log(data);
         	hay = parseInt(data);
         	if (hay!=0) {
         		Swal.fire({
  				icon: 'error',
  				title: 'Nro Ya Registrado'
				});
				if (quees=='1') {
					document.getElementById("rif").focus();
					document.getElementById("rif").value='';
				}else if (quees=='2') {
					document.getElementById("nrodoc").focus();
					document.getElementById("nrodoc").value='';
				}

         	}
         },
          error:function (){}
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
                     <h1>Medicos</h1>
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
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="apellido1">1er Apellido </label>
                              <input type="text" name="apellido1" id="apellido1" class="form-control form-control-sm" style="text-transform:uppercase;" onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;" required>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="apellido2">2do Apellido </label>
                              <input type="text" name="apellido2" id="apellido2" style="text-transform:uppercase;" onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;" class="form-control form-control-sm ">
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="nombre1">1er Nombre </label>
                              <input type="text" name="nombre1" id="nombre1" style="text-transform:uppercase;" onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;" class="form-control form-control-sm " required>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="mombre2">2do Nombre </label>
                              <input type="text" name="nombre2" id="nombre2" style="text-transform:uppercase;" onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;" class="form-control form-control-sm ">
                           </div>
                        </div>

                        <!-- 2da  -->
                        <div class="col-md-1">
                           <div class="form-group">
                              <label for="rif">RIF:</label>
                              <select class="form-control form-control-sm" id="tprif" name="tprif">
                                 <option value="V">V</option>
                                 <option value="J">J</option>
                                 <option value="E">E</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <label for="rif" style="visibility:hidden ;">.</label>
                           <div class="form-group">
                              <input type="text" name="rif" id="rif" minlength="9" maxlength="9"  onblur="valdoc('1',this.value)"
                              onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" class="form-control form-control-sm " required>
                           </div>
                        </div>
                        <div class="col-md-1">
                           <div class="form-group">
                              <label for="tpdoc" style="visibility:hidden ;">.</label>
                              <select class="form-control form-control-sm " id="tpdoc" name="tpdoc">
                                 <option value="V">V</option>
                                 <option value="E">E</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="nrodoc">Nro. Documento:</label>
                              <input type="text" name="nrodoc" id="nrodoc" minlength="6" maxlength="8" onblur="valdoc('2',this.value)"
                              onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" class="form-control form-control-sm " required>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="fnacimiento">Fec.Nacimiento:</label>
                              <input type="date" name="fnacimiento" id="fnacimiento" class="form-control form-control-sm " onchange="calcedad(this.value)">
                           </div>
                        </div>
                        <div class="col-md-1">
                           <div class="form-group">
                              <label for="edad">Edad:</label>
                              <input type="text" name="edad" id="edad" class="form-control form-control-sm " readonly>
                           </div>
                        </div>
                        <div class="col-md-1">
                           <div class="form-group">
                              <label for="idsexo">Sexo:</label>
                              <select id="idsexo" class="form-control form-control-sm" name="idsexo" required>
                                 <option value="">Selec.</option>
                                 <?php
                                 //require('admin/conexion.php');
                                 $query = $mysqli->query("select idsexo, sexo from sexo WHERE idestatus='1'; ");
                                 while ($valores = mysqli_fetch_array($query)) {
                                    echo '<option value="' . $valores['idsexo'] . '">' . $valores['sexo'] . '</option>';
                                 } ?>

                              </select>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="idestcivil">Est.Civil:</label>
                              <select id="idestcivil" class="form-control form-control-sm" name="idestcivil" required>
                                 <option value="">-- Seleccione --</option>
                                 <?php
                                 //require('admin/conexion.php');
                                 $query = $mysqli->query("select idestcivil, estcivil from estadocivil WHERE idestatus='1'; ");
                                 while ($valores = mysqli_fetch_array($query)) {
                                    echo '<option value="' . $valores['idestcivil'] . '">' . $valores['estcivil'] . '</option>';
                                 } ?>

                              </select>
                           </div>
                        </div>
                        <!-- 3ra -->
                        <!--//!el name operadora no esta en el insert REVISAR-->
                        <!--
                        <div class="col-md-1">
                           <div class="form-group">
                              <label for="movil">Movil:</label>
                              <select class="form-control form-control-sm" id="operadora" name="operadora">
                                 <option value="0412">0412</option>
                                 <option value="0414">0414</option>
                                 <option value="0424">0424</option>
                                 <option value="0414">0416</option>
                                 <option value="0424">0426</option>
                              </select>
                           </div>
                        </div>
                        -->
                        <div class="col-md-2">
                           <div class="form-group">
                              <!--label for="movil" style="visibility: hidden;">Movil</label-->
                              <label for="movil">Movil</label>
                              <input type="text" name="movil" id="movil" maxlength="11" minlength="11" class="form-control form-control-sm" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="telefono">Teléfono:</label>
                              <input type="text" name="telefono" id="telefono" minlength="11" maxlength="11" class="form-control form-control-sm" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;">
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="correo">Correo:</label>
                              <input type="email" name="correo" id="correo" onblur="valmail(this.value)" class="form-control form-control-sm " required>
                           </div>
                        </div>

                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="correoalt">Correo Alterno:</label>
                              <input type="email" name="correoalt" id="correoalt" class="form-control form-control-sm ">
                           </div>
                        </div>


                        <!-- 4ta -->

                        <!-- Pais / Estado / Municipio / Parroquia -->
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="idpais" class="control-label mb-1">País</label>
                              <select id="idpais" class="form-control form-control-sm " name="idpais" required>
                                 <option value="">-- Pais --</option>
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
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="id_estado" class="control-label mb-1">Estado</label>
                              <select id="id_estado" class="form-control form-control-sm " name="idestado" required>
                                 <option value="">-- Seleccione --</option>
                                 <!--	
              < ?php
              //require('admin/conexion.php');
              $query = $mysqli -> query ("select idestado, estado from estado");
              while ($valores = mysqli_fetch_array($query)) {
              echo '<option value="'.$valores['idestado'].'">'.$valores['estado'].'</option>';
            } ?>
            -->
                              </select>
                              <!--span class="help-block" data-valmsg-for="mtitu" data-valmsg-replace="true"></span-->
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="id_municipio" class="control-label mb-1">Municipio</label>
                              <select id="id_municipio" class="form-control form-control-sm " name="idmunicipio" required>
                                 <option value="">-- Municipio --</option>
                              </select>
                              <!--span class="help-block" data-valmsg-for="mtitu" data-valmsg-replace="true"></span-->
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="id_parroquia" class="control-label mb-1">Municipio</label>
                              <select id="id_parroquia" class="form-control form-control-sm " name="idparroquia" required>
                                 <option value="">-- Parroquia --</option>
                              </select>
                              <!--span class="help-block" data-valmsg-for="mtitu" data-valmsg-replace="true"></span-->
                           </div>
                        </div>
                        <!-- 7ta  -->
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="urbanizacion">Urbanización:</label>
                              <input type="text" name="urbanizacion" id="urbanizacion" class="form-control form-control-sm " style="text-transform:uppercase;" required>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="calleav">Calle/Avenida:</label>
                              <input type="text" name="calleav" id="calleav" style="text-transform:uppercase;" class="form-control form-control-sm " required>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="casaedif">Casa/Edif.:</label>
                              <input type="text" name="casaedif" id="casaedif" style="text-transform:uppercase;" class="form-control form-control-sm " required>
                           </div>
                        </div>
                        <div class="col-md-1">
                           <div class="form-group">
                              <label for="piso">Piso:</label>
                              <input type="text" name="piso" id="piso" maxlength="2" class="form-control form-control-sm " required>
                           </div>
                        </div>
                        <div class="col-md-1">
                           <div class="form-group">
                              <label for="oficina">Oficina:</label>
                              <input type="text" name="oficina" style="text-transform:uppercase;" id="oficina" maxlength="8" class="form-control form-control-sm " required>
                           </div>
                        </div>
                        <div class="col-md-1">
                           <div class="form-group">
                              <label for="codpostal">Cod.Postal:</label>
                              <input type="text" name="codpostal" id="codpostal" maxlength="4" minlength="4" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" class="form-control form-control-sm " required>
                           </div>
                        </div>

                        <!-- 8va  -->
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
            <a href="rpt_med.php" class="btn btn-secondary">Atrás</a>
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
         var edad = document.getElementById("edad").value;
         if (isNaN(edad) || edad=='' || edad=='0' ) {
            Swal.fire({icon: 'error',title: 'Edad' });
            document.getElementById("fnacimiento").value = '';
            document.getElementById("fnacimiento").focus();
            return false;
         }
      }
      function valmail(correo) {
         var nroriginal='99';
         

         jQuery.ajax({
         type: "POST",  
         url: "valnro_js.php",
         data: {quees: '3', nro: correo, nroriginal: nroriginal},
         success:function(data){
         console.log(data);
            hay = parseInt(data);
            if (hay!=0) {
               Swal.fire({
                  icon: 'error',
                  title: 'Correo Ya Registrado'
               });
               document.getElementById("correo").value = '';
            }
         },
          error:function (){}
        });
        
      }
   </script>

</body>

</html>