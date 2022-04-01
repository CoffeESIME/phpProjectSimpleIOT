<?php
Define ('Usuario', 'root');
//Define ('Contraseña', ''); 
Define ('Contraseña', ''); 
//Define ('Direccion', 'localhost:3306');
Define ('Direccion', 'localhost:3306');
Define ('NombreBaseDatos', 'grdxf');
try
{
    $ConexionBD = new mysqli(Direccion, Usuario, Contraseña, NombreBaseDatos);
    mysqli_set_charset($ConexionBD, 'utf8');
}
catch(Exception $e) 
{
    print "El sistema esta ocupado, intente más tarde";
}
catch(Error $e)
{
    print "El sistema esta ocupado, intente mas tarde.";
}
?>