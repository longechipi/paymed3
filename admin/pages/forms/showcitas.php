<?php   // Muestra fecha de citas futuras 
   session_start();
	require('../../conexion.php');
   if (isset($_GET['idpc'])) {
      $idpc=$_GET['idpc']; $fechacita=$_SESSION['sefechacita'];$horacita=$_SESSION['sehoracita'];$hoy=date('Y-m-d');
   }else{
      echo '<script language="javascript">window.location.href="../../cerrar.php"; </script>';
   }
   $fechacita=$_SESSION['sefechacita'];$horacita=$_SESSION['sehoracita'];
   $sqlbuscita = ("SELECT  idcita, idpaci, fechacita, horacita, fechasoli, nombre, apellido, correo 
                  FROM citas WHERE idpaci='".$idpc."' AND fechacita>= '".$hoy."';");
   //echo $sqlbuscita; exit();
   $result=$mysqli->query($sqlbuscita); //$rowbuscita = mysqli_fetch_array($arrbuscita);
?>
<html>
<head>
   <meta charset="utf-8">
   <title>Dashboard | PayMed</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/material-icons@1.13.12/iconfont/material-icons.min.css">
   <style>
    .blue-color {
        color:blue;
    }
     
    .green-color {
        color:green;
    }
     
    .teal-color {
        color:teal;
    }
     
   </style>
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
                  <h2>Paciente Con Citas En Fecha(s):</h2>
    				    <?php $tienecita='N';
                     while ($row = mysqli_fetch_array($result)) { 
                        $fechacitamostrar = date("d-m-Y", strtotime($row['fechacita']));
                        ?>
                        <?php if ($row['fechacita']==$hoy) { $tienecita='S';?>
                              <h3 style="color:red;"><?php echo $fechacitamostrar; ?><br><small><strong>Cita Hoy</strong></small> </h3>
                           <?php  }else{ ?>
                           <h4><span class='material-icons green-color'>done_outline</span> <?php echo $fechacitamostrar; ?></h4>
                        <?php  } ?>
                   <?php }?>
			      </div>
			   <div class="modal-footer">
               <?php if ($tienecita!='S') { ?>
					    <a href="regcitapac.php?idpc=<?php echo $idpc;?>" class="btn btn-success" role="button" aria-pressed="true">Continuar</a>
                   <a href="preregpac.php" class="btn btn-info" role="button" aria-pressed="true">Volver</a>
               <?php }else{ ?>
                  <a href="preregpac.php" class="btn btn-info" role="button" aria-pressed="true">Volver</a>
               <?php } ?>
			   </div>
           </form>
      </div>
   </div>
</div>
</body>
</html>