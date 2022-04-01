<?php
 require ('ConexionMySQLUsuarios.php');
$errors = array(); 
$Nombre = trim($_POST['Nombre']);
if (empty($Nombre)) {
    $errors[] = 'No escribiste ningun nombre.';
}
$Cliente = trim($_POST['Cliente']);
if (empty($Cliente)) {
    $errors[] = 'Olvidaste el nombre de cliente.';
 }
 $correo = trim($_POST['correo']);
 if (empty($correo)) {
     $errors[] = 'Olvidaste proporcionar un correo.';
 }
 $Contraseña1 = trim($_POST['Contraseña1']);
 $Contraseña2 = trim($_POST['Contraseña2']);
if (!empty($Contraseña1)) {
    if ($Contraseña1 !== $Contraseña2) {
        $errors[] = 'Las contraseñas no coinciden.';
    }
} 
else {
    $errors[] = 'Olvidaste la contraseña.';
}
if (empty($errors)) { 
    try {
         
        $CodigoSeguro= password_hash($Contraseña1, PASSWORD_DEFAULT);
        require ('ConexionMySQLUsuarios.php'); 
        $query = "INSERT INTO usuarios_del_grd (nombre, cliente,correo, contraseña, fecha_registro) ";
        $query .=" VALUES(?, ?,?,?, NOW() )"; 
        $q = mysqli_stmt_init($ConexionBD);
        $nivel=1;
        mysqli_stmt_prepare($q, $query);
        mysqli_stmt_bind_param($q, 'ssss', $Nombre, $Cliente, $correo, $CodigoSeguro);
        mysqli_stmt_execute($q);
        if (mysqli_stmt_affected_rows($q) == 1) { 
            header ("location: GraciasporelRegistro.php");
            exit();
        } 
        else {
            $errorstring = "<p style='color:red'>";
            $errorstring .= "Error del sistema<br />No pudimos registrarte";
            echo "<p style='color:red'>$errorstring</p>";
            mysqli_close($ConexionBD);
            echo '<footer style="padding-bottom:1px; padding-top:8px;">
            include("pie.php");</footer>';
            exit();
        }
    }
    catch(Exception $e)
    {
        print "El sistema esta ocupado";
    }
    catch(Error $e)
    {
        print "El sistema esta ocupado intente mas tarde";
    }
} 
else {
    $errorstring = "Error! El siguiente problema(s) ha occurrido:<br>";
    foreach ($errors as $msg) { // Print each error.
        $errorstring .= " - $msg<br>\n";
    }
    $errorstring .= "Intenta de nuevo.<br>";
    echo "<p style='color:red'>$errorstring</p>";
 }
?>