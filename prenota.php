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
    if (!isset($_POST['guest-name'])) {
        $errore = $errore . "<li>errore nel nome</li>";
    }
    if (!isset($_POST['guest-mail'])) {
        $errore = $errore . "<li>errore nella e-mail</li>";
    }
    if (!$errore && (!checkDatas($_POST['check-in'],$_POST['check-out'])) ) {
        $errore = $errore . "<li>Prenotazione minima un giorno</li>";
    }
    if(!$errore && (getStanzeOccupate($_POST['TipoStanza']) == getMaxStanze($_POST['TipoStanza']))) {
        $errore = $errore . "<li>Il tipo di camera selezionata ha raggiunto il massimo numero di prenotazioni</li>";
    }
    if (!$errore && checkDateLibere(formattaData($_POST['check-in']),formattaData($_POST['check-out']),$_POST['TipoStanza']) && getStanzeOccupate($_POST['TipoStanza']) == getMaxStanze($_POST['TipoStanza'])) {
        $errore = $errore . "<li>La data di prenotazione e gia impegnata</li>";
    }
    
    if($errore) 
      $mod['{errori}'] = "<ul>".$errore."</ul>";
    else {
        $_SESSION['Preventivo']=1;
        header("location: riepilogo.php");
    }

  }

  $result=PrepareContent($mod,"contents/prenota.html");
  BuildPage("Prenota",$result,1);
?>