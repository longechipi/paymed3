<?php 
$a="SELECT A.idasist, A.idlogin, A.nrodoc, A.apellidos, A.nombres, A.movil, A.correo, L.clave
FROM asistentes A
INNER JOIN loginn L ON A.idlogin = L.idlogin 
WHERE A.idlogin =$idlogin";
$ares = $mysqli->query($a);
$row = $ares->fetch_array();
?>
<div class="row">
<form id="upd_datos">
<input type="hidden" name="idlogin" value="<?php echo $idlogin; ?>">
<div class="row"> <!--INICIO ROW 1 -->
    <div class="divider">
        <div class="divider-text">Datos de Principales</div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="apellidos">Apellidos</label>
            <input type="text" name="apellidos" id="apellidos" value="<?php echo $row['apellidos']; ?>" class="form-control" style="text-transform:uppercase;" required />
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="form-group">
            <label for="nombres">Nombres</label>
            <input type="text" name="nombres" id="nombres" value="<?php echo $row['nombres']; ?>" class="form-control" style="text-transform:uppercase;" />
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="form-group">
            <label for="nrodoc">Cedula </label>
            <input type="text" name="nrodoc" id="nrodoc" value="<?php echo $row['nrodoc']; ?>" class="form-control" style="text-transform:uppercase;" required />
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <div class="form-group">
            <label for="telf">Telefono </label>
            <input type="text" name="telefono" id="telefono" value="<?php echo $row['movil']; ?>" class="form-control" style="text-transform:uppercase;" />
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="clave">Contraseña</label>
            <input type="password" name="clave" id="clave" class="form-control" value="<?php echo $row['clave'];?>">
            
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="clave2">Repetir Contraseña</label>
            <input type="password" name="clave2" id="clave2" class="form-control" value="<?php echo $row['clave'];?>">
            
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="correo">Correo:</label>
            <input type="email" name="correo" value="<?php echo $row['correo']; ?>" id="correo" class="form-control" readonly>
            <small class="mb-3">Por razones de seguridad el correo no se puede modificar</small>
        </div>
    </div>
</div> <!--FIN ROW 1 -->
    <div class="text-center mt-6">
        <button type="submit" class="btn btn-primary"><i class="fi fi-rs-disk"></i> GUARDAR</button>
        <a href="javascript:history.back()" class="btn btn-outline-warning" rel="noopener noreferrer"><i class="fi fi-rr-undo"></i> VOLVER </a>
    </div>
</form>
</div>