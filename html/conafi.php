<?php 
include('../layouts/header.php');
require('../conf/conexion.php');
$idmed = $_GET['idmed'];
?>

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <?php include("../layouts/menu.php"); ?>
            <div class="layout-page">
                <?php include("../layouts/navbar.php"); ?>
                <?php 
                    $a ="SELECT * FROM medicos WHERE idmed = $idmed";
                    $ares=$mysqli->query($a);
                    $row = mysqli_fetch_array($ares);
                    $nom_comple = strtoupper($row['apellido1']) . ' ' .strtoupper($row['apellido2']) . ', ' .strtoupper($row['nombre1']) . ' ' . strtoupper($row['nombre2']);
                  
                  
                ?>
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">    
                            <div class="col-lg-12 mb-12 order-0">
<div class="card">
    <div class="d-flex align-items-end row">
        <div class="col-12">
            <div class="card-body">
                <h5 class="card-title text-primary">Editando al Dr(a): <?php echo $nom_comple;?></h5>
                <?php 
			 $sql = "SELECT idservaf, servicio, idestatus FROM serviciosafiliados where idestatus='1'";
			 $result=$mysqli->query($sql);
			// busco imagenes de firma, si tiene 
			$sql = ("SELECT iddocument, idmed, imagen, quees FROM drdocument WHERE idmed='$idmed' AND quees='firma'; ");
			$obj=$mysqli->query($sql); 
			if($obj->num_rows > 0){
				$arr=$obj->fetch_array();
				$firmaimg=$arr['imagen'];
			}else{
				$firmaimg='';
			}
			// busco imagenes de sello, si tiene 
			$sql = ("SELECT iddocument, idmed, imagen, quees FROM drdocument WHERE idmed='$idmed' AND quees='sello'; ");
			$obj=$mysqli->query($sql); 
				if($obj->num_rows > 0){
				$arr=$obj->fetch_array();
				$selloimg=$arr['imagen'];
			}else{
				$selloimg='';
			}
			?>
			<div class="row">
				<form enctype="multipart/form-data" action="../model/perfil/medicos/serv_afiliado_documentos.php" method="post">
					<input type="text" id="idmed" name="idmed" value="<?php echo $idmed; ?>" hidden>
                    <input type="text" id="nrodoc" name="nrodoc" value="<?php echo $row['nrodoc']; ?>" hidden>

					<div style="text-align: left;">
						<div class="row">
						<?php while($row = mysqli_fetch_array($result)) { 
							$sqlbusca="SELECT COUNT(*) as cant FROM convafixmedico WHERE idmed= '".$idmed."' and  idservaf = '".$row['idservaf']."'; ";
							$obj=$mysqli->query($sqlbusca);
							$arrlast=$obj->fetch_array();
							$cant=$arrlast[0];
						?>
							<div class="col-md-3">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="<?php echo $row['idservaf'];?>"  onclick="fcheckafilia(this.id)" 
									<?php if ($cant!='0') { ?>
									checked
									<?php } ?>
									>
									<label class="form-check-label" for="<?php echo $row['idservaf'];?>">
										<?php echo $row['servicio'];?>
									</label>
								</div>
							</div>
						<?php } ?>
							
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<h5>Firma:</h5>
							<div class="custom-file">
								<input type="file" id="firma" name="imagen" class="form-control" accept="image/png, image/jpeg" >  
								<label id="firma" class="custom-file-label" for="firma"></label> 
								<small style="color: red" >Formato permitido: Png/Jpg</small>
							</div>
						</div>
						<div class="col-md-6">
							<h5>Sello:</h5>
							<div class="custom-file">
								<input type="file" id="sello" name="imagen1" class="form-control" accept="image/png, image/jpeg" >  
								<label id="sello" class="custom-file-label" for="sello"></label> 
								<small style="color: red" >Formato permitido: Png/Jpg</small>
							</div>
						</div>
						<!-- Imagenes -->
						<div align="center" class="col-md-6">
							<img class="img-fluid" src="<?php echo $firmaimg ? "../upload/documentos_medicos/".$firmaimg : "../assets/img/elements/sinfoto.jpg"; ?>" alt="Sin Imagen Seleccionada!!!" class="img-fluid">
						</div>
						<div align="center" class="col-md-6">
							<img class="img-fluid" src="<?php echo $selloimg ? "../upload/documentos_medicos/".$selloimg : "../assets/img/elements/sinfoto.jpg"; ?>" alt="Sin Imagen Seleccionada!!!" class="img-fluid">
						</div>
					</div>
                   <div class="text-center">
                    <button type="submit" class="btn btn-primary"> CARGAR DOCUMENTOS</button>
                   </div>

				</form>
			</div>
            <div class="text-center mt-4">
        <a href="javascript:history.back()" class="btn btn-outline-warning" rel="noopener noreferrer">
            <i class="fi fi-rr-undo"></i> VOLVER 
        </a>
    </div>
		</div>

            </div>
        </div>
    </div>
 </div> <!--fin card -->
</div>
</div>
</div>
<?php include('../layouts/footer.php')?>
                </div>
            </div>
    </div>
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
</div>
<?php include('../layouts/script.php')?>
<script>
    function fcheckafilia(id){
        const idmed = $("#idmed").val();
    jQuery.ajax({
        type: "POST",   
        url: "../model/perfil/medicos/serv_afiliados_med.php",
        data: {id: id, idmed: idmed},
        success:function(data){ 
            console.log(data);
            if (data!='1') {
            }
        }
    });
}
		</script>
<!-- Adicionales -->
<script src="../js/direcciones.js"></script>
<script src="../js/fun_globales.js"></script>
</body>
</html>