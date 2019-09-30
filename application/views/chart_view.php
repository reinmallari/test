<!-- Styles -->
<style>
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>
<body>
	<div id="chartdiv"></div>
<!-- Resources -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://www.amcharts.com/lib/3/amcharts.js" type="text/javascript"></script>
<script src="https://www.amcharts.com/lib/3/serial.js" type="text/javascript"></script>
<script src="https://www.amcharts.com/lib/3/plugins/dataloader/dataloader.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/lib/charts.js')?>"></script>
<script>
 var base_url = '<?php echo base_url();?>';
</script>
 <script type="text/javascript">
// var chartData = generateChartData();
var chart = AmCharts.makeChart("chartdiv", {
      "type": "serial",
      "theme": "light",
      "marginRight": 40,
      "marginLeft": 40,
      "autoMarginOffset": 20,
      "mouseWheelZoomEnabled": true,
      "dataDateFormat": "YYYY-MM-DD",
      "dataLoader": {
          "url": base_url + "chart/get_all_data",
          "format": "json"
      },
	// "dataProvider": chartData,
      "categoryField": "date_created",
      "rotate": false, //Para sa sorting
      "categoryAxis": {
          "gridPosition": "start",
          "axisColor": "#DADADA"
      },
      "valueAxes": [{
          "id": "v1",
          "axisAlpha": 0,
          "position": "left",
          "ignoreAxisWidth": true
      }],

      "graphs": [{
          "id": "g1",
		"lineColor": "#29B4B6",
          "bullet": "round",
          "bulletBorderAlpha": 1,
          "bulletColor": "#FFFFFF",
          "bulletSize": 5,
          "hideBulletsCount": 50,
          "lineThickness": 2,
          "title": "Total Payment",
          "useLineColorForBulletBorder": true,
          "valueField": "current_usage",
          "balloonText": "[[title]] in [[valueField]]:<b>[[current_usage]]</b>"
	}],
      "chartScrollbar": {
          "graph": "g1",
          "oppositeAxis": false,
          "offset": 30,
          "scrollbarHeight": 80,
          "backgroundAlpha": 0,
          "selectedBackgroundAlpha": 0.1,
          "selectedBackgroundColor": "#888888",
          "graphFillAlpha": 0,
          "graphLineAlpha": 0.5,
          "selectedGraphFillAlpha": 0,
          "selectedGraphLineAlpha": 1,
          "autoGridCount": true,
          "color": "#AAAAAA"
      },
      "chartCursor": {
          "pan": true,
          "valueLineEnabled": true,
          "valueLineBalloonEnabled": true,
          "cursorAlpha": 1,
          "cursorColor": "#258cbb",
          "limitToGraph": "g1",
          "valueLineAlpha": 0.2,
          "valueZoomable": true
      },
      "valueScrollbar": {
          "oppositeAxis": false,
          "offset": 50,
          "scrollbarHeight": 10
      },

      "categoryAxis": {
          "parseDates": true,
          "dashLength": 1,
          "minorGridEnabled": true
      },
      "export": {
          "enabled": true
      },
  });
  $.ajax({
  	url: base_url + "chart/get_all_data",
     method: 'get',
  	dataType:"json",
      success: function(data) {
		 console.log(data);
      }, error: function(err) {
  	    console.log(err)
      }
  })
</script>
</body>
