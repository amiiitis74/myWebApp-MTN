<?php
    
    echo '<script type="text/javascript">  var places = [';


    $result = mysqli_query($conn,"SELECT * FROM complaints");
        while ($row = mysqli_fetch_assoc($result)) { 
            if(strpos($row['net_type'], "LTE") !== false){
                $src = "'./img/loc/sharp-green.png'";
            }else if(strpos($row['net_type'],"3G") !== false ){
            $src = "'./img/loc/dark-blue.png'";
            }else if( strpos($row['net_type'],"4G") !== false ){
                $src = "'./img/loc/light-blue.png'";
            }else if( strpos($row['net_type'],"EDGE") !== false ){
                $src = "'./img/loc/red.png'";
            }else if( strpos($row['net_type'],"EVDO") !== false ){
                $src = "'./img/loc/orange.png'";
            }else if( strpos($row['net_type'],"GPRS") !== false ){
                $src = "'./img/loc/yellow.png'";
            }else if( strpos($row['net_type'],"EHRPD") !== false ){
                $src = "'./img/loc/green.png'";
            }else if( strpos($row['net_type'],"IDEN") !== false ){
                $src = "'./img/loc/purple.png'";
            }else if( strpos($row['net_type'],"UNKNOWN") !== false ){
                $src = "'./img/loc/white.png'";
            }
            echo "
            [".$row['longitude'].",".$row['latitude'].",".$src." ],
            ";
        }
        
  
    echo ']; ';
?>

    //center of the map
    var center = ol.proj.fromLonLat([51.4626601, 35.6977833]);

    //define the view
    var view = new ol.View({
      center: center,
      zoom: 6// 5
    });

    //vector source for markers locations
    var vectorSource = new ol.source.Vector({});


    //loop the array of markers
    var features = [];
    for (var i = 0; i < places.length; i++) {
        var iconFeature = new ol.Feature({
            geometry: new ol.geom.Point(ol.proj.transform([places[i][0], places[i][1]], 'EPSG:4326', 'EPSG:3857')),
        });

        var iconStyle = new ol.style.Style({
            image: new ol.style.Icon({
              src: places[i][2],
              color: places[i][3],
              crossOrigin: 'anonymous',
            })
        });
        iconFeature.setStyle(iconStyle);
        vectorSource.addFeature(iconFeature);
    }


    var vectorLayer = new ol.layer.Vector({
       source: vectorSource,
       updateWhileAnimating: true,
       updateWhileInteracting: true
    });


    //map
    var map = new ol.Map({
      target: 'map',
      view: view,
      layers: [
        new ol.layer.Tile({
          preload: 3,
          source: new ol.source.OSM(),
        }),
        vectorLayer,
      ],
      loadTilesWhileAnimating: true,
    });
</script>
