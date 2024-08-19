<?php   session_start();
		require('../../conexion.php');
		$iduser=$_GET['idu']; 
		$strsqli="SELECT clave FROM loginn WHERE idlogin='".$iduser."'"; 
			$pedi=$mysqli->query($strsqli);
				$datosprin=$pedi->fetch_array();
				$contalo=0; ?>
<html>
<head>
   <meta charset="utf-8">
   <title>Dashboard | Habita Inmueble</title>
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
          <form action="../mail/confirm.php" method="post">
			   <div class="modal-body">   					
   					<div align="center" style="padding-top: 10px">
    				<label for="inputStatus">Clave de Acceso:</label>
	    			<input type="text" class="form-control" value="<?php echo $datosprin['clave']; ?>" disabled>
		    		<input type="hidden" name="idservicio" value="<?php echo $idorden; ?>">					
			    </div>
			   <div class="modal-footer">		   
					<a href="rpt_user.php" class="btn btn-danger" role="button" aria-pressed="true">Cerrar</a>          
			   </div>
           </form>
      </div>
   </div>
</div>
</body>
</html>