<?php $idfrecuencia=$_GET['idfrecuencia']; ?>
<html>
<head>
   <meta charset="utf-8">
   <title>Dashboard | PayMed</title>
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
   <div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-body">
				<center><img src="media/delete.jpg" width="236" height="122" /></center>
           </div>
           <div class="modal-footer">
            <?php echo '<a href="delfrecuencia.php?idfrecuencia='.$idfrecuencia.'" class="btn btn-success" role="button" aria-pressed="true">Eliminar</a>'; ?> 
            <a href="rpt_frecuencia.php" class="btn btn-danger" role="button" aria-pressed="true">Cancelar</a>          
           </div>
      </div>
   </div>
</div>
</body>
</html>