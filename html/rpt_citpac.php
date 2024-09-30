<?php 
include('../layouts/header.php');
require('../conf/conexion.php');
?>

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <?php include("../layouts/menu.php"); ?>
            <div class="layout-page">
                <?php include("../layouts/navbar.php"); ?>
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">    
<div class="col-lg-12 mb-12 order-0">
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-12">
                <div class="card-body">
                    <h5 class="card-title text-primary">Crear Citas</h5>
                    <form id="add_citas">
                    <div class="row">
                        <div class="divider">
                            <div class="divider-text">Datos del Paciente</div>
                        </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="inputName">Buscar Paciente:</label>
                                    <input type="text" id="nomevento" name="nomevento" class="form-control" />
                                    <small>Permite Buscar por Cedula o por Nombre</small>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputName">Cedula:</label>
                                    <input type="text" id="cedula" name="cedula" class="form-control" readonly/>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="inputName">Nombre y Apellido:</label>
                                    <input type="text" id="nom_paci" name="nom_paci" class="form-control" readonly/>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputName">Telefono:</label>
                                    <input type="text" id="telf" name="telf" class="form-control" readonly/>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="inputName">Correo:</label>
                                    <input type="text" id="correo" name="correo" class="form-control" readonly/>
                                </div>
                            </div>
                    </div>
                    <div class="row">
                        <div class="divider">
                            <div class="divider-text">Datos de la Cita</div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="inputName">Dr(a):</label>
                                <select class="form-select" name="dr_atiende" id="dr_atiende">
                                    <option value="1">Primer Doctor</option>
                                    <option value="2">Segundo Doctor</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="inputName">Dia de la Consulta:</label>
                                <input type="date" class="form-control" name="dia_cita" id="dia_cita" min="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="inputName">Hora de la Consulta:</label>
                                <input type="time" class="form-control" name="hora_cita" id="hora_cita" />
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="inputName">Paciente Asegurado</label>
                                <select class="form-select mb-4" name="dr_atiende" id="dr_atiende">
                                    <option selected disabled value="">Seleccione</option>
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary"><i class="fi fi-rs-disk"></i> CREAR CITA</button>
                        <a href="javascript:history.back()" class="btn btn-outline-warning" rel="noopener noreferrer"><i class="fi fi-rr-undo"></i> VOLVER </a>
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

</body>
</html>