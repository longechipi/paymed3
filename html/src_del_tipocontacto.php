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
Swal.fire({
  title: "¿Está seguro de eliminar este Contacto?",
  text: "Está Acción no podrá Revertirse",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#007ebc",
  cancelButtonColor: "#d33",
  confirmButtonText: "Eliminar",
  cancelButtonText: "Cancelar"
}).then((result) => {
  if (result.isConfirmed) {
    window.location.href = "../model/reg_contacto/delete_cuenta.php?idcontacto=<?php echo $_GET['idcontacto']; ?>";
    Swal.fire({
      title: "Cuenta Eliminada",
      text: "Elimino con Exito la Cuenta",
      icon: "success"
    }).then((result) => {
      if (result.isConfirmed) {
        window.history.back()
      }
    });
  }else{
    window.history.back()
  }
});
</script>

</body>
</html>