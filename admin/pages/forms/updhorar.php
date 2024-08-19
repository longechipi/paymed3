<?php
    session_start();
    require('../../conexion.php');
    $usuario=$_SESSION['usuario'];
    $idlogin=$_SESSION['idlogin'];
    if (isset($_GET['id'])) {
        $idclinica=$_GET['id'];
        $idhorario=$_GET['c'];
    }else{}
    /* Busco Nombre de Clinica */
    $sql = ("SELECT nombrecentrosalud from clinicas WHERE idclinica='".$idclinica."';");
            $obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
            $nombreclinica=$arr[0];
    /* Busco Encabezado Del Horario */
    $sql = ("SELECT b.idmedcli, b.idclinica, b.idmed, b.pacxdia, b.pacconseg, b.pacsinseg, b.consultorio, b.piso, b.telefono1, b.telefono2
            FROM medicos a, clinicamedico b WHERE a.idmed = b.idmed AND b.idclinica = '".$idclinica."' AND a.idlogin = '".$idlogin."';");

            $obje=$mysqli->query($sql); $arra=$obje->fetch_array();  
            $idmed=$arra['idmed'];
            $pacxdia=$arra['pacxdia'];
            $pacconseg=$arra['pacconseg'];
            $pacsinseg=$arra['pacsinseg'];
            $consultorio=$arra['consultorio'];
            $piso=$arra['piso'];
            $telefono1=$arra['telefono1'];
            $telefono2=$arra['telefono2'];
    /* Busco Horario */
    $sql = ("SELECT a.idhorario, a.idmedcli, a.idclinica, a.idmed, a.dia, a.desde, a.hasta 
            FROM horariomed a, medicos b WHERE a.idmed=b.idmed AND a.idclinica = '".$idclinica."' AND b.idlogin = '".$idlogin."';");
    
    $objh=$mysqli->query($sql); 
    while ($row = mysqli_fetch_array($objh)) { 
        if ($row['dia']=='Lunes') {
            $dlunes=$row['desde'];
            $hlunes=$row['hasta'];
        }
        if ($row['dia']=='Martes') {
            $dmartes=$row['desde'];
            $hmartes=$row['hasta'];
        }
        if ($row['dia']=='Miercoles') {
            $dmiercoles=$row['desde'];
            $hmiercoles=$row['hasta'];
        }
        if ($row['dia']=='Jueves') {
            $djueves=$row['desde'];
            $hjueves=$row['hasta'];
        }
        if ($row['dia']=='Viernes') {
            $dviernes=$row['desde'];
            $hviernes=$row['hasta'];
        }
        if ($row['dia']=='Sabado') {
            $dsabado=$row['desde'];
            $hsabado=$row['hasta'];
        }
        if ($row['dia']=='Domingo') {
            $ddomingo=$row['desde'];
            $hdomingo=$row['hasta'];
        }
    }  // End While
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
    <!-- Sweet Alert  -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--CSS Table -->
    <link rel="stylesheet" href="css/Tablas2.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
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
            margin: 4px 2px;
            cursor: pointer;
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
                            <h1>Actualizando Horario: <?php echo $nombreclinica; ?></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../../index.php?usr=1">Home</a></li>
                                <li class="breadcrumb-item active">Horario</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="card">
                    <div style="background: #F89921" class="card-header">
                        <h3 class="card-title">Horario</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                            <!--button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fas fa-times"></i></button-->
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <form action="updhor.php" method="post" onsubmit="return hvalidacion()">
                            <input type="hidden" name="idlogin" value="<?php echo $idlogin; ?>">
                            <input type="hidden" name="idclinica"  value="<?php echo $idclinica; ?>">
                            <input type="hidden" name="idmed" value="<?php echo $idmed; ?>">
                            
                            <table >
                              <tbody>
                                <tr>
                                  <th class="col-md-2 text-right">Pacientes Por Día:</th>
                                  <td class="col-md-1"><input type="text" name="pacxdia" id="pacxdia" value="<?php echo $pacxdia;?>" maxlength="3" minlength="1" size="1"  
                                                                onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required></td>
                                  <th class="col-md-2 text-right">Con Seguro:</th>
                                  <td class="col-md-1"><input type="text" name="pacconseg" id="pacconseg" value="<?php echo $pacconseg;?>" maxlength="3" minlength="1" size="1" 
                                                                onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required></td>
                                  <th class="col-md-2 text-right">Sin Seguro:</th>
                                  <td class="col-md-1"><input type="text" name="pacsinseg" id="pacsinseg" value="<?php echo $pacsinseg;?>" maxlength="3" minlength="1" size="1" 
                                                                onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required></td>
                                  <th class="col-md-1 text-right">Consultorio:</th>
                                  <td class="col-md-1"><input type="text" name="consultorio" id="consultorio" value="<?php echo $consultorio;?>" maxlength="7" minlength="1" size="1" 
                                                                 required></td>
                                  <th class="col-md-2 text-right">Piso:</th>
                                  <td class="col-md-1"><input type="text" name="piso" id="piso" value="<?php echo $piso;?>" maxlength="3" minlength="1" size="3" required></td>

                                  <th class="col-md-2 text-right">Telf:</th>
                                  <td class="col-md-1"><input type="text" name="telefono1" id="telefono1" value="<?php echo $telefono1;?>" maxlength="11" minlength="9" size="9" required></td>

                                  <th class="col-md-2 text-right">Telf:</th>
                                  <td class="col-md-1"><input type="text" name="telefono2" id="telefono2" value="<?php echo $telefono2;?>" maxlength="11" minlength="9" size="9"></td>

                                </tr>
                              </tbody>
                            </table>
                            <!-- 2da -->
                                <table>
                                   <caption>Actualizacón de Horario</caption>
                                    <tr>
                                        <th>Día:</th>
                                        <th>Desde:</th>
                                        <th>Hasta:</th>
                                    </tr>
                                    <tr>
                                        <td><strong>Lunes:</strong></td>
                                        <td><input type="time" id="dlunes" name="dlunes" value="<?php echo $dlunes;?>" size="4"></td>
                                        <td><input type="time" id="hlunes" name="hlunes" value="<?php echo $hlunes;?>" size="4"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Martes:</strong></td>
                                        <td><input type="time" id="dmartes" name="dmartes" value="<?php echo $dmartes;?>" size="4"></td>
                                        <td><input type="time" id="hmartes" name="hmartes" value="<?php echo $hmartes;?>" size="4"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Miércoles:</strong></td>
                                        <td><input type="time" id="dmiercoles" name="dmiercoles" value="<?php echo $dmiercoles;?>" size="4"></td>
                                        <td><input type="time" id="hmiercoles" name="hmiercoles" value="<?php echo $hmiercoles;?>" size="4"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Jueves:</strong></td>
                                        <td><input type="time" id="djueves" name="djueves" value="<?php echo $djueves;?>" size="4"></td>
                                        <td><input type="time" id="hjueves" name="hjueves" value="<?php echo $hjueves;?>" size="4"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Viernes:</strong></td>
                                        <td><input type="time" id="dviernes" name="dviernes" value="<?php echo $dviernes;?>" size="4"></td>
                                        <td><input type="time" id="hviernes" name="hviernes" value="<?php echo $hviernes;?>" size="4"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Sábado:</strong></td>
                                        <td><input type="time" id="dsabado" name="dsabado" value="<?php echo $dsabado;?>" size="4"></td>
                                        <td><input type="time" id="hsabado" name="hsabado" value="<?php echo $hsabado;?>" size="4"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Domingo:</strong></td>
                                        <td><input type="time" id="ddomingo" name="ddomingo" value="<?php echo $ddomingo;?>" size="4"></td>
                                        <td><input type="time" id="hdomingo" name="hdomingo" value="<?php echo $hdomingo;?>" size="4"></td>
                                    </tr>
                                </table>
                            <!-- 3ra  -->
                            <div align="right" class="col-md-12">
                                <input style="background: #F89921;border-color: #F89921" type="submit" name="submit" value="Actualizar..." class="btn btn-main btn-primary btn-lg uppercase">
                            </div>  
                            </div>
                        </form> 
                    <!-- /.card-body  -->
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
    <!-- Ds -->
    <script src="js/ds.js"></script>
</body>

</html>