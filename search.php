<?php
Include('dbcon.php');

$tags = $DB->query("SELECT * FROM `tags`");
if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
{
    //$query = mysqli_query($db, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
   // $userdata = mysqli_fetch_assoc($query);
$query =  $DB->query("SELECT id FROM users WHERE id =?", array($_COOKIE['id']));
    if($query[0]['id'] !== $_COOKIE['id'])
    {
        setcookie("id", "", time() - 3600*24*30*12, "/");
        setcookie("hash", "", time() - 3600*24*30*12, "/");
        print "Хм, что-то не получилось";
    }
    else
    {
//print_r($tags);
?>
<html>
   <head>
      <title>Dating Trak</title>
      <!-- Meta -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Режим для инт. эксплорэра - последний -->
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="keywords" content="Diplom.com, Diplom Educafion, Search Teachers">
      <meta name="description" content="Diplom.com, Diplom Educafion, Search Teachers">
      <meta name="author" content="Diplom.com, Diplom Educafion, Search Teachers">    
      <link rel="shortcut icon" href="Da.ico"> <!-- Иконка вкладки Vladimir Samkov, Oksana Popova -->
      <!-- Гугл шрифты -->
      <link href="https://fonts.googleapis.com/css?family=Ubuntu:700" rel="stylesheet">
            
      <!-- Global CSS -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <!--link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.css"-->   
      <!-- Plugins CSS -->
      <link rel="stylesheet" href="D-plugins/font-awesome/css/font-awesome.css">
      <!-- Theme CSS -->  
      <link id="theme-style" rel="stylesheet" href="D-css/SearchLoveSearch.css">
      
      <!--script defer src="js/garlic.js"></script-->
   </head>
<body class="center-block" id="body">
   <div class="justify-content-center" id="Allcontent">
      <header class="">
         <div class="content">
             <div class="logo">
              <!--   <img src="D-IMG/Logo.jpg" alt="Наш сайт знакомств">-->
             </div>
             <div class="InputLogin">
                                <?php
      $id_user = $_COOKIE['id'];
$user = $DB->query("SELECT * FROM `users` WHERE id=?",array($id_user));


      ?>
                 <a href="profil.php" class="a nickname"><?php echo $user[0]['login']; ?></a>
                 <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0.915039 24.0722C7.45481 17.9614 19.0214 18.9015 24.0971 24.0722" stroke="#6B6B6B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M9.68753 11.3805C8.54445 10.687 7.68833 9.5966 7.27802 8.31168C6.86772 7.02677 6.93108 5.63457 7.45637 4.39343C7.98165 3.15228 8.93319 2.14647 10.1344 1.56262C11.3356 0.978774 12.705 0.856538 13.9883 1.21859C15.2717 1.58065 16.3819 2.40242 17.113 3.53141C17.8442 4.6604 18.1465 6.01995 17.964 7.35779C17.7814 8.69562 17.1264 9.92091 16.1204 10.8063C15.1145 11.6916 13.8259 12.177 12.4938 12.1722C11.5042 12.1762 10.5329 11.9022 9.68753 11.3805" stroke="#6B6B6B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
         </div>
      </header>
     <div class="CenterContent justify-content-center">
           <div class="CenterBlock">
               <input id="pac-input" class="controls" type="text" placeholder="Введите город">
    <div id="map"></div>
           </div>
     </div>
     <footer class="row justify-content-center">
            <a href="" class="Falcon">Made by FalconTeam for INT20H</a>
        </footer>  
   </div>
   <script src="D-js/D-js.js"></script>
</body>
</html>

    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      .controls {
        margin-top: 10px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 300px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      .pac-container {
        font-family: Roboto;
      }

      #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
      }

      #type-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }
      #target {
        width: 345px;
      }
    </style>
  </head>
  <body>
    <script>
      // This example adds a search box to a map, using the Google Place Autocomplete
      // feature. People can enter geographical searches. The search box will return a
      // pick list containing a mix of places and predicted search terms.

      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

      function initAutocomplete() {
          var styledMapType = new google.maps.StyledMapType(
              [
  {
    "featureType": "administrative",
    "elementType": "geometry",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "poi",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "road",
    "elementType": "labels.icon",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  },
  {
    "featureType": "transit",
    "stylers": [
      {
        "visibility": "off"
      }
    ]
  }
],
{name: 'Dating Trak'});
              
        var map = new google.maps.Map(document.getElementById('map'), {

          center: {lat: 48.945700, lng: 38.493964},
          zoom: 18,
          mapTypeControlOptions: {
            mapTypeIds: ['roadmap', 'satellite', 'hybrid', 'terrain',
                    'styled_map']
          }
        });

        map.mapTypes.set('styled_map', styledMapType);
        map.setMapTypeId('styled_map');
<?php
        for($i=0; $i < count($tags); $i++){

          $id_user = $tags[$i]['id_user'];
$user = $DB->query("SELECT * FROM `users` WHERE id='$id_user'");

          ?>
 var contentString<?php echo $i; ?> = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h1 id="firstHeading" class="firstHeading"><?php echo $user[0]['name']; ?> </h1>'+
            '<div id="bodyContent">'+
            '<?php echo $tags[$i]['text']; ?>'+
            '</div>'+
            '</div>';

            var infowindow<?php echo $i; ?> = new google.maps.InfoWindow({
          content: contentString<?php echo $i; ?>
        });


        var marker<?php echo $i; ?> = new google.maps.Marker({
          position: {lat: <?php echo $tags[$i]['x']; ?>, lng: <?php echo $tags[$i]['y']; ?>},
          map: map,
          title: '<?php echo $tags[$i]['text'];  ?>',
          animation: google.maps.Animation.DROP,
        });
        marker<?php echo $i; ?>.addListener('click', function() {
          infowindow<?php echo $i; ?>.open(map, marker<?php echo $i; ?>);
        });

        <?php
}
        ?>

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBM6GyeLm7hzLGH3TRSEmUQTYWchvuiq7E&libraries=places&callback=initAutocomplete"
         async defer></script>
  </body>
</html>
<?php
    }}
?>
