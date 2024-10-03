<header>
    <script src="../../libs/sweetalert/sweetalert.js"></script>
</header>

<?php
require('../../conf/conexion.php');
$idpaci = $_GET['idpaci'];
$a="DELETE FROM pacientes WHERE idpaci= $idpaci";
$conexion=$mysqli->query($a);
    
if($conexion){
	echo '<script>
            Swal.fire({
               title: "Paciente Eliminado!",
               text: "Elimino Correctamente el Usuario",
               icon: "success",
               confirmButtonColor: "#007ebc",
               confirmButtonText: "Aceptar"
           }).then((result) => {
               if (result.isConfirmed) {
                   window.location.href = "../../html/rpt_pacxmed.php";
                    }
            });
            </script>';
}else{
echo '<script>
    Swal.fire({
        icon: "error",
        title: "Error al Eliminar",
        text:"Ocurrio un error al Eliminar el Paciente",
        confirmButtonText: "Volver",
        confirmButtonColor: "#005e43",
        }).then(function() {
            window.location.href = "../../html/rpt_pacxmed.php";
        });
    </script>';
}

?>