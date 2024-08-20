<?php 
include('../layouts/header.php');
require('conexion.php');
?>

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <?php //include("../layouts/menu.php"); ?>
            <div class="layout-page">
                <?php include("../layouts/navbar.php"); ?>
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                          <?php include('resumen2.php')?>

                

                            <div class="col-6">
                                asd
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