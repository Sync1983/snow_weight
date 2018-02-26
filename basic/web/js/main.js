/* 
 */

var update_timer;
var map;

function mapInit(){
  map = new ymaps.Map("map", {
            center: [53.198037, 45.020042],
            zoom: 11
  });
}

function updatePoints(){
  
  function datain(data){
    var res = JSON.parse(data);
    
    map.geoObjects.removeAll();
    
    for(var i in res){
      var pt = res[i];      
      var bln = new ymaps.GeoObject({
        geometry: {          
          type: "Point",
          coordinates: [pt.lng*1.0, pt.lat*1.0]
        },
        properties: {            
          iconContent: (pt.raw_data * 1.0).toFixed(0),
          hintContent: (pt.raw_data * 1.0).toFixed(0)
        }
      });
      map.geoObjects.add(bln); // Размещение геообъекта на карте.
    }    
  }
  
  $.ajax({
    url:'points',
    success:datain
  });
}
  
$(document).ready(function(){
  update_timer = setInterval(updatePoints, 2000);  
});
