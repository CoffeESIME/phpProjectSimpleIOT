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
            <header>
            </header>
            <div>
                        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
                require('obtencionJason.php');
            }
            ?>
            </div>
                <h2  align="center">Registro</h2>
                <form action="PaginaRegistro.php" method="post";>
                    <div>
                        <label for="correo">Datps Avtech:</label>
                        <div>
                            <input type="IP" id="IP" name="IP"
                                   placeholder="Direccion IP" maxlength="20" required
                                   value="<?php if (isset($_POST['IP'])) echo $_POST['correo']; ?>">
                        </div>
                    </div>
                    <div>
                                <div>
                                    <input id="submit" type="submit" name="submit"
                                           value="Acceder">
                                </div>
                        </div>
                </form>
            <hr>       <!-- seccion central -->
            <h3 style="text-align:center">Bienvenido a tu datos de room alert</h3>

<!--pie de pagina-->
            <hr>
            <div>
                <footer>
                </footer>
            </div>
        </body>
<!--    final del documento html-->
</html>