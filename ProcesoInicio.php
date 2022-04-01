<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
try {
 require ('ConexionMySQLUsuarios.php');
 $usuario =  $_POST['usuario'];
 if (empty($usuario)) {
 $errors[] = 'Olvidaste tu usuario';
 }
 $password =$_POST['password'];
 if (empty($password)) {
 $errors[] = 'Olvidaste la contraseña.';
 }
 if (empty($errors)) {
 $query =
 "SELECT  cliente,contraseña,nivel,grdusuario FROM usuarios_del_grd WHERE cliente=?";
 $q = mysqli_stmt_init($ConexionBD);
 mysqli_stmt_prepare($q, $query);
 mysqli_stmt_bind_param($q, "s", $usuario);
 mysqli_stmt_execute($q);
 $result = mysqli_stmt_get_result($q);
 $row = mysqli_fetch_array($result, MYSQLI_NUM);
 if (mysqli_num_rows($result) == 1) {
 if (password_verify($password, $row[1])) {
     session_start();
     $_SESSION['nivel'] = (int) $row[2];
     $_SESSION['GRD']=(int) $row[3]; 
     $_SESSION['Nombre']= $row[0]; 
$url = ($_SESSION['nivel'] === 1) ? 'index2.php' :
 'NOEXISTEXD.php'; 

        header('Location: ' . $url);
 } else { 
$errors[] = 'La contraseña no corresponde con nuestros datos. ';
$errors[] = 'Si necesitas registrarte, registrate. ';
 }
 } else {
$errors[] = 'El usuario no corresponde con nuestros datos. ';
$errors[] = 'Si necesitas registrarte, regístrate. ';
}
}
if (!empty($errors)) {
 $errorstring =
 "Error! <br /> Los siguientes errores han ocurrido:<br>";
 foreach ($errors as $msg) { // Print each error.
 $errorstring .= " $msg<br>\n";
 }
 $errorstring .= "Intenta de nuevo.<br>";
echo "<p style='color:red'>$errorstring</p>";
 }// final de los errores
 mysqli_stmt_free_result($q);
 mysqli_stmt_close($q);
 }
 catch(Exception $e)
 {
 print "El sistema está ocupado intente de nuevo";
 }
 catch(Error $e)
 {
 print "El sistema está ocupado intente de nuevo.";
 }
} ?>