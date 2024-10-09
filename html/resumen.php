<?php 
if($privilegios ==1){
  include('../html/view/inicio/admin.php');
}elseif($privilegios ==2){
  include('../html/view/inicio/medicos.php');
}else{
  include('../html/view/inicio/asistentes.php');
}
?>