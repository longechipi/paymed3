<header>
    <script src="../../libs/sweetalert/sweetalert.js"></script>
</header>
<?php
	require('../../conf/conexion.php');
	if(isset($_GET['idlin'])){
		$idcconta=$_GET['idlin'];
		$idseguro=$_GET['idseg'];

		$a="SELECT * FROM asegura_negocia WHERE idaseg = $idseguro";
		$ares=$mysqli->query($a);
		$rowcount=mysqli_num_rows($ares);
			if($rowcount>0){
				$arow = mysqli_fetch_array($ares);
				unlink("../../upload/baremos/". $arow['archivo']);
				$b="DELETE FROM asegura_negocia WHERE idneg='".$idcconta."'";
				$bres=$mysqli->query($b);
				if($bres){
					echo '<script>
					Swal.fire({
						title: "Baremo Eliminado Correctamente",
						text: "Documento eliminado con Exito",
						icon: "success",
						confirmButtonColor: "#007ebc",
						confirmButtonText: "Aceptar"
					}).then((result) => {
						if (result.isConfirmed) {
							window.location.href = "../../html/rpt_seg.php";
						}
					});
				</script>';
				}else{
					echo '<script>
					Swal.fire({
						title: "Error",
						text: "El Baremo no se pudo Eliminar",
						icon: "error",
						confirmButtonColor: "#007ebc",
						confirmButtonText: "Aceptar"
					}).then((result) => {
						if (result.isConfirmed) {
							window.location.href = "../../html/rpt_seg.php";
						}
					});
				</script>';
				}
				
			}
		}
?>