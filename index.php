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
   <!--                                              Campo Chara                                                   -->
      <a class="weatherwidget-io" href="https://forecast7.com/es/n40d81n63d00/viedma/" data-label_1="VIEDMA" data-label_2="Rio Negro" data-theme="desert" >VIEDMA Rio Negro</a>

      <!--                                              Campo el Ceferino                                                   -->
      <a class="weatherwidget-io" href="https://forecast7.com/es/n40d05n63d01/patagones-partido/" data-label_1="PATAGONES" data-label_2="Buenos Aires" data-theme="dark" >PATAGONES Buenos Aires</a>
      <!--                                              Campo San Antonio               -->
      	<a class="weatherwidget-io" href="https://forecast7.com/es/n38d99n64d09/la-adela/" data-label_1="LA ADELA" data-label_2="La pampa" data-theme="orange" >LA ADELA La pampa</a>

      	<!--                                              Campo laguna del monte                                                   -->
        <a class="weatherwidget-io" href="https://forecast7.com/es/n40d73n64d95/san-antonio-oeste/" data-label_1="SAN ANTONIO OESTE" data-label_2="CLIMA" data-theme="original" >SAN ANTONIO OESTE CLIMA</a>
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
         <!--    <div class="report-container" style="background: white; padding: 20px; border-radius: 10px;">
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
            </div> -->
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
<!--  <script>
    !function(d,s,id){
      var js,fjs=d.getElementsByTagName(s)[0];
      if(!d.getElementById(id)){
        js=d.createElement(s);js.id=id;
        js.src='https://weatherwidget.io/js/widget.min.js';
        fjs.parentNode.insertBefore(js,fjs);
      }
    }(document,'script','weatherwidget-io-js');
  </script>-->
  <script>
    !function(d,s,id){
      var js,fjs=d.getElementsByTagName(s)[0];
      if(!d.getElementById(id)){
        js=d.createElement(s);
        js.id=id;
        js.src='https://weatherwidget.io/js/widget.min.js';
        fjs.parentNode.insertBefore(js,fjs);
      }
    }(document,'script','weatherwidget-io-js');
  </script>
  <!-- Include Spanish language -->
  <script src="plugins/AirDatePicker/js/i18n/datepicker.es.js"></script>
  <script src="js/vue.js"></script>
  <script src="js/vue-axios.min.js"></script>
<script src="js/index.js"></script>
  <script src="js/rutas.js"></script>
  <script src="js/inicio.js"></script>

</body>

</html>