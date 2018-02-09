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
        'Contattaci'=>'contatti.php'
    );
    $menu='<ul class="inner">';
    foreach($menuEntry as $index=>$link) {
        if($index==$title) {
            $menu=$menu.'<li><a class="active">'.$index.'</a></li>';
        }
        else {
            $menu=$menu.'<li><a class="not-active" href="'.$link.'">'.$index.'</a></li>';            
        }
    }
    $menu=$menu.'</ul>';
    return $menu;
}

function PrepareHeader($title) {
    $btn='';
    if($title!='Home')
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
    if(isset($_SESSION['adminOnline']))
        return true;
    else
        return false;
}

function isAdmin($email,$pwd) {
    if(isset($email) && isset($pwd)){
        return connection::QueryRead("SELECT nome FROM amministratori WHERE email='$email' AND password=MD5('$pwd')");
    }
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
?>