<?php
require_once('php/connection.class.php');

session_start();

function PrepareMenu($title) {
    $menuEntry=array(
        'Home'=>'index.php',
        'Come raggiungerci'=>'come_raggiungerci.php',
        'Le nostre camere'=>'camere.php',
        'Attorno a noi'=>'dintorni.php',
        'I nostri servizi'=>'servizi.php',
        'Contattaci'=>'contatti.php',
        'Prenota'=>'prenota.php',
        'Menu'=>'#naventry-home'
    );
    $menu='<ul class="inner">';
    foreach($menuEntry as $index=>$link) {
        if($index==$title) {
          if($link=='prenota.php')
            $menu=$menu.'<li id="naventry-prenota"><a class="active">'.$index.'</a></li>';
            else if($link=='index.php')
              $menu=$menu.'<li id="naventry-home"><a class="active" href="'.$link.'">'.$index.'</a></li>';
            else{
            $menu=$menu.'<li><a class="active">'.$index.'</a></li>';
          }
        }
        else {
          if($link=='prenota.php')
            $menu=$menu.'<li id="naventry-prenota"><a class="not-active" href="'.$link.'">'.$index.'</a></li>';
          else if($link=='index.php')
            $menu=$menu.'<li id="naventry-home"><a class="not-active" href="'.$link.'">'.$index.'</a></li>';
            else if($link=='#naventry-home')
              $menu=$menu.'<li id="naventry-menu"><a class="not-active" href="'.$link.'">'.$index.'</a></li>';
            else{
            $menu=$menu.'<li><a class="not-active" href="'.$link.'">'.$index.'</a></li>';
          }
        }
    }
    $menu=$menu.'</ul>';
    return $menu;
}

function PrepareHeader($title) {
    $btn='';
    if($title!='Home' && $title!='Prenota')
        $btn='<a id="booking-button" href="prenota.php">PRENOTA ORA</a>';
    $header=file_get_contents("contents/header.html");
    $header=str_replace('{booking-btn}',$btn,$header);
    return $header;
}

function PrepareContent($modification,$content) {
    $page = file_get_contents($content);
    foreach($modification as $tag=>$value){
         $page = str_replace($tag,$value,$page);
    }
    return $page;
}

function PrepareFooter($title) {
    $btn='';
    if($title=='Pannello di Controllo') {
        if(isLogin())
            $btn='<a href="logout.php">LOGOUT</a>';
    }
    else {
        $btn='<a href="cp_admin.php">PANNELLO DI CONTROLLO</a>';
    }
    $footer=file_get_contents("contents/footer.html");
    $footer=str_replace('{cpanel-btn}',$btn,$footer);
    return $footer;
}

function BuildPage($title,$content,$array=0) {
    $page=file_get_contents("contents/structure.html");
    $page=str_replace('{title}',$title,$page);
    $header=PrepareHeader($title);
    $page=str_replace('{header}',$header,$page);
    $navbar=PrepareMenu($title);
    $page=str_replace('{navbar}',$navbar,$page);
    if($array==1)
        $body=$content;
    else
        $body=file_get_contents($content);
    $page=str_replace('{content}',$body,$page);
    $footer=PrepareFooter($title);
    $page=str_replace('{footer}',$footer,$page);
    echo $page;

}
function isLogin() {
    if(isset($_SESSION['adminOnline'])) {
        if($_SESSION['adminOnline']==1)
            return true;
        else
            return false;
    }
    else
        return false;
}

function isAdmin($email,$pwd) {
        $res=connection::QueryRead("SELECT nome FROM amministratori WHERE email='$email' AND password=MD5('$pwd')");
        $row=mysqli_fetch_row($res);
        if($row)
            return true;
        else
            return false;
}

function getAdminName($email,$pwd) {
        $result = connection::QueryRead("SELECT nome FROM amministratori WHERE email='$email' AND password=MD5('$pwd')");
        $row = mysqli_fetch_row($result);
        return $row[0];
}

function getPrenotazioni() {
    $result = connection::QueryRead("SELECT * FROM prenotazioni");
    return $result;

}
function getNomeStanza($TipoStanza) {
    $result = connection::QueryRead("SELECT nomeStanza FROM appartamenti WHERE idStanza='$TipoStanza'");
    $row = mysqli_fetch_row($result);
    return $row[0];
}

function getCostoStanza($TipoStanza) {
    $result = connection::QueryRead("SELECT costoGiornaliero FROM prezzi_disponibilita WHERE idStanza='$TipoStanza'");
    $row = mysqli_fetch_row($result);
    return $row[0];
}
function getCostoTotale($TipoStanza,$stringda,$stringa) {
    $da = new DateTime($stringda);
    $a = new DateTime($stringa);
    $giorni=$da->diff($a)->days;
    return $giorni*getCostoStanza($TipoStanza);
}

function formattaData($string) {
    $date = explode("-", $string);
    $result = $date[2] . "-" . $date[1] . "-". $date[0];
    return $result;
}
function getMaxStanze($idStanza) {
    $result = connection::QueryRead("SELECT maxStanze FROM prezzi_disponibilita WHERE idStanza='$idStanza'");
    $row = mysqli_fetch_row($result);
    return $row[0];
}
function getStanzeOccupate($idStanza) {
    $result = connection::QueryRead("SELECT * FROM prenotazioni WHERE tipoStanza='$idStanza'");
    $row = mysqli_num_rows($result);
    return $row;
}

function checkData($string) {
    $date = explode("-", $string);
    if(sizeof($date) >= 3) {
        return checkdate($date[1], $date[0], $date[2]);
    }
    else
        return false;
}

function checkDatas($stringda,$stringa){
    $da = new DateTime($stringda);
    $a = new DateTime($stringa);
    return $a>$da;
}

function checkDateLibere($data_inizio,$data_fine,$appartamento) {
    //false il periodo è ok, true il periodo è occupato
    $query = "SELECT * FROM prenotazioni
    WHERE (('$data_inizio' BETWEEN data_arrivo AND data_partenza)
    OR (data_arrivo BETWEEN '$data_inizio' AND '$data_fine'))
    AND tipoStanza = '$appartamento'";
    $result = connection::QueryRead($query);
    return (mysqli_fetch_row($result));
}
function checkEmail($email) {
    $result = connection::QueryRead("SELECT email FROM prenotazioni WHERE email='$email'");
    $row = mysqli_fetch_row($result);
    if($row)
        return true;
    else
        return false;

}
function insertPrenotazione($guestName,$guestMail,$da,$a,$tipoStanza) {
    $query = "INSERT INTO `prenotazioni` (`nomeUtente`, `email`, `data_arrivo`, `data_partenza`, `tipoStanza`) VALUES
    ('$guestName', '$guestMail', '$da', '$a', '$tipoStanza')";
    return connection::QueryWrite($query);
}
?>
