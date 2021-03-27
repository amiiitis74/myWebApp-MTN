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
            [".$row['longitude'].",".$row['latitude'].",".$src.",'".$row['net_type']."','".$row['title']."','".$row['content']."','".$row['id']."','".$row['status']."','".$row['signal_str']."' ],
            ";
        }       
  
    echo ']; ';
?>

    
    //center of the map
    var center = ol.proj.fromLonLat([51.4626601, 35.6977833]);

    //define the view
    var view = new ol.View({
      center: center,
      zoom: 8
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
              crossOrigin: 'anonymous',
            })
        });
                                        
        iconFeature.setProperties({'lat':places[i][1],'lon':places[i][0],'net':places[i][3],'title':places[i][4],'content':places[i][5],'id':places[i][6],'status':places[i][7],'str':places[i][8]});
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
                                      

                                      
    //Initialize the popup                                    
     var container = document.getElementById('popup');
     var popupContent = document.getElementById('popup-content');
     var closer = document.getElementById('popup-closer');

     var overlay = new ol.Overlay({
         element: container,
         autoPan: true,
         autoPanAnimation: {
             duration: 250
         }
     });
     map.addOverlay(overlay);

     closer.onclick = function() {
         overlay.setPosition(undefined);
         closer.blur();
         return false;
     };


    //function to open the popup
    map.on('singleclick', function (event) {
         var netType,title,content,id,status,lat,lon,str = "undefined";  
         if (map.hasFeatureAtPixel(event.pixel) === true) {                         
             var coordinate = event.coordinate;
             var feature = map.forEachFeatureAtPixel(event.pixel,
                 function(feature, layer) {
                   netType = feature.get('net');                        
                   title =  feature.get('title');                        
                   content =  feature.get('content');                        
                   id =  feature.get('id'); 
                   lat = feature.get('lat');                   
                   lon = feature.get('lon');                   
                   str = feature.get('str');                   
                   status = feature.get('status');                   
                   return [feature, layer];   
                 });                             
             popupContent.innerHTML = "<b>".concat(title,"</b><br />",netType,"<br />",lat," , ",lon);
             overlay.setPosition(coordinate);
         } else {
             overlay.setPosition(undefined);
             closer.blur();
         }
         
         //show details in table                             
         document.getElementById('com_id').innerHTML= id ;
         document.getElementById('com_title').innerHTML= title ;
         document.getElementById('com_content').innerHTML= content ;
         document.getElementById('com_net').innerHTML= netType ;
         document.getElementById('com_loc').innerHTML= "".concat(lat," , ",lon);
         document.getElementById('com_str').innerHTML= str.concat(" dbm");
         document.getElementById('com_status').innerHTML= status ;
         document.getElementById('edit_btn').innerHTML= "<li class='list-group-item'><a href='edit_status.php?edit_id=".concat(id,"' class='btn btn-success '> Edit Status </a></li>")  ;
         document.getElementById('del_btn').innerHTML= "<li class='list-group-item'><a href='edit_status.php?edit_id=".concat(id,"' class='btn btn-success '> Delete Marker </a></li>")  ;                             
                                      
     });
    
                                      
</script>
