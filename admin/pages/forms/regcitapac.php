<?php  // no registra el id del modico seleccionado, registra idmed del primer medico del asistente
session_start();
$usuario = $_SESSION['usuario'];
$cargo   = $_SESSION['cargo'];
require('../../conexion.php');
/*leo variables de session */
$fechacita = $_SESSION['sefechacita'];
// Formateo Fecha de Cita d-m-A;
$fechacitamostrar = date("d-m-Y", strtotime($fechacita));
$horacita  = $_SESSION['sehoracita'];
$idclinica = $_SESSION['seidclinica'];
//echo $fechacita.'/'.$horacita.'/'.$idclinica;

$idpc = $_GET['idpc'];

$sqlidp = ("SELECT idpaci, idlogin, nombre1, apellido1, movil, correo 
            FROM pacientes WHERE idpaci='".$idpc."'");
            $objidp = $mysqli->query($sqlidp); $arridp = $objidp->fetch_array();
               $idpaci = $arridp['idpaci'];
               $nom    = $arridp['nombre1'];
               $ape    = $arridp['apellido1'];
               $mol    = $arridp['movil'];
               $cor    = $arridp['correo'];
               $nbpaci = $arridp['nombre1'].' '.$arridp['apellido1'];
               //$hipaci = 'HIST-00-'.$arridp['idlogin'];
               $hipaci = 'S/A';
if ($cargo=='Asistente1' || $cargo=='Asistente2') {
   // busco idtrabajacon en loginn para poder vincular con idmed
   $sqlasist = ("SELECT idlogin, idtrabajacon FROM loginn WHERE correo='".$usuario."'");
   $objasist = $mysqli->query($sqlasist); $arrasist = $objasist->fetch_array();
   $idregistrador = $arrasist['idlogin'];       // Leo el idlogin del Asistente para registrarlo en la cita
   $idtrabajacon = $arrasist['idtrabajacon'];   // Leo el idlogin del Medico para quien trabaja
   // Si esta seteada la session, es el idlogin del medico seleccionado para el asistente logeado
   if (isset($_SESSION['idloginmed'])) {$idlogin_session = $_SESSION['idloginmed'];}else{$idlogin_session = $_SESSION['idlogin'];}
   // busco idmed para llenar input hidden y leer nombre del medico
   // Antes $sqlmed = ("SELECT idmed, nombre1, apellido1 FROM medicos WHERE idlogin='".$idtrabajacon."'");
   $sqlmed = ("SELECT idmed, nombre1, apellido1 FROM medicos WHERE idlogin='".$idlogin_session."'");
   $objmed = $mysqli->query($sqlmed); $arrmed = $objmed->fetch_array();
   $idmed = $arrmed['idmed'];
   $nbmedico = $arrmed['nombre1'].' '.$arrmed['apellido1'];
   //echo $idmed.'/'.$idtrabajacon.'/'.$idregistrador; exit();

}else if ($cargo=='Medico') {
   $sqlmed = ("SELECT idmed, nombre1, apellido1 FROM medicos WHERE correo='".$usuario."'");
   $objmed = $mysqli->query($sqlmed); $arrmed = $objmed->fetch_array();
   $idmed = $arrmed['idmed'];
   $nbmedico = $arrmed['nombre1'].' '.$arrmed['apellido1'];
}


if (isset($_POST['submit'])) {
   //datos 
   $idregistrador=$_POST['idregistrador'];
   $fechasoli = date('Y-m-d');
   $idmed     = $_POST['idmed'];
   $idpaci    = $_POST['idpaci'];
   $historia  = $_POST['historia'];
   $idaseg    = $_POST['idaseg'];
   $idservaf  = $_POST['idservaf'];
   $caracter  = $_POST['caracter'];
   $motivo    = $_POST['motivo'];
   //-----------$fecha     = $_POST['fecha'];
   $nom       = $_POST['nom'];
   $ape       = $_POST['ape'];
   $mol       = $_POST['mol'];
   $cor       = $_POST['cor'];
   /* Sumo cantidad de servicios que hs asistido */
   $sqlcount="SELECT count(*) as nroservi FROM citas WHERE idpaci='".$idpaci."' AND idservaf='".$idservaf."';  ";
   //echo $sqlcount;
   $objcount = $mysqli->query($sqlcount); 
   $arrcount = $objcount->fetch_array();
   $nroservi = $arrcount[0]+1;
   //echo $nroservi;exit();

   $str = "INSERT INTO citas (idpaci, historia, fechacita, horacita, fechasoli, nombre, apellido, telefono, correo, importancia, motivo, idaseg, idclinica, idmed, idregistrador, idservaf, nroservi, idestatus) 
            VALUES ('".$idpaci."','".$historia."','".$fechacita."','".$horacita."','".$fechasoli."','".strtoupper($nom)."','".strtoupper($ape)."','".$mol."','".$cor."','".$caracter."','".strtoupper($motivo)."','".$idaseg."','".$idclinica."','".$idmed."','".$idregistrador."','".$idservaf."', '".$nroservi."','3')";

            //VALUES ('".$idpaci."','".$historia."','".substr($fecha, 0,10)."','".substr($fecha, 12,5)."','".strtoupper($nom)."','".strtoupper($ape)."','".$mol."','".$cor."','".$caracter."','".strtoupper($motivo)."','".$idaseg."','".$idmed."','".$tcita."','3')";
  
   $conexion = $mysqli->query($str);
   /* ....Envio Correo al Paciente Con Datos Citas.... */
   $sqlcita="SELECT MAX(idcita) FROM citas WHERE idpaci='".$idpaci."'; ";
   
   $objcita = $mysqli->query($sqlcita); 
   $arrcita = $objcita->fetch_array();
   $idcita = $arrcita[0];
   require("sendcita.php");

   echo '<script language="javascript">alert("¡Registro Exitoso!");
         window.location.href="rpt_citas.php"; </script>'; 
} ?>
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
                     <h1>Pacientes (Cita)</h1>
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
                  <h3 class="card-title">Registro de Cita</h3>

                  <div class="card-tools">
                     <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                  </div>
               </div>
               <div class="card-body">
                  <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return validacion()">
                     <div class="row">
                        <!-- antes de 1ra -->
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="idmedico">Médico: </label>
                              <input type="text" style="text-transform:uppercase;" 
                                     value="<?php echo $nbmedico;?>" 
                                     class="form-control form-control-sm " disabled>
                              <input type="hidden" name="idmed" value="<?php echo $idmed;?>">
                              <input type="hidden" name="idregistrador" value="<?php echo $idregistrador;?>">
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="idpaci">Paciente: </label>
                              <input type="text" style="text-transform:uppercase;" 
                                     value="<?php echo $nbpaci;?>" 
                                     class="form-control form-control-sm " disabled>
                              <input type="hidden" name="idpaci" value="<?php echo $idpaci;?>">
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="idmedico">#Historia: </label>
                              <input type="text" style="text-transform:uppercase;" 
                                     value="<?php echo $hipaci;?>" 
                                     class="form-control form-control-sm " disabled>
                              <input type="hidden" name="historia" value="<?php echo $hipaci;?>">
                              <input type="hidden" name="nom" value="<?php echo $nom;?>">
                              <input type="hidden" name="ape" value="<?php echo $ape;?>">
                              <input type="hidden" name="mol" value="<?php echo $mol;?>">
                              <input type="hidden" name="cor" value="<?php echo $cor;?>">
                              <input type="hidden" name="idclinica" value="<?php echo $idclinica;?>">
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="idaseg">Seguro:</label>
                              <select name="idaseg" id="idaseg" class="form-control form-control-sm" required>
                                 <option value="0">-- Seleccione --</option>
                                 <?php
                                 //require('admin/conexion.php');
                                 $query = $mysqli->query("SELECT idaseg, razsocial from aseguradores");
                                 while ($valores = mysqli_fetch_array($query)) {
                                    echo '<option value="' . $valores['idaseg'] . '">' . $valores['razsocial'] . '</option>';
                                 } ?>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="idservaf">Tipo de Cita:</label>
                              <select name="idservaf" id="idservaf" class="form-control form-control-sm" required>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="apellido1">Importancia:</label>
                              <select name="caracter" id="caracter" class="form-control form-control-sm" required>
                                 <option value="">-- Seleccione --</option>
                                 <?php
                                 //require('admin/conexion.php');
                                 $query = $mysqli->query("SELECT importancia from importancia");
                                 while ($valores = mysqli_fetch_array($query)) {
                                    echo '<option value="'.$valores['importancia'].'">'.$valores['importancia'].'</option>';
                                 } ?>
                              </select>
                           </div>
                        </div> 
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="apellido1">Motivo de Consulta:</label>
                              <textarea class="form-control form-control-sm" name="motivo" style="text-transform:uppercase;" n></textarea>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="fecha">Fecha:</label>
                              <input type="text" class="form-control" id="fecha" name="fecha" value="<?php echo $fechacitamostrar; ?>" disabled> 
                           </div>
                        </div>

                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="horacita">Hora:</label>
                              <input type="text" class="form-control" id="horacita" name="horacita" value="<?php echo $horacita; ?>" disabled>
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
            <a href="rpt_citas.php" class="btn btn-secondary">Atrás</a>
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
   <!-- DS -->
   <script src="js/ds.js"></script>
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