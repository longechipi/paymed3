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
                <form enctype="multipart/form-data" action="../model/perfil/medicos/add_doc.php" method="post">
				<input type="text" id="idmed" name="idmed" value="<?php echo $idmed; ?>" hidden/> 
                <input type="text" id="idlogin" name="idlogin" value="<?php echo $idlogin; ?>" hidden/> 
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
						<label for="codcolmed">Código Colegio Médico</label>
						<input type="text" name="codcolemed" id="codcolemed" minlength="9" maxlength="9" value="<?php echo $row['codcolemed']; ?>" class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;"  />
						</div>  
					</div>

					<div class="col-md-6">
						<div class="form-group">
						<label for="codcolmed">MPSS</label>
						<input type="text" name="mpsscod" id="mpsscod"  minlength="5" maxlength="5" value="<?php echo $row['mpss']; ?>" class="form-control mb-4" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;"  />
						</div>  
					</div>

					<div class="col-md-3">
						<label for="cedula">Cédula</label>
						<div class="custom-file">
						<input type="file" id="cedula" name="imagen" class="form-control" accept="image/jpeg, image/png, image/jpg, image/webp, application/pdf">
						</div>
					</div>
					<div class="col-md-3">
					<label for="rif">RIF</label>
						<div class="custom-file">
						<input type="file" id="rif" name="imagen1" class="form-control" accept="image/jpeg, image/png, image/jpg, image/webp, application/pdf">
						</div>
					</div>
					
					<div class="col-md-3">
					<label for="colemed">Carnet C.M.</label>
						<div class="custom-file">
						<input type="file" id="colemed" name="imagen2" class="form-control" accept="image/jpeg, image/png, image/jpg, image/webp, application/pdf">
						</div>
					</div>
					<div class="col-md-3">
					<label for="colemed">MPSS</label>
						<div class="custom-file">
							<input type="file" id="mpss" name="imagen3" class="form-control" accept="image/jpeg, image/png, image/jpg, image/webp, application/pdf">
						</div>
					</div>
                    
<div class="row">
    <div class="text-center mt-3">
        <p class="text-danger">Formatos Permitos por el Sistema: jpeg - png - jpg - pdf</p>
    </div>
</div>
					<div class="text-center">
						<button type="submit" class="btn btn-primary mt-2"><i class="fi fi-rs-cloud-upload"></i> Actualizar </button>
					</div>


				</div>
			</form>
			<div class="table-responsive">
				 <table class="table table-hover mt-4" id="user3" cellspacing="0" style="width: 100%;">
					<thead>
						<tr>
							<th>Documento</th>
							<th>Accion</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$sql = ("SELECT iddocument, idmed, imagen, quees FROM drdocument WHERE idmed='$idmed' AND quees NOT IN ('firma', 'sello')");
						$objimg=$mysqli->query($sql);
						while($rowdoc = mysqli_fetch_array($objimg)) { ?>
						<tr>
						<td>
							
						<a href="../upload/doc_medicos/<?php echo $rowdoc['imagen'];?>" target="_blank"><?php echo $rowdoc['imagen']; ?></a>
						</td>
						<td align="center">
							<button type="button" onclick="fdeldoc(<?php echo $rowdoc['iddocument'];?>)" class="btn btn-primary btn-sm"><i class="fi fi-rr-delete-user"></i></button>
							
						</td>
						</tr>
					<?php } ?>

					</tbody>

				 </table>
			</div>
        <div class="text-center mt-4">
				<a href="javascript:history.back()" class="btn btn-outline-warning" rel="noopener noreferrer">
					<i class="fi fi-rr-undo"></i> VOLVER 
				</a>
			</div>

            </div>
        </div>
    </div>
 </div> <!--fin card -->
</div>
</div>
</div>

                    <?php 
                    include('../layouts/modals/add-horarios.php');
                    include('../layouts/footer.php')?>
                    
            
                </div>
            </div>
    </div>
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
</div>
<?php include('../layouts/script.php')?>
<script>
function fdeldoc(id) {
const idmed = $("#idmed").val();
    $.ajax({
        type: "POST",
        url: "../model/perfil/medicos/del_docs.php",
        data: { id: id, idmed: idmed },
        success: function (data) {
            if(data == 1){
                Swal.fire({
                    title: "Documento Eliminado",
                    text: "Elimino con Exito el Documento y el Registro seleccionado",
                    icon: "success",
                    confirmButtonColor: "#007ebc",
                    confirmButtonText: "Aceptar"
                })
                var tabla = document.getElementById("user3");
                var filas = tabla.getElementsByTagName("tr");
                for (var i = 0; i < filas.length; i++) {
                    var celdas = filas[i].getElementsByTagName("td");
                    if (celdas.length > 0) {
                        var boton = celdas[celdas.length - 1].getElementsByTagName("button")[0];
                            if (boton.getAttribute("onclick").includes(id)) {
                                tabla.deleteRow(i);
                                break;
                            }
                    }
                }
            }else{
                Swal.fire({
                    icon: "error",
                    title: "Error al Eliminar",
                    text:"Ocurrio un error al Eliminar el Documento",
                    confirmButtonText: "Volver",
                    confirmButtonColor: "#005e43",
                })
            }
            if(data == 3){
                Swal.fire({
                    icon: "error",
                    title: "No se encuentra el documento",
                    text:"Ocurrio un error al Eliminar el Documento",
                    confirmButtonText: "Volver",
                    confirmButtonColor: "#005e43",
                    }).then(function() {
                        window.location.href = "../../../html/perfil.php";
                    });

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