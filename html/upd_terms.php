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
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">    
<div class="col-lg-12 mb-12 order-0">
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-12">
                <div class="card-body">
                    <h5 class="card-title text-primary">Actualizacion de Terminos y Condiciones</h5>
                    <?php 
                        $sql = ("SELECT * FROM termcondi");
                        $result = $mysqli->query($sql);
                        $roww = mysqli_fetch_array($result);
                    ?>

<form id="reg_term">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                
                <textarea name="termn" class="form-control" id="terminos" rows="20"><?php echo $roww['terminos']; ?></textarea>
                <div class="text-center">
                <button class="btn btn-primary mt-3" type="submit" name="submit"><i class="fi fi-rs-refresh"></i> ACTUALIZAR</button>
                </div>
            </div>
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
$(document).ready(function() {
  $('#terminos').summernote();
  $('#reg_term').submit(function(e){
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "../model/reg_terminos/udterminos.php",
        data: $("#reg_term").serialize(),
        success: function(data){
            if(data == 1){
                Swal.fire({
                    title: 'Actualización Exitosa!',
                    text: 'Se Actualizo correctamente la Cuenta',
                    icon: 'success',
                    confirmButtonColor: "#007ebc",
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "upd_terms.php";
                    }
                });
            }else{
                Swal.fire({
                    title: 'Error!',
                    text: 'Ocurrio un Error al Actualizar la Cuenta',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            }
        }
    })
})
});
</script>
</body>
</html>