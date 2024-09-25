<?php 
include('../layouts/header.php');
require('../admin/conexion.php');
?>

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <?php include("../layouts/menu.php"); ?>
            <div class="layout-page">
                <?php include("../layouts/navbar.php"); ?>
                <div class="content-wrapper">
                    <div class="container-fluid flex-grow-1 container-p-y">
                        <div class="row">    
<div class="col-lg-12 mb-12 order-0">
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-12">
                <div class="card-body">
                    <h5 class="card-title text-primary">Registro de Asistentes</h5>
                    <form id="regbanco">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="correo">Correo:</label>
                                    <input type="email" name="correo" id="correo" class="form-control" required>
                                    <input type="text" style="display:none;" name="idmed" id="idmed" class="form-control" value="<?php echo $idmedico;?>">
                                    <input type="text" style="display:none;" name="usuario" id="usuario" class="form-control" value="<?php echo $usuario;?>">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="apellidos">Apellidos: </label>
                                    <input type="text" name="apellidos" id="apellidos" class="form-control" style="text-transform:uppercase;" required>
                                </div>
                           </div>

                           <div class="col-md-3">
                                <div class="form-group">
                                <label for="nombres">Nombres: </label>
                                <input type="text" name="nombres" id="nombres"  class="form-control" style="text-transform:uppercase;" required>
                                </div>
                           </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="cedula">Cedula:</label>
                                    <input type="text" name="cedula" id="cedula" onblur="valdoc('2',this.value)" maxlength="8" minlength="7" class="form-control mb-3"
                                    onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nombrecargo">Cargo:</label>
                                    <input type="text" name="nombrecargo" id="nombrecargo" class="form-control" value="ASISTENTE" required readonly>
                                    <input type="text" style="display:none;" name="idlogin" id="idlogin" class="form-control" value="<?php echo $idlogin;?>">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="tpasist">Nivel:</label>
                                    <select class="form-select mb-3" id="tpasist" name="tpasist">
                                        <option value="" selected disabled >Seleccione</option>
                                        <option value="Asistente1">Primer Asistente</option>
                                        <option value="Asistente2">Segundo Asistente</option>
                                    </select>
                                </div>
                            </div>

                            
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="movil">Celular:</label>
                                    <input type="text" name="movil" id="movil" value="" maxlength="12" minlength="7" class="form-control"
                                    onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;"  required>
                                </div>
                            </div>

                            <?php 
                            //------ Habilita si es Admin ------//
                                if($idlogin == 1){ ?>
                              <div class="col-md-3">
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


                            <div class="text-center mb-6">
                                <button type="submit" class="btn btn-primary"><i class="fi fi-rs-disk"></i> GUARDAR</button>
                                <a href="javascript:history.back()" class="btn btn-outline-warning" rel="noopener noreferrer"><i class="fi fi-rr-undo"></i> VOLVER </a>
                               
                            </div>

                            <div class="col-md-12 text-center mb-5" id="existe" hidden>
                                <h4 >El Asistente Esta Registrado, ¿Quiere que forme parte de su Equipo? <br> De ser correcto por favor Pulse Guardar</h4>
                            </div>
                        </div>
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
$("#correo").blur(function() {
    const correo = $("#correo").val();
    const idmed = $("#idmed").val();
    $.ajax({
        type: "POST",
        url: "../model/reg_asisten/valida_asist.php",
        data: {correo: correo, idmed: idmed},
            success:function(val){
                if(val==1){
                    Swal.fire({
                        title: 'El Correo Existe',
                        text: 'El correo de este Asistente ya se encuentra registrado para este Doctor',
                        icon: 'warning',
                        confirmButtonColor: "#007ebc",
                        confirmButtonText: 'Aceptar'
                    })
                    $("#correo").val("");
                }else{
                    arreglo=[];
                    $.ajax({
                        type: "POST",
                        url: "../model/reg_asisten/val_email.php",
                        data: {correo: correo},
                        success:function(data){
                            const arreglo = data.split("|");
                            const lenarreglo=arreglo.length;
                            if (arreglo.length !== 1) {
                                
                                $('#existe').removeAttr('hidden');
                                const fields = ['cedula', 'apellidos', 'nombres', 'movil', 'tpasist'];
                                    fields.forEach((field, index) => {
                                        document.getElementById(field).value = arreglo[index];
                                        document.getElementById(field).readOnly = true;
                                    });
                            } else {
                                $('#existe').attr('hidden', true);
                                document.getElementById('existe').style.display = 'none';
                                const fields = ['cedula', 'apellidos', 'nombres', 'movil', 'tpasist'];
                                    fields.forEach((field) => {
                                        document.getElementById(field).value = '';
                                        document.getElementById(field).readOnly = false;
                                    });
                            }
                        }
                    })

                }
            }
    })


});
   
    $('#regbanco').submit(function(e){
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "../model/reg_asisten/regasist.php",
        data: $("#regbanco").serialize(),
        success: function(data){
            console.log(data)
            // if(data == 1){
            //     Swal.fire({
            //         title: 'Registro Exitoso!',
            //         text: 'Se ha registrado correctamente el Asistente',
            //         icon: 'success',
            //         confirmButtonColor: "#007ebc",
            //         confirmButtonText: 'Aceptar'
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             window.location.href = "rpt_asist.php";
            //         }
            //     });
            // }else{
            //     Swal.fire({
            //         title: 'Error!',
            //         text: 'Ocurrio un Error al Registrar el Asistente',
            //         icon: 'error',
            //         confirmButtonText: 'Aceptar'
            //     });
            // }
        }
    }) 
})
    $('#medi_tra').select2({
        theme: 'bootstrap-5',
        width: '100%'
    });
})
</script>
</body>
</html>