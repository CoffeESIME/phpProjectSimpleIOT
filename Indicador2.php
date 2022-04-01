<?php  
session_start();
 $connexion = mysqli_connect("localhost:3306", "root", "", "grdxf");
//  $connexion = mysqli_connect("localhost:3307", "root", "12Telemetic12", "grdxf");
 $seleccion = "SELECT an6 FROM reports where grd_id=".$_SESSION['GRD'].";";  
 $resultado = mysqli_query($connexion, $seleccion);  
$fila = mysqli_fetch_array($resultado);
 $dato=$fila["an6"]/100;
?> 

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  	<head>
    	<meta content="text/html;charset=utf-8">
    	<title>Indicador</title>
		 <script src="Javascriptsweb/indicador.js"></script>
	<style>
		
			body
			{
			  	font: 10px arial;
			}
			
		</style>
	</head>
	<body>
<div id="Indicacion"></div>
	</body>
	
</html>

		<script>
						
		// Element inside which you want to see the chart
let elemento = document.querySelector('#Indicacion')

// Properties of the gauge
let Options = {
  hasNeedle: true,
  needleColor: 'gray',
  needleUpdateSpeed: 1000,
  arcColors: ['rgb(255, 84, 84)','rgb(226, 217, 0)','rgb(21, 191, 47)','rgb(226, 217, 0)','rgb(255, 84, 84)', ],
  arcDelimiters: [50,60,70,80],
  rangeLabel: ['0', '200'],
  centralLabel: '<?php echo $dato?> V',
}

let rang=(<?php echo $dato?>/200)*100
// Drawing and updating the chart
GaugeChart.gaugeChart(elemento, 200, Options).updateNeedle(rang)
		</script>