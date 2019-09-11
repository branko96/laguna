<?php
session_start();

$apiKey = "410463b3935acea56c8171825dbb4440";
$cityId = "3435910";
$lat=-40.699819;
$lng=-64.565306;
$googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?lat=".$lat."&lon=".$lng."&lang=es&units=metric&APPID=" . $apiKey;

$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);

curl_close($ch);
$data = json_decode($response);
$currentTime = time();

//var_dump($data);
date_default_timezone_set('america/argentina/buenos_aires');

setlocale(LC_TIME, 'es_CO.UTF-8');
//date_default_timezone_set('UTC');
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
      <div class="content" id="app">
        <div class="container-fluid">
          <!-- <img src="assets/img/cartel.jpeg"></img> -->
          <div class="row">
            <div class="col-sm-6">
              <select name="estab" id="select_estab" data-live-search="true" class="selectpicker" ref="sel1" v-model="filtro_establecimiento" @change="change_establecimiento">
                <option v-for="establecimiento in establecimientos" :value="establecimiento.id">{{establecimiento.nombre}}</option>
              </select>
              <input id="air_datepicker" style="display: none;" type="text" value="<?php echo date('d/m/Y');?>"
                     class="datepicker-here"
                     data-language="es"
                     data-inline="true"
                     data-position="top left"/>

            </div>
            <div class="col-sm-6">
              <!--<div id="openweathermap-widget-15"></div>-->
              <div class="report-container" style="background: white; padding: 20px; border-radius: 10px;">
                <h2><?php //echo $data->name; ?>{{nombre_estab_elegido}} Clima</h2>
                <div class="time">
                  <div><?php echo date("l g:i a", $currentTime); ?></div>
                  <div><?php echo date("jS F, Y",$currentTime); ?></div>
                  <div><?php echo ucwords($data->weather[0]->description); ?></div>
                </div>
                <div class="weather-forecast">
                  <img src="http://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png"
                       class="weather-icon" /> <?php echo $data->main->temp_max; ?>°C<span
                        class="min-temperature"><?php echo $data->main->temp_min; ?>°C</span>
                </div>
                <div class="time">
                  <div>Humedad: <?php echo $data->main->humidity; ?> %</div>
                  <div>Viento: <?php echo $data->wind->speed; ?> km/h</div>
                </div>
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


  <link href="plugins/AirDatePicker/css/datepicker.min.css" rel="stylesheet" type="text/css">
  <script src="plugins/AirDatePicker/js/datepicker.min.js"></script>
  <link rel="stylesheet" href="plugins/bootstrap-select/css/bootstrap-select.css">
  <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>
  <!-- Include Spanish language -->
  <script src="plugins/AirDatePicker/js/i18n/datepicker.es.js"></script>
  <script>
    window.myWidgetParam ? window.myWidgetParam : window.myWidgetParam = [];
    window.myWidgetParam.push({
      id: 15,
      cityid: '3435910',
      language:'es',
      appid: '410463b3935acea56c8171825dbb4440',
      units: 'metric',
      containerid: 'openweathermap-widget-15',
    });
    (function() {
      var script = document.createElement('script');
      script.async = true;
      script.charset = "utf-8";
      script.src = "//openweathermap.org/themes/openweathermap/assets/vendor/owm/js/weather-widget-generator.js";
      var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(script, s);
    })();
  </script>
  <script src="js/vue.js"></script>
  <script src="js/vue-axios.min.js"></script>
<script src="js/index.js"></script>
  <script src="js/rutas.js"></script>
  <script src="js/inicio.js"></script>

</body>

</html>