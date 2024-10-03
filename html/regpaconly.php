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
<div class="card">
    <div class="d-flex align-items-end row">
        <div class="col-12">
            <div class="card-body">
                <h5 class="card-title text-primary">Registro de Paciente </h5>
                <form id="reg_med">
                    <input type="text" name="privi" id="privi" value="<?php echo $privilegios;?>" hidden />
                    <input type="text" name="idlogin" id="idlogin" value="<?php echo $idlogin;?>" hidden />
                    <input type="text" name="idmedico" id="idmedico" value="<?php echo empty($idmedico) ? '' : $idmedico; ?>" hidden/>
                     <div class="row"> <!--INICIO ROW 1 -->
                     <div class="divider">
                        <div class="divider-text">Datos de Principales</div>
                      </div>

                      <div class="col-md-4">
                            <label for="rif">Nro. Documento</label>
                            <div class="input-group">
                                <select class="form-control" id="tpdoc" name="tpdoc">
                                    <option value="V">V</option>
                                    <option value="E">E</option>
                                </select>
                                <input type="text" name="nrodoc" id="nrodoc" minlength="6" maxlength="9" onblur="busci(this.value)"
                                onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                            <label for="rif">Primer Apellido</label>
                            <input type="text" name="apellido1" id="apellido1" style="text-transform:uppercase;" onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;" required class="form-control" required 
                            value="">
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <div class="form-group">
                                <label for="apellido2">Segundo Apellido </label>
                                <input type="text" name="apellido2" id="apellido2" style="text-transform:uppercase;" onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;" class="form-control">
					        </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="nombre1">Primer Nombre </label>
                                <input type="text" name="nombre1" id="nombre1" style="text-transform:uppercase;" onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="mombre2">Segundo Nombre </label>
                                <input type="text" name="nombre2" id="nombre2" style="text-transform:uppercase;" onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122) event.returnValue = false;" class="form-control">
                            </div> 
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="idestcivil">Estado Civil</label>
                                <select id="idestcivil" class="form-select" name="idestcivil" required>
                                    <option value="">-- Seleccione --</option>
                                    <?php
                                    $query = $mysqli->query("select idestcivil, estcivil from estadocivil WHERE idestatus='1'; ");
                                    while ($valores = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $valores['idestcivil'] . '">' . $valores['estcivil'] . '</option>';
                                    } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="idsexo">Genero</label>
                                <select id="idsexo" class="form-select" name="idsexo" required>
                                    <option value="">Selec.</option>
                                    <?php
                                    $query = $mysqli->query("select idsexo, sexo from sexo WHERE idestatus='1'; ");
                                    while ($valores = mysqli_fetch_array($query)) {
                                        echo '<option value="' . $valores['idsexo'] . '">' . $valores['sexo'] . '</option>';
                                    } ?>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="fnacimiento">Fec.Nacimiento:</label>
                                <input type="date" name="fnacimiento" id="fnacimiento" class="form-control" onblur="calcedad(this.value)"/>
                            </div>
                        </div>

                        <div class="col-md-1">
                           <div class="form-group">
                              <label for="edad">Edad:</label> 
                              <input type="text" name="edad" id="edad" class="form-control" readonly/>
                           </div>
                        </div>


                    </div><!--FIN ROW 1 -->

                    <div class="divider">
                        <div class="divider-text">Datos de Contacto</div>
                    </div>
                    <div class="row">
                    <div class="col-md-2">
                           <div class="form-group">
                              <!--label for="movil" style="visibility: hidden;">Movil</label-->
                              <label for="movil">Movil</label>
                              <input type="text" name="movil" id="movil" maxlength="11" minlength="11" class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <label for="telefono">Teléfono:</label>
                              <input type="text" name="telefono" id="telefono" minlength="11" maxlength="11" class="form-control mb-3" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;">
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label for="correo">Correo:</label>
                              <input type="email" name="correo" id="correo" class="form-control " required>
                           </div>
                        </div>

                    </div>
                    <div class="row"> <!--INICIO ROW 3 -->
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label for="descripcion">País:</label>
                                <select id="idpais" class="form-select" name="idpais" required>
                                    <option value="">-- Pais --</option>
                                    <?php
                                    $query = $mysqli -> query ("SELECT idpais, pais, idestatus FROM paises WHERE idestatus =1 AND idpais = 232");
                                    while ($valores = mysqli_fetch_array($query)) {
                                    echo '<option value="'.$valores['idpais'].'">'.$valores['pais'].'</option>';
                                    } ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="descripcion">Estado:</label>
                                <select id="id_estado" class="form-select" name="idestado" required>
                                    <option value="">-- Seleccione --</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="descripcion">Municipio:</label>
                                <select id="id_municipio" class="form-select" name="idmunicipio" required>
                                    <option value="">-- Municipio --</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="descripcion">Parroquia:</label>
                                <select id="id_parroquia" class="form-select" name="idparroquia" required>
                                    <option value="">-- Parroquia --</option>
                                </select>	
                            </div>
                        </div>
                    </div><!--FIN ROW 3 -->

                    <div class="row"> <!--INICIO ROW 3 -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="urbanizacion">Urbanización:</label>
                                <input type="text" name="calleav" style="text-transform:uppercase;" id="calleav" style="text-transform:uppercase;" class="form-control">
                            </div>
                        </div>

                        <!-- Habilita si es Admin -->
                        <?php if($privilegios == 1){ ?>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="movil">Seleccionar Medico</label>
                                    <select name="medi_tra" id="medi_tra" class="form-select">
                                    <option value="" selected disabled >Seleccione</option>
                                    <?php 
                                        $a ="SELECT idlogin, CONCAT(apellido1, ' ',apellido2, ' ',nombre1, ' ',nombre2) from medicos ";
                                        $ares = $mysqli->query($a); ?>
                                        <?php while($row = $ares->fetch_array()){ ?>
                                            <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                                        <?php } ?>
                                    </select>
                            </div>
                        </div>
                           <?php } ?>

                        <!-- Habilita que medico trabaja con el asistente -->
                        <?php if($privilegios == 7){ ?>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="movil">Seleccionar Medico</label>
                                    <select name="medi_tra" id="medi_tra" class="form-select">
                                    <option value="" selected disabled >Seleccione</option>
                                    <?php 
                                        $a ="SELECT L.idlogin, L.idtrabajacon, CONCAT(M.apellido1, ' ',M.apellido2, ' ',M.nombre1, ' ',M.nombre2) AS nom_med
                                            FROM loginn L
                                            INNER JOIN medicos M ON L.idtrabajacon = M.idlogin
                                            WHERE L.idlogin = $idlogin";
                                        $ares = $mysqli->query($a); ?>
                                        <?php while($row = $ares->fetch_array()){ ?>
                                            <option value="<?php echo $row['idtrabajacon'] ?>"><?php echo $row['nom_med'] ?></option>
                                        <?php } ?>
                                    </select>
                            </div>
                        </div>
                           <?php } ?>

                        <div class="text-center mt-4">
                            <button type="submit" id="btn_register_clinica" class="btn btn-primary"><i class="fi fi-rs-disk"></i> REGISTRAR</button>
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

function busci(cinro) {
    let tpdoc=document.getElementById("tpdoc").value;
    let cedula=tpdoc+cinro;
    
    jQuery.ajax({
    type: "POST",
    url: "../model/mod_actP_med/busci_js.php",
    data: {cedula: cedula },
    success: function(data) {
        if (data =='1') {
            Swal.fire({
                title: 'Error!',
                text: 'El Numero de Cedula se Encuentra Registrado',
                icon: 'error',
                confirmButtonColor: "#007ebc",
                confirmButtonText: 'Aceptar'
            });   
            return;          
        }
    }
});
}
    
$(document).ready(function(){
    $('#reg_med').submit(function(e){
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "../model/mod_actP_med/regpaciente.php",
        data: $("#reg_med").serialize(),
        success: function(data){
            console.log(data);
            if(data == 1){
                Swal.fire({
                    title: 'Registro Exitoso!',
                    text: 'Se ha registrado correctamente el Paciente',
                    icon: 'success',
                    confirmButtonColor: "#007ebc",
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "rpt_pacxmed.php";
                    }
                });
            }else{
                Swal.fire({
                    title: 'Error!',
                    text: 'Ocurrio un Error al Registrar el Paciente',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            }
        }
    }) 
})

});

</script>
<!-- Adicionales -->
<script src="../js/direcciones.js"></script>
<script src="../js/fun_globales.js"></script>
</body>
</html>