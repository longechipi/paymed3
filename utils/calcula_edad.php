<?php
function calcularEdad($fechaNacimiento) {
	if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fechaNacimiento)) {
	  return "ERROR";
	}
	$fechaNacimiento = new DateTime($fechaNacimiento);
	$hoy = new DateTime();
	$diferencia = $hoy->diff($fechaNacimiento);
	return $diferencia->y;
  }
  $fechaNacimiento = $_POST['fecha'];
  echo calcularEdad($fechaNacimiento);
?>