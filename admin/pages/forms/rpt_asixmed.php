<?php
session_start();
date_default_timezone_set('America/Caracas');
$usuario = $_SESSION['usuario'];
$idlogin = $_SESSION['idlogin'];

require('../../conexion.php');
$fechahoy=date('Y-m-d');
//$dia=date('d'); $mes=date('m'); $ano=date('Y'); echo $fechahoy; 

/*
$sqlmed = ("SELECT idmed FROM medicos WHERE correo='".$usuario."'");
$arrmed = $mysqli->query($sqlmed);
$rowmed = mysqli_fetch_array($arrmed);
$idmed =$rowmed['idmed'];*/
// 
//$sql = ("SELECT idlogin, fullname, cedula, correo, usuario, telefono, movil, cargo, nombrecargo FROM loginn WHERE trabajacon='".$usuario."' AND privilegios='7'; ");
//$sql = ("SELECT a.idlogin, b.idasist, b.apellidos, b.nombres, b.nrodoc, b.correo,  b.movil, b.cargo, b.tpasist
//        FROM medicos a, asistentes b, medicosxasist c 
//        WHERE a.idmed=c.idmed and b.idasist=c.idasist and a.idlogin='".$idlogin."';");
$sql="SELECT a.idlogin, b.idlogin as idloginAsist, b.idasist, b.apellidos, b.nombres, b.nrodoc, b.correo,  b.movil, b.cargo, b.tpasist, concat(a.apellido1,' ',a.nombre1) as nombremedico
        FROM medicos a, asistentes b, medicosxasist c 
        WHERE a.idmed=c.idmed 
        and b.idasist=c.idasist
        ORDER by 1;";

$result = $mysqli->query($sql);
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
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Sweetalert  -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        .buttonr {
            background-color: #F89921;
            /* Orange */
            border: #F89921;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 5px 2px;
            cursor: pointer;
            border-radius: 2px;
        }

        .btns {
            border: none;
            background-color: #F89921;
            color: #FFF;
            border-radius: 3px;
            padding: 10px;
            margin: 0 10px 15px 10px;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

        <!--  -->
        <?php include("menuppal.php"); ?>
        <!-- -->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Listado Asistentes Por Médico</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../../index.php?usr=1">Home</a></li>
                                <li class="breadcrumb-item active">Asistentes</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <!-- FILTRO  -->
                <!--
                <div class="cotainer" style="display: flex;">
                    <label>Filtro Citas </label>
                    <button class="fa fa-filter btns" onclick="view()"></button>
                </div>
                
                <div style="visibility:visible;">
                    <form action="< ?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                        <table class="table table-striped projects" id="windows">
                            <thead>
                                <tr>
                                    <th style="width:15% ;">Fecha inicio</th>
                                    <th style="width:15% ;">Fecha fin </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> <input type="date" min="2022-01-01"  class="form-control" name="f1"> </td>
                                    <td> <input type="date" min="2022-01-01" class="form-control" name="f2"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div align="right" id="btns">
                            <input value="Buscar" class="btns" type="submit" name="submit">
                            <input value="Restablecer" class="btn btn-primary" type="submit" name="cancel">
                        </div>
                    </form>
                </div>  -->
                <!--
                <div align="center" class="col-md-12">
                    <form action="regasist.php">
                        <input style="background: #F89921;border-color: #F89921" type="submit" name="submit" value="Añadir" class="btn btn-main btn-primary btn-lg uppercase">
                    </form>
                </div><br>
                -->
                <!-- Default box -->
                <div class="card">
                    <div style="background: #F89921" class="card-header">
                        <h3 class="card-title">Listado Asistentes Por Médico</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                            <!--button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fas fa-times"></i></button-->
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped projects">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>C.I</th>
                                    <th>Correo</th>
                                    <th>Telefono</th>
                                    <th>Cargo</th>
                                    <th>Nivel</th>
                                    <th>Médico</th>
                                    <!--th class="text-center">Telefono</th-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php  $hoy = strtotime(date('Y-m-d'));
                                       //echo $startDate; echo $currentDate;exit();
                                while ($row = mysqli_fetch_array($result)) {
                                    /*
                                    $sqlclin = ("SELECT nombrecentrosalud FROM clinicas WHERE idclinica='".$idclinica."'");
                                    $arrclin = $mysqli->query($sqlclin);
                                    $rowclin = mysqli_fetch_array($arrclin);
                                    $nombrecentrosalud =$rowclin[0];*/
                                    ?>
                                    <tr>
                                        <!--td class="project_progress">< ?php echo $row['nombres'] . " " . $row['apellidos']; ?></td-->
                                        <td class="project_progress"><?php echo $row['apellidos'].' '.$row['nombres']; ?></td>
                                        <td class="project_progress"><?php echo $row['nrodoc']; ?></td>
                                        <td class="project_progress"><?php echo $row['correo']; ?></td>
                                        <td class="project_progress"><?php echo $row['movil']; ?></td>
                                        <td class="project_progress"><?php echo $row['cargo']; ?></td>
                                        <td class="project_progress"><?php echo substr($row['tpasist'],-1); ?></td>
                                        <td class="project_progress"><strong><?php echo $row['nombremedico']; ?></strong></td>
                                        <!--
                                        <td class="project-actions text-right">
                                           <a class="btn btn-primary btn-sm" href="updasist.php?gp1=< ?php echo $row['idasist']; ?>">
                                           <i class="fa fa-edit"></i></a>
                                           <a class="btn btn-danger btn-sm" href="src_del_asist.php?xy=< ?php echo $row['idasist']; ?>"><i class="fas fa-trash"></i> </a>
                                        </td>
                                        -->
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <div align="center" class="col-md-12">
                    <a class="btn btn-danger btn-sm" href="../../index.php?usr=1"><i class="fas fa-backward"></i> Regresar</a>
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
    <!-- ND jQuery -->
    <script src="js/scripts.js"></script>
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
    <!-- Page script -->
    
    <script type="text/javascript">
	/* viene de Pag validation.html */
        $(document).ready(function() {
            //alert();
        });
    </script>
</body>

</html>