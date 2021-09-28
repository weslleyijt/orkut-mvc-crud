<?php 

    require_once 'vendor/autoload.php'; 

    if(!isset($_GET['url'])) header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]/home");     

    $core = new \App\Core\Core; 
    $core->start($_GET['url']);   
    