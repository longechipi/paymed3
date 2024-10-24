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
                $idimage=$_GET['id'];
                $sql = ("SELECT a.idimage, a.servicio, a.zona, a.estudio, a.idestatus, b.estatus FROM servimage a, estatus b WHERE a.idestatus=b.idestatus AND idimage= '" . $idimage . "';");   
                $obj = $mysqli->query($sql);
                $row = mysqli_fetch_array($obj);
                $servicio = $row['servicio'];
                $zona = $row['zona'];
                $estudio = $row['estudio'];
                $idestatus = $row['idestatus'];
                $estatus = $row['estatus'];
                ?>
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">    
<div class="col-lg-12 mb-12 order-0">
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-12">
                <div class="card-body">
                    <h5 class="card-title text-primary">Editando Estudio: <?php echo $row['servicio']; ?></h5>
                    <form id="updservimg">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="inputName">Servicio</label>
                                    <input type="hidden" name="idimage" value="<?php echo $idimage;?>">
                                    <input type="text" value="<?php echo $servicio;?>" name="servicio" class="form-control mb-3">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="inputName">Zona</label>
                                    <input type="text" value="<?php echo $zona;?>" name="zona" class="form-control">
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="inputName">Estudio</label>
                                    <input type="text" value="<?php echo $estudio;?>" name="estudio" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="inputStatus">Estatus:</label>
                                    <select class="form-select" name="idestatus" required>
                                        <option value="<?php echo $idestatus;?>"><?php echo $estatus;?></option>
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
    $('#updservimg').submit(function(e){
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "../model/reg_servimg/updservimg.php",
        data: $("#updservimg").serialize(),
        success: function(data){
            if(data == 1){
                Swal.fire({
                    title: 'Actualización Exitosa!',
                    text: 'Se Actualizo correctamente el Estudio',
                    icon: 'success',
                    confirmButtonColor: "#007ebc",
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "rpt_servimg.php";
                    }
                });
            }else{
                Swal.fire({
                    title: 'Error!',
                    text: 'Ocurrio un Error al Actualizar el Estudio',
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