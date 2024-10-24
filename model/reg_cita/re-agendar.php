<header>
    <script src="../../libs/sweetalert/sweetalert.js"></script>
</header>
<?php 
require('../../conf/conexion.php');

$id_cita = $_POST['id_cita'];
$estatus = $_POST['estatus'];

$a = "UPDATE citas SET idestatus = $estatus WHERE idcita = 62 ";
$ares=$mysqli->query($a);
if($ares){
    echo '<script>
            Swal.fire({
               title: "Cambio Estatus",
               text: "Cambio el Estatus de la Cita Exitosamente",
               icon: "success",
               confirmButtonColor: "#007ebc",
               confirmButtonText: "Aceptar"
           }).then((result) => {
               if (result.isConfirmed) {
                   window.location.href = "../../html/rpt_citas.php";
                }
            });
            </script>';
}else{
    echo '<script>
    Swal.fire({
        icon: "error",
        title: "Error al Actualziar",
        text: "Ocurrio un error al Actualizar la Cita",
        confirmButtonText: "Volver",
        confirmButtonColor: "#005e43",
        }).then(function() {
            window.location.href = "../../html/rpt_citas.php";
        });
    </script>';
}
?>