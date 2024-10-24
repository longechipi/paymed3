<?php 
require('../../conf/conexion.php');
 

$a="SELECT C.*, E.estatus
FROM citas C 
LEFT JOIN estatus E ON C.idestatus = E.idestatus
WHERE idcita = ".$_POST['cita_id']."";
$ares=$mysqli->query($a);
$row=$ares->fetch_assoc();
?>

<div class="divider">
    <div class="divider-text">Datos del Paciente</div>
</div>
<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label for="inputName">Historia #:</label>
            <input type="text" class="form-control" name="historia" id="historia" value="<?php echo $row['historia']; ?>" readonly/>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="inputName">Paciente:</label>
            <input type="text" class="form-control" name="nom_pac" id="nom_pac" value="<?php echo strtoupper($row['apellido']) . ' '. strtoupper($row['nombre']) ?>" readonly/>
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="inputName">Telf:</label>
            <input type="text" class="form-control" name="telf" id="telf" value="<?php echo $row['telefono']; ?>" readonly/>
        </div>
    </div>

    <div class="col-md-5">
        <div class="form-group">
            <label for="inputName">Correo:</label>
            <input type="text" class="form-control" name="correo" id="correo" value="<?php echo $row['correo']; ?>" readonly/>
        </div>
    </div>

</div>

<div class="divider">
    <div class="divider-text">Reagendamiento </div>
</div>
<div class="row">
    <form id="agendar">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="inputName">Dia de la Consulta:</label>
                    <input type="date" class="form-control" name="dia_cita" id="dia_cita" min="<?php echo date('Y-m-d'); ?>">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="inputName">Hora de la Consulta:</label>
                    <select class="form-select" name="hora_cita" id="hora_cita">
                        <option selected disabled value="">Seleccione</option>
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary mt-5"><i class="fi fi-rs-disk"></i> ACTUALIZAR</button>
                </div>
            </div>

        </div>
    </form>
</div>
<div class="divider">
    <div class="divider-text">Estatus </div>
</div>
<div class="row">
    <form id="change" action="../model/reg_cita/re-agendar.php"  method="post">
    <div class="row">
        <input type="text" name="id_cita" id="id_cita" value="<?php echo $_POST['cita_id'] ?>" hidden />
        <div class="col-md-5">
            <label for="rif">Estatus:</label>
                <div class="input-group">
                    <select id="estatus" class="form-select" name="estatus" required>
                        <?php
                        $aa = $mysqli->query("SELECT idestatus, estatus FROM estatus WHERE idestatus IN (3, 6, 7)");
                        while ($rowa = mysqli_fetch_array($aa)) {
                            if ($rowa['idestatus'] == $row['idestatus']) {
                                echo '<option value="' . $rowa['idestatus'] . '" selected>' . $rowa['estatus'] . '</option>';
                            } else {
                                echo '<option value="' . $rowa['idestatus'] . '">' . $rowa['estatus'] . '</option>';
                            }
                        } ?>
                    </select>
                </div>
            </div>
        <div class="col-md-5">
            <div class="form-group">
                <button type="submit" class="btn btn-primary mt-5"><i class="fi fi-rs-disk"></i> ACTUALIZAR</button>
            </div>
        </div>
    </div>
    </form>
</div> 
