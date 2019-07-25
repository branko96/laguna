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
        </div>
      </div>
      <!-- FOOTER -->
      <?php include('footer.php');?>
      <!-- END FOOTER -->
    </div>
  </div>

<script src="js/index.js"></script>

</body>

</html>