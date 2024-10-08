<header>
    <script src="../../libs/sweetalert/sweetalert.js"></script>
</header>
<?php
	require('../../conf/conexion.php');
	if(isset($_GET['idlin'])){
		$idbare=$_GET['idlin'];
		$a="SELECT * FROM baremos_paymed WHERE idbaremo = $idbare";
		$ares=$mysqli->query($a);
		$rowcount=mysqli_num_rows($ares);
		if($rowcount>0){
			$arow = mysqli_fetch_array($ares);
			unlink("../../upload/baremo_paymed/". $arow['archivo']);
			$b="DELETE FROM baremos_paymed WHERE idbaremo = $idbare";
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
						window.location.href = "../../html/baremo_paymed.php";
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
						window.location.href = "../../html/baremo_paymed.php";
					}
				});
			</script>';
			}	

		}
	} 
?>