/* 
 */

var update_timer;
var map;
var div_chart;
var line_chart;
var select_imei = undefined;

var chartData = {
  labels: [],
  datasets: [{
    label: "Нагрузка, г",
    data: [],
  }]
};
 
var chartOptions = {
  legend: {
    display: false,    
  }
};

function ConvertValue(value){
  return 3.0+(value-641703)/16000;
}

function pointSelect(e){
  var object = e.get('target');    
  var imei = object.properties.get('imei');  
  line_chart.data.labels = [];
  line_chart.data.datasets.data = [];
    
  if(imei == select_imei){  
    select_imei = undefined;
    line_chart.update();
    return;
  }
  
  select_imei = imei;
  
  function datain(data){
    var res = JSON.parse(data);
    var labels = [];
    var data = [];
    
    for(var i in res){
      var row = res[i];
      labels.push(row.date);
      data.push(ConvertValue(row.weight).toFixed(1));
    }
    
    line_chart.data.labels = labels;
    line_chart.data.datasets = [{
      label: "Нагрузка, г",
      data: data,
    }];
    line_chart.update();
  }
  
  $.ajax({
    url:'history?d='+imei,
    success:datain
  });
}

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
          iconContent: ConvertValue(pt.raw_data).toFixed(1),
          hintContent: ConvertValue(pt.raw_data).toFixed(1),
          imei: pt.IMEI
        }
      });
      bln.events.add('click', pointSelect);
      map.geoObjects.add(bln); // Размещение геообъекта на карте.
    }    
  }
  
  $.ajax({
    url:'points',
    success:datain
  });
}
  
$(document).ready(function(){
  update_timer = setInterval(updatePoints, 30000);  
  
  var div_chart = document.getElementById("chart");
  
  line_chart = new Chart(div_chart, {
    type: 'line',
    data: chartData,
    options: chartOptions
  });
});
