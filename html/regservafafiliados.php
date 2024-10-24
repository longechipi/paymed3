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
                    <div class="container-fluid flex-grow-1 container-p-y">
                        <div class="row">    
<div class="col-lg-12 mb-12 order-0">
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-12">
                <div class="card-body">
                    <h5 class="card-title text-primary">Registro de Servicios Afiliados</h5>
                    <form id="regafiliado">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputName">Servicio</label>
                                    <input type="text" name="servicios" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputName">Estatus</label>
                                    <select class="form-select mb-3" name="estatus" required>
                                        <option value="1" selected>Activo</option>
                                        <option value="2">Inactivo</option>
                                    </select>                
                                </div>
                            </div> 
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="fi fi-rs-disk"></i> GUARDAR</button>
                                <a href="javascript:history.back()" class="btn btn-outline-warning" rel="noopener noreferrer"><i class="fi fi-rr-undo"></i> VOLVER </a>
                               
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
    $('#regafiliado').submit(function(e){
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "../model/reg_afiliado/regafiliado.php",
        data: $("#regafiliado").serialize(),
        success: function(data){
            console.log(data)
            if(data == 1){
                Swal.fire({
                    title: 'Registro Exitoso!',
                    text: 'Se ha registrado correctamente el Servicio',
                    icon: 'success',
                    confirmButtonColor: "#007ebc",
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "rpt_servafafiliados.php";
                    }
                });
            }else{
                Swal.fire({
                    title: 'Error!',
                    text: 'Ocurrio un Error al Registrar el Servicio',
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