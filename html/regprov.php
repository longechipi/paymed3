<?php 
include('../layouts/header.php');
require('../admin/conexion.php');
?>

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <?php include("../layouts/menu.php"); ?>
            <div class="layout-page">
                <?php include("../layouts/navbar.php"); ?>
                <div class="content-wrapper">
                    <div class="container-fluid flex-grow-1 container-p-y">
                        <div class="row">    
<div class="col-lg-12 mb-12 order-0">
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-12">
                <div class="card-body">
                    
                    <h5 class="card-title text-primary">Registro de Proveedores</h5>
    <form id="signUpForm" action="#!">
        <!-- start step indicators -->
        <div class="form-header d-flex mb-4">
            <span class="stepIndicator">Datos Básicos</span>
            <span class="stepIndicator">Datos Bancarios</span>
            <span class="stepIndicator">Rama del Proveedor</span>
            <span class="stepIndicator">Desconocido</span>
        </div>
        <!-- end step indicators -->
    
        <!-- step one -->
        <div class="step">
        <div class="divider">
                        <div class="divider-text">Datos de Básicos</div>
                      </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="idcateg">Categoria:</label>
                        <select id="idcateg" class="form-select" name="idcateg" required>
                        
                            <?php
                            //require('admin/conexion.php');
                            $query = $mysqli -> query ("SELECT idcateg, categoria FROM categprove WHERE idestatus='1' ; ");
                            while ($valores = mysqli_fetch_array($query)) {
                            echo '<option value="'.$valores['idcateg'].'">'.$valores['categoria'].'</option>';
                        } ?>
                        
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="rif">RIF:</label>
					    <input type="text" name="rif" id="rif"  maxlength="9" minlength="9" class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;">
					</div>
				</div>

                <div class="col-md-3">
					<div class="form-group">
						<label for="razsocial">Razón Social:</label>
						<input type="text" name="razsocial" id="razsocial" class="form-control" style="text-transform:uppercase;">
					</div>
				</div>

                <div class="col-md-3">
					<div class="form-group">
						<label for="dencomercial">Denominación Comercial:</label>
						<input type="text" name="dencomercial" id="dencomercial" class="form-control"style="text-transform:uppercase;">
					</div>
				</div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="correo">Correo:</label>
                        <input type="email" name="correo" id="correo" class="form-control mb-3" required>
                    </div>
                </div>
             </div><!-- FIN ROW -->
             <div class="row">
                <div class="col-md-1">
                    <div class="form-group">
                        <label for="codarea">Cod:</label>
                        <input type="text" name="codarea" id="codarea" minlength="3" maxlength="5"class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;">
                    </div>
                </div>

                <div class="col-md-2">
					<div class="form-group">
						<label for="telefono">Telefono Local:</label>
						<input type="text" name="telefono" id="telefono" maxlength="7" minlength="7" class="form-control" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>
					</div>
				</div>

                <div class="col-md-1">
                    <div class="form-group">
                        <label for="operadora">Operadora:</label>
                        <select class="form-select" id="operadora" name="operadora">
                            <option value="0412">0412</option>
                            <option value="0414">0414</option>
                            <option value="0424">0424</option>
                            <option value="0416">0416</option>
                            <option value="0426">0426</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="movil">Telefono Movil</label>
                        <input type="text" name="movil" id="movil" maxlength="7" minlength="7"class="form-control mb-3" onKeypress="if (event.keyCode < 48 || event.keyCode > 57) event.returnValue = false;" required>
                    </div>
                </div> 

                <div class="col-md-3">
					<div class="custom-file">
                        <label for="rifimg">Rif (PDF)</label>
                        <input type="file" id="rifimg" name="imagen1" class="form-control" accept="application/pdf" title="Formato PDF" >
                    </div>
				</div>

                <div class="col-md-3">
					<div class="custom-file">
                        <label for="rmimg">Reg.Mercantil:</label>
						<input type="file" id="rmimg" name="imagen2" class="form-control" accept="application/pdf" title="Formato PDF" >  
					</div>
				</div>

                <div class="col-md-3">
					<div class="custom-file">
                        <label for="cedimg1">Cedula Socio:</label>
						<input type="file" id="cedimg1"  name="imagen3"  class="form-control" accept="application/pdf" title="Formato PDF" >
					</div>
				</div>

                <div class="col-md-3">
					<div class="custom-file">
                        <label for="cedimg2">Cedula Socio:</label> 
						<input type="file" id="cedimg2"  name="imagen4"  class="form-control mb-6" accept="application/pdf" title="Formato PDF" >
					</div>
				</div>
             </div><!-- FIN ROW -->
            
            
            
            <!-- <div class="mb-3">
                <input type="email" placeholder="Email Address" oninput="this.className = ''" name="email">
            </div>
            <div class="mb-3">
                <input type="password" placeholder="Password" oninput="this.className = ''" name="password">
            </div>
            <div class="mb-3">
                <input type="password" placeholder="Confirm Password" oninput="this.className = ''" name="password">
            </div> -->
        </div>
    
        <!-- step two -->
        <div class="step">
            <p class="text-center mb-4">Your presence on the social network</p>
            <div class="mb-3">
                <input type="text" placeholder="Linked In" oninput="this.className = ''" name="linkedin">
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Twitter" oninput="this.className = ''" name="twitter">
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Facebook" oninput="this.className = ''" name="facebook">
            </div>
        </div>
    
        <!-- step three -->
        <div class="step">
            <p class="text-center mb-4">We will never sell it</p>
            <div class="mb-3">
                <input type="text" placeholder="Full name" oninput="this.className = ''" name="fullname">
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Mobile" oninput="this.className = ''" name="mobile">
            </div>
            <div class="mb-3">
                <input type="text" placeholder="Address" oninput="this.className = ''" name="address">
            </div>
        </div>
    
        <!-- start previous / next buttons -->
        <div class="row">
            <div class="text-center">
                <div class="form-footer ">
                    <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                    <button type="button" class="btn btn-primary" id="nextBtn" onclick="nextPrev(1)">Next</button>
                </div>
            </div>
        </div>
        <!-- end previous / next buttons -->
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