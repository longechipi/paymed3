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
                    $idbco = $_GET['idbk'];
                    $sql = ("SELECT * FROM bancos WHERE idbco = '".$idbco."'");
                    $result = $mysqli->query($sql);
                    $roww = mysqli_fetch_array($result);
                    $tipo =$roww['tipo'];
                    if ($tipo=='1') {$tiponombre='Nacional';}elseif ($tipo=='2') {$tiponombre='Internacional';}
       
                ?>
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">    
<div class="col-lg-12 mb-12 order-0">
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-12">
                <div class="card-body">
                    <h5 class="card-title text-primary">Editando Entidad Bancaria: <?php echo $roww['banco']; ?></h5>
                    <form id="updbanco">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputName">Entidad Bancaria</label>
                                    <input type="hidden" value="<?php echo $idbco; ?>" name="idbco">
                                    <input type="text" value="<?php echo $roww['banco']; ?>" name="banco" class="form-control mb-3">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="inputName">Tipo Banco</label>
                                    <select class="form-select" name="tipo" required>
                                        <option value="<?php echo $tipo;?>" selected><?php echo $tiponombre; ?></option>
                                        <option value="1" >Nacional</option>
                                        <option value="2">Internacional</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
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
    $('#updbanco').submit(function(e){
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "../model/reg_banco/updbanco.php",
        data: $("#updbanco").serialize(),
        success: function(data){
            if(data == 1){
                Swal.fire({
                    title: 'Actualización Exitosa!',
                    text: 'Se Actualizo correctamente la Especialidad',
                    icon: 'success',
                    confirmButtonColor: "#007ebc",
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "rpt_bancos.php";
                    }
                });
            }else{
                Swal.fire({
                    title: 'Error!',
                    text: 'Ocurrio un Error al Actualizar la Especialidad ',
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