<section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $ninm['cuantos'];?></h3>
                <p >Médicos</p>

              </div>
              <div class="icon">
                <!--i class="ion ion-bag"></i-->
                
              </div>
              <!--a href="pages/forms/rpt_med.php" class="small-box-footer">Ver</a-->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>87.7<sup style="font-size: 20px">%</sup></h3>
                <p>Pacientes Atendidos</p>
              </div>
              <div class="icon">
                
                <i class="ion ion-person-add"></i>
              </div>
              <!--a href="#" class="small-box-footer">Ver</a-->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $nregis['cuantoss'];?></h3>
                <p>Compañías Seguros</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <!--a href="pages/forms/rpt_seguros.php" class="small-box-footer">Ver</a-->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $cantacti[0];?></h3>
                <p>Actividades</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <!--a href="#" class="small-box-footer">Ver</a-->
            </div>
          </div>
          <!-- ./col -->
          <!-- botones de Medicos (Solo Para Asistentes)  -->
          <?php 
          if (substr($cargo,0,9)=='Asistente') {
            while($arrasist=$resultasist->fetch_array()){ ?>
              <!--
              <div class="col-lg-3 col-6">
                <button type="button" class="btn btn-outline-success btn-sm"><?php echo $arrasist['nombremedico']; ?></button>
            </div>
            
          <?php }
          } ?>
          <!-- Fin de botones                             -->
          
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">

            <!-- TO DO List -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  Lista de tareas
                </h3>

                <div class="card-tools">
                  <ul class="pagination pagination-sm">
                    <li class="page-item"><a href="#" class="page-link">&laquo;</a></li>
                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">&raquo;</a></li>
                  </ul>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <ul class="todo-list" data-widget="todo-list">
			   <?php 
					//require('conexion.php');
					$sql = ( "SELECT * FROM citas WHERE idestatus=1 ORDER BY importancia ASC") ;	
					//echo $sql;
					$conexion=$mysqli->query($sql);
					$deast=$mysqli->query($sql);				
					while($task=$deast->fetch_array()){ ?>                   
						  <li>
							<!-- drag handle -->
							<span class="handle">
							  <i class="fas fa-ellipsis-v"></i>
							  <i class="fas fa-ellipsis-v"></i>
							</span>
							<!-- checkbox -->
							<div  class="icheck-primary d-inline ml-2">
							  <input type="checkbox" value="" name="todo1" id="todoCheck1">
							  <label for="todoCheck1"></label>
							</div>
							<!-- todo text -->
							<span class="text"><?php echo $task['nombre'];?></span>
							<!-- Emphasis label -->
							<?php if($task['importancia']=='A') { ?>
								<small class="badge badge-danger"><i class="far fa-clock"></i> Alta</small>
							<?php }else if($task['importancia']=='M') { ?>
								<small class="badge badge-warning"><i class="far fa-clock"></i> Media</small>
							<?php }else if($task['importancia']=='B') { ?>
								<small class="badge badge-secondary"><i class="far fa-clock"></i> Baja</small>
							<?php }else if($task['importancia']=='S') { ?>
								<small class="badge badge-success"><i class="far fa-clock"></i> Suprema</small>
							<?php } ?>
							<!-- General tools such as edit or delete-->
							<div class="tools">
							  <a href="pages/forms/modevento.php?idcita=<?php echo $task['idcita'];?>"><i class="fas fa-edit"></i></a>
							  <i class="fas fa-trash-o"></i>
							</div>
						  </li>
                 	<?php } ?>
                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <!--
                <a href="pages/forms/regevento.php"><button type="button" class="btn btn-info float-right"><i class="fas fa-plus"></i> Añadir</button></a>
                -->
              </div>
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">
            <div class="container">
              <?php if ($privilegios=='1') { // Admin ?>
              <div class="row">
                <div class="col-12 mt-3">
                  <!-- de Bootrap <button type="button" class="btn btn-outline-success btn-lg btn-block">Ver Citas Medicas</button> -->
                  <a href="pages/forms/rpt_med.php"> <button>Médicos</button></a>
                </div>
              </div>
              
              <div class="row">
                <div class="col-12 mt-3">
                  <a href="pages/forms/rpt_regpago.php"><button>Aprobar Pagos</button></a>
                </div>
              </div>

              <div class="row">
                <div class="col-12 mt-3">
                  <a href="pages/forms/rpt_apromed.php"><button>Junta Médica</button></a>
                </div>
              </div>
              
              <?php }else if ($privilegios=='2') { // Medicos ?>
                  <?php if ($estatusmedico=='A') { // Verifico Estatus del Medico ?>
                    <div class="row">
                      <div class="col-12 mt-3">
                        <!-- de Bootrap <button type="button" class="btn btn-outline-success btn-lg btn-block">Ver Citas Medicas</button> -->
                        <a href="pages/forms/rpt_citas.php"> <button>Ver Citas</button></a>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-12 mt-3">
                        <a href="pages/forms/rpt_citpac.php"><button> Solicitar Cita Medica</button></a>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-12 mt-3">
                        <a href="pages/forms/rpt_asist.php"><button>Ver Asistente</button></a>
                      </div>
                    </div>
                    <?php }else{  ?>
                      <div class="row">
                      <div class="col-12 mt-3">
                        <!-- de Bootrap <button type="button" class="btn btn-outline-success btn-lg btn-block">Ver Citas Medicas</button> -->
                        <a href="#"> <button>Ver Citas</button></a>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-12 mt-3">
                        <a href="#"><button> Solicitar Cita Medica</button></a>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-12 mt-3">
                        <a href="#"><button>Ver Asistente</button></a>
                      </div>
                    </div>
                    <?php } // Fin Verificacion Estatus del Medico ?>

              <?php }else if ($privilegios=='4') { // Proveedor ?>
              <div class="row">
                <div class="col-12 mt-3">
                  <!-- de Bootrap <button type="button" class="btn btn-outline-success btn-lg btn-block">Ver Citas Medicas</button> -->
                  <a href="pages/forms/updespec.php"> <button>Especialidades</button></a>
                </div>
              </div>
              
              <div class="row">
                <div class="col-12 mt-3">
                  <a href="#"><button>A B C</button></a>
                </div>
              </div>

              <div class="row">
                <div class="col-12 mt-3">
                  <a href="#"><button>1 2 3 </button></a>
                </div>
              </div>
            <?php }else if ($privilegios=='7') { // Asistente ?>
              
              <div class="row">
                <div class="col-12 mt-3">
                  <a ><button id="btnselmedico">Seleccione Medico</button></a>
                </div>
              </div>

              <div class="row">
                <div class="col-12 mt-3">
                  <!-- de Bootrap <button type="button" class="btn btn-outline-success btn-lg btn-block">Ver Citas Medicas</button> -->
                  <a href="pages/forms/rpt_citas.php"> <button>Ver Citas</button></a>
                </div>
              </div>

              <div class="row">
                <div class="col-12 mt-3">
                  <a href="pages/forms/rpt_citpac.php"><button>Solicitar Cita</button></a>
                </div>
              </div>
              <?php } ?>

            </div> <!-- end Conteiner -->

          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>