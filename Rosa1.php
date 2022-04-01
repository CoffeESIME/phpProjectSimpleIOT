<head>
	<!-- Load plotly.js into the DOM -->
	<script src='Javascriptsweb/plotly-latest.min.js'></script>
</head>

<body>
	<div id='myDiv'><!-- Plotly chart will be drawn inside this DIV --></div>
</body>
<script>
    let g=50
    let d=150
    if (d<=22.5 && d>=0) {
        var R= [0,0,g,0,0,0,0,0]
        } 
    else if (d<=337.5 && d>=292.5) {
        var R= [0,0,0,g,0,0,0,0]
        } 
    else if (d<=292.5 && d>=247.5) {
        var R= [0,0,0,0,g,0,0,0]
        } 
    else if (d<=247.5 && d>=202.5) {
        var R= [0,0,0,0,0,g,0,0]
        } 
    else if (d<=202.5 && d>=157.5) {
        var R= [0,0,0,0,0,0,g,0]
        } 
    else if (d<=157.5 && d>=112.5) {
        var R= [0,0,0,0,0,0,0,g]
        } 
    else if (d<=112.5 && d>=67.5) {
        var R= [g,0,0,0,0,0,0,0]
        } 
    else if (d<=67.5 && d>=22.5) {
        var R= [0,g,0,0,0,0,0,0]
        } 
    else if (d<=360 && d>=337.5) {
        var R= [0,0,g,0,0,0,0,0]
        } 
var data = [{
    r: [70,0,0,0,0,0,0,0],
    theta: ["90°", "45°", "0°", "315°", "270°", "225°", "180°", "135°"],
    name: "",
    marker: {color: "rgb(255, 255, 255)"},
    type: "barpolar"
  },{
    r: R,
    theta: ["90°", "45°", "0°", "315°", "270°", "225°", "180°", "135°"],
    name: "m/s",
    marker: {color: "rgb(81, 122, 163)"},
    type: "barpolar"
  }]
var layout = {
      width: 300,
        height: 300,
    
    font: {size: 10},
    legend: {font: {size: 10}},
    polar: {
      barmode: "overlay",
      bargap: 0,
      radialaxis: {ticksuffix: "m/s", angle: 90, dtick: 25},
      angularaxis: {direction: "clockwise"}
    }
  }
Plotly.newPlot("myDiv", data, layout)
</script>