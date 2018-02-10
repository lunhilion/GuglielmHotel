<?php
  require_once('php/functions.php');
  $mod=array();
  if(!isset($_SESSION['Preventivo'])) {
    header("location: index.php");
  }
  else {
    $result=PrepareContent($mod,"contents/riepilogo.html");
    BuildPage("Riepilogo",$result,1);
  }
?>