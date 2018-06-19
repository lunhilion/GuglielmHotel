<?php
  require_once('php/functions.php');
  $mod=array('{check-in}' => '','{check-out}' => '','{errori}' => '');
  if(isset($_SESSION['Preventivo']))
    header("location: riepilogo.php");

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
    if (!isset($_POST['guest-name']) || $_POST['guest-name']=='') {
        $errore = $errore . "<li>errore nel nome</li>";
    }
    if (!isset($_POST['guest-mail']) || $_POST['guest-mail']=='') {
        $errore = $errore . "<li>errore nella e-mail</li>";
    }
    else {
        if(!filter_var($_POST['guest-mail'], FILTER_VALIDATE_EMAIL))
            $errore = $errore . "<li>formato email non corretto</li>";
    }
    if (!$errore && (!checkDatas($_POST['check-in'],$_POST['check-out'])) ) {
        $errore = $errore . "<li>Prenotazione minima un giorno</li>";
    }
    if(!$errore && (getStanzeOccupate($_POST['TipoStanza']) == getMaxStanze($_POST['TipoStanza']))) {
        $errore = $errore . "<li>Il tipo di camera selezionata ha raggiunto il massimo numero di prenotazioni</li>";
    }
    if (!$errore && !checkBoundDate(formattaData($_POST['check-in']),formattaData($_POST['check-out']),$_POST['TipoStanza'])) {
        $errore = $errore . "<li>La stanza non è prenotabile nel periodo selezionato</li>";
    }

    if($errore)
    {
      $mod['{errori}'] = '<ul class="error">'.$errore.'</ul>';
    }
    else {
        $_SESSION['Preventivo']=1;
        $_SESSION['ArrayMod']=array('{guest-name}' => $_POST['guest-name'],
                                    '{guest-mail}' => $_POST['guest-mail'],
                                    '{TipoStanza}' => getNomeStanza($_POST['TipoStanza']),
                                    '{check-in}' => $_POST['check-in'],
                                    '{costo}' => getCostoTotale($_POST['TipoStanza'],formattaData($_POST['check-in']),formattaData($_POST['check-out'])),
                                    '{check-out}' => $_POST['check-out'],
                                    'idStanza' => $_POST['TipoStanza']);
        header("location: riepilogo.php");
    }

  }

  $result=PrepareContent($mod,"contents/prenota.html");
  BuildPage("Prenota",$result,1);
?>
