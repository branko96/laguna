<?php
session_start();
?>
<!doctype html>
<html lang="en" xmlns:v-bind="http://www.w3.org/1999/xhtml">

<head>
  <title>Hectareas</title>
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
                      <h4 class="card-title">Hectareas</h4>
                    </div>
                    <!--<div class="col-md-6 text-right">
                      <a href="#" data-target="#modal_nueva_caravana" data-toggle="modal" class="btn btn-success btn-round">Nuevo<div class="ripple-container"></div></a>
                    </div>-->
                  </div>

                </div>
                <div class="card-body table-responsive" style="min-height: 300px;">
                  <select name="estab" id="select_estab" data-live-search="true" class="selectpicker" ref="sel1" v-model="filtro_establecimiento" @change="change_establecimiento">
                    <option v-for="establecimiento in establecimientos" :value="establecimiento.id">{{establecimiento.nombre}}</option>
                  </select>
                  <table  id="tablahect" class="table table-hover">
                    <thead class="text-warning">

                      <th>Numero</th>
                      <th>Total Vacas</th>
                      <th>Total Toros</th>
                      <th>Total Terneras</th>
                      <th>Total Terneros</th>
                      <th>Total Novillos</th>
                      <th>Total Vacas Viejas</th>
                      <th>Total Vaquillonas</th>
                      <th>Total Caballos</th>
                    </thead>
                    <tbody>
                      <tr v-for="hect in hectareas">


                        <td>{{hect.numero}}</td>
                        <td>{{hect.total_vacas}}</td>
                        <td>{{hect.total_toros}}</td>
                        <td>{{hect.total_terneras}}</td>
                        <td>{{hect.total_terneros}}</td>
                        <td>{{hect.total_novillos}}</td>
                        <td>{{hect.total_vaca_vieja}}</td>
                        <td>{{hect.total_vaquillona}}</td>
                        <td>{{hect.total_caballos}}</td>
                        <!--<td class="td-actions text-center">
                          <button type="button" title="Editar" @click="modal_editar(caravana);" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <button type="button" @click="eliminar_caravana(caravana.id)" title="Borrar" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button>
                        </td>-->
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>

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
  <link rel="stylesheet" href="plugins/bootstrap-select/css/bootstrap-select.css">
  <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>
<script src="js/hectareas-controller.js"></script>
</body>

</html>
