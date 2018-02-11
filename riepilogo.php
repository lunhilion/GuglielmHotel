<?php
  require_once('php/functions.php');
  if(!isset($_SESSION['Preventivo'])) {
    header("location: index.php");
  }
  if(isset($_POST['conferma'])) {
    unset($_SESSION['Preventivo']);
    unset($_SESSION['ArrayMod']);
    header("location: index.php");
  }
  else {
    $mod=$_SESSION['ArrayMod'];

    $result=PrepareContent($mod,"contents/riepilogo.html");
    BuildPage("Riepilogo",$result,1);
  }
?>