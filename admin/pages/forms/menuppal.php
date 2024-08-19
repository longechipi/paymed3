<?php session_start();
		date_default_timezone_set('America/Caracas');
		if (!isset($_SESSION['usuario'])) {
			echo '<script language="javascript">window.location.href="../../../login.html";</script>';	
		}
		$idlogin=$_SESSION['idlogin'];
		$usuario=$_SESSION['usuario'];
		$privilegios = $_SESSION['privilegios'];
		$cargo = $_SESSION['cargo'];

?>
	
  <!-- Main Sidebar Container -->
  <aside style="background: #484748" class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../../index.php" target="_blank" class="brand-link">
      <img src="../../dist/img/70.png"
	  		alt="LOGO PAYMED GLOBAL, LLC"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">PayMed</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
	  	<div class="info">
        	<a href="#" class="d-block" style="color: #fff"><span style="font-weight: bold">USUARIO:</span><?php echo ' '.$usuario; ?></a>
        	<a href="#" class="d-block" style="color: #fff"><span style="font-weight: bold">CARGO:</span>
				<?php 
					// Busco nombre del que esta logeado
  					$sqldatosdr = ("SELECT idlogin, fullname  FROM loginn WHERE correo='".$usuario."';");
  					$arrdatosdr =$mysqli->query($sqldatosdr);
  					$rowdatosdr = mysqli_fetch_array($arrdatosdr);
  					$idlogin =$rowdatosdr['idlogin'];
  					$namedr  =$rowdatosdr['fullname'];
          		if($privilegios==1){echo ' Administrador';}
          		else if($privilegios==2){echo ' Médicos'; echo '<p style="color:#EEFF41;" >Dr(a): '. $namedr.'</p>';}
					else if($privilegios==3){echo ' Aseguradora';}
          		else if($privilegios==4){echo ' Proveedor';}
          		else if($privilegios==7){echo ' Asistente';}
				?>
			</a>
			<?php 
			// Busco con quien trabaja (Jefe)
			if ($privilegios==7) {
				if (isset($_SESSION['idloginmed'])) {$idlogin = $_SESSION['idloginmed'];}else{$idlogin = $_SESSION['idlogin'];}
				/*
				$sqltrabcon = ("SELECT trabajacon  FROM loginn WHERE correo='".$usuario."';");
  				$arrtrabcon =$mysqli->query($sqltrabcon);$rowtrabcon = mysqli_fetch_array($arrtrabcon);$usuario =$rowtrabcon['trabajacon'];*/
  				// Busco nombre del Dr(Jefe)
  				$sqldatosdr = ("SELECT fullname  FROM loginn WHERE idlogin='".$idlogin."';");
  				$arrdatosdr =$mysqli->query($sqldatosdr);$rowdatosdr = mysqli_fetch_array($arrdatosdr);
  				$namedr =$rowdatosdr['fullname'];
  				$_SESSION['nombremedico']=$namedr;
			?>
			<p style="color:#EEFF41;" >Dr(a): <?php echo $namedr; ?></p>
			<?php
			}
			if($privilegios==2 || $privilegios==7){
				if (isset($_SESSION['idloginmed'])) {$idlogin = $_SESSION['idloginmed'];}else{$idlogin = $_SESSION['idlogin'];}
				//$sql = ("SELECT a.fecinicio, a.fecfinal FROM regpagos a, medicos b WHERE a.idmed=b.idmed and b.correo='".$usuario."'");
				$sql = ("SELECT a.fecinicio, a.fecfinal FROM regpagos a, medicos b 
							WHERE a.idmed=b.idmed and b.idlogin='".$idlogin."'");
  				$arrcli    =$mysqli->query($sql);
  				$rowcli    = mysqli_fetch_array($arrcli);
  				
  				if (!isset($rowcli['fecinicio'])) {
  					$fecinicio='0000-00-00';
  				}else{
  					$fecinicio=$rowcli['fecinicio'];	
  				}
  				if (!isset($rowcli['fecfinal'])) {
  					$fecfinal='0000-00-00';
  				}else{
  					$fecfinal=$rowcli['fecfinal'];
  				}
  				// Busco si el Cliente (Medico)ya esta activo y habilitar o no opciones del menu
  				// OOOjOOOOO --->>>> por ahora no esta habilitado, faltan definir cosas con el usuario 
				$sqlestatus = ("SELECT estatus  FROM loginn WHERE idlogin ='".$idlogin."';");
				//echo $sqlestatus.'---'; $idlogin;
		  		$objestatus = $mysqli->query($sqlestatus);
		  		$arrestatus = mysqli_fetch_array($objestatus);
		  		$estatusmedico =$arrestatus['estatus'];
		  		//echo 'aquiiiiiiiiiiiiii'.$estatusmedico; exit();
				?>
				<center><h5 style="color:red" >Membresía</h5></center>
        		<small style="font-weight: italic; color: white; font-weight: bold; font-size: 20px;" >Desde : <?php echo $fecinicio;?><br> Hasta : <?php echo $fecfinal;?></small>
        	<?php } ?>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <?php if($privilegios==1){ ?>
		  <nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
			  <!-- Add icons to the links using the .nav-icon class
				   with font-awesome or any other icon font library  -->  
			  <li class="nav-header"><a href="../../index.php?usr=1">INICIO</a></li>
			  <li class="nav-item has-treeview">
				<a href="#" class="nav-link">
				  <i class="nav-icon fas fa-lock"></i>
				  <p>
					ACCESOS
					<i class="fas fa-angle-left right"></i>
				  </p>
				</a>
				<ul class="nav nav-treeview">    
				  <li class="nav-item">
					<a href="#" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Usr Clinicas </p>
					</a>
				  </li>

				  <li class="nav-item">
					<a href="#" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Usr Aseguradoras</p>
					</a>
				  </li>

				  <li class="nav-item">
					<a href="#" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Usr Medicos</p>
					</a>
				  </li>

				  <li class="nav-item">
					<a href="rpt_upac.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Usr Pacientes</p>
					</a>
				  </li>
				  <!--li class="nav-item">
					<a href="rpt_user.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Usuarios Web</p>
					</a>
				  </li-->                                   
				</ul>						
			  </li>
			  <!--  - - - - - - - - - - - - - - - - - - - - - - - - -->
			  <li class="nav-item has-treeview">
				<a href="#" class="nav-link">
				  <i class="nav-icon fas fa-cog"></i>
				  <p>
					MODULOS
					<i class="fas fa-angle-left right"></i>
				  </p>
				</a>
				<ul class="nav nav-treeview">              
				  <li class="nav-item">
					<a href="rpt_clin.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Clinicas</p>
					</a>
				  </li>
				  <li class="nav-item">
					<a href="rpt_prov.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Proveedores</p>
					</a>
				  </li>
				  <li class="nav-item">
					<a href="rpt_seg.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Aseguradoras</p>
					</a>
				  </li>
				  <li class="nav-item">
					<a href="rpt_med.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Medicos</p>
					</a>
				  </li>

				  <li class="nav-item">
					<a href="rpt_presupuestos.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Presupuestos</p>
					</a>
				  </li>

				    <!--li class="nav-item">
					<a href="rpt_pac.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Pacientes</p>
					</a>
				  </li-->
				</ul>
			  </li>
			  <!-- -->
			  <li class="nav-item has-treeview">
				<a href="#" class="nav-link">
				  <i class="nav-icon far fa-calendar-alt"></i>
				  <p>
					CITAS MEDICAS
					<i class="fas fa-angle-left right"></i>
				  </p>
				</a>
				<ul class="nav nav-treeview">              
				  <li class="nav-item">
					<a href="rpt_citas.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Ver Citas</p>
					</a>
				  </li>              			  
				</ul>
			  </li>
			  <!-- -->
			  <li class="nav-item has-treeview">
				<a href="#" class="nav-link">
				  <i class="nav-icon far fa-calendar-alt"></i>
				  <p>
					OPERATIVO
					<i class="fas fa-angle-left right"></i>
				  </p>
				</a>
				<ul class="nav nav-treeview">              
				  <li class="nav-item">
					<a href="rpt_admegr.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Adminsión/Egreso</p>
					</a>
				  </li>
				  <li class="nav-item">
					<a href="rpt_regpago.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Pagos</p>
					</a>
				  </li>
				  <li class="nav-item">
					<a href="baremo_paymed.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					 <p>Baremo Paymed</p>
					</a>
				  </li>

				  <li class="nav-item">
					<a href="rpt_apromed.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					 <p>Junta Medica</p>
					</a>
				  </li>
				  <li class="nav-item">
					<a href="rpt_asixmed.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					 <p>Asistentes Por Médico</p>
					</a>
				  </li>
				  <li class="nav-item">
					<a href="updatmed.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					 <p>Carga Medicos(Excel)</p>
					</a>
				  </li>
				</ul>
			  </li>
			  <!-- -->
				<li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                     <i class="nav-icon far fa-calendar-alt"></i>
                     <p>
                        CONFIGURACIÓN
                        <i class="fas fa-angle-left right"></i>
                     </p>
                  </a>
                  <ul class="nav nav-treeview">
                     <li class="nav-item">
                        <a href="rpt_tipoempresa.php" class="nav-link">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Tipo de Empresa</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="rpt_tipocuenta.php" class="nav-link">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Tipo de Cuenta</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="rpt_tipocontacto.php" class="nav-link">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Tipo de Contacto</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="rpt_tpprov.php" class="nav-link">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Tipo de Proveedor</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="rpt_sexo.php" class="nav-link">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Sexo</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="rpt_servafafiliados.php" class="nav-link">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Servicios Afiliados</p>
                        </a>
                     </li>

                     <li class="nav-item">
                        <a href="rpt_servimg.php" class="nav-link">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Imagenología</p>
                        </a>
                     </li>

                     <li class="nav-item">
                        <a href="rpt_frecuencia.php" class="nav-link">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Frecuencia de Pagos</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="rpt_estadocivil.php" class="nav-link">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Estado Civil</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="rpt_espmed.php" class="nav-link">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Especialidades Medicas</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="rpt_bancos.php" class="nav-link">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Registro de Bancos</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="rpt_planes.php" class="nav-link">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Registro de Planes</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="upd_terms.php" class="nav-link">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Terminos y Condiciones</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="rpt_paises.php" class="nav-link">
                           <i class="far fa-circle nav-icon"></i>
                           <p>países</p>
                        </a>
                     </li>
                  </ul>
               </li>
			  <!-- ----------------- -->
			  
			  <li class="nav-item has-treeview">
				<a href="#" class="nav-link">
				  <i class="nav-icon far fa-calendar-alt"></i>
				  <p>
					AGENDA
					<i class="fas fa-angle-left right"></i>
				  </p>
				</a>
				<ul class="nav nav-treeview">              
				  <li class="nav-item">
					<a href="rpt_agenda.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Ver Actividades</p>
					</a>
				  </li>              			  
				</ul>
			  </li>
				
			  <!-- -->
			
			  <!-- -->
			  
			  <!-- -->
			  
			  <!-- -->
			  	
			</ul>
		  </nav>
     	<?php }else if($privilegios==2){ ?>
			<!-- * * * * * * * * * * * * * * *Medicos * * * * * * * * * * * * * * * * * * * * * * * * * * *  -->
			<!-- Verifico si ya pago y tiene estatus Activo, sino solo muestro opccion de actualizar perfil -->
          <nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
			  <!-- Add icons to the links using the .nav-icon class
				   with font-awesome or any other icon font library  -->  
			  <li class="nav-header"><a href="../../index.php?usr=1">INICIO</a></li>
			  <?php if ($estatusmedico=='I') { ?>
			  <li class="nav-item has-treeview">
				<a href="#" class="nav-link">
				  <i class="nav-icon fas fa-lock"></i>
				  <p>
					PERFIL
					<i class="fas fa-angle-left right"></i>
				  </p>
				</a>
				<ul class="nav nav-treeview">    				                 
				  <li class="nav-item">
					<!--a href="rpt_user.php" class="nav-link"-->
					<a href="updmed.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Actualizar</p>
					</a>
				  </li>                                   
				</ul>						
			  </li>
				<?php }else{ ?>
			<!-- 
		  <nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
			  < !-- Add icons to the links using the .nav-icon class
				   with font-awesome or any other icon font library  -- >  
			  <li class="nav-header"><a href="../../index.php?usr=1">INICIO</a></li>-->
			  <!-- - - - - - - -- - - - - - -- - - - - - - - -->

			  <li class="nav-item has-treeview">
				<a href="#" class="nav-link">
				  <i class="nav-icon fas fa-lock"></i>
				  <p>
					PERFIL
					<i class="fas fa-angle-left right"></i>
				  </p>
				</a>
				<ul class="nav nav-treeview">    				                 
				  <li class="nav-item">
					<a href="updmed.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Actualizar</p>
					</a>
				  </li>                                   
				</ul>						
			  </li>
			  <!-- ------------------------------------------------------------------>

			  <li class="nav-item has-treeview">
				<a href="#" class="nav-link">
				  <i class="nav-icon fas fa-cog"></i>
				  <p>
					ACTUALIZAR
					<i class="fas fa-angle-left right"></i>
				  </p>
				</a>
				<ul class="nav nav-treeview">              
				  <i class="nav-item">
					<a href="rpt_prov.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Proveedores</p>
					</a>
				  </li>
				  <li class="nav-item">
					<a href="rpt_pacxmed.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Pacientes</p>
					</a>
				  </li>
				  <!--li class="nav-item">
					<a href="rpt_logo.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Presupuesto</p>
					</a>
				  </li-->
				  <li class="nav-item">
					<a href="rpt_asist.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Asistente</p>
					</a>
				  </li>
				  <li class="nav-item">
					<a href="rpt_horar.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Horarios</p>
					</a>
				  </li>
				</ul>
			  </li>
			  <!-- -->
			  <li class="nav-item has-treeview">
				<a href="#" class="nav-link">
				  <i class="nav-icon far fa-calendar-alt"></i>
				  <p>
					AGENDA
					<i class="fas fa-angle-left right"></i>
				  </p>
				</a>
				<ul class="nav nav-treeview">              
				  <li class="nav-item">
					<a href="rpt_citas.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Ver Citas</p>
					</a>
				  </li>  
				  <li class="nav-item">
					<a href="rpt_citpac.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Crear Citas</p>
					</a>
				  </li>            			  
				</ul>
			  </li>
			  <!-- -->
			   <li class="nav-item has-treeview">
				<a href="#" class="nav-link">
				  <i class="nav-icon far fa-calendar-alt"></i>
				  <p>
					VER
					<i class="fas fa-angle-left right"></i>
				  </p>
				</a>
				<ul class="nav nav-treeview">              
				  <li class="nav-item">
					<a href="prefilterpac.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Historia Medica</p>
					</a>
				  </li>  
				</ul>
			  </li>
			  <!-- --> 
			  <li class="nav-item has-treeview">
				<a href="#" class="nav-link">
				  <i class="nav-icon far fa-calendar-alt"></i>
				  <p>
					PRESUPUESTOS
					<i class="fas fa-angle-left right"></i>
				  </p>
				</a>
				<ul class="nav nav-treeview">              
				  <li class="nav-item">
					<a href="rpt_presupuestos.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Ver Presupuestos</p>
					</a>
				  </li>  
				</ul>
			  </li>
			  <?php } ?>
			</ul>
		  </nav>
     	<?php }else if($privilegios==3){ ?>
		<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *  -->
		 <nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
			  <!-- Add icons to the links using the .nav-icon class
				   with font-awesome or any other icon font library  -->  
			  <li class="nav-header"><a href="../../index.php?usr=1">INICIO</a></li>
			  <!-- -->
			  <li class="nav-item has-treeview">
				<a href="#" class="nav-link">
				  <i class="nav-icon far fa-calendar-alt"></i>
				  <p>
					AGENDA
					<i class="fas fa-angle-left right"></i>
				  </p>
				</a>
				<ul class="nav nav-treeview">              
				  <li class="nav-item">
					<a href="rpt_agenda.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Ver Actividades</p>
					</a>
				  </li>              			  
				</ul>
			  </li>
			  <!-- -->
			  <li class="nav-item has-treeview">
				<a href="#" class="nav-link">
				  <i class="nav-icon fas fa-edit"></i>
				  <p>
					CLIENTES
					<i class="fas fa-angle-left right"></i>
				  </p>
				</a>
				<ul class="nav nav-treeview">              
				  <li class="nav-item">
					<a href="#" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Medicos</p>
					</a>
				  </li>
				  <li class="nav-item">
					<a href="#" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Asegurados</p>
					</a>
				  </li>
				                
				</ul>
			  </li>
			  <!-- -->
			  
			  <!-- -->		  
			</ul>
		  </nav>
		  <!-- -->
		  <?php }else if($privilegios==4){ // Proveedor ?>
		<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *  -->
		 <nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
			  <!-- Add icons to the links using the .nav-icon class
				   with font-awesome or any other icon font library  -->  
			  <li class="nav-header"><a href="../../index.php?usr=1">INICIO</a></li>
			  <!-- -->
			  <li class="nav-item has-treeview">
				<a href="#" class="nav-link">
				  <i class="nav-icon far fa-calendar-alt"></i>
				  <p>
					PERFIL
					<i class="fas fa-angle-left right"></i>
				  </p>
				</a>
				<ul class="nav nav-treeview">              
				  <li class="nav-item">
					<a href="regprov.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Actualizar</p>
					</a>
				  </li>              			  
				</ul>
			  </li>
			  
			  <li class="nav-item has-treeview">
				<a href="#" class="nav-link">
				  <i class="nav-icon fas fa-edit"></i>
				  <p>
				  OPERACIONES
					<i class="fas fa-angle-left right"></i>
				  </p>
				</a>
				<ul class="nav nav-treeview">              
				  <li class="nav-item">
					<a href="updespec.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Especialidades</p>
					</a>
				  </li>
				  <li class="nav-item">
					<a href="#" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Maquinas</p>
					</a>
				  </li>
				  <li class="nav-item">
					<a href="#" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Alquiler</p>
					</a>
				  </li>
				                
				</ul>
			  </li>
			  <!-- -->
			  
			  <!-- -->		  
			</ul>
		  </nav>
		 <?php }else if($privilegios==7){ // Asistentes ?>
			<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *  -->
			<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
			  <!-- Add icons to the links using the .nav-icon class
				   with font-awesome or any other icon font library  -->  
			  <li class="nav-header"><a href="../../index.php?usr=1">INICIO</a></li>
			  <!-- -->
			  <!-- -->
			  <li class="nav-item has-treeview">
				<a href="#" class="nav-link">
				  <i class="nav-icon far fa-calendar-alt"></i>
				  <p>
					AGENDA
					<i class="fas fa-angle-left right"></i>
				  </p>
				</a>
				<ul class="nav nav-treeview">              
				  <li class="nav-item">
					<a href="rpt_citas.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Ver Citas</p>
					</a>
				  </li>  
				  <li class="nav-item">
					<a href="rpt_citpac.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Citas</p>
					</a>
				  </li>
				</ul>
			  </li>
			  <!-- -->
			   <li class="nav-item has-treeview">
				<a href="#" class="nav-link">
				  <i class="nav-icon far fa-calendar-alt"></i>
				  <p>
					VER
					<i class="fas fa-angle-left right"></i>
				  </p>
				</a>
				<ul class="nav nav-treeview">              
				  <li class="nav-item">
					<a href="prefilterpac.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Historia Medica</p>
					</a>
				  </li>  
				</ul>
			  </li>
			  <!-- -->
			  <li class="nav-item has-treeview">
				<a href="#" class="nav-link">
				  <i class="nav-icon far fa-calendar-alt"></i>
				  <p>
					ACTUALIZAR
					<i class="fas fa-angle-left right"></i>
				  </p>
				</a>
				<ul class="nav nav-treeview">              
				  <li class="nav-item">
					<a href="rpt_pacxmed.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Pacientes</p>
					</a>
				  </li>  
				</ul>
			  </li>	  
			</ul>
		  </nav>
     	<?php } ?>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- Fin Menu Ppal -->