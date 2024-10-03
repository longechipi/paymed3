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
$a = ("SELECT * FROM pacientes WHERE idpaci='$idpaci'");
$ares = $mysqli->query($a); 
$row = $ares->fetch_array();

$idsexo= $row['idsexo'];
$sql = ("SELECT sexo from sexo WHERE idsexo='".$idsexo."';");
$obj=$mysqli->query($sql); 
$arr=$obj->fetch_array();  
$sexo=$arr[0];
$idestcivil= $row['idestcivil'];


$idpais=$row['idpais'];
$sql = ("SELECT pais from paises WHERE idpais='".$idpais."';");
$obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
$pais=$arr[0];
$idestado=$row['idestado'];
$sql = ("SELECT estado from estado WHERE idestado='".$idestado."';");
$obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
$estado=$arr[0];
$idmunicipio=$row['idmunicipio'];
$sql = ("SELECT municipio from municipios WHERE idmunicipio='".$idmunicipio."';");
$obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
$municipio=$arr[0];
$idparroquia=$row['idparroquia'];
$sql = ("SELECT parroquia from parroquias WHERE idparroquia='".$idparroquia."';");
$obj=$mysqli->query($sql); $arr=$obj->fetch_array();  
$parroquia=$arr[0];

?>
<div class="card">
    <div class="d-flex align-items-end row">
        <div class="col-12">
            <div class="card-body">
                <h5 class="card-title text-primary">Editando al Paciente: <?php echo $row['apellido1'] .' '. $row['apellido2'].', '.$row['nombre1'].' '.$row['nombre2'];?></h5>
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
                              value="<?php echo $row['apellido1']; ?>">
                           </div>
                        </div>

                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="apellido2">2do Apellido: </label>
                              <input type="text" name="apellido2" id="apellido2" style="text-transform:uppercase;" onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;" class="form-control" 
                              value="<?php echo $row['apellido2'];;?>">
                           </div>
                        </div>

                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="nombre1">1er Nombre: </label>
                              <input type="text" name="nombre1" id="nombre1" style="text-transform:uppercase;" onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;" class="form-control mb-3" required 
                              value="<?php echo  $row['nombre1'];?>">
                           </div>
                        </div>

                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="mombre2">2do Nombre: </label>
                              <input type="text" name="nombre2" id="nombre2" style="text-transform:uppercase;" onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;" class="form-control" 
                              value="<?php echo $row['nombre2']; ?>">
                           </div>
                        </div>

                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="fnacimiento">Fec.Nacimiento:</label>
                              <input type="date" name="fnacimiento" id="fnacimiento" class="form-control" onchange="calcedad(this.value)" 
                                 value="<?php echo $row['fnacimiento'];?>">
                           </div>
                        </div>

                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="edad">Edad:</label>
                              <input type="text" name="edad" id="edad" class="form-control" value="<?php echo $row['edad'];?>" readonly>
                           </div>
                        </div>

                        <div class="col-md-4">
                            <label for="rif">Nro. Documento</label>
                            <div class="input-group">
                                <select class="form-control" id="tpdoc" name="tpdoc">
                                    <option value="V">V</option>
                                    <option value="E">E</option>
                                </select>
                                <input type="text" name="nrodoc" id="nrodoc" minlength="6" maxlength="9" 
                                onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" class="form-control" value="<?php echo substr($row['cedula'], 1); ?>"required>
                            </div>
                        </div>

                       

                        <div class="col-md-2">
                            <div class="form-group">
                            <label for="idsexo">Sexo:</label>
                            <select id="idsexo" class="form-select" name="idsexo" required>
                                <option value="<?php echo $idsexo ?>"><?php echo substr($sexo, 0,9); ?></option>
                                <?php
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
                                 value="<?php echo $row['movil'];?>">
                           </div>
                        </div> 
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="correo">Correo:</label>
                              <input type="email" name="correo" id="correo" class="form-control" required value="<?php echo $row['correo'];?>">
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
                              <input type="text" name="calleav" style="text-transform:uppercase;" id="calleav" style="text-transform:uppercase;" class="form-control"  value="<?php echo $row['calleav'];?>">
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
})
</script>
<!-- Adicionales -->
<script src="../js/direcciones.js"></script>
<script src="../js/fun_globales.js"></script>
</body>
</html>