<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php 
require('../../conf/conexion.php');


$idasist = $_GET['id'];

//--------- ELIMINAR DE LA TABLA ASISTENTE----------//
$a="DELETE FROM asistentes WHERE idasist = $idasist";
$ares=$mysqli->query($a);	

$b="DELETE FROM medicosxasist WHERE idasist = $idasist";
$ares=$mysqli->query($b);

if($ares){
echo '<script>
Swal.fire({
  title: "¿Está seguro de eliminar el Banco?",
  text: "Está Acción no podrá Revertirse",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#007ebc",
  cancelButtonColor: "#d33",
  confirmButtonText: "Eliminar",
  cancelButtonText: "Cancelar"
}).then((result) => {
  if (result.isConfirmed) {
    window.location.href = "../../html/rpt_asixmed.php";
    Swal.fire({
      title: "Servisio Eliminado",
      text: "Elimino con Exito el Banco",
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
</script>';
}else{
echo '<script>
    Swal.fire({
        icon: "error",
        title: "Error al Eliminar el Asistente",
        text:"No se pudo eliminar el asistente",
        confirmButtonText: "Volver",
        confirmButtonColor: "#005e43",
        }).then(function() {
            window.location.href = "../../html/rpt_asixmed.php";
        });
    </script>';
}
?>