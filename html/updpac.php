<?php 
include('../layouts/header.php');
require('../conf/conexion.php');
?>

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <?php include("../layouts/menu.php"); ?>
            <div class="layout-page">
                <?php include("../layouts/navbar.php"); ?>
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">    
                            <div class="col-lg-12 mb-12 order-0">
                                <?php $idpaci=$_GET['i'];
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
?>
<div class="card">
    <div class="d-flex align-items-end row">
        <div class="col-12">
            <div class="card-body">
                <h5 class="card-title text-primary">Editando al Paciente: <?php echo $apellido1 .' '. $apellido2.', '.$nombre1.' '.$nombre2;?></h5>
                <form id="upd_cli">
                <input type="hidden" id="idpaci" name="idpaci" value="<?php echo $idpaci;?>">
                    <div class="row"> <!-- ROW BASE INTERNA -->

                    <div class="divider">
                        <div class="divider-text">Datos de Principales</div>
                      </div>

                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="apellido1">1er Apellido:</label>
                              <input type="text" name="apellido1" id="apellido1" style="text-transform:uppercase;" onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;" class="form-control" 
                              value="<?php echo $apellido1; ?>">
                           </div>
                        </div>

                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="apellido2">2do Apellido: </label>
                              <input type="text" name="apellido2" id="apellido2" style="text-transform:uppercase;" onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;" class="form-control" 
                              value="<?php echo $apellido2;?>">
                           </div>
                        </div>

                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="nombre1">1er Nombre: </label>
                              <input type="text" name="nombre1" id="nombre1" style="text-transform:uppercase;" onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;" class="form-control mb-3" required 
                              value="<?php echo $nombre1;?>">
                           </div>
                        </div>

                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="mombre2">2do Nombre: </label>
                              <input type="text" name="nombre2" id="nombre2" style="text-transform:uppercase;" onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;" class="form-control" 
                              value="<?php echo $nombre2;?>">
                           </div>
                        </div>

                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="fnacimiento">Fec.Nacimiento:</label>
                              <input type="date" name="fnacimiento" id="fnacimiento" class="form-control" onchange="calcedad(this.value)" 
                                 value="<?php echo $fnacimiento;?>">
                           </div>
                        </div>

                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="edad">Edad:</label>
                              <input type="text" name="edad" id="edad" class="form-control" value="<?php echo $edad;?>" readonly>
                           </div>
                        </div>

                        <div class="col-md-1">
                           <div class="form-group">
                              <label for="tpdoc">Cédula:</label>
                              <select class="form-select" id="tpdoc" name="tpdoc" >
                                 <option value="<?php echo substr($cedula, 0,1);?>"><?php echo substr($cedula, 0,1); ?></option>
                                 <option value="V">V</option>
                                 <option value="E">E</option>
                              </select>
                           </div>
                        </div>

                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="cedula" style="visibility:hidden ;">.</label>
                              <input type="text" name="cedula" id="cedula"  minlength="7" maxlength="8" value="<?php echo substr($cedula, 1); ?>" class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;">
                           </div>
                        </div>    

                        <div class="col-md-2">
                            <div class="form-group">
                            <label for="idsexo">Sexo:</label>
                            <select id="idsexo" class="form-select" name="idsexo" required>
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

                        <div class="col-md-3">
                           <div class="form-group">
                              <!--label for="movil" style="visibility: hidden;">.</label-->
                              <label for="movil">Móvil:</label>
                              <input type="text" name="movil" id="movil" maxlength="11" minlength="7" class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required 
                                 value="<?php echo $movil;?>">
                           </div>
                        </div> 
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="correo">Correo:</label>
                              <input type="email" name="correo" id="correo" class="form-control" required value="<?php echo $correo;?>">
                           </div>
                        </div>


                    </div><!-- FIN ROW BASE INTERNA -->

                     <div class="row"> <!--INICIO ROW 1 -->
                    
                       
                    </div> <!--FIN ROW 2 --> 

                    <div class="divider">
                        <div class="divider-text">Datos de Vivienda</div>
                    </div>
                    <div class="row"> <!--INICIO ROW 3 -->

                        <div class="col-md-3">
                           <div class="form-group">
                              <label for="idpais">País:</label>
                              <select id="idpais" class="form-select" name="idpais" required>
                                <option value="<?php echo $idpais; ?>"><?php echo $pais; ?></option>
                                 <?php
                                 $query = $mysqli->query("SELECT idpais, pais FROM paises WHERE idestatus='1';");
                                 while ($valores = mysqli_fetch_array($query)) {
                                    echo '<option value="' . $valores['idpais'] . '">' . $valores['pais'] . '</option>';
                                 } ?>
                              </select>
                            
                           </div>
                        </div>

                        <div id="div-estado" class="col-md-3">
                           <div class="form-group">
                              <label for="correo">Estado:</label>
                              <select id="id_estado" class="form-control" name="idestado">
                                    <option value="<?php echo $idestado;?>"><?php echo $estado;?></option>
                              </select>
                           </div>
                        </div>
                        <div id="div-municipio" class="col-md-3">
                           <div class="form-group">
                              <label for="correo">Municipio:</label>
                              <select id="id_municipio" class="form-control" name="idmunicipio" >
                                    <option value="<?php echo $idmunicipio;?>"><?php echo $municipio;?></option>
                              </select>
                           </div>
                        </div>
                        <div  id="div-parroquia" class="col-md-3">
                           <div class="form-group">
                              <label for="correo">Parroquia:</label>
                              <select id="id_parroquia" class="form-control mb-3" name="idparroquia" >
                                    <option value="<?php echo $idparroquia;?>"><?php echo $parroquia;?></option>
                              </select>
                           </div>
                        </div>
                    </div><!--FIN ROW 3 -->

                    <div class="row mt-3"> <!--INICIO ROW 3 -->
                        <div id="div-caav" class="col-md-12 mb-3">
                           <div class="form-group">
                              <label for="calleav">Dirección:</label>
                              <input type="text" name="calleav" style="text-transform:uppercase;" id="calleav" style="text-transform:uppercase;" class="form-control"  value="<?php echo $calleav;?>">
                           </div>
                        </div>

                       

                        <div class="text-center mt-4">
                            <button type="submit" id="btn_update_clinica" class="btn btn-primary"><i class="fi fi-rs-disk"></i> ACTUALIZAR</button>
                            <a href="javascript:history.back()" class="btn btn-outline-warning" rel="noopener noreferrer"><i class="fi fi-rr-undo"></i> VOLVER </a>
                        </div>

                   </div>  <!-- FIN ROW 4 -->
                </form>
            </div>
        </div>
    </div>
 </div> <!--fin card -->
</div>
</div>
</div>
                    <?php include('../layouts/footer.php')?>
            
                </div>
            </div>
    </div>
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
</div>
<?php include('../layouts/script.php')?>
<script>
$(document).ready(function(){
$('#upd_cli').submit(function(e){
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "../model/mod_actP_med/updpaci.php",
        data: $("#upd_cli").serialize(),
        success: function(data){
            if(data == 1){
                console.log(data)
                Swal.fire({
                    title: 'Actualizo con Exito!',
                    text: 'Se actualizo correctamente el Paciente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "rpt_pacxmed.php";
                    }
                });
            }else{
                console.log(data)
                Swal.fire({
                    title: 'Error!',
                    text: 'Ocurrio un Error al Actualizar el Paciente',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            }
        }
    }) 
})

     $("#idpais").change(function(){				
        $.get("../model/reg_clinica/pais.php","idpais="+$("#idpais").val(), function(data){
            $("#id_estado").html(data);
        });
    });

    $("#id_estado").change(function(){				
        $.get("../model/reg_clinica/estado.php","id_estado="+$("#id_estado").val(), function(data){
            $("#id_municipio").html(data);
        });
    });

    $("#id_municipio").change(function(){
        $.get("../model/reg_clinica/municipio.php","id_municipio="+$("#id_municipio").val(), function(data){
            $("#id_parroquia").html(data);
        });
    });

    $('#id_estado, #id_parroquia, #id_municipio, #idpais').select2({
        theme: 'bootstrap-5',
        width: '100%',
    });
})
</script>
</body>
</html>