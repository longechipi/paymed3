<?php   session_start();
		require('../../conexion.php');
		$idcita=$_GET['idcita']; 
		$strsqli="SELECT * FROM citas WHERE idcita='".$idcita."'"; 
			$pedi=$mysqli->query($strsqli);
				$datosprin=$pedi->fetch_array();
				$contalo=0; ?>
<html>
<head>
   <meta charset="utf-8">
   <title>Dashboard</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
   <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
   <script>
      $(document).ready(function()
      {
         $("#mostrarmodal").modal("show");
      });
    </script>
</head>
<body>
   <div class="modal fade" id="mostrarmodal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="ucita.php" method="post">
			   <div class="modal-body">   					
   					<div style="padding-top: 10px">
						<label for="inputStatus">Detalle de Cita:</label>
						<textarea class="form-control" disabled><?php echo $datosprin['comentario']; ?></textarea>
						<br>
						<label for="inputStatus">Respuesta de Cita:</label>
						<?php if(empty($datosprin['respuesta'])){ ?>
							<textarea class="form-control" name="rpta" placeholder="¿Qué sucedió en la cita?"></textarea>
						<?php }else{ ?>			
							<textarea class="form-control" name="rpta"><?php echo $datosprin['respuesta']; ?></textarea>			
						<?php } ?>	
						<input type="hidden" name="iddcita" value="<?php echo $idcita; ?>">					
			    	</div>
			   <div class="modal-footer">		   			   		
			   		<button type="submit" class="btn btn-success">Responder</button>
					<a href="rpt_agenda.php" class="btn btn-danger" role="button" aria-pressed="true">Cerrar</a>          
			   </div>
           </form>
      </div>
   </div>
</div>
</body>
</html>