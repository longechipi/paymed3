<?php 
include('../layouts/header.php');
require('../admin/conexion.php');
?>

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <?php include("../layouts/menu.php"); ?>
            <div class="layout-page">
                <?php include("../layouts/navbar.php"); ?>
                <?php 
                $idcontacto = $_GET['idcontacto'];
                $sql = ("SELECT * FROM tipocontacto WHERE idtipocontacto = '" . $idcontacto . "'");
                $result = $mysqli->query($sql);
                $roww = mysqli_fetch_array($result);
                ?>
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">    
<div class="col-lg-12 mb-12 order-0">
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-12">
                <div class="card-body">
                    <h5 class="card-title text-primary">Editando Cuenta: <?php echo $roww['tipocontacto']; ?></h5>
                    <form id="updcontacto">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputName">Tipo de Contacto</label>
                                    <input type="hidden" value="<?php echo $idcontacto; ?>" name="idcontacto">
                                    <input type="text" value="<?php echo $roww['tipocontacto']; ?>" name="tipocontacto" class="form-control mb-3">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputName">Estatus</label>
                                    <select class="form-select" name="estatus" required>
                                        <option value="<?php echo $roww['idestatus']; ?>" selected>
                                            <?php
                                            $sqlst = ("SELECT estatus FROM estatus 
                                                WHERE idestatus = '" . $roww['idestatus'] . "'");
                                            $respst = $mysqli->query($sqlst);
                                            $rowst = mysqli_fetch_array($respst);
                                            echo $rowst['estatus']; ?></option>
                                        <option value="1">Activo</option>
                                        <option value="2">Inactivo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-center">
                            <button type="submit" name="submit" class="btn btn-primary"><i class="fi fi-rs-disk"></i> ACTUALIZAR</button>
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
    $('#updcontacto').submit(function(e){
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "../model/reg_contacto/updcontacto.php",
        data: $("#updcontacto").serialize(),
        success: function(data){
            if(data == 1){
                Swal.fire({
                    title: 'Actualización Exitosa!',
                    text: 'Se Actualizo correctamente el Contacto',
                    icon: 'success',
                    confirmButtonColor: "#007ebc",
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "rpt_tipocontacto.php";
                    }
                });
            }else{
                Swal.fire({
                    title: 'Error!',
                    text: 'Ocurrio un Error al Actualizar el Contacto',
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