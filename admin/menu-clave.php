<?php session_start();
	  date_default_timezone_set('America/Caracas');
	  $usuario=$_SESSION['usuario'];
	  $privilegios = $_SESSION['privilegios']; //echo  $privilegios; exit();
	  ?>
    <!-- Main Sidebar Container -->
  <aside style="background: #484748" class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../index.php" target="_blank" class="brand-link">
      <img src="dist/img/70.png"
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
          			if($privilegios==1){echo ' Administrador';}
          			else if($privilegios==2){echo ' Medico';}
					else if($privilegios==3){echo ' Comp.Aseguradora';}
          			else if($privilegios==4){echo ' Asegurado';} 
				?>
			</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <?php if($privilegios==1){ ?>
		  <nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
			  <!-- Add icons to the links using the .nav-icon class
				   with font-awesome or any other icon font library  -->  
			  <li class="nav-header"><a href="index.php?usr=1">INICIO</a></li>
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
					<a href="pages/forms/rpt_uclin.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Usr Clinicas</p>
					</a>
				 </li>

				 <li class="nav-item">
					<a href="pages/forms/rpt_team.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Usr Aseguradoras</p>
					</a>
				 </li>
				 <li class="nav-item">
					<a href="pages/forms/rpt_team.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Usr Medicos</p>
					</a>
				 </li>
				 <li class="nav-item">
					<a href="pages/forms/rpt_upac.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Usr Pacientes</p>
					</a>
				 </li>
				  <!--li class="nav-item">
					<a href="pages/forms/rpt_user.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Usuarios Web</p>
					</a>
				  </li-->                                   
				</ul>						
			  </li>
			  <!-- -->
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
					<a href="pages/forms/rpt_clin.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Clinicas</p>
					</a>
				  </li>
				  <li class="nav-item">
					<a href="pages/forms/rpt_seg.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Aseguradoras</p>
					</a>
				  </li>

				  <li class="nav-item">
					<a href="pages/forms/rpt_med.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Medicos</p>
					</a>
				  </li>

				  <li class="nav-item">
					<a href="pages/forms/rpt_pac.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Pacientes</p>
					</a>
				  </li>
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
					<a href="pages/forms/rpt_agenda.php" class="nav-link">
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
					<a href="pages/forms/rpt_pres.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Presupuesto</p>
					</a>
				  </li>
				  <li class="nav-item">
					<a href="pages/forms/rpt_pres.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					 <p>Adminsión/Egreso</p>
					</a>
				  </li>
				  <li class="nav-item">
					<a href="pages/forms/rpt_regpago.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					 <p>Pagos</p>
					</a>
				  </li>
				  <li class="nav-item">
					<a href="pages/forms/baremo_paymed.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					 <p>Baremo Paymed</p>
					</a>
				  </li>
				</ul>
			  </li>
			  <!-- -------------- -->
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
                        <a href="pages/forms/rpt_tipoempresa.php" class="nav-link">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Tipo de Empresa</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="pages/forms/rpt_tipocuenta.php" class="nav-link">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Tipo de Cuenta</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="pages/forms/rpt_tipocontacto.php" class="nav-link">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Tipo de Contacto</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="pages/forms/rpt_sexo.php" class="nav-link">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Sexo</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="pages/forms/rpt_servafafiliados.php" class="nav-link">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Servicios Afiliados</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="pages/forms/rpt_frecuencia.php" class="nav-link">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Frecuencia de Pagos</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="pages/forms/rpt_estadocivil.php" class="nav-link">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Estado Civil</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="pages/forms/rpt_espmed.php" class="nav-link">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Especialidades Medicas</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="pages/forms/rpt_bancos.php" class="nav-link">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Registro de Bancos</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="pages/forms/rpt_planes.php" class="nav-link">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Registro de Planes</p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="pages/forms/upd_terms.php" class="nav-link">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Terminos y Condiciones</p>
                        </a>
                     </li>
                  </ul>
               </li>
			  <!-- ---------------------- -->
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
					<a href="pages/forms/rpt_agenda.php" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Ver Actividades</p>
					</a>
				  </li>			  
				</ul>
			  </li>
			  <!-- -->

			</ul>
		  </nav>
     	<?php }else if($privilegios==2){ ?>
			<!-- * * * * * * * * * * * * * * Medicos * * * * * * * * * * * * * * * * * * * * * * * * * -->
          
     	<?php }else if($privilegios==3){ ?>
			<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * -->
		  <nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
			  <!-- Add icons to the links using the .nav-icon class
				   with font-awesome or any other icon font library  -->  
			  <li class="nav-header"><a href="index.php?usr=1">INICIO</a></li>			
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
					<a href="pages/forms/rpt_agenda.php" class="nav-link">
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
					<a href="pages/forms/xxx" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Medicos</p>
					</a>
				  </li>
				  <li class="nav-item">
					<a href="pages/forms/xxx" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Asegurados</p>
					</a>
				  </li>
				  

				</ul>
			  </li>
			  <!-- -->		  
			 
			  <!-- -->
			  </li>			  
			</ul>
		  </nav>
		  <?php }else if($privilegios==4){ ?>
			<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * -->
		  <nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
			  <!-- Add icons to the links using the .nav-icon class
				   with font-awesome or any other icon font library  -->  
			  <li class="nav-header"><a href="index.php?usr=1">INICIO</a></li>			
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
					<a href="pages/forms/rpt_agenda.php" class="nav-link">
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
					SOLICITUDES
					<i class="fas fa-angle-left right"></i>
				  </p>
				</a>
				<ul class="nav nav-treeview">              
				  <li class="nav-item">
					<a href="pages/forms/xxx" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Cita Medica</p>
					</a>
				  </li>
				  <li class="nav-item">
					<a href="pages/forms/xxx" class="nav-link">
					  <i class="far fa-circle nav-icon"></i>
					  <p>Carta Aval</p>
					</a>
				  </li>
				</ul>
			  </li>
			  <!-- -->		  
			 
			  <!-- -->
			  </li>			  
			</ul>
		  </nav>     	
     	<?php } ?>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- Fin Menu Ppal -->