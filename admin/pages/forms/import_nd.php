<?php
include "database.php";
require('../../conexion.php');
include "class.upload.php";

if(isset($_FILES["datosexcel"])){
	$up = new Upload($_FILES["datosexcel"]);
	if($up->uploaded){
		$up->Process("./uploads/");
		if($up->processed){
            /// leer el archivo excel
            require_once 'PHPExcel/Classes/PHPExcel.php';
            $archivo = "uploads/".$up->file_dst_name;
            $inputFileType = PHPExcel_IOFactory::identify($archivo);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($archivo);
            $sheet = $objPHPExcel->getSheet(0); 
            $highestRow = $sheet->getHighestRow(); 
            $highestColumn = $sheet->getHighestColumn();
            $lei=0;$reg=0;$rec=0;$esta=0;$lnerr=1;
            for ($row = 2; $row <= $highestRow; $row++){ 
                $lei++;$lnerr++;
                $cedula = $sheet->getCell("A".$row)->getValue();
                $rif = $sheet->getCell("B".$row)->getValue();
                $apellido1 = strtoupper($sheet->getCell("C".$row)->getValue());
                $apellido2 = strtoupper($sheet->getCell("D".$row)->getValue());
                $nombre1 = strtoupper($sheet->getCell("E".$row)->getValue());
                $nombre2 = strtoupper($sheet->getCell("F".$row)->getValue());
                $correo = $sheet->getCell("G".$row)->getValue();
                $movil = $sheet->getCell("H".$row)->getValue();
                //echo $rif.'--'.$cedula; exit();
                /**/
                $nombres = $nombre1.' '.$nombre2; 
                $apellidos = $apellido1.' '.$apellido2;
                $fullname = $apellido1.' '.$nombre1;
                if ($cedula!='' && $rif!='' && $apellido1!='' && $nombre1!='' && $correo!='' && $movil!='') {
                    
                    $str="SELECT count(*) as hay FROM medicos WHERE nrodoc='".$cedula."';";
                    $objlast=$mysqli->query($str); $arrlast=$objlast->fetch_array();  
                    $estacedula=$arrlast[0];

                    $str="SELECT count(*) as hay FROM medicos WHERE correo='".$correo."';";
                    $objlast=$mysqli->query($str); $arrlast=$objlast->fetch_array();  
                    $estacorreo=$arrlast[0];

                    $str="SELECT count(*) as hay FROM medicos WHERE rif='".$rif."';";
                    $objlast=$mysqli->query($str); $arrlast=$objlast->fetch_array();  
                    $estarif=$arrlast[0];
                    
                    if ($estacedula=='0' && $estacorreo=='0' && $estarif=='0') { 
                      $reg++;
                      $str="INSERT INTO loginn (idlogin, nombres, apellidos, fullname, correo, cargo, cedula, clave, privilegios, estatus) 
                      VALUES (NULL, '".$nombres."','".$apellidos."','".$fullname."','".$correo."', 'Medico', '".$rif."','123','2', 'A' );";

                      $conexion=$mysqli->query($str);

                      $sqllast = ("SELECT max(idlogin) from loginn;");
                      $objlast=$mysqli->query($sqllast); $arrlast=$objlast->fetch_array();  
                      $idlogin=$arrlast[0];
                      
                      //$sql = "insert into person (no, name, lastname, address1, address2, email1, phone1, created_at) value ";
                      $sql = "insert into medicos (idmed, idlogin, nrodoc, rif, apellido1, apellido2, nombre1, nombre2, movil, correo, idestatus, fechahora_sist) value ";
                      $sql .= " (\"null\",\"$idlogin\",\"$cedula\",\"$rif\",\"$apellido1\",\"$apellido2\",\"$nombre1\",\"$nombre2\",\"$movil\",\"$correo\",\"1\", NOW())";
                      $con->query($sql);
                      //$conexion=$mysqli->query($str);
                      $fecinicio=date('Y-m-d'); $fecfinal= date("Y-m-d",strtotime($fecinicio."+ 6 month")); 

                      $sqllastmed = ("SELECT max(idmed) from medicos;");
                      $objlastmed=$mysqli->query($sqllastmed); $arrlastmed=$objlastmed->fetch_array();  
                      $idmed=$arrlastmed[0];
                      //       ojo    FALTA        ojo otra cosa, en el registro de pago no esta registrando el banco
                      $formapago='99';$conptopago='Carga Masiva';$bnco='99';$nroref='9999999999';$monto='70';$observacion='Carga Masiva';
                      $sql = "INSERT INTO regpagos(idpagos, idmed, formapago, conptopago, bnco, nroref, monto, fechabco, fecinicio, fecfinal, observacion, idestatus) ";
                      $sql .= " value (\"null\",\"$idmed\",\"$formapago\",\"$conptopago\",\"$bnco\",\"$nroref\",\"$monto\",\"$fecinicio\",\"$fecinicio\",\"$fecfinal\",\"$observacion\",\"1\")";

                      $con->query($sql);
                      
                    }else{
                      $lineaserr=$lnerr;
                    }
                }
            }  // end ciclo
    	unlink($archivo);
        } // Up-pro
    } // Upload
    $rec=$lei-$reg;
}
//echo "<script> window.location = './index.php'; </script>";
  //echo 'aquiii'.$sql; exit();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard | PayMed</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="../../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- -->
  <style type="text/css">
                  .tftable {
                    font-size: 12px;
                    color: #333333;
                    width: 50%;
                    border-width: 1px;
                    border-color: #729ea5;
                    border-collapse: collapse;
                  }

                  .tftable th {
                    font-size: 12px;
                    background-color: #acc8cc;
                    border-width: 1px;
                    padding: 8px;
                    border-style: solid;
                    border-color: #729ea5;
                    text-align: center;
                  }

                  .tftable tr {
                    background-color: #d4e3e5;
                  }

                  .tftable td {
                    font-size: 12px;
                    border-width: 1px;
                    padding: 8px;
                    border-style: solid;
                    border-color: #729ea5;
                  }

                  .tftable tr:hover {
                    background-color: #ffffff;
                  }
  </style>
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <!-- Main Sidebar Container -->
 <!-- -->
<?php include("menuppal.php"); ?>
<!-- -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Carga Lote</h1>
          </div>
          <div class="col-sm-6">  
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../../index.php?usr=1">Home</a></li>
              <li class="breadcrumb-item active">Carga Medicos</li>
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
              <h3 class="card-title">Resumen de Carga</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
                <div class="col-md-12" align="center">
                  <br>
                  <table class="tftable" border="1">
                      <tr>
                        <th><h1>Procesados</h1></th>
                        <th align="right"><h1><?php echo $lei; ?></h1></th>
                      </tr>
                      <tr>
                        <th><h1>Registrados</h1></th>
                        <th align="center"><h1><?php echo $reg; ?></h1></th>
                      </tr>
                      <tr>
                        <th><h1>Rechazados</h1></th>
                        <th align="center"><h1><?php echo $rec; ?></h1></th>
                      </tr>
                       <tr>
                        <th><h1>Linea Error</h1></th>
                        <th align="center"><h1><?php echo $lineaserr; ?></h1></th>
                      </tr>
                  </table>
                </div>
            <!-- /.card-body -->
          </div>
          <div class="row">
        <div align="center" class="col-12">
          <a href="../../index.php?usr=1" class="btn btn-secondary">Atras</a>
        </div>
      </div>
          <!-- /.card -->
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
<!-- jquery-validation new -->
<script src="../../plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../../plugins/jquery-validation/additional-methods.min.js"></script>
<!-- Select2 -->
<script src="../../plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="../../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="../../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="../../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
</body>
</html>
