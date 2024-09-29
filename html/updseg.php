<?php 
include('../layouts/header.php');
require('../conf/conexion.php');
?>

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <?php include("../layouts/menu.php"); ?>
            <div class="layout-page">
                <?php include("../layouts/navbar.php"); ?>
                <?php 
                   $idaseg=$_GET['id'];
                   $sql = ("SELECT a.idaseg, a.idlogin, a.idtiposeg,a.rif, a.razsocial, a.movil, a.ttelf, a.telefono, a.correo, 
                        a.idpais, b.pais, a.idestado, c.estado, a.idmunicipio, d.municipio, a.idparroquia, e.parroquia,
                        a.calleav, a.casaedif, a.piso, a.oficina, a.urbanizacion, a.codpostal, a.idestatus, es.estatus, a.fechahora_sist, a.fecharegistro
                        FROM aseguradores a, paises b, estado c, municipios d, parroquias e, estatus es
                        WHERE a.idaseg='".$idaseg."'
                        AND a.idpais=b.idpais 
                        and a.idestado=c.idestado 
                        and a.idmunicipio=d.idmunicipio 
                        and a.idparroquia=e.idparroquia
                        AND a.idestatus = es.idestatus");
                     $objaseg=$mysqli->query($sql);
                     $arraseg = mysqli_fetch_array($objaseg);
                     $tprif        = substr($arraseg['rif'], 0,1);
  				$rif          = substr($arraseg['rif'], 1,9);
  				$idtiposeg    = $arraseg['idtiposeg'];
  				$razsocial    = $arraseg['razsocial'];
  				$fecmod       = $arraseg['fechahora_sist'];
				  $fecreg       = $arraseg['fecharegistro']; 
  				$movil        = $arraseg['movil'];
  				$tipotlf      = $arraseg['ttelf'];
  				$telefono     = $arraseg['telefono'];
  				$correo       = $arraseg['correo'];
  				$idpais       = $arraseg['idpais'];
  				$pais         = $arraseg['pais'];
  				$idestado     = $arraseg['idestado'];
  				$estado       = $arraseg['estado'];
  				$idmunicipio  = $arraseg['idmunicipio'];
  				$municipio    = $arraseg['municipio'];
  				$idparroquia  = $arraseg['idparroquia'];
  				$parroquia    = $arraseg['parroquia'];
  				$calleav      = $arraseg['calleav'];
  				$casaedif     = $arraseg['casaedif'];
  				$piso         = $arraseg['piso'];
  				$oficina      = $arraseg['oficina'];
  				$urbanizacion = $arraseg['urbanizacion'];
  				$codpostal    = $arraseg['codpostal'];
  				$idestatus    = $arraseg['idestatus'];
       
                ?>
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">    
<div class="col-lg-12 mb-12 order-0">
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-12">
                <div class="card-body">
                    <h5 class="card-title text-primary">Editando Seguro: <?php echo $arraseg['razsocial']; ?></h5>
                    <form id="updseg">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="inputName">Código de Seguro</label>
                                    <input type="hidden" name="idaseg" value="<?php echo $idaseg;?>">
                                    <input type="hidden" id="onoffswitch" value="<?php echo $arraseg['idestatus'];?>">
                                    <input type="text" value="SEG-000<?php echo $idaseg;?>" class="form-control mb-3" disabled>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="razsocial">Fecha de Registro:</label>
                                    <input type="text" value="<?php echo $arraseg['fecharegistro'];?>" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="razsocial">Última Modificación:</label>
                                        <input type="text" value="<?php echo $arraseg['fechahora_sist'];?>" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="form-group">
                                    <label for="descripcion">Estatus:</label>
                                        <select id="idestatus" class="form-select" name="idestatus" required>
                                            <option value="<?php echo $arraseg['idestatus']; ?>" selected>
                                                <?php
                                                $sqlst = ("SELECT estatus FROM estatus 
                                                    WHERE idestatus = '" . $arraseg['idestatus'] . "'");
                                                $respst = $mysqli->query($sqlst);
                                                $rowst = mysqli_fetch_array($respst);
                                                echo $rowst['estatus']; ?></option>
                                            <option value="1">Activo</option>
                                            <option value="2">Inactivo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="rif">RIF:</label>
                                    <select class="form-select" id="tprif" name="tprif">
                                        <option value="<?php echo $tprif;?>"><?php echo $tprif;?></option>
                                        <option value="N">N</option>
                                        <option value="J">J</option>
                                        <option value="G">G</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="rif">N° RIF</label>
                                    <input type="text" name="rif" id="rif" value="<?php echo $rif;?>" minlength="9" maxlength="9" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="razsocial">Razón Social:</label>
                                    <input type="text" name="razsocial" id="razsocial" value="<?php echo $razsocial;?>" style="text-transform:uppercase;" class="form-control mb-3" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="descripcion">Tipo Proveedor:</label>
                                    <select id="idtiposeg" class="form-select" name="idtiposeg" required>
                                        <option value="<?php echo $idtiposeg;?>">
                                            <?php $sql = ("SELECT tiposeg FROM tiposeguro WHERE idtiposeg= '".$idtiposeg."'");
                                             $result=$mysqli->query($sql); $vale = mysqli_fetch_array($result);
                                             echo $vale['tiposeg'];?></option>
                                        <?php
                                            $query = $mysqli -> query ("SELECT idtiposeg , tiposeg FROM tiposeguro WHERE idestatus='1' ORDER BY tiposeg ASC");
                                            while ($valores = mysqli_fetch_array($query)) {
                                                echo '<option value="'.$valores['idtiposeg'].'">'.$valores['tiposeg'].'</option>';
                                        } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="descripcion">País:</label>
                                    <select id="idpais" class="form-select" name="idpais" required>
                                        <option value="<?php echo $idpais;?>"><?php echo $pais;?></option>
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
                                    <label for="descripcion">Estado:</label>
                                    <select id="id_estado" class="form-select" name="idestado" required>
                                        <option value="<?php echo $idestado;?>"><?php echo $estado;?></option>
                                    </select>
                                </div>
                            </div> 
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="descripcion">Municipio:</label>
                                    <select id="id_municipio"class="form-select" name="idmunicipio" required>
                                        <option value="<?php echo $idmunicipio;?>"><?php echo $municipio;?></option>
                                    </select>	
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="descripcion">Parroquia:</label>
                                    <select id="id_parroquia" class="form-select mb-3"name="idparroquia" required>
                                        <option value="<?php echo $idparroquia;?>"><?php echo $parroquia;?></option>
                                    </select>	
                                </div>
                            </div>
                            <!-- 7ta  -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="urbanizacion">Urbanización:</label>
                                    <input type="text" name="urbanizacion" id="urbanizacion" value="<?php echo $urbanizacion;?>" style="text-transform:uppercase;" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="calleav">Calle/Avenida:</label>
                                    <input type="text" name="calleav" id="calleav" value="<?php echo $calleav;?>" style="text-transform:uppercase;" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="casaedif">Casa/Edif.:</label>
                                    <input type="text" name="casaedif" style="text-transform:uppercase;" id="casaedif" value="<?php echo $casaedif;?>" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="piso">Piso:</label>
                                    <input type="text" maxlength="2" name="piso" id="piso" value="<?php echo $piso;?>" style="text-transform:uppercase;" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="oficina">Oficina:</label>
                                    <input type="text" name="oficina" id="oficina"  maxlength="8" value="<?php echo $oficina;?>" class="form-control mb-3" required>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="codpostal">Cod.Postal:</label>
                                    <input type="text" name="codpostal" id="codpostal" value="<?php echo $codpostal;?>" maxlength="4" minlength="4" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" class="form-control" required>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" name="submit" class="btn btn-primary"><i class="fi fi-rs-disk"></i> ACTUALIZAR</button>
                                <a href="javascript:history.back()" class="btn btn-outline-warning" rel="noopener noreferrer"><i class="fi fi-rr-undo"></i> VOLVER </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
                    </div>
                    <?php include('../layouts/footer.php')?>
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
    </div>
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
</div>
<?php include('../layouts/script.php')?>
<script>
$(document).ready(function(){
    $('#updseg').submit(function(e){
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "../model/mod_seguro/updseg.php",
        data: $("#updseg").serialize(),
        success: function(data){
            if(data == 1){
                Swal.fire({
                    title: 'Actualización Exitosa!',
                    text: 'Se Actualizo correctamente La Aseguradora',
                    icon: 'success',
                    confirmButtonColor: "#007ebc",
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "rpt_seg.php";
                    }
                });
            }else{
                Swal.fire({
                    title: 'Error!',
                    text: 'Ocurrio un Error al Actualizar La Aseguradora',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            }
        }
    })
})
})
</script>

</body>
</html>