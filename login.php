<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>

    <?php include("header.php"); ?>
    <!-- login -->
    <link rel="stylesheet" type="text/css" href="assets_login/vendor/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets_login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="assets_login/fonts/iconic/css/material-design-iconic-font.min.css">

    <link rel="stylesheet" type="text/css" href="assets_login/vendor/animate/animate.css">

    <link rel="stylesheet" type="text/css" href="assets_login/vendor/css-hamburgers/hamburgers.min.css">

    <link rel="stylesheet" type="text/css" href="assets_login/vendor/animsition/css/animsition.min.css">

    <link rel="stylesheet" type="text/css" href="assets_login/vendor/select2/select2.min.css">

    <link rel="stylesheet" type="text/css" href="assets_login/vendor/daterangepicker/daterangepicker.css">

    <link rel="stylesheet" type="text/css" href="assets_login/css/util.css">
    <link rel="stylesheet" type="text/css" href="assets_login/css/main.css">

</head>
<body>
	
	<div class="limiter" id="app" >

		<div class="container-login100" >
			<div class="wrap-login100" style="max-width: 700px" >


				<form class="login100-form validate-form" @submit.prevent="loguear">
					<span class="login100-form-title p-b-26">
						Bienvenido!
					</span>


                    <div class="wrap-input100 validate-input" data-validate="Ingrese Usuario">
                        <span class="label-input100" >Usuario</span>
                        <input class="input100" v-model="login.us" type="text" name="username"required placeholder="Username...">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate = "Ingrese contraseña">
                        <span class="label-input100">Contraseña</span>
                        <input class="input100" v-model="login.pass" type="password" name="pass" required placeholder="*************">
                        <span class="focus-input100"></span>
                    </div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit">
								Ingresar
							</button>
						</div>
					</div>
					<div class="text-center p-t-115">
						<span class="txt1">
							No tiene una cuenta?
						</span>

						<a class="txt2" href="#">
							Regístrese
						</a>
					</div>
				</form>



			</div>
<!--            <div class="wrap-login100" style="margin-left: 50px;"  >-->
<!---->
<!--            </div>-->
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>

    <script src="assets_login/vendor/jquery/jquery-3.2.1.min.js"></script>

    <script src="assets_login/vendor/animsition/js/animsition.min.js"></script>

    <script src="assets_login/vendor/bootstrap/js/popper.js"></script>
    <script src="assets_login/vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="assets_login/vendor/select2/select2.min.js"></script>

    <script src="assets_login/vendor/daterangepicker/moment.min.js"></script>
    <script src="assets_login/vendor/daterangepicker/daterangepicker.js"></script>

    <script src="assets_login/vendor/countdowntime/countdowntime.js"></script>

    <script src="assets_login/js/main.js"></script>

    <script src="js/vue.js"></script>
    <script src="js/vue-axios.min.js"></script>


    <script src="assets/js/plugins/bootstrap-notify.js"></script>
    <script src="plugins/v-calendar/v-calendar.min.js"></script>
    <script src="assets/js/plugins/moment.min.js"></script>
    <script src="js/rutas.js"></script>

    <script src="js/login.js"></script>

</body>
</html>