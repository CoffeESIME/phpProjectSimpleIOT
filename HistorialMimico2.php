 <?php                                                                       
session_start();
if (!isset($_SESSION['nivel']))
{ header("Location: PaginaIniciodeSesion.php");
  exit();
}

?>
<!DOCTYPE HTML>
<html lang="es">
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <title>HMI</title>
    <script src="Javascriptsweb/termometro.js"></script>
    <script src="Javascriptsweb/jquery.min.js"></script>
    <script src="Javascriptsweb/d3tanque2.js"></script>
    <script src="Javascriptsweb/indicador.js"></script>
<link rel="stylesheet" href="CSSweb/estilo.css">
    <style>
                    body{
                    background-color: white;
                    font: 15px arial;
    </style>
    </head>
    <body >
        <header class="jumbotron jumbotronCabecera">
            <?php include('CabeceraIniciado.php'); ?>
        </header>
        <hr>   
        <nav>
            <ul>
                <?php include('BarradeNavegacion.php'); ?>
            </ul>
        </nav>
        <hr>
        <h3 align="center">Bienvenido a tu historial de datos Mimico</h3>
        <hr>
        <div class="divTable blueTable">
            <div class="divTableBody">
                <div class="divTableRow">
                    <div class="divTableCell" id="actualiza1"></div><div class="divTabletanque" id="actualiza2" ></div><div class="divTableCell" id="actualiza3"></div></div>
                                <div class="divTableRow">
                    <div  class="divTableCell">Temperatura</div>
                    <div class="divTableCell">Nivel</div>
                    <div class="divTableCell">Presión</div>
                    </div>
                                <div class="divTableRow">
                    <div class="divTableCell" id="actualiza4"></div><div class="divTabletanque" id="actualiza5" ></div><div class="divTableCell" id="actualiza6"></div></div>
                                <div class="divTableRow">
                    <div  class="divTableCell">Temperatura</div>
                    <div class="divTableCell">Nivel</div>
                    <div class="divTableCell">Presión</div>
                    </div>
                                <div class="divTableRow">
                    <div class="divTableCell" ></div><div class="divTableCell"></div><div class="divTableCell"></div></div>
            </div>
        </div>
        <div class="divrosa" id="" ></div>
        <hr>
        <div>
            <footer class="jumbotron jumbotronPiedePagina">
                <?php include('Pie.php'); ?>
            </footer>
        </div> 
    </body>
</html>

<script type="text/javascript">
    $(document).ready(function() {
        $('#actualiza2').load('Tanque1.php')
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#actualiza1').load('Termometro1.php')
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#actualiza3').load('Indicador1.php')
    });    
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#actualiza4').load('Termometro2.php')
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#actualiza5').load('Tanque2.php')
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#actualiza6').load('Indicador2.php')
    });    
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#actualiza7').load('Rosa1.php')
    });
</script>