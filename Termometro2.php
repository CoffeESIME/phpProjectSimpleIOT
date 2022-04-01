<?php  
session_start();
 $connexion = mysqli_connect("localhost:3306", "root", "", "grdxf");
// $connexion = mysqli_connect("localhost:3307", "root", "12Telemetic12", "grdxf");
 $seleccion = "SELECT an3 FROM reports where grd_id=".$_SESSION['GRD'].";";  
 $resultado = mysqli_query($connexion, $seleccion);  
$fila = mysqli_fetch_array($resultado);
 $dato=$fila["an3"]/1000;
$superior=$dato+30;
    $inferior=$dato-30;
                     ?>  
<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Termometro</title>
        <script src="Javascriptsweb/d3.v5.js"></script>
<script src="Javascriptsweb/term3.js"></script>
	<style>

        @font-face{
 font-family:'Digital';
 src: url('CSSweb/loopy/LOOPY_IT.ttf');
}
        h2{color: red}
	</style>
</head>
<body>

<div id="termo"></div>
    <h2 style="font-family:'Digital'" ><?php echo $dato?> °C</h2>
</body>
</html>
<script>
	var thermo = new Thermometer();
	var container = document.getElementById('termo');
	thermo.render(container, <?php echo $dato?>, <?php echo $inferior?>, <?php echo $superior ?>);
    </script>