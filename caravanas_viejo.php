<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
  <title>Caravanas</title>
  <!-- Required meta tags -->
  <?php $_SESSION['pagina_actual']='hectareas'; ?>
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
                      <h4 class="card-title">Caravanas</h4>
                    </div>
                    <div class="col-md-6 text-right">
                      <a href="#" data-target="#modal_nueva_caravana" data-toggle="modal" class="btn btn-success btn-round">Nuevo<div class="ripple-container"></div></a>
                    </div>
                  </div>

                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>ID</th>
                      <th>Codigo</th>
                      <th>Descripcion</th>
                      <th>Cantidad</th>
                      <th>Peso</th>
                      <th>Sexo</th>
                      <th>Categoria</th>
                      <th>Procedencia</th>
                      <th>Hectarea</th>
                      <th>Accion</th>
                    </thead>
                    <tbody>
                      <tr v-for="caravana in hectareas">
                        <td>{{hectarea.id}}</td>
                        <td>{{caravana.codigo}}</td>
                        <td>{{caravana.descripcion}}</td>
                        <td>{{caravana.cantidad}}</td>
                        <td>{{caravana.peso}}</td>
                        <td>{{caravana.sexo}}</td>
                        <td>{{caravana.categoria}}</td>
                        <td>{{caravana.procedencia}}</td>
                        <td>{{caravana.hectarea}}</td>
                        <td class="td-actions text-center">
                          <button type="button" title="Editar" @click="modal_editar(caravana);" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" @click="eliminar_caravana(caravana.id)" title="Borrar" class="btn btn-danger btn-link btn-sm">
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


<div class="modal fade" id="modal_editar_caravana">
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
                      <h4 class="card-title">Editar Caravana</h4>
                    </div>
                    <div class="col-md-2">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                  </div>
                  <!-- <p class="card-category">Complete your profile</p> -->
                  
                </div>
                <div class="card-body">
                  <form @submit.prevent="editar_caravana">
                     <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                          <label class="">Código</label>
                          <input type="text" name="nombre" v-model="caravana_editar.codigo" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="">Descripción</label>
                          <input type="text" v-model="caravana_editar.descripcion" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="">Peso</label>
                          <input type="text" v-model="caravana_editar.peso" max-length="10" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="">Sexo</label>
                          <select name="sexo" id="" v-model="caravana_editar.sexo" class="form-control">
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="">Categoría</label>
                          <input type="text" v-model="caravana_editar.categoria" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="">Cantidad</label>
                          <input type="number" v-model="caravana_editar.cantidad" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="">Procedencia</label>
                          <select name="procedencia" v-model="caravana_editar.procedencia" class="form-control">
                            <option v-for="est in establecimientos" :value="est.id">{{est.nombre}}</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="">Hectarea</label>
                          <input type="text" name="hectarea" v-model="caravana_editar.hectarea" class="form-control">
                        </div>
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
<div class="modal fade" id="modal_nueva_caravana">
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
                      <h4 class="card-title">Nueva Caravana</h4>
                    </div>
                    <div class="col-md-2">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                  </div>
                  <!-- <p class="card-category">Complete your profile</p> -->
                  
                </div>
                <div class="card-body">
                  <form method="POST" id="form_alta" @submit.prevent="nueva_caravana">
                    <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                          <label class="bmd-label-floating">Código</label>
                          <input type="text" name="nombre" v-model="nuev_caravana.codigo" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Descripción</label>
                          <input type="text" v-model="nuev_caravana.descripcion" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Peso</label>
                          <input type="text" v-model="nuev_caravana.peso" max-length="10" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Sexo</label>
                          <select name="sexo" v-model="nuev_caravana.sexo" class="form-control">
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Categoría</label>
                          <input type="text" v-model="nuev_caravana.categoria" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="">Cantidad</label>
                          <input type="number" v-model="nuev_caravana.cantidad" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Procedencia</label>
                          <select name="procedencia" v-model="nuev_caravana.procedencia" class="form-control">
                            <option v-for="est in establecimientos" :value="est.id">{{est.nombre}}</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="">Hectarea</label>
                          <input type="text" name="hectarea" v-model="nuev_caravana.hectarea" class="form-control">
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
<script src="js/hectareas-controller_viejo.js"></script>
</body>

</html>
