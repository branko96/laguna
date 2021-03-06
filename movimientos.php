<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
  <title>Movimientos</title>
  <!-- Required meta tags -->
  <?php $_SESSION['pagina_actual']='movimientos'; ?> 
  <?php include('header.php');?>
</head>

<body>
  <div class="wrapper ">
    <!-- MENU -->
    <?php include('menu.php');?>
      <!-- End Navbar -->
      <div class="content" id="app">
        <div class="container-fluid">
          <!-- your content here -->
           <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-warning">
                  <div class="row">
                    <div class="col-md-6">
                      <h4 class="card-title">Movimientos</h4>
                    </div>
                    <div class="col-md-6 text-right">
                      <a href="#" data-target="#modal_nuevo_movimiento" data-toggle="modal" class="btn btn-success btn-round">Nuevo<div class="ripple-container"></div></a>
                    </div>
                  </div>

                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>ID</th>
                      <th>Cantidad</th>
                      <th>Fecha de Movimiento</th>
                      <th>Caravana Id</th>
                      <th>Tipo Transacción</th>
                      <th>Acción</th>
                    </thead>
                    <tbody>
                      <tr v-for="movimiento in movimientos">
                        <td>{{movimiento.id}}</td>
                        <td>{{movimiento.cantidad}}</td>
                        <td>{{movimiento.fecha_mov}}</td>
                        <td>{{movimiento.id_caravana}}</td>
                        <td>{{movimiento.tipo_mov}}</td>
                        <td class="td-actions text-center">
                          <button type="button" title="Editar" @click="modal_editar(movimiento);" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" @click="eliminar_movimiento(movimiento.id)" title="Borrar" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

<!-- The Modal -->
<div class="modal fade" id="modal_nuevo_movimiento">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header
      <div class="modal-header">
        <h4 class="modal-title text-center">Nuevo Empleado</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div> -->

      <!-- Modal body -->
      <div class="modal-body">
          <div class="card">
                <div class="card-header card-header-success">
                  <div class="row">
                    <div class="col-md-10">
                      <h4 class="card-title">Nuevo Movimiento</h4>
                    </div>
                    <div class="col-md-2">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                  </div>
                  <!-- <p class="card-category">Complete your profile</p> -->
                  
                </div>
                <div class="card-body">
                  <form method="POST" id="form_alta" @submit.prevent="nuevo_movimiento">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Cantidad</label>
                          <input type="text" name="nombre" v-model="nuev_movimiento.cantidad" class="form-control">
                        </div>
                      </div>
                      <!-- <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Fecha Movimiento</label>
                          <input type="date" v-model="nuev_movimiento.fecha_mov" class="form-control">
                        </div>
                      </div> -->
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Caravana</label>
                          <input type="text" v-model="nuev_movimiento.id_caravana" max-length="10" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Tipo Transacción</label>
                          <input type="text" v-model="nuev_movimiento.tipo_mov" class="form-control">
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-md-12 text-center">
                      <button type="submit" class="btn btn-success">Guardar</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    </div>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
      </div>

      <!-- Modal footer 
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>-->

    </div>
  </div>
</div>
<!--fin modal-->

<div class="modal fade" id="modal_editar_movimiento">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <!-- Modal Header
      <div class="modal-header">
        <h4 class="modal-title text-center">Nuevo Empleado</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div> -->

      <!-- Modal body -->
      <div class="modal-body">
          <div class="card">
                <div class="card-header card-header-success">
                  <div class="row">
                    <div class="col-md-10">
                      <h4 class="card-title">Editar Movimiento</h4>
                    </div>
                    <div class="col-md-2">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                  </div>
                  <!-- <p class="card-category">Complete your profile</p> -->
                  
                </div>
                <div class="card-body">
                  <form @submit.prevent="editar_movimiento">
                     <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                          <label class="">Cantidad</label>
                          <input type="text" name="nombre" v-model="movimiento_editar.cantidad" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="">Fecha Movimiento</label>
                          <input type="date" v-model="movimiento_editar.fecha_mov" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="">Caravana</label>
                          <input type="text" v-model="movimiento_editar.id_caravana" max-length="10" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="">Tipo Transacción</label>
                          <input type="text" v-model="movimiento_editar.tipo_mov" class="form-control">
                        </div>
                      </div>
                   <!--  <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>About Me</label>
                          <div class="form-group">
                            <label class="bmd-label-floating"> Lamborghini Mercy, Your chick she so thirsty, I'm in that two seat Lambo.</label>
                            <textarea class="form-control" rows="5"></textarea>
                          </div>
                        </div>
                      </div>
                    </div> -->
                    <div class="col-md-12 text-center">
                      <button type="submit" class="btn btn-success">Guardar</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    </div>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
      </div>
    </div>
  </div>
</div>

</div>
<!--         FIN APP -->
      
      <!-- FOOTER -->
      <?php include('footer.php');?>
      <!-- END FOOTER -->
    </div>
  </div>
<!--fin todo-->



<script src="js/vue.js"></script>
<script src="js/vue-axios.min.js"></script>
<script src="js/index.js"></script>
<script src="assets/js/plugins/bootstrap-notify.js"></script>
  <script src="js/rutas.js"></script>
<script src="js/movimientos-controller.js"></script>
</body>

</html>