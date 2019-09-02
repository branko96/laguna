<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
  <title>Inicio</title>
  <!-- Required meta tags -->
  <?php
  $_SESSION['pagina_actual']='inicio';
    //var_dump($_SESSION);
  ?>
  <?php include('header.php');?>

</head>

<body>
  <div class="wrapper ">
    <!-- MENU -->
    <?php include('menu.php');?>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <!-- <img src="assets/img/cartel.jpeg"></img> -->
          <div class="row">
            <div class="col-sm-6">
              <input id="air_datepicker" style="display: none;" type="text" value="<?php echo date('d/m/Y');?>"
                     class="datepicker-here"
                     data-language="es"
                     data-inline="true"
                     data-position="top left"/>
              
            </div>
            <div class="col-sm-6">
              <h2>Información del Clima</h2>
            </div>
          </div>

        </div>
      </div>
      <!-- FOOTER -->
      <?php include('footer.php');?>
      <!-- END FOOTER -->
    </div>
  </div>


  <link href="plugins/AirDatePicker/css/datepicker.min.css" rel="stylesheet" type="text/css">
  <script src="plugins/AirDatePicker/js/datepicker.min.js"></script>

  <!-- Include Spanish language -->
  <script src="plugins/AirDatePicker/js/i18n/datepicker.es.js"></script>
<script src="js/index.js"></script>

</body>

</html>