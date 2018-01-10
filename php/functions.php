<?php

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

function BuildPage($title,$content) {
    $page=file_get_contents("contents/structure.html");
    $page=str_replace('{title}',$title,$page);
    $header=file_get_contents("contents/header.html");
    $page=str_replace('{header}',$header,$page);
    $navbar=PrepareMenu($title);
    $page=str_replace('{navbar}',$navbar,$page);
    $body=file_get_contents($content);
    $page=str_replace('{content}',$body,$page);
    $footer=file_get_contents("contents/footer.html");
    $page=str_replace('{footer}',$footer,$page);
    echo $page;
    
}
?>