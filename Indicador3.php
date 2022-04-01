<?php  
session_start();
 $connexion = mysqli_connect("localhost:3306", "root", "", "grdxf");
//  $connexion = mysqli_connect("localhost:3307", "root", "12Telemetic12", "grdxf");
 $seleccion = "SELECT an7 FROM reports where grd_id=".$_SESSION['GRD'].";";  
 $resultado = mysqli_query($connexion, $seleccion);  
$fila = mysqli_fetch_array($resultado);
 $dato=$fila["an7"]/100;
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
<div id="Indicar"></div>
	</body>
	
</html>

		<script>
						
		// Element inside which you want to see the chart
let elementos = document.querySelector('#Indicar')

// Properties of the gauge
let Option = {
  hasNeedle: true,
  needleColor: 'gray',
  needleUpdateSpeed: 1000,
  arcColors: ['rgb(61, 204, 91)','rgb(239, 214, 19)','rgb(255, 84, 84)', ],
  arcDelimiters: [50,90],
  rangeLabel: ['0', '10000'],
  centralLabel: ' <?php echo $dato?>',
}

let rangs=(<?php echo $dato?>/10000)*100
// Drawing and updating the chart
GaugeChart.gaugeChart(elementos, 180,Option).updateNeedle(rangs)
		</script>