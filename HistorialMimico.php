 <?php                                                                       
session_start();
if (!isset($_SESSION['nivel']) or ($_SESSION['nivel']!=1))
{ header("Location: PaginaIniciodeSesion.php");
  exit();
}
else {
    if ($_SESSION['GRD']==1)
    { header("Location: HistorialMimico1.php");
    }
    if ($_SESSION['GRD']==2)
    { header("Location: HistorialMimico2.php");
    }
}
?>