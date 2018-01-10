<?php

function BuildPage($title,$content) {
    $page=file_get_contents("contents/structure.html");
    $page=str_replace('{title}',$title,$page);
    $header=file_get_contents("contents/header.html");
    $page=str_replace('{header}',$header,$page);
    $navbar=file_get_contents("contents/navbar.html");
    $page=str_replace('{navbar}',$navbar,$page);
    $body=file_get_contents($content);
    $page=str_replace('{content}',$body,$page);
    $footer=file_get_contents("contents/footer.html");
    $page=str_replace('{footer}',$footer,$page);
    echo $page;
    
}
?>