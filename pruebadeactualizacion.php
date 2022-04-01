 <?php                                                                       
session_start();
if (!isset($_SESSION['nivel']) or ($_SESSION['nivel']!=1))
{ header("Location: PaginaIniciodeSesion.php");
  exit();
}
?>
<!DOCTYPE html> 
<!--debemos definir que nuestro documento es de tipo HTML-->
<html> 
    <!-- inicio de nuestro documento-->
        
<html lang="es"> 
    <head>
    <title>Página para pruebas</title>
    <!-- inicio de la cabecera-->
    <meta charset="utf-8">

    <script src="Javascriptsweb/jquery.min.js"></script>
    <link rel="stylesheet" href="CSSweb/jquery-ui.css"> 
    <link rel="stylesheet" href="CSSweb/estilo.css">
<!--    final de la cabecera-->
    </head>
<!--    inicio del cuerpo y final -->
    <body>

     <header class="jumbotron jumbotronCabecera">
         <?php include('CabeceraIniciado.php'); ?>
<!--include nos sirve para agregar o quitar elementos en php como ejecutar una subrutina en php-->
        </header>
        
        <hr>       <!-- seccion central -->
        <nav>
            <ul>
                <?php include('BarradeNavegacion.php'); ?>
            </ul>
        </nav>
        <h4 font-family: Rubik,sans-serif>Esta Pagina muestra los datos almacenados en la Base de datos llamada aleatorios, guardados en MySQL Datos de historial</h4>

	<div id="actualiza" class="divtamano">

	<script type="text/javascript">
		$(document).ready(function() {
			setInterval(function () {
				$('#actualiza').load('PruebasMySQLGeneral.php')
			}, 5000);
		});
	</script>

<!--pie de pagina-->
        </div>
               <hr> 
        <div>
            <footer class="jumbotron jumbotronPiedePagina">
                <?php include('Pie.php'); ?>
            </footer>
        </div>
    </body>
<!--    final del documento html-->
</html>
