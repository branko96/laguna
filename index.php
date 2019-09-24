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
  <link rel="stylesheet" href="assets/css/inicio.css">
  <link rel="stylesheet" href="assets_login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">

</head>

<body>
  <div class="wrapper ">
    <!-- MENU -->
    <?php include('menu.php');?>
      <!-- End Navbar -->
                                                  
      <div class="content" id="app">


        <!--         Campo laguna del monte    -->
        <div v-show="filtro_establecimiento == 1">
          <h1>Campo Laguna del Monte</h1>
          <a class="weatherwidget-io" id="estab1" href="https://forecast7.com/es/n40d73n64d95/san-antonio-oeste/" data-label_1="SAN ANTONIO OESTE" data-label_2="CLIMA" data-theme="original" >SAN ANTONIO OESTE CLIMA</a>
        </div>
        <!--         Campo Ceferino         -->
        <div v-show="filtro_establecimiento == 2">
          <h1>Campo Ceferino</h1>
          <a class="weatherwidget-io" id="estab2" href="https://forecast7.com/es/n40d05n63d01/patagones-partido/" data-label_1="PATAGONES" data-label_2="Buenos Aires" data-theme="dark" >PATAGONES Buenos Aires</a>
        </div>
        <!--         Campo Chacra              -->
        <div v-show="filtro_establecimiento == 3">
          <h1>Campo Chacra</h1>
          <a class="weatherwidget-io" id="estab3" href="https://forecast7.com/es/n40d81n63d00/viedma/" data-label_1="VIEDMA" data-label_2="Rio Negro" data-theme="desert" >VIEDMA Rio Negro</a>
        </div>
        <!--         Campo San Antonio         -->
        <div v-show="filtro_establecimiento == 4">
          <h1>Campo San Antonio</h1>
          <a class="weatherwidget-io" id="estab4" href="https://forecast7.com/es/n38d99n64d09/la-adela/" data-label_1="LA ADELA" data-label_2="La pampa" data-theme="orange" >LA ADELA La pampa</a>
        </div>

        <div class="container-fluid">
          <!-- <img src="assets/img/cartel.jpeg"></img> -->
          <div class="row">

            <div class="col-sm-4">
              <select name="estab" id="select_estab" data-live-search="true" class="selectpicker" ref="sel1" v-model="filtro_establecimiento" @change="change_establecimiento">
                <option v-for="establecimiento in establecimientos" :value="establecimiento.id">{{establecimiento.nombre}}</option>
              </select>
              <!--<input id="air_datepicker" v-model="fecha" style="display: none;" type="text" value="<?php //echo date('d/m/Y');?>"
                     class="datepicker-here"
                     data-language="es"
                     data-inline="true"
                     data-position="top left"/>-->
             <!--<datepicker v-model="fecha" name="uniquename"></datepicker>-->
              <vuejs-datepicker v-model="fecha" @input="fecha = fixDate($event)" :inline="autoshow_calendario" :format="DatePickerFormat" :language="language"></vuejs-datepicker>

            </div>
            	<!-- Precipitaciones Campo Laguna del monte -->
            	<div class="col-sm-3 precipitaciones_div" v-show="filtro_establecimiento == 1">
        		<iframe src="https://www.meteoblue.com/es/tiempo/widget/daily/san-antonio-oeste_argentina_3837980?geoloc=fixed&days=4&tempunit=CELSIUS&windunit=KILOMETER_PER_HOUR&precipunit=MILLIMETER&coloured=coloured&pictoicon=0&pictoicon=1&maxtemperature=0&mintemperature=0&windspeed=0&windspeed=1&windgust=0&winddirection=0&winddirection=1&uv=0&humidity=0&humidity=1&precipitation=0&precipitation=1&precipitationprobability=0&precipitationprobability=1&spot=0&pressure=0&layout=light&location_url=https%3A%2F%2Fwww.meteoblue.com%2Fes%2Ftiempo%2Fwidget%2Fdaily%2Fsan-antonio-oeste_argentina_3837980&location_mainUrl=https%3A%2F%2Fwww.meteoblue.com%2Fes%2Ftiempo%2Fsemana%2Fsan-antonio-oeste_argentina_3837980&nolocation_url=https%3A%2F%2Fwww.meteoblue.com%2Fes%2Ftiempo%2Fwidget%2Fdaily&nolocation_mainUrl=https%3A%2F%2Fwww.meteoblue.com%2Fes%2Ftiempo%2Fsemana%2Findex&dailywidth=54&tracking=%3Futm_source%3Dweather_widget%26utm_medium%3Dlinkus%26utm_content%3Ddaily%26utm_campaign%3DWeather%252BWidget"  frameborder="0" scrolling="NO" allowtransparency="true" sandbox="allow-same-origin allow-scripts allow-popups allow-popups-to-escape-sandbox" style="width: 250px;height: 310px;background: #1F577C;margin-left: auto;margin: auto;color: white"></iframe><div><!-- DO NOT REMOVE THIS LINK --><a href="https://www.meteoblue.com/es/tiempo/semana/san-antonio-oeste_argentina_3837980?utm_source=weather_widget&utm_medium=linkus&utm_content=daily&utm_campaign=Weather%2BWidget" target="_blank"></a></div>
        		</div>

        			<!-- Precipitaciones Campo Ceferino -->
        		<div class="col-sm-3 precipitaciones_div" v-show="filtro_establecimiento == 2">
     			<iframe src="https://www.meteoblue.com/es/tiempo/widget/daily/carmen-de-patagones_argentina_3862583?geoloc=fixed&days=4&tempunit=CELSIUS&windunit=KILOMETER_PER_HOUR&precipunit=MILLIMETER&coloured=coloured&pictoicon=0&pictoicon=1&maxtemperature=0&mintemperature=0&windspeed=0&windspeed=1&windgust=0&winddirection=0&winddirection=1&uv=0&humidity=0&precipitation=0&precipitation=1&precipitationprobability=0&precipitationprobability=1&spot=0&pressure=0&layout=light&location_url=https%3A%2F%2Fwww.meteoblue.com%2Fes%2Ftiempo%2Fwidget%2Fdaily%2Fcarmen-de-patagones_argentina_3862583&location_mainUrl=https%3A%2F%2Fwww.meteoblue.com%2Fes%2Ftiempo%2Fsemana%2Fcarmen-de-patagones_argentina_3862583&nolocation_url=https%3A%2F%2Fwww.meteoblue.com%2Fes%2Ftiempo%2Fwidget%2Fdaily&nolocation_mainUrl=https%3A%2F%2Fwww.meteoblue.com%2Fes%2Ftiempo%2Fsemana%2Findex&dailywidth=54&tracking=%3Futm_source%3Dweather_widget%26utm_medium%3Dlinkus%26utm_content%3Ddaily%26utm_campaign%3DWeather%252BWidget"  frameborder="0" scrolling="NO" allowtransparency="true" sandbox="allow-same-origin allow-scripts allow-popups allow-popups-to-escape-sandbox" style="width: 250px;height: 310px;background: #000000;margin-left: auto;margin: auto;"></iframe><div><!-- DO NOT REMOVE THIS LINK --><a href="https://www.meteoblue.com/es/tiempo/semana/carmen-de-patagones_argentina_3862583?utm_source=weather_widget&utm_medium=linkus&utm_content=daily&utm_campaign=Weather%2BWidget" target="_blank"></a></div>
     			</div>

        		<!-- Precipitaciones Campo Chacra -->
        		<div class="col-sm-3 precipitaciones_div" v-show="filtro_establecimiento == 3">
        			<iframe src="https://www.meteoblue.com/es/tiempo/widget/daily/viedma_argentina_3832899?geoloc=fixed&days=4&tempunit=CELSIUS&windunit=KILOMETER_PER_HOUR&precipunit=MILLIMETER&coloured=coloured&pictoicon=0&pictoicon=1&maxtemperature=0&mintemperature=0&windspeed=0&windspeed=1&windgust=0&winddirection=0&winddirection=1&uv=0&humidity=0&precipitation=0&precipitation=1&precipitationprobability=0&precipitationprobability=1&spot=0&pressure=0&layout=light&location_url=https%3A%2F%2Fwww.meteoblue.com%2Fes%2Ftiempo%2Fwidget%2Fdaily%2Fviedma_argentina_3832899&location_mainUrl=https%3A%2F%2Fwww.meteoblue.com%2Fes%2Ftiempo%2Fsemana%2Fviedma_argentina_3832899&nolocation_url=https%3A%2F%2Fwww.meteoblue.com%2Fes%2Ftiempo%2Fwidget%2Fdaily&nolocation_mainUrl=https%3A%2F%2Fwww.meteoblue.com%2Fes%2Ftiempo%2Fsemana%2Findex&dailywidth=54&tracking=%3Futm_source%3Dweather_widget%26utm_medium%3Dlinkus%26utm_content%3Ddaily%26utm_campaign%3DWeather%252BWidget"  frameborder="0" scrolling="NO" allowtransparency="true" sandbox="allow-same-origin allow-scripts allow-popups allow-popups-to-escape-sandbox" style="width: 250px;height: 310px;background: #B3A797;margin-left: auto;margin: auto;"></iframe><div><!-- DO NOT REMOVE THIS LINK --><a href="https://www.meteoblue.com/es/tiempo/semana/viedma_argentina_3832899?utm_source=weather_widget&utm_medium=linkus&utm_content=daily&utm_campaign=Weather%2BWidget" target="_blank"></a></div>
        		</div>	
        	
     			<!-- Precipitaciones Campo San Antonio -->
        		<div class="col-sm-3 precipitaciones_div" v-show="filtro_establecimiento == 4">
        		<iframe src="https://www.meteoblue.com/es/tiempo/widget/daily/la-adela_argentina_11748567?geoloc=fixed&days=4&tempunit=CELSIUS&windunit=KILOMETER_PER_HOUR&precipunit=MILLIMETER&coloured=coloured&pictoicon=0&pictoicon=1&maxtemperature=0&mintemperature=0&windspeed=0&windspeed=1&windgust=0&winddirection=0&winddirection=1&uv=0&humidity=0&precipitation=0&precipitation=1&precipitationprobability=0&precipitationprobability=1&spot=0&pressure=0&layout=light&location_url=https%3A%2F%2Fwww.meteoblue.com%2Fes%2Ftiempo%2Fwidget%2Fdaily%2Fla-adela_argentina_11748567&location_mainUrl=https%3A%2F%2Fwww.meteoblue.com%2Fes%2Ftiempo%2Fsemana%2Fla-adela_argentina_11748567&nolocation_url=https%3A%2F%2Fwww.meteoblue.com%2Fes%2Ftiempo%2Fwidget%2Fdaily&nolocation_mainUrl=https%3A%2F%2Fwww.meteoblue.com%2Fes%2Ftiempo%2Fsemana%2Findex&dailywidth=54&tracking=%3Futm_source%3Dweather_widget%26utm_medium%3Dlinkus%26utm_content%3Ddaily%26utm_campaign%3DWeather%252BWidget"  frameborder="0" scrolling="NO" allowtransparency="true" sandbox="allow-same-origin allow-scripts allow-popups allow-popups-to-escape-sandbox" style="width: 250px;height: 310px;background: #FEC93B;margin-left: auto;margin: auto;"></iframe><div><!-- DO NOT REMOVE THIS LINK --><a href="https://www.meteoblue.com/es/tiempo/semana/la-adela_argentina_11748567?utm_source=weather_widget&utm_medium=linkus&utm_content=daily&utm_campaign=Weather%2BWidget" target="_blank"></a></div>
        		</div>
            <div class="col-sm-5">

              <div class="card card-primary">
                <div class="card-header-info">Tareas
                  <button type="button" @click="abrir_edicion_tareas" class="btn btn-primary pull-right">Nueva</button>
                </div>
                <div class="card-body">
                  <div v-show="vista_alta_tarea">
                    <div class="row">
                      <div class="form-group col-sm-6">
                        <input type="text" v-model="nueva_tarea_nombre" class="form-control" placeholder="Nombre">
                      </div>
                      <div class="form-group col-sm-6">
                        <input type="text" v-model="nueva_tarea_desc" class="form-control" placeholder="Descripcion">
                      </div>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-success" @click="alta_tarea">Crear</button>
                    </div>
                  </div>
                  <div v-show="vista_edicion_tarea">
                    <div class="row">
                      <div class="form-group col-sm-6">
                        <input type="text" v-model="edit_tarea_nombre" class="form-control" placeholder="Nombre">
                      </div>
                      <div class="form-group col-sm-6">
                        <input type="text" v-model="edit_tarea_desc" class="form-control" placeholder="Descripcion">
                      </div>
                    </div>
                    <div class="form-group">
                      <select name="edit_estab" id="edit_estab" data-live-search="true" class="selectpicker" ref="sel2" v-model="edit_tarea_establecimiento" @change="change_establecimiento_edit">
                        <option v-for="establecimiento in establecimientos" :value="establecimiento.id">{{establecimiento.nombre}}</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <button type="button" class="btn btn-success" @click="editar_tarea">Actualizar</button>
                    </div>
                  </div>
                  <ul class="list-group list-group-flush ">
                    <li class="list-group-item list-group-item-info text-center" v-for="tarea in tareas">
                      <a href="#" @click="abrir_edicion_tareas(tarea.id,tarea.descrip,tarea.nombre,tarea.id_establecimiento)" class="pull-left">
                        <span class="fa fa-pencil"></span>
                      </a>
                      {{tarea.nombre}} - {{tarea.descrip}}
                      <a href="#" class="pull-right" @click="eliminar_tarea(tarea.id)">
                        <span class="fa fa-trash"></span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <!--<div id="openweathermap-widget-15"></div>-->
         <!--    <div class="report-container" style="background: white; padding: 20px; border-radius: 10px;">
                <h2><?php //echo $data->name; ?>{{nombre_estab_elegido}} Clima</h2>
                <div class="time">
                  <div><?php // echo date("l g:i a", $currentTime); ?></div>
                  <div><?php // echo date("jS F, Y",$currentTime); ?></div>
                  <div><?php // echo ucwords($data->weather[0]->description); ?></div>
                </div>
                <div class="weather-forecast">
                  <img src="http://openweathermap.org/img/w/<?php // echo $data->weather[0]->icon; ?>.png"
                       class="weather-icon" /> <?php //echo $data->main->temp_max; ?>°C<span
                        class="min-temperature"><?php //echo $data->main->temp_min; ?>°C</span>
                </div>
                <div class="time">
                  <div>Humedad: <?php //echo $data->main->humidity; ?> %</div>
                  <div>Viento: <?php //echo $data->wind->speed; ?> km/h</div>
                </div>
              </div>
            </div> -->
          </div>

        </div>
      </div>

    </div>
    <!-- FOOTER -->
    <?php include('footer.php');?>
    <!-- END FOOTER -->
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
  <script src="https://unpkg.com/vuejs-datepicker"></script>
<script src="js/index.js"></script>
  <script src="js/rutas.js"></script>
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <script src="assets/js/plugins/moment.min.js"></script>
  <script src="js/inicio.js"></script>

</body>

</html>