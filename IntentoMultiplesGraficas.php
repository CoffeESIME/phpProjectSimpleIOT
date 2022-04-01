 <?php                                                                       
session_start();
if (!isset($_SESSION['nivel']))
{ header("Location: PaginaIniciodeSesion.php");
  exit();
}
else {
    if ($_SESSION['GRD']==1)
    { header("Location: Graficas1.php");
    }
    if ($_SESSION['GRD']==2)
    { header("Location: Graficas2.php");
    }
}
?>