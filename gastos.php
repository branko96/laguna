<!doctype html>
<html lang="en">

<head>
  <title>Gastos</title>
  <!-- Required meta tags -->
  <?php $_SESSION['pagina_actual']='gastos'; ?>
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
                      <h4 class="card-title">Gastos</h4>
                    </div>
                    <div class="col-md-6 text-right">
                      <a href="#" data-target="#modal_nuevo_gasto" data-toggle="modal" class="btn btn-success btn-round">Nuevo<div class="ripple-container"></div></a>
                    </div>
                  </div>

                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>ID</th>
                      <th>Fecha</th>
                      <th>Categoria</th>
                      <th>Detalle</th>
                      <th>Valor</th>
                      <th>Cantidad</th>
                      <th>Establecimiento</th>
                      <th>Tipo Recibo</th>
                      <th>Total $</th>
                      <th>Accion</th>
                    </thead>
                    <tbody>
                      <tr v-for="gasto in gastos">
                        <td>{{gasto.id}}</td>
                        <td>{{gasto.fecha}}</td>
                        <td>{{gasto.id_categoria}}</td>
                        <td>{{gasto.detalle}}</td>
                        <td>{{gasto.valor}}</td>
                        <td>{{gasto.cantidad}}</td>
                        <td>{{gasto.id_establecimiento}}</td>
                        <td>{{gasto.tipo_recibo}}</td>
                        <td>{{gasto.total}}</td>
                        <td class="td-actions text-center">
                          <button type="button" title="Editar" @click="modal_editar(gasto);" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" @click="eliminar_gasto(gasto.id)" title="Borrar" class="btn btn-danger btn-link btn-sm">
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


<div class="modal fade" id="modal_editar_gasto">
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
                      <h4 class="card-title">Editar Gasto</h4>
                    </div>
                    <div class="col-md-2">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                  </div>
                  <!-- <p class="card-category">Complete your profile</p> -->
                  
                </div>
                <div class="card-body">
                  <form @submit.prevent="editar_gasto">
                     <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                          <label class="">Fecha</label>
                          <input type="date" name="nombre" v-model="gasto_editar.fecha" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="">Categoria</label>
                          <input type="text" v-model="gasto_editar.id_categoria" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="">Establecimiento</label>
                          <select class="form-control" v-model="gasto_editar.id_establecimiento">
                            <option v-for="est in establecimientos" :value="est.id_establecimiento">{{est.nombre}}</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="">Valor</label>
                          <input type="number" v-model="gasto_editar.valor" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="">Cantidad</label>
                          <input type="number" min="1" v-model="gasto_editar.cantidad" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="">Tipo Recibo</label>
                          <input type="text" v-model="gasto_editar.tipo_recibo" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="">Detalle</label>
                          <input type="text" v-model="gasto_editar.detalle" max-length="10" class="form-control">
                        </div>
                      </div>
                    </div>
                    <!-- <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="">Total $</label>
                          <input type="text" v-model="gasto_editar.total" class="form-control">
                        </div>
                      </div>
                    </div> -->
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
                    <button type="submit" class="btn btn-success pull-right">Guardar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
      </div>
    </div>
  </div>
</div>
<!-- The Modal -->
<div class="modal fade" id="modal_nuevo_gasto">
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
                      <h4 class="card-title">Nuevo Gasto</h4>
                    </div>
                    <div class="col-md-2">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                  </div>
                  <!-- <p class="card-category">Complete your profile</p> -->
                  
                </div>
                <div class="card-body">
                  <form method="POST" id="form_alta" @submit.prevent="nuevo_gasto">
                    <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                          <label class="bmd-label-floating">Fecha</label>
                          <input type="date" name="nombre" v-model="nuev_gasto.fecha" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Categoría</label>
                          <select class="form-control" v-model="nuev_gasto.id_categoria">
                            <option value="0">Seleccione Establecimiento</option>
                            <option v-for="cat in categorias" :value="cat.id_categoria">{{cat.descripcion}}</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Establecimiento</label>
                          <select class="form-control" v-model="nuev_gasto.id_establecimiento">
                            <option value="0">Seleccione Establecimiento</option>
                            <option v-for="est in establecimientos" :value="est.id_establecimiento">{{est.nombre}}</option>
                          </select>
                        </div>
                        
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Valor</label>
                          <input type="number" v-model="nuev_gasto.valor" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="">Cantidad</label>
                          <input type="number" min="1" v-model="nuev_gasto.cantidad" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Tipo Recibo</label>
                          <input type="text" v-model="nuev_gasto.tipo_recibo" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Detalle</label>
                          <input type="text" v-model="nuev_gasto.detalle" max-length="10" class="form-control">
                        </div>
                      </div>
                    </div>
                    
                    <button type="submit" class="btn btn-success pull-right">Guardar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
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
      </div>
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
<script src="js/gastos-controller.js"></script>
</body>

</html>