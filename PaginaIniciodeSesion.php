<!DOCTYPE html>
<html lang="es">
<head>
 <title>inicio Sesión</title>
 <meta charset="utf-8">

    <link rel="stylesheet" href="CSSweb/estilo.css">
</head>
<body>
<header class="jumbotron jumbotronCabecera">
 <?php include('Cabecera.php'); ?>
</header>
<!-- Body Section -->
 <div >
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') { //#1
 require('ProcesoInicio.php');
}
?>
<div>
<h2>Inicio Sesion</h2> 
<form action="PaginaIniciodeSesion.php" method="post" name="loginform" id="loginform">
 <div>
 <label for="usuario">Usuario:</label>
 <div>
 <input type="text" id="usuario" name="usuario" placeholder="Usuario" maxlength="20" required value="<?php if (isset($_POST['usuario'])) echo $_POST['usuario']; ?>" >
 </div>
 </div>
 <div>
 <label for="password">Contraseña:</label>
 <div>
<input type="password" id="password" name="password" placeholder="Contraseña" maxlength="20" required value= "<?php if (isset($_POST['password'])) echo $_POST['password']; ?>">
 <span>Entre 8 y 12 caracteres.</span>
 </div>
<div>
 <div>
 <input id="submit" type="submit" name="submit"
 value="Inicio">
 </div>
     </div>
 </div>
    </form>
</div>
<!-- Right-side Column Content Section -->
</div>
              <div>
                <hr>
              <footer class="jumbotron jumbotronPiedePagina">
                  <?php include('Pie.php'); ?>
              </footer>
          </div>
</body>
</html>