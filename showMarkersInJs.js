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
//define icon feature and icon style for each marker place
for (var i = 0; i < places.length; i++) {
    //icon feature
    var iconFeature = new ol.Feature({
        geometry: new ol.geom.Point(ol.proj.transform([places[i][0], places[i][1]], 'EPSG:4326', 'EPSG:3857')),
    });

    //icon style
    var iconStyle = new ol.style.Style({
        image: new ol.style.Icon({
          src: places[i][2],
          crossOrigin: 'anonymous',
        })
    });

    //insert some properties to each icon features (that are markers)
    iconFeature.setProperties({'lat':places[i][1],'lon':places[i][0],'net':places[i][3],'title':places[i][4],'content':places[i][5],'id':places[i][6],'status':places[i][7],'str':places[i][8]});
    //aply icon style to icon feature
    iconFeature.setStyle(iconStyle);
    //add features to Vector Source
    vectorSource.addFeature(iconFeature);
}


//define a vector layer to add vector source into it( that has our features with their properties)
var vectorLayer = new ol.layer.Vector({
   source: vectorSource,
   updateWhileAnimating: true,
   updateWhileInteracting: true
});


//map (apply View, Target and Layers to map)
var map = new ol.Map({
  target: 'map',
  view: view,
  layers: [
    new ol.layer.Tile({
      preload: 3,
      source: new ol.source.OSM(),
    }),
    vectorLayer, //our vector layer (that has every thing we want!)
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

//all details
var netType,title,content,id,status,lat,lon,str = "undefined";  

//function to open the popup
map.on('singleclick', function (event) {    
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
         
         //call geo
          reverseGeocode(lat,lon);
             
         //pop up content                         
         popupContent.innerHTML = "<b>".concat(title,"</b><br />",netType,"<br />",lat," , ",lon,"<br />","<a href='#markerDetails' class='btn btn-info smallBtn'>View</a>"," ","<a href='#' data-href='view_reportsOnMap.php?del_id=",id,"' class='btn btn-danger smallBtn' data-toggle='modal' data-target='#confirm-delete'>Delete</a>","<br />");
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
     document.getElementById('com_str').innerHTML= str.concat(" dbm");
     document.getElementById('com_status').innerHTML= status ;
     document.getElementById('edit_btn').innerHTML= "<li class='list-group-item'><a href='edit_status.php?edit_id=".concat(id,"' class='btn btn-success '> Edit Status </a></li>");
                                                                    
 });




//geocode reverse function
function reverseGeocode(lat,lon) { 
    var key ={city:"city", road:"road", ne:"neighbourhood",town:"town",district:"district",suburb:"suburb",suburb:"county"}
   fetch('http://nominatim.openstreetmap.org/reverse?format=json&lon=' + lon + '&lat=' + lat)
     .then(function(response) {
            return response.json();
        }).then(function(json) {                
            console.log(json["address"]);
            document.getElementById('com_loc').innerHTML= getAddr(json,key).key;
            document.getElementById('com_loc').setAttribute("title",getAddr(json,key).context) ;  
        });
}

function getAddr(json,keyObj){
    var result = {
        context:'',
        key:''
    };
    if(json["address"][keyObj.ne]){
        console.log("Neighbourhood is defined. ");
        
        if(json["address"][keyObj.county]){
            console.log("County is defined too. ");
            result.key=json["address"][keyObj.county].concat(", ",json["address"][keyObj.ne]);
            result.context="County, Neighbourhood";
            return result;
        }else if(json["address"][keyObj.suburb]){
            console.log("Suburb is defined. ");
            result.key=json["address"][keyObj.suburb].concat(", ",json["address"][keyObj.ne]);
            result.context="Suburb, Neighbourhood";
            return result;
        
        }else{
            result.key=json["address"][keyObj.ne];
            result.context="Neighbourhood";
            return result;
        }
            
        
    }else if(json["address"][keyObj.road]){
        console.log("Road is defined. ");
        
        if(json["address"][keyObj.county]){
            console.log("County is defined too. ");
            result.key=json["address"][keyObj.county].concat(", ",json["address"][keyObj.road]);
            result.context="County, Road";
            return result;
        }else if(json["address"][keyObj.suburb]){
            console.log("Suburb is defined. ");
            result.key=json["address"][keyObj.suburb].concat(", ",json["address"][keyObj.road]);
            result.context="Suburb, Road";
            return result;           
        }else{
            result.key=json["address"][keyObj.road];
            result.context="Road";
            return result;
        }
        
        
        
    }else if(json["address"][keyObj.county]){
        console.log("county is defined. ");
        result.key=json["address"][keyObj.county];
        result.context="County";
        return result;  
        
    }else if(json["address"][keyObj.suburb]){
        console.log("Suburb is defined. ");
        
        if(json["address"][keyObj.district]){
            console.log("District is defined too. ");
            result.key=json["address"][keyObj.suburb].concat(", ",json["address"][keyObj.district]);
            result.context="Suburb, District";
            return result;
        }else{       
            result.key=json["address"][keyObj.suburb];
            result.context="Suburb";
            return result;
        }
            
        
    }else if(json["address"][keyObj.city]){
        console.log("City is defined, ");
        
        if(json["address"][keyObj.district]){
            console.log("District is defined too. ");
            result.key=json["address"][keyObj.city].concat(", ",json["address"][keyObj.district]);
            result.context="City, District";
            return result;
        }else{
            result.key=json["address"][keyObj.city];
            result.context="City";
            return result;
        }
        
       
        
    }else if(json["address"][keyObj.town]){
        console.log("Town is defined. ");
        result.key=json["Town"][keyObj.town];
        result.context="Town";
        return result;       
        
    }else{
        console.log("No good address found.");
        result.key = "unknown";
        result.context="unknown";
        return result; 
    }
}
    










