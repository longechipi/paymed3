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
                <div class="divider">
				<div class="divider-text">Especialidades Médicas</div>
			</div>
			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
						<label for="idespmed">Especialidad</label>
                        <input type="text" id="idmed" name="idmed" value="<?php echo $idmed; ?>" hidden/>
						<select class="form-select" id="idespmed" name="idespmed">
							<option value="" disabled selected>Seleccione</option>
							<?php
							$a3 = $mysqli -> query ("SELECT idespmed, especialidad FROM especialidadmed WHERE idestatus = 1");
							while ($row3 = mysqli_fetch_array($a3)) {
							echo '<option value="'.$row3['idespmed'].'">'.$row3['especialidad'].'</option>'; } ?>
						</select>
					</div>
				</div>
				<div class="col-md-7">
				<?php 
				$b = "SELECT c.idespmed, c.especialidad FROM medicos a, medicos_esp b, especialidadmed c
				WHERE a.idmed= $idmed and a.idmed=b.idmed and b.idespmed =c.idespmed and a.idestatus='1'";
				$bres=$mysqli->query($b);
				?>
				<div class="table-responsive">
					<table class="table table-hover" id="tblesp" cellspacing="0" style="width: 100%;">
					<thead>
						<tr>
							<th>Especialidad Seleccionada</th>
							<th>Acción</th>
						</tr>
						</thead>
						<tbody>
							<?php
								while ($row = $bres->fetch_array(MYSQLI_ASSOC)) {
								echo '<tr>';
								echo '<td>'.$row['especialidad'].'</td>';
								echo '<td><button class="btn btn-primary" type="button" onclick="borrar('.$row['idespmed'].')" id="del-'.$row['idespmed'].'"><i class="fi fi-rr-delete-user"></i></button></td>';
								echo '</tr>';
								}
							?>
						</tbody>
					</table>
					</div>
					
				</div>
			</div> <!-- FIN DE ROW 2 -->

        <div class="row"> 
            <div class="divider">
                <div class="divider-text">Horarios de Atención</div>
            </div>
            <div class="text-center mb-5">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <i class="fi fi-rs-disk"></i> Agregar Horarios de Atención
                </button>
            </div>
	
			<div class="table-responsive">
				<table class="table table-hover" id="user2" cellspacing="0" style="width: 100%;">
				<thead>
					<tr>
						<th>Clinica</th>
						<th>Horario de Atención</th>
						<th>Accion</th>
					</tr>
				</thead>
					<tbody>
						<?php
						$c = "SELECT HM.idclinica, HM.idmed, C.razsocial, HM.dia, HM.desde, HM.hasta
								FROM horariomed HM
								INNER JOIN clinicas C ON C.idclinica = HM.idclinica
								WHERE idmed= $idmed";
							$cres=$mysqli->query($c);
							while ($rowc = $cres->fetch_array(MYSQLI_ASSOC)) {
								$desde=date("g:iA", strtotime($rowc['desde']));
								$hasta=date("g:iA", strtotime($rowc['hasta']));
							echo '<tr>';
							echo '<td>'.$rowc['razsocial'].'</td>';
							echo '<td>'.$rowc['dia'].' : '.$desde.'-'.$hasta.'</td>';
							echo '<td><button class="btn btn-primary" type="button" onclick="borrarcli('.$rowc['idclinica'].')" id="del-'.$rowc['idclinica'].'"><i class="fi fi-rr-delete-user"></i></button></td>';
							echo '</tr>';
							}
						?>
                    </tbody>
				</table>
			</div>
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
$("#idespmed").change(function () {
    const idespmed = $("#idespmed").val();
    const idmed = $("#idmed").val();
    $.ajax({
        type: "POST",
        url: "../model/perfil/medicos/datos_especialidades.php",
        data: { idespmed: idespmed, idmed: idmed },
        success: function (data) {
            if(data == 2){
                Swal.fire({
                    title: 'Error!',
                    text: 'La especialidad seleccionada ya esta incluida anteriormente',
                    icon: 'error',
                    confirmButtonColor: "#007ebc",
                    confirmButtonText: 'Aceptar'
                });
                return false;
            }
            const arrdata = data.split('-');
            const id =arrdata[0];
            const espe =arrdata[1];
            document.getElementById("tblesp").insertRow(-1).innerHTML = '<tr><td>'+espe+'</td><td><button class="btn btn-primary" type="button" onclick="borrar('+id+')" id="del-'+id+'"><i class="fi fi-rr-delete-user"></i></button></td></tr>';
        }
    });
});
function borrar(id) {
    const idmed = $("#idmed").val();
    $.ajax({
        type: "POST",
        url: "../model/perfil/medicos/del_espe.php",
        data: { id: id, idmed: idmed },
        success: function (data) {
            var tabla = document.getElementById("tblesp");
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
        }
    });
}

function borrarcli(id) {
    const idmed = $("#idmed").val();
    $.ajax({
        type: "POST",
        url: "../model/perfil/medicos/del_cli.php",
        data: { id: id, idmed: idmed },
        success: function (data) {
            var tabla = document.getElementById("user2");
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
        }
    });
}
$('#idespmed').select2({
    theme: 'bootstrap-5',
    width: '100%',
});
</script>
<!-- Adicionales -->
<script src="../js/direcciones.js"></script>
<script src="../js/fun_globales.js"></script>
</body>
</html>