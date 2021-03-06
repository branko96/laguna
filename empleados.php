<?php
session_start();
?>

<!doctype html>
<html lang="en">

<head>
  <title>Empleados</title>
  <!-- Required meta tags -->
  <?php// setcookie('pagina_actual','empleados',time()+60); ?>
   <?php $_SESSION['pagina_actual']='empleados'; ?>
  <?php include('header.php');?>
  <link rel="stylesheet" type="text/css" href="plugins/v-calendar/v-calendar.min.css">
</head>

<body>
  <div class="wrapper ">
    <!-- MENU -->
    <?php include('menu.php');?>
      <!-- End Navbar -->
      <div class="content" id="app">
        <div class="container-fluid" style="background-image: url(assets/img/cartel.jpeg);">
          <!-- your content here -->
        </div>

           <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-warning">
                  <div class="row">
                    <div class="col-md-6">
                      <h4 class="card-title">Empleados</h4>
                    </div>
                    <div class="col-md-6 text-right">
                      <a href="#" id="nuevo_empleado" data-target="#modal_nuevo_user" data-toggle="modal" class="btn btn-success btn-round">Nuevo<div class="ripple-container"></div></a>
                    </div>
                  </div>

                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>Mail</th>
                      <th>DNI</th>
                      <th>Cuil</th>
                      <th>Codigo Postal</th>
                      <th>Puesto</th>
                      <th>Sueldo</th>
                      <th>Fecha Inicio</th>
                      <th>Fecha Fin</th> 
                      <th>Accion</th>
                    </thead>
                    <tbody>
                      <tr v-for="empleado in empleados">
                        <td>{{empleado.id}}</td>
                        <td>{{empleado.nombre}}</td>
                        <td>{{empleado.apellido}}</td>
                        <td>{{empleado.email}}</td>
                        <td>{{empleado.dni}}</td>
                        <td>{{empleado.cuil}}</td>
                        <td>{{empleado.cod_postal}}</td>
                        <td>{{empleado.puesto}}</td>
                        <td>{{empleado.sueldo}}</td>
                        <td>{{empleado.fecha_inicio}}</td>
                        <td>{{empleado.fecha_fin}}</td>
                        <td class="td-actions text-center">
                          <button type="button" title="Editar" @click="modal_editar(empleado.id);" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" @click="eliminar_empleado(empleado.id)" title="Borrar" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>


<div class="modal fade" id="modal_editar_user">
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
                      <h4 class="card-title">Editar Empleado</h4>
                    </div>
                    <div class="col-md-2">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                  </div>
                  <!-- <p class="card-category">Complete your profile</p> -->
                  
                </div>
                <div class="card-body">
                  <form @submit.prevent="editar_empleado">
                    <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                          <label class="">Nombre</label>
                          <input type="text" v-model="empleado_editar.nombre" name="nombre" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="">Apellido</label>
                          <input type="text" v-model="empleado_editar.apellido" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="">Dni</label>
                          <input type="text" v-model="empleado_editar.dni" max-length="10" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="">Email</label>
                          <input type="email" v-model="empleado_editar.email" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="">Cuil</label>
                          <input type="text" v-model="empleado_editar.cuil" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="">Puesto</label>
                          <input type="text" v-model="empleado_editar.puesto" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="">Sueldo</label>
                          <input type="text" v-model="empleado_editar.sueldo" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="">Fecha Inicio</label>
                          <input type="text" disabled v-model="empleado_editar.fecha_inicio" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="">Fecha Fin</label>
                          <input type="date" v-model="empleado_editar.fecha_fin" class="form-control">
                          <!-- <v-date-picker :mode='mode' :formats="formats" v-model='empleado_editar.fecha_fin'>
                          </v-date-picker> -->
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="">Codigo Postal</label>
                          <input type="text" v-model="empleado_editar.cod_postal" class="form-control">
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
<div class="modal fade" id="modal_nuevo_user">
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
                      <h4 class="card-title">Nuevo Empleado</h4>
                    </div>
                    <div class="col-md-2">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                  </div>
                  <!-- <p class="card-category">Complete your profile</p> -->
                  
                </div>
                <div class="card-body">
                  <form @submit.prevent="nuevo_empleado">
                    <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nombre</label>
                          <input type="text" name="nombre" v-model="nuevo_emp.nombre" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="bmd-label-floating">Apellido</label>
                          <input type="text" v-model="nuevo_emp.apellido" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Dni</label>
                          <input type="text" v-model="nuevo_emp.dni" max-length="10" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email</label>
                          <input type="email" v-model="nuevo_emp.email" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Cuil</label>
                          <input type="text" v-model="nuevo_emp.cuil" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Puesto</label>
                          <input type="text" v-model="nuevo_emp.puesto" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Sueldo</label>
                          <input type="text" v-model="nuevo_emp.sueldo" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <!-- <div class="col-md-4">
                        <div class="form-group">
                          <label class="bmd-label-floating">Fecha Fin</label>
                          <input type="date" v-model="nuevo_emp.fecha_fin" class="form-control">
                        </div>
                      </div> -->
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Codigo Postal</label>
                          <input type="text" v-model="nuevo_emp.cod_postal" class="form-control">
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
<script src="plugins/v-calendar/v-calendar.min.js"></script>
<script src="assets/js/plugins/moment.min.js"></script>
  <script src="js/rutas.js"></script>

<script src="js/empleados-controller.js"></script>
</body>

</html>