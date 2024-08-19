<?php 
   session_start();
   date_default_timezone_set('America/Caracas');
   $usuario = $_SESSION['usuario'];
   $idlogin = $_SESSION['idlogin'];
   if(isset($_GET['xy'])){
      $id=$_GET['xy'];
   }else{
      exit();
   }
  ?>
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
				<center>
               <img src="media/delete.jpg" width="236" height="122" />
               <!--h3>Contacte al Administrador<br> Para Esta Acciòn.</h3-->
            </center>
           </div>
           <div class="modal-footer">
            <?php echo '<a href="delasist.php?xy='.$id.'" class="btn btn-success" role="button" aria-pressed="true">Eliminar</a>'; ?> 
            <a href="rpt_asist.php" class="btn btn-warning" role="button" aria-pressed="true">Volver</a>          
           </div>
      </div>
   </div>
</div>
</body>
</html>