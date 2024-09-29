<?php 
include('../layouts/header.php');
require('../conf/conexion.php');
?>

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <?php include("../layouts/menu.php"); ?>
            <div class="layout-page">
                <?php include("../layouts/navbar.php"); ?>
                <?php 
                 $idclinica=$_GET['id'];
                 $idhorario=$_GET['c'];
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
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">    
<div class="col-lg-12 mb-12 order-0">
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-12">
                <div class="card-body">
                    <h5 class="card-title text-primary"> <h1>Actualizando Horario: <?php echo $nombreclinica; ?></h1></h5>
                    <form id="updplan">
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
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
                    </div>
                    <?php include('../layouts/footer.php')?>
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
    </div>
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
</div>
<?php include('../layouts/script.php')?>
<script>
$(document).ready(function(){
    $('#updplan').submit(function(e){
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "../model/reg_plan/updplan.php",
        data: $("#updplan").serialize(),
        success: function(data){
            if(data == 1){
                Swal.fire({
                    title: 'Actualización Exitosa!',
                    text: 'Se Actualizo correctamente el Plan PayMed',
                    icon: 'success',
                    confirmButtonColor: "#007ebc",
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "rpt_planes.php";
                    }
                });
            }else{
                Swal.fire({
                    title: 'Error!',
                    text: 'Ocurrio un Error al Actualizar el Plan PayMed',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            }
        }
    })
})
})
</script>

</body>
</html>