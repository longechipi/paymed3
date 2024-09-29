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
                $idbco = $_GET['id'];
                $sql = ("SELECT * FROM planes WHERE idplan  = '".$idbco."'");
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
                    <h5 class="card-title text-primary">Editando Plan: <?php echo $roww['plan']; ?></h5>
                    <form id="updplan">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="inputName"> Nombre del Plan</label>
                                    <input type="text" value="<?php echo $roww['plan'];?>" style="text-transform:uppercase;" 
                                    onKeypress="if (event.keyCode < 65 || event.keyCode > 90 && event.keyCode < 97 || event.keyCode > 122 && event.keyCode = 32) event.returnValue = false;" required name="nbplan" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputName"> Costo del Plan (Anual)</label>
                                    <input type="text" value="<?php echo $roww['costo'];?>" name="ctplan" maxlength="4" minlength="2" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required class="form-control">
                                    <input type="hidden" value="<?php echo $roww['idplan']; ?>" name="idtp">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputName"> Dias para Honorarios</label>
                                    <input type="text" value="<?php echo $roww['dias'];?>" name="ddplan" maxlength="3" minlength="1" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required class="form-control mb-3">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputName"> %Comision</label>
                                    <input type="text" value="<?php echo $roww['transaccion'];?>" name="pcplan" maxlength="2" minlength="1" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required class="form-control">
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