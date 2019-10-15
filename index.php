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
  <link rel="stylesheet" href="assets/fonts/flaticon.css">

</head>

<body>
  <div class="wrapper ">
    <!-- MENU -->
    <?php include('menu.php');?>
      <!-- End Navbar -->
                                                  
      <div class="content" id="app">

        <select name="estab" id="select_estab" data-live-search="true" class="selectpicker" ref="sel1" v-model="filtro_establecimiento" @change="change_establecimiento">
          <option v-for="establecimiento in establecimientos" :value="establecimiento.id">{{establecimiento.nombre}}</option>
        </select>
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

              <!--<input id="air_datepicker" v-model="fecha" style="display: none;" type="text" value="<?php //echo date('d/m/Y');?>"
                     class="datepicker-here"
                     data-language="es"
                     data-inline="true"
                     data-position="top left"/>-->
             <!--<datepicker v-model="fecha" name="uniquename"></datepicker>-->
              <vuejs-datepicker :use-utc="use_utc" v-model="fecha" @input="change_fecha($event)" :inline="autoshow_calendario" :format="DatePickerFormat" :language="language"></vuejs-datepicker>

            </div>
            	<!-- Precipitaciones Campo Laguna del monte -->
            	<div class="col-sm-3 precipitaciones_div" v-show="filtro_establecimiento == 1">

              	<iframe src="https://www.meteoblue.com/es/tiempo/widget/daily/san-antonio-oeste_argentina_3837980?geoloc=fixed&days=4&tempunit=CELSIUS&windunit=KILOMETER_PER_HOUR&precipunit=MILLIMETER&coloured=coloured&pictoicon=0&pictoicon=1&maxtemperature=0&mintemperature=0&windspeed=0&windspeed=1&windgust=0&winddirection=0&winddirection=1&uv=0&humidity=0&humidity=1&precipitation=0&precipitation=1&precipitationprobability=0&precipitationprobability=1&spot=0&spot=1&pressure=0&layout=dark&location_url=https%3A%2F%2Fwww.meteoblue.com%2Fes%2Ftiempo%2Fwidget%2Fdaily%2Fsan-antonio-oeste_argentina_3837980&location_mainUrl=https%3A%2F%2Fwww.meteoblue.com%2Fes%2Ftiempo%2Fsemana%2Fsan-antonio-oeste_argentina_3837980&nolocation_url=https%3A%2F%2Fwww.meteoblue.com%2Fes%2Ftiempo%2Fwidget%2Fdaily&nolocation_mainUrl=https%3A%2F%2Fwww.meteoblue.com%2Fes%2Ftiempo%2Fsemana%2Findex&dailywidth=54&tracking=%3Futm_source%3Dweather_widget%26utm_medium%3Dlinkus%26utm_content%3Ddaily%26utm_campaign%3DWeather%252BWidget"  frameborder="0" scrolling="NO" allowtransparency="true" sandbox="allow-same-origin allow-scripts allow-popups allow-popups-to-escape-sandbox" style="width: 250px;height: 310px;background: #1F577C;margin-left: auto;margin: auto"></iframe><div><!-- DO NOT REMOVE THIS LINK --><a href="https://www.meteoblue.com/es/tiempo/semana/san-antonio-oeste_argentina_3837980?utm_source=weather_widget&utm_medium=linkus&utm_content=daily&utm_campaign=Weather%2BWidget" target="_blank"></a></div>
        		</div>

        			<!-- Precipitaciones Campo Ceferino -->
        		<div class="col-sm-3 precipitaciones_div widget_ceferino" v-show="filtro_establecimiento == 2">

        		<iframe src="https://www.meteoblue.com/es/tiempo/widget/daily/carmen-de-patagones_argentina_3862583?geoloc=fixed&days=4&tempunit=CELSIUS&windunit=KILOMETER_PER_HOUR&precipunit=MILLIMETER&coloured=coloured&pictoicon=0&pictoicon=1&maxtemperature=0&mintemperature=0&windspeed=0&windspeed=1&windgust=0&winddirection=0&winddirection=1&uv=0&humidity=0&humidity=1&precipitation=0&precipitation=1&precipitationprobability=0&precipitationprobability=1&spot=0&spot=1&pressure=0&layout=dark&location_url=https%3A%2F%2Fwww.meteoblue.com%2Fes%2Ftiempo%2Fwidget%2Fdaily%2Fcarmen-de-patagones_argentina_3862583&location_mainUrl=https%3A%2F%2Fwww.meteoblue.com%2Fes%2Ftiempo%2Fsemana%2Fcarmen-de-patagones_argentina_3862583&nolocation_url=https%3A%2F%2Fwww.meteoblue.com%2Fes%2Ftiempo%2Fwidget%2Fdaily&nolocation_mainUrl=https%3A%2F%2Fwww.meteoblue.com%2Fes%2Ftiempo%2Fsemana%2Findex&dailywidth=54&tracking=%3Futm_source%3Dweather_widget%26utm_medium%3Dlinkus%26utm_content%3Ddaily%26utm_campaign%3DWeather%252BWidget"  frameborder="0" scrolling="NO" allowtransparency="true" sandbox="allow-same-origin allow-scripts allow-popups allow-popups-to-escape-sandbox" style="width: 250px;height: 310px;background: #000000;margin-left: auto;margin: auto"></iframe><div><!-- DO NOT REMOVE THIS LINK --><a href="https://www.meteoblue.com/es/tiempo/semana/carmen-de-patagones_argentina_3862583?utm_source=weather_widget&utm_medium=linkus&utm_content=daily&utm_campaign=Weather%2BWidget" target="_blank"></a></div>

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
                <div class="card-header-info">
                  <div>Tareas
                    <button type="button" @click="abrir_alta_tareas" class="btn btn-primary pull-right"><span class="fa fa-plus"></span></button>
                  </div>
                  <div>{{fecha | formatDate}} - {{nombre_estab_elegido}}</div>

                </div>
                <div class="card-body">
                  <div v-show="vista_alta_tarea">
                    <div class="col-sm-12 pull-right">
                      <button type="button" @click="cerrar_alta" class="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
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
                    <div class="col-sm-12 pull-right">
                      <button type="button" @click="cerrar_edicion" class="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="row">
                      <div class="form-group col-sm-6">
                        <input type="text" v-model="edit_tarea_nombre" class="form-control" placeholder="Nombre">
                      </div>
                      <div class="form-group col-sm-6">
                        <input type="text" v-model="edit_tarea_desc" class="form-control" placeholder="Descripcion">
                      </div>
                    </div>
                    <div class="form-group">
                      <select name="edit_estab" id="edit_estab" data-live-search="true" class="selectpicker" ref="sel2" v-model="edit_tarea_establecimiento">
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
          <div class="col-sm-12 card">
            <div class="card-heading">
             <h3>Caravanas Campo {{nombre_estab_elegido}}</h3>
              <div><span class="flaticon-cow-silhouette"></span> <span class="badge badge-secondary">50</span> Vacas </div>
              <div><span class="flaticon-strong-bull-side-view"></span> <span class="badge badge-secondary">20</span> Toros </div>
            </div>
            <div class="card-body">
            <!--<svg version="1.1" class="hectarea" xmlns="http://www.w3.org/2000/svg"
                 width="100" height="100" viewBox="0 0 100 100">
              <rect x="0" y="0" stroke-width="1" stroke="black" width="100" height="80"
                    fill="RoyalBlue" />
            </svg>-->
              <div class="row" v-show="filtro_establecimiento == 1">
                <?php require('grafico_laguna_monte.html');?>
              </div>
            <!--<svg xmlns="http://www.w3.org/2000/svg" width="200" height="100" viewBox="0 0 200 100" class="hectarea">
              <path fill="#4a90d6" fill-opacity="1" stroke="#222222" stroke-opacity="1" stroke-width="2" stroke-dasharray="none" stroke-linejoin="round" stroke-linecap="butt" stroke-dashoffset="" fill-rule="nonzero" opacity="1" marker-start="" marker-mid="" marker-end="" id="svg_1" d="M3.0211530674960727,63.284551143803924 L16.260179907325835,128.455288801736 L106.50408234635023,128.455288801736 L104.87806608618763,4.065044899296964 L3.0211530674960727,63.284551143803924 z" style="color: rgb(0, 0, 0);" class=""/>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="200" height="100" viewBox="0 0 200 100" class="hectarea">
              <path fill="#4a90d6" fill-opacity="1" stroke="#222222" stroke-opacity="1" stroke-width="2" stroke-dasharray="none" stroke-linejoin="round" stroke-linecap="butt" stroke-dashoffset="" fill-rule="nonzero" opacity="1" marker-start="" marker-mid="" marker-end="" id="svg_5" d="M295.7040632340336,129.95121451973 " style="color: rgb(0, 0, 0);"/>
              <path fill="#4a90d6" fill-opacity="1" stroke="#222222" stroke-opacity="1" stroke-width="2" stroke-dasharray="none" stroke-linejoin="round" stroke-linecap="butt" stroke-dashoffset="" fill-rule="nonzero" opacity="1" marker-start="" marker-mid="" marker-end="" id="svg_7" d="M337.167477225211,195.80487203512934 " style="color: rgb(0, 0, 0);"/>
              <path fill="#4a90d6" fill-opacity="1" stroke="#222222" stroke-opacity="1" stroke-width="2" stroke-dasharray="none" stroke-linejoin="round" stroke-linecap="butt" stroke-dashoffset="" fill-rule="nonzero" opacity="1" marker-start="" marker-mid="" marker-end="" id="svg_4" d="M390.8260129784993,125.88617393235968 " style="color: rgb(0, 0, 0);"/>
              <path fill="#4a90d6" fill-opacity="1" stroke="#222222" stroke-opacity="1" stroke-width="2" stroke-dasharray="none" stroke-linejoin="round" stroke-linecap="butt" stroke-dashoffset="" fill-rule="nonzero" opacity="1" marker-start="" marker-mid="" marker-end="" id="svg_2" d="M452.6146299065283,124.26015769741153 " style="color: rgb(0, 0, 0);"/><path fill="#4a90d6" fill-opacity="1" stroke="#222222" stroke-opacity="1" stroke-width="2" stroke-dasharray="none" stroke-linejoin="round" stroke-linecap="butt" stroke-dashoffset="" fill-rule="nonzero" opacity="1" marker-start="" marker-mid="" marker-end="" id="svg_6" d="M-2.6699037598652353,75.47966755767354 C170.50082526211077,77.10568379262165 170.50082526211077,77.10568379262165 169.91871680282964,76.4227636073663 C170.50082526211077,77.10568379262165 170.50082526211077,42.14633474123684 169.91871680282964,41.46341401387036 C170.50082526211077,42.14633474123684 3.021153062453209,3.121945102481675 2.4390420060817064,2.4390237699679176 C3.021153062453209,3.121945102481675 3.021153062453209,72.22763508777729 2.4390420060817064,71.5447148268785 " style="color: rgb(0, 0, 0);" class=""/>
             </svg>
            <svg xmlns="http://www.w3.org/2000/svg" width="150" height="100" viewBox="0 0 150 100" class="hectarea">
                <path fill="#4a90d6" fill-opacity="1" stroke="#222222" stroke-opacity="1" stroke-width="2" stroke-dasharray="none" stroke-linejoin="round" stroke-linecap="butt" stroke-dashoffset="" fill-rule="nonzero" opacity="1" marker-start="" marker-mid="" marker-end="" id="svg_11" d="M48.87768752286273,267.67766884524855 " style="color: rgb(0, 0, 0);" class=""/><path fill="#4a90d6" fill-opacity="1" stroke="#222222" stroke-opacity="1" stroke-width="2" stroke-dasharray="none" stroke-linejoin="round" stroke-linecap="butt" stroke-dashoffset="" fill-rule="nonzero" opacity="1" marker-start="" marker-mid="" marker-end="" id="svg_1" d="M150.53057539704957,47.016513260769784 L148.93388433742132,1.0000000201966373 L1.000000039900641,2.6528925821800735 C1.7702495084182601,3.214861749117233 81.10908998235487,38.75205071140141 89.37355253172333,24.70246437747511 C97.6380150810918,10.65287804354881 121.60495647426018,10.65287804354881 120.83471078370229,10.090909111105702 C121.60495647426018,10.65287804354881 147.2247903773022,40.40494322127506 147.2247903773022,40.40494322127506 " style="color: rgb(0, 0, 0);" class="" transform="rotate(0.22406457364559174 75.7652969360362,24.008258819579087) "/>
            </svg>-->
            </div>
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
  <!-- Include Spanish language
  <script src="plugins/AirDatePicker/js/i18n/datepicker.es.js"></script>-->
  <script src="js/vue.js"></script>
  <script src="js/vue-axios.min.js"></script>
  <script src="https://unpkg.com/vuejs-datepicker"></script>
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/vuejs-datepicker/1.6.2/locale/index.js"></script>-->
<script src="js/index.js"></script>
  <script src="js/rutas.js"></script>
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <script src="assets/js/plugins/moment.min.js"></script>
  <script src="js/inicio.js"></script>

</body>

</html>
