<?php  
session_start();
 $connexion = mysqli_connect("localhost:3306", "root", "", "grdxf");
// $connexion = mysqli_connect("localhost:3307", "root", "12Telemetic12", "grdxf");
 $seleccion = "SELECT an3 FROM reports where grd_id=".$_SESSION['GRD'].";  ";  
 $resultado = mysqli_query($connexion, $seleccion);  
$fila = mysqli_fetch_array($resultado);
 $dato=$fila["an3"];
?> 

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  	<head>
    	<meta http-equiv="content-type" content="text/html;charset=utf-8">
    	<title>Indicadores</title>
		 <script src="Javascriptsweb/indicador.js"></script>
	<style>
		
			body
			{
			  	font: 10px arial;
			}
			
		</style>
	</head>
	<body>
<div id="Indicador"></div>
	</body>
	
</html>

		<script>
						
		// Element inside which you want to see the chart
let element = document.querySelector('#Indicador')

// Properties of the gauge
let gaugeOptions = {
  hasNeedle: true,
  needleColor: 'gray',
  needleUpdateSpeed: 1000,
  arcColors: ['rgb(255, 84, 84)','rgb(226, 217, 0)','rgb(21, 191, 47)','rgb(226, 217, 0)','rgb(255, 84, 84)', ],
  arcDelimiters: [50,60,70,80],
  rangeLabel: ['0', '200'],
  centralLabel: '<?php echo $dato/1000?> V',
}

let rango=((<?php echo $dato?>/1000)/200)*100
// Drawing and updating the chart
GaugeChart.gaugeChart(element, 200, gaugeOptions).updateNeedle(rango)
		</script>