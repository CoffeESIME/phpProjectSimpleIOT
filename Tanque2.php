<?php  
session_start();
 $connexion = mysqli_connect("localhost:3306", "root", "", "grdxf");
//  $connexion = mysqli_connect("localhost:3307", "root", "12Telemetic12", "grdxf");
 $seleccion = "SELECT an4 FROM reports where grd_id=".$_SESSION['GRD'].";";  
 $resultado = mysqli_query($connexion, $seleccion);  
$fila = mysqli_fetch_array($resultado);
 $dato=$fila["an4"];
?> 
<html>
<head>
	<meta charset="UTF-8">
	<title>Tanque de agua</title>
    <script src="Javascriptsweb/jquery.min.js"></script>
<script src="Javascriptsweb/d3tanque3.js"></script>
</head>
<body>
<style>
.divTablata{ display: table; }
.divcedata{ background-color: beige; background: beige  }
            @font-face{
 font-family:'Digital';
 src: url('CSSweb/loopy/LOOPY_IT.ttf');
}

</style>
<div class="divTablata">

<div class="divTableRow">
<div class="divceldata Tanque"></div></div>
<div class="divTableRow">
<div class="divTableCella"><h2 style="font-family:'Digital'" ><?php echo $dato?> L</h2></div></div>
</div>
<script>
    $(document).ready(function() {
        $('.Tanque').waterTank({
            width: 100,
            height:100,
            color: '#72bddb',//color de nuestro liquido
            level:  <?php echo $dato ?>,
            tamano:400// tamaño tanque
	});

});

</script>
</body>
</html>
