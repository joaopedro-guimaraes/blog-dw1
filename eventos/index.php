
<?php $dir = $_SERVER['DOCUMENT_ROOT'];

require_once $dir . '/blogdw1/menu.php';
require_once $dir . '/blogdw1/eventos/eventos.php';

ini_set('display_errors', 0);

?>   

  <head>
    <meta name="viewport" content="initial-scale=1.0, width=device-width" />
    <script src="http://js.api.here.com/v3/3.0/mapsjs-core.js"
        type="text/javascript" charset="utf-8"></script>
    <script src="http://js.api.here.com/v3/3.0/mapsjs-service.js"
        type="text/javascript" charset="utf-8"></script>
    <script src="http://js.api.here.com/v3/3.0/mapsjs-ui.js" 
        type="text/javascript" charset="utf-8"></script>
    <script src="http://js.api.here.com/v3/3.0/mapsjs-mapevents.js" 
        type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" type="text/css" 
          href="http://js.api.here.com/v3/3.0/mapsjs-ui.css" />
          <link rel="stylesheet" href="../blog/public/styles/css/style.css"/>

    <link href='./fullcalendar.min.css' rel='stylesheet' />
<link href='./fullcalendar.print.min.css' rel='stylesheet' media='print' />
<script src='lib/moment.min.js'></script>
<script src='lib/jquery.min.js'></script>
<script src='fullcalendar.min.js'></script>
<script src='pt-br.js'></script>
<script>

  $(document).ready(function() {

    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay,listWeek'
      },
      defaultDate: '2018-12-10',
      editable: true,
      locale: 'pt-br',
      navLinks: true, // can click day/week names to navigate views
      eventLimit: true, // allow "more" link when too many events
      events: {
        url: 'php/get-events.php',
        error: function() {
          $('#script-warning').show();
        }
      },
      loading: function(bool) {
        $('#loading').toggle(bool);
      }
    });

  });

</script>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Eventos</title>
  </head>

  <body class="mt-5">
    <?php
    if (isset($_GET['confirmar'])) {
      confirmarPresenca($_GET['confirmar']);
    }
    if (isset($_GET['remover'])) {
      removerPresenca($_GET['remover']);
    }

    if (!isset($_GET['id'])) {
      ?>
    <div class="container">    
      <?php 
      $pc;
      if (!isset($_GET['page'])) {
        $pc = "1";
      } else {
        $pc = $_GET["page"];
      }
      echo "<h1 class='container-fluid text-center mt-5 pt-5'>Eventos Agendados</h1>";
      listEventos($pc); ?>
    </div>
<?php



} else if (isset($_GET['id'])) {
  $evento = new Evento();
  $evento = getEvento($_GET['id']);
  ?>
          <div style="width: 1200px; height: 480px" id="mapContainer" class="container-fluid"></div>
          <script>

        // Instantiate a map and platform object:
        var platform = new H.service.Platform({
          'app_id': 'HJKlrTPUGmkvNNnKFsxu',
          'app_code': '90VsFtVlM_iubBy5Q_3hVw'
        });
        // Retrieve the target element for the map:
        var targetElement = document.getElementById('mapContainer');

        // Get default map types from the platform object:
        var defaultLayers = platform.createDefaultLayers();
  

        // Instantiate the map:
        var map = new H.Map(
          document.getElementById('mapContainer'),
          defaultLayers.normal.map,
          {
          zoom: 11.75,
          center: { lat: -22.010522, lng: -47.890014 }
          });

            // Create the default UI:
            var ui = H.ui.UI.createDefault(map, defaultLayers, 'pt-BR');
            var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));

        // Create the parameters for the geocoding request:
        var geocodingParams = {
            searchText: '<?= utf8_encode($evento->getEndereco()) ?>'
        };

        // Define a callback function to process the geocoding response:
        var onResult = function(result) {
          var locations = result.Response.View[0].Result,
            position,
            marker;
          // Add a marker for each location found
          for (i = 0;  i < locations.length; i++) {
          position = {
            lat: locations[i].Location.DisplayPosition.Latitude,
            lng: locations[i].Location.DisplayPosition.Longitude
          };
          marker = new H.map.Marker(position);
          map.addObject(marker);
          map.setCenter({lat:locations[i].Location.DisplayPosition.Latitude, lng:locations[i].Location.DisplayPosition.Longitude});
          map.setZoom(15);
          }
        };

        // Get an instance of the geocoding service:
        var geocoder = platform.getGeocodingService();

        // Call the geocode method with the geocoding parameters,
        // the callback and an error callback function (called if a
        // communication error occurs):
        geocoder.geocode(geocodingParams, onResult, function(e) {
          alert(e);
        });
          </script>
        <?php
        mostrarEvento($evento->getId());
      }
      getEventosCalendario();
      ?>
    <div class="container-fluid bg-dark">
      <div class="container">
        <div class="row">
          <div class="col">
            <div
              class="card bg-dark border-dark text-center mb-3"
              style="width: 18rem;"
            >
              <div class="card-body bg-dark">
                <ul class="list-unstyled text-white text-muted">
                  <li class="mb-2">Desenvolvimento</li>
                  <li>Thon C. Ataide</li>
                  <li>Rafael Giro</li>
                  <li>Fabrício Rocha</li>
                  <li>Jonathan</li>
                  <li>João Pedro Guimarães</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col">
            <div
              class="card bg-dark text-center border-dark mt-3 mb-3"
              style="width: 18rem;"
            >
              <div class="card-body bg-dark">
                <ul class="list-unstyled text-white text-muted">
                  <li class="mb-2">Orientação</li>
                  <li>Erinaldo</li>
                  <li>Rafael Lang</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col">
            <div
              class="card bg-dark text-center border-dark mt-3 mb-3"
              style="width: 18rem;"
            >
              <div class="card-body bg-dark">
                <ul class="list-unstyled text-white text-muted">
                  <li class="mb-2">Patrocinio</li>
                  <li>Dolly</li>
                  <li>Trivago</li>
                  <li>Posto Ipiranga</li>
                  <li>Hotel Monte Verde</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>