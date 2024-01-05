<?php
session_start();
include '../class/bdd_connect.php';
require '../class/class.auth.php';
$page = 'dashboard' ;
$Auth->allow('admin');
$typeOfDoc = "dossier";
$parent_id = 0;
?>
<?php include 'includes/head.php'; ?>

<div class="d-flex"  id="wrapper">

    <?php include "includes/sidebar.php" ?>

    <!-- Page Content -->
    <div id="page-content-wrapper">

        <?php include "includes/navigation.php" ?>
        
        <?php include "includes/dashboard.php" ?>

    </div>

</div>



<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="../js/main.js"></script>

<script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/maps.js"></script>
<script src="https://www.amcharts.com/lib/4/geodata/worldLow.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
<script>
am4core.useTheme(am4themes_animated);
var chart = am4core.create("chartdiv", am4maps.MapChart);
chart.homeZoomLevel = 3;
chart.homeGeoPoint = {
  latitude: 50.52,
  longitude: 15.25
};
var latlong = {<?php include 'includes/latLong.php' ; ?>};
var mapData = [<?php include 'includes/mapData.php' ; ?>];

for(var i = 0; i < mapData.length; i++) {
  mapData[i].latitude = latlong[mapData[i].id].latitude;
  mapData[i].longitude = latlong[mapData[i].id].longitude;
}

var title = chart.chartContainer.createChild(am4core.Label);
title.text = "Nombre de visiteurs";
title.fontSize = 20;
title.fontWeight = "bold";
title.paddingTop = 30;
title.align = "center";
title.zIndex = 100;

chart.exporting.menu = new am4core.ExportMenu();
// Zoom control
chart.zoomControl = new am4maps.ZoomControl();

let homeButton = new am4core.Button();
homeButton.events.on("hit", function(ev){
  ev.chart.goHome();
  ev.chart.zoomToMapObject(ev.imageSeries)
});

homeButton.icon = new am4core.Sprite();
homeButton.padding(7, 5, 7, 5);
homeButton.width = 30;
homeButton.icon.path = "M16,8 L14,8 L14,16 L10,16 L10,10 L6,10 L6,16 L2,16 L2,8 L0,8 L8,0 L16,8 Z M16,8";
homeButton.marginBottom = 10;
homeButton.parent = chart.zoomControl;
homeButton.insertBefore(chart.zoomControl.plusButton);

chart.geodata = am4geodata_worldLow;
chart.projection = new am4maps.projections.Miller();

var polygonSeries = chart.series.push(new am4maps.MapPolygonSeries());
polygonSeries.exclude = ["AQ"];
polygonSeries.useGeodata = true;

var imageSeries = chart.series.push(new am4maps.MapImageSeries());
imageSeries.data = mapData;
imageSeries.dataFields.value = "value";

var imageTemplate = imageSeries.mapImages.template;
imageTemplate.propertyFields.latitude = "latitude";
imageTemplate.propertyFields.longitude = "longitude";
imageTemplate.nonScaling = false;

var circle = imageTemplate.createChild(am4core.Circle);
circle.fillOpacity = .8;
circle.fill = "#50AF31";
circle.tooltipText = "{name} : [bold]{value}[/]";

imageSeries.heatRules.push({
  "target": circle,
  "property": "radius",
  "min": 1,
  "max": 3,
  "dataField": "value"
})
</script>



</body>        
</html>