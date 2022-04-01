<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Registro</title>
        <meta charset="utf-8">
<link rel="stylesheet" href="CSSweb/estilo.css">
    </head>
    <body>
        <header class="jumbotron jumbotronCabecera">
<!--
<div class="divTabla">
    <div class="divTablaCabeza">
        <a title="Inicio" href="index.php"><img class="imagenizquierda"  src="TelePNG.png"  alt="Logo"></a>
    </div>
    <div class="divTablaCabeza">
-->
                <?php include('Cabecera.php'); ?>
<!--include nos sirve para agregar o quitar elementos en php como ejecutar una subrutina en php-->
            </header>
                    <hr>
        <div>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
                require('PaginadeProcesoDeRegistro.php');
            }
            ?>

            <div>
                <h2  align="center">Registro</h2>
                <form action="PaginaRegistro.php" method="post";>
                    <div>
                        <label for="Nombre">Nombre:</label>
                        <div>
                            <input type="Texto" id="Nombre" name="Nombre"
                                   placeholder="Nombre registro" maxlength="30" required
                                   value="<?php if (isset($_POST['Nombre'])) echo $_POST['Nombre']; ?>" >
                        </div>
                    </div>
                    <div>
                        <label for="NombreCliente">Nombre Cliente:</label>
                        <div>
                            <input type="Cliente" id="Cliente" name="Cliente"
                                   placeholder="Cliente (Empresa)" maxlength="60" required
                                   value="<?php if (isset($_POST['Cliente'])) echo $_POST['Cliente']; ?>">
                        </div>
                    </div>
                    <div>
                        <label for="correo">Correo:</label>
                        <div>
                            <input type="correo" id="correo" name="correo"
                                   placeholder="Correo" maxlength="60" required
                                   value="<?php if (isset($_POST['correo'])) echo $_POST['correo']; ?>">
                        </div>
                    </div>
                    <div>
                        <label for="Contraseña">Contraseña:</label>
                        <div >
                            <input type="password" id="Contraseña1" name="Contraseña1"
                                   placeholder="Contraseña" minlength="8" maxlength="12"
                                   required value="<?php if (isset($_POST['Contraseña1'])) echo $_POST['Contraseña1']; ?>">
                            <span id='mensaje'> 8 a 12 caracteres.</span>
                        </div>
                        <div>
                            <label for="Contraseña2">Confirme contraseña:</label>
                            <div>
                                <input type="password" id="Contraseña2" name="Contraseña2"
                                       placeholder="Confirmar contraseña" minlength="8" maxlength="12" required
                                       value="<?php if (isset($_POST['contraseña2'])) echo $_POST['Contraseña2']; ?>">
                            </div>
                            <div>
                                <div>
                                    <input id="submit" type="submit" name="submit"
                                           value="Registrar">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <?php
            if(!isset($errorstring)) {
                echo '<aside>';
                include('InformacionRegistro.php');
                echo '</aside>';

}
            else
            {
                
                echo '<footer class="jumbotron jumbotronPiedePagina">';
                echo '<hr>';
            }
            include('Pie.php');
            ?>
        </div>
    </body>
</html>      
