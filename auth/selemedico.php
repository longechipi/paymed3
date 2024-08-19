<?php
  // Busco el primer medico del Asistente
  $sqlselmed = ("SELECT b.idlogin, b.idmed, b.apellido1, b.nombre1
                FROM asistentes a, medicos b, medicosxasist c
                WHERE a.idasist=c.idasist AND b.idmed=c.idmed AND a.idlogin='".$_SESSION['idlogin']."' LIMIT 1;");

  $objselmed = $mysqli->query($sqlselmed);
  $arrselmed = mysqli_fetch_array($objselmed);
  $_SESSION['nombremedico'] = $arrselmed['apellido1'].' '.$arrselmed['nombre1'];
  $_SESSION['idloginmed'] = $arrselmed['idlogin'];
?>