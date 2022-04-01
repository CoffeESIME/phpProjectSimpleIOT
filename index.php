
<!DOCTYPE html> 
<!--debemos definir que nuestro documento es de tipo HTML-->
<html> 
    <!-- inicio de nuestro documento-->
    <html lang="es"> 
        <head>
            <title>Visualizador de Datos</title>
    <!-- inicio de la cabecera-->
            <meta charset="utf-8">
             <link rel="stylesheet" href="CSSweb/estilo.css">
        </head>
        <body>
            <header class="jumbotron jumbotronCabecera">
                <?php include('Cabecera.php'); ?>
<!--include nos sirve para agregar o quitar elementos en php como ejecutar una subrutina en php-->
            </header>
            <hr>       <!-- seccion central -->
            <h3 style="text-align:center">Bienvenido a tu historial de datos en Telemetic por favor inicia sesión o registrate</h3>

<!--pie de pagina-->
            <hr>
            <div>
                <footer class="jumbotron jumbotronPiedePagina">
                    <?php include('Pie.php'); ?>
                </footer>
            </div>
        </body>
<!--    final del documento html-->
</html>