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
                    <h5 class="card-title text-primary">Carga Masiva</h5>
                    <form method="post" id="addproduct" action="import.php" enctype="multipart/form-data" role="form">
                        <div class="row">
                            <div class="col-md-12">
                            <span>Selecione Archivo <strong>Excel</strong> a Cargar:</span>
                                <input type="file" id="datosexcel" name="datosexcel" class="form-control" 
                                accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel,text/comma-separated-values, text/csv, application/csv" required>  
                                <label id="cedula" class="custom-file-label" for="cedula"></label>
                                <small class="text-danger">* Recuerda que esta carga obedece a un Formato Definido en el Archivo Excel *</small>
                            </div> 
                            <div class="text-center">
                            <button type="submit" name="submit" value="Cargar" class="btn btn-primary"><i class="fi fi-rr-folder-upload"></i> CARGAR</button>
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

</body>
</html>