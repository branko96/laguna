<!doctype html>
<html lang="en">

<head>
  <title>Ventas</title>
  <!-- Required meta tags -->
  <?php $_SESSION['pagina_actual']='ventas'; ?>
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
                      <h4 class="card-title">Ventas</h4>
                    </div>
                    <div class="col-md-6 text-right">
                      <a href="#" @click="habilitar_nueva_venta" data-target="#modal_nuevo" data-toggle="modal" class="btn btn-success btn-round">Nuevo<div class="ripple-container"></div></a>
                    </div>
                  </div>

                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>Nro Fact</th>
                      <th>Fecha</th>
                      <th>Cabezas</th>
                      <th>Kg</th>
                      <th>Peso Kg</th>
                      <th>Bruto</th>
                      <th>Iva</th>
                      <th>Neto</th>
                      <th>Retención</th>
                    </thead>
                    <tbody>
                      <tr v-show="nueva_venta_ver">
                        <td><input type="text" v-model="nuev_venta.num_fact" class="form-control" placeholder="Nro Fact"></td>
                        <td><input type="text" v-model="nuev_venta.fecha" class="form-control" placeholder="Fecha"></td>
                        <td><input type="text" v-model="nuev_venta.cabezas" class="form-control" placeholder="Cabezas"></td>
                        <td><input type="text" v-model="nuev_venta.kg" class="form-control" placeholder="Kg"></td>
                        <td><input type="text" v-model="nuev_venta.peso_x_kg" class="form-control" placeholder="Peso Kg"></td>
                        <td><input type="text" v-model="nuev_venta.bruto" class="form-control" placeholder="Bruto"></td>
                        <td><input type="text" v-model="nuev_venta.iva" class="form-control" placeholder="Iva"></td>
                        <td><input type="text" v-model="nuev_venta.neto" class="form-control" placeholder="Neto"></td>
                        <td><input type="text" v-model="nuev_venta.retencion" class="form-control" placeholder="Retencion"></td>
                      </tr>
                      <tr v-for="venta in ventas">
                        
                        <td>{{venta.fecha}}</td>
                        <td>{{venta.cabezas}}</td>
                        <td>{{venta.kg}}</td>
                        <td>{{venta.peso_x_kg}}</td>
                        <td>{{venta.bruto}}</td>
                        <td>{{venta.iva}}</td>
                        <td>{{venta.neto}}</td>
                        <td>{{venta.retencion}}</td>
                        <td class="td-actions text-center">
                          <button type="button" title="Editar" @click="habilitar_edicion(venta);" class="btn btn-primary btn-link btn-sm">
                            <i class="material-icons">edit</i>
                          </button>
                          <!-- <button type="button" @click="eliminar_caravana(caravana.id)" title="Borrar" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                          </button> -->
                        </td>
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
<script src="js/ventas-controller.js"></script>
</body>

</html>