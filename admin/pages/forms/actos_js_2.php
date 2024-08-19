<?php
	include('conn.php');
	$db=connect();
	$query=$db->query("SELECT codproced, proced FROM presupuesto_baremo WHERE codesp=$_GET[id_esp2] ORDER BY proced ASC");
	$states = array();
	while($r=$query->fetch_object()){ $states[]=$r; }
		if(count($states)>0){
			print "<option value=''>-- SELECCIONE --</option>";
			foreach ($states as $s) {
				print "<option value='$s->codproced'>$s->codproced - $s->proced</option>";
			}
		}else{
			print "<option value=''>-- NO HAY DATOS --</option>";
		}
?>