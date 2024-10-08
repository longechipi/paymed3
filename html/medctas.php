<?php 
include('../layouts/header.php');
require('../conf/conexion.php');
$cod_med = $_GET['id'];
?>

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <?php include("../layouts/menu.php"); ?>
            <div class="layout-page">
                <?php include("../layouts/navbar.php"); ?>
                <?php 
                    $a ="SELECT * FROM medicos WHERE idmed = $cod_med";
                    $ares=$mysqli->query($a);
                    $row = mysqli_fetch_array($ares);
                    $nom_comple = strtoupper($row['apellido1']) . ' ' .strtoupper($row['apellido2']) . '' .strtoupper($row['nombre1']) . ' ' . strtoupper($row['nombre2']);
                  
                  
                ?>
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">    
                            <div class="col-lg-12 mb-12 order-0">
<div class="card">
    <div class="d-flex align-items-end row">
        <div class="col-12">
            <div class="card-body">
                <h5 class="card-title text-primary">Editando al Dr(a):  <?php echo $nom_comple;?></h5>
                <form id="upd_banco">
				<input type="text" name="idmed_banco" id="idmed_banco" value="<?php echo $cod_med; ?>"  hidden/>
                <input type="text" name="idlogin_med" id="idlogin_med" value="<?php echo $row['idlogin']; ?>"  hidden/>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="apellido1">Titular </label>
							<input type="text" name="titular" id="titular" value="<?php echo strtoupper($row['apellido1']).' '. strtoupper($row['apellido2']).' '. strtoupper($row['nombre1']).' '. strtoupper($row['nombre2']); ?>" class="form-control" readonly>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="nrodoc">Nro. Documento:</label>
							<input type="text" name="nrodoc" id="nrodoc" value="<?php echo $row['nrodoc'];?>" class="form-control mb-3" readonly>
						</div>
					</div>
				</div>
				<div class="row">
					<?php 
					//--------- DATA DE CUENTAS NACIONALES ---------//
					$a1 = ("SELECT a.idlogin, a.titular, a.nrodoc, a.idbco, b.banco, a.idtipocuenta, c.tipocuenta,  a.nrocuenta, a.idestatus, d.idmed
                            FROM datbconac a
                            LEFT JOIN bancos b ON a.idbco = b.idbco
                            LEFT JOIN tipocuenta c ON a.idtipocuenta=c.idtipocuenta
                            LEFT JOIN medicos d ON a.idlogin = d.idlogin
                            WHERE d.idmed = $cod_med");
					$a1res=$mysqli->query($a1);
					$row_cnt_nac = $a1res->num_rows;
					if($row_cnt_nac > 0){
						$row1=$a1res->fetch_array();
					}
					//--------- DATA SI TIENE CUENTA INTERNACIONAL --------//
					$a2 = "SELECT CI.*, P.pais, B.banco, M.idmed
                            FROM datbcoint CI
                            INNER JOIN paises P ON CI.idpais = P.idpais
                            INNER JOIN bancos B ON CI.idbco = B.idbco
                            INNER JOIN medicos M ON CI.idlogin = M.idlogin
                            WHERE M.idmed = $cod_med
                            AND B.idestatus = 1
                            AND P.idestatus = 1";
					$a2res=$mysqli->query($a2);
					$row_cnt = $a2res->num_rows;
					if($row_cnt > 0){
						$row2=$a2res->fetch_array();
					}	
					?>
					<div class="divider">
						<div class="divider-text">Datos Transferencia Nacional</div>
					</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="idbco">Banco:</label>
						<select id="idbco" class="form-select mb-3" name="idbco" required>
							<?php
							echo $row_cnt_nac > 0 ? '<option value="'.$row1['idbco'].'">'.$row1['banco'].'</option>' : '<option value="" selected disabled>Seleccionar</option>';
							?>
							<?php
							$query = $mysqli -> query ("SELECT idbco, banco FROM bancos WHERE tipo='1' AND idestatus='1'");
							while ($valores = mysqli_fetch_array($query)) {
							echo '<option value="'.$valores['idbco'].'">'.$valores['banco'].'</option>';
						} ?>
						
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="idtipocuenta">Tipo Cta:</label>
						<select id="idtipocuenta" class="form-select" name="idtipocuenta" required>
							<?php echo $row_cnt_nac > 0 ? '<option value="'.$row1['idtipocuenta'].'">'.$row1['tipocuenta'].'</option>' : '<option value="" selected disabled>Seleccionar</option>'; ?>
						<?php
							$query = $mysqli -> query ("SELECT idtipocuenta, tipocuenta FROM tipocuenta WHERE idestatus='1'; ");
							while ($valores = mysqli_fetch_array($query)) {
							echo '<option value="'.$valores['idtipocuenta'].'">'.$valores['tipocuenta'].'</option>';
						} ?>
						
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="nrocuenta">Nro. Cuenta: <span><small>(Solo Nùmeros, 20 Digitos)</small></span> </label>
							<?php echo $row_cnt_nac > 0 ? '<input type="text" name="nrocuenta" id="nrocuenta" minlength="20" maxlength="20" value="'.$row1['nrocuenta'].'" class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>' : '<input type="text" name="nrocuenta" id="nrocuenta" minlength="20" maxlength="20" placeholder="0000-0000-00-0000000000" class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>';?>
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-group">
						<label for="nrocuenta">¿Posee Cuenta Internacional?</label>
						<select name="bank_inter" class="form-select" id="bank_inter" required>
							<option value="" selected disabled>Seleccionar</option>
							<option value="0">No</option>
							<option value="1">Si</option>
						</select>
					</div>
				</div>
			<div class="row" id="cuenta_inter" hidden>
				<div class="divider">
					<div class="divider-text">Datos Transferencia Internacional</div>
				</div>
			
				<div class="col-md-3 mb-3">
					<div class="form-group">
						<label for="idpais" class="control-label">Pais:</label>
						<select id="idpais" class="form-control" name="idpais" >
							<?php echo $row_cnt > 0 ? '<option value="'.$row2['idpais'].'">'.$row2['pais'].'</option>' : '<option value="" selected disabled>Seleccionar</option>'; ?>
							<?php
							$query = $mysqli -> query ("SELECT idpais, pais FROM paises WHERE idestatus='1';");
							while ($valores = mysqli_fetch_array($query)) {
							echo '<option value="'.$valores['idpais'].'">'.$valores['pais'].'</option>';
							} ?>
						</select>
					</div>
				</div> 

				<div class="col-md-3">
					<div class="form-group">
						<label for="idbcoint">Banco:</label>
						<select id="idbcoint" class="form-select" name="idbcoint" >
						<?php echo $row_cnt > 0 ? '<option value="'.$row2['idbco'].'">'.$row2['banco'].'</option>' : '<option value="" selected disabled>Seleccionar</option>'; ?>
							<?php
							$query = $mysqli -> query ("SELECT idbco, banco FROM bancos WHERE tipo='2' AND idestatus='1' ; ");
							while ($valores = mysqli_fetch_array($query)) {
							echo '<option value="'.$valores['idbco'].'">'.$valores['banco'].'</option>';
						} ?>
						
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="nrocuentaint">Nro. Cuenta:</label>
							<?php echo $row_cnt > 0 ? '<input type="text" name="nrocuentaint" id="nrocuentaint" minlength="8" maxlength="11" value="'.$row2['nrocuenta'].'" class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>' : '<input type="text" name="nrocuentaint" id="nrocuentaint" minlength="8" maxlength="11" placeholder="00000000000" class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>'; ?>
					</div>
				</div>
				<!-- 3ra -->
				<div class="col-md-4">
					<div class="form-group">
						<label for="ach">ACH:</label>
							<?php echo $row_cnt > 0 ? '<input type="text" name="ach" id="ach" value="'.$row2['ach'].'" class="form-control">' : '<input type="text" name="ach" id="ach" placeholder="00000000000" class="form-control">';?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="swit">SWIT:</label>
							<?php echo $row_cnt > 0 ? '<input type="text" name="swit" id="swit" value="'.$row2['swit'].'" class="form-control">' : '<input type="text" name="swit" id="swit" placeholder="00000000000" class="form-control">';?>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="aba">ABA:</label>
							<?php echo $row_cnt > 0 ? '<input type="text" name="aba" id="aba" value="'.$row2['aba'].'" class="form-control">' : '<input type="text" name="aba" id="aba" placeholder="00000000000" class="form-control">';?>
					</div>
				</div>
				<!-- 4ta -->
				<div class="col-md-8">
					<div class="form-group">
						<label for="dircta">Dirección Cuenta:</label>
							<?php echo $row_cnt > 0 ? '<input type="text" name="dircta" id="dircta" value="'.$row2['dircta'].'" class="form-control">' : '<input type="text" name="dircta" id="dircta" placeholder="Dirección de la Cuenta" class="form-control">';?>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="telf_inter">Teléfono:</label>
							<?php echo $row_cnt > 0 ? '<input type="text" name="telf_inter" id="telf_inter" maxlength="10" minlength="10" value="'.$row2['telefono'].'" class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>' : '<input type="text" name="telf_inter" id="telf_inter" maxlength="10" minlength="10" placeholder="0000000000" class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>';?>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="codpostalint">Cod.Postal:</label>
							<?php echo $row_cnt > 0 ? '<input type="text" name="codpostalint" id="codpostalint" maxlength="5" minlength="5" value="'.$row2['codpostal'].'" class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>' : '<input type="text" name="codpostalint" id="codpostalint" maxlength="5" minlength="5" placeholder="00000" class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>';?>
					</div>
				</div>
				</div>
			</div>

			<div class="text-center mt-4">
				<button type="submit" id="btn_upd_banco" class="btn btn-primary"><i class="fi fi-rs-disk"></i> ACTUALIZAR</button>
				<a href="javascript:history.back()" class="btn btn-outline-warning" rel="noopener noreferrer"><i class="fi fi-rr-undo"></i> VOLVER </a>
			</div>
			</form>
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
$(document).ready(function () {
$("#bank_inter").change(function () {
    const selectedOption = $(this).val();
    const requiredElements = ["telf_inter", "codpostalint", "dircta", "aba", "swit", "ach", "nrocuentaint"];
    if (selectedOption === "1") {
        $("#cuenta_inter").removeAttr("hidden");
        requiredElements.forEach(elementId => {
            $("#" + elementId).attr("required", true);
        });
    } else {
        $("#cuenta_inter").attr("hidden", true);
        requiredElements.forEach(elementId => {
            $("#" + elementId).removeAttr("required");
        });
    }
});
$("#upd_banco").submit(function (e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "../model/perfil/medicos/datos_bancarios.php",
        data: $(this).serialize(),
        success: function (data) {
            if(data == 1){
                Swal.fire({
                    title: 'Actualización Exitosa!',
                    text: 'Se Actualizo correctamente los datos Bancarios',
                    icon: 'success',
                    confirmButtonColor: "#007ebc",
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "rpt_med.php";
                    }
                });
            }else{
                Swal.fire({
                    title: 'Error!',
                    text: 'Ocurrio un Error al Actualizar los Datos Bancarios ',
                    icon: 'error',
                    confirmButtonColor: "#007ebc",
                    confirmButtonText: 'Aceptar'
                });
            }
        }
    });
});
});
</script>
<!-- Adicionales -->
<script src="../js/direcciones.js"></script>
<script src="../js/fun_globales.js"></script>
</body>
</html>