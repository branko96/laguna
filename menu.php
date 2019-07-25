<?php 
include('verificar_login.php');
?>
<div class="sidebar" data-color="orange" data-background-color="black" data-image="assets/img/caballos.jpeg">
      <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
      <div class="logo">
        <!-- <a data-image="assets/img/logo.jpeg" class="simple-text logo-mini"> -->
        </a> 
        <a href="http://www.perros-soft.com" class="simple-text logo-normal">
          <img src="assets/img/logo.jpeg" style="border-radius: 50%"></img>
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <?php $activo='';
          //var_dump($_COOKIE);
                if($_SESSION['pagina_actual'] == 'inicio'){ 
                 // echo "entro";
                  $activo=' active';
                }
            ?>
          <li class="nav-item <?php echo $activo;?>">
            <a class="nav-link" href="index.php">
              <i class="material-icons">dashboard</i>
              <p>Inicio</p>
            </a>
          </li>

           <?php $activo='';
                if($_SESSION['pagina_actual']== 'empleados'){ 
                  $activo=' active';
                }
            ?>
           <li class="nav-item <?php echo $activo;?>">
            <a class="nav-link" href="empleados.php">
              <i class="material-icons">person</i>
              <p>Empleados</p>
            </a>
          </li>

            <?php $activo='';
                if($_SESSION['pagina_actual']== 'ventas'){ 
                  $activo=' active';
                }
            ?>
          <li class="nav-item <?php echo $activo;?>">
            <a class="nav-link" href="ventas.php">
              <i class="material-icons">content_paste</i>
              <p>Ventas</p>
            </a>
          </li>        
                 <?php $activo='';
                if($_SESSION['pagina_actual']== 'movimientos'){ 
                  $activo=' active';
                }
            ?>
          <li class="nav-item <?php echo $activo;?>">
            <a class="nav-link" href="movimientos.php">
              <i class="material-icons">library_books</i>
              <p>Movimientos</p>
            </a>
          </li>
        <?php $activo='';
                if($_SESSION['pagina_actual']== 'caravanas'){ 
                  $activo=' active';
                }
            ?>
          <li class="nav-item <?php echo $activo;?>">
            <a class="nav-link" href="caravanas.php">
              <i class="material-icons">library_books</i>
              <p>Caravanas</p>
            </a>
          </li>
           <?php $activo='';
                if($_SESSION['pagina_actual']== 'gastos'){ 
                  $activo=' active';
                }
            ?>
          <li class="nav-item <?php echo $activo;?>">
            <a class="nav-link" href="gastos.php">
              <i class="material-icons">library_books</i>
              <p>Gastos</p>
            </a>
          </li>
   
          <!-- your sidebar here -->
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
<!--          <div class="navbar-wrapper">-->
<!--             <a class="navbar-brand" href="#pablo">Inicio</a> -->
<!--          </div>-->
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <form class="navbar-form">
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Buscar...">
                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                  <i class="material-icons">search</i>
                  <div class="ripple-container"></div>
                </button>
              </div>
            </form>
            <ul class="navbar-nav">
              <!-- <li class="nav-item dropdown">
                <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">notifications</i>
                  <span class="notification">5</span>
                  <p class="d-lg-none d-md-block">
                    Some Actions
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Mike John responded to your email</a>
                  <a class="dropdown-item" href="#">You have 5 new tasks</a>
                  <a class="dropdown-item" href="#">You're now friend with Andrew</a>
                  <a class="dropdown-item" href="#">Another Notification</a>
                  <a class="dropdown-item" href="#">Another One</a>
                </div>
              </li> -->


              <li class="nav-item dropdown">
                <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="#">Perfil</a>
                  <!-- <a class="dropdown-item" href="#">Settings</a> -->
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="logout.php">Salir</a>
                </div>
              </li>
            </ul>


                <?php if(!isset($_SESSION['objetoCliente'])){ ?>
                      <a href="login.php"><button type="button" class="boton-ingresar "style="font-family: 'Lato', sans-serif;" >INGRESAR	</button></a>
                <?php }else{ ?>
                    <button type="button" class="btn btn-dark">Hola, <?php echo $_SESSION['objetoCliente']['nombre'];?></button>
                <?php } ?>

          </div>
<!--        </div>-->
      </nav>