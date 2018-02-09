<?php
  require_once('php/functions.php');
  $mod=array('{check-in}' => '','{check-out}' => '','{errori}' => '');
  if(isset($_GET['check-in']) && isset($_GET['check-out'])) {
    $mod['{check-in}']='value="'.$_GET['check-in'].'"';
    $mod['{check-out}']='value="'.$_GET['check-out'].'"';
  }
  if(isset($_POST['prenota'])){
    $errore="";
    if(!isset($_POST['check-in']) || !checkData($_POST['check-in'])) {
        $errore = $errore . "<li>errore nella data di arrivo</li>";
    }
    if (!isset($_POST['check-out']) || !checkData($_POST['check-out'])) {
        $errore = $errore . "<li>errore nella data di partenza</li>";
    }
    if (!$errore && (!checkDatas($_POST['check-in'],$_POST['check-out'])) ) {
        $errore = $errore . "<li>Prenotazione minima un giorno</li>";
    }
    if (!isset($_POST['NumeroPersone']) || $_POST['NumeroPersone'] > getMaxPersone($_POST['TipoStanza'])) {
        $errore = $errore . "<li>In questo appartamento ha la capienza di ".getMaxPersone($_POST['TipoStanza'])." persone</li>";
    }
    if (!$errore && checkDateLibere(formattaData($_POST['check-in']),formattaData($_POST['check-out']),$_POST['TipoStanza'])) {
        $errore = $errore . "<li>La data di prenotazione e gia impegnata</li>";
    }
    
    if($errore) 
      $mod['{errori}'] = "<ul>".$errore."</ul>";

  }

  $result=PrepareContent($mod,"contents/prenota.html");
  BuildPage("Prenota",$result,1);
?>