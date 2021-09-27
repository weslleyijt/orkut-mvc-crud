<?php 

require_once 'vendor/autoload.php';
 
$loader = new \Twig\Loader\FilesystemLoader('app/Template');
$twig = new \Twig\Environment($loader); 
$template =  $twig->load('template.html');   
  
ob_start();
    $core = new \App\Core\Core; 
    $core->start($_GET['url']);  

    $middleContent = ob_get_contents(); 
ob_end_clean();

ob_start(); 
    $core->startUserProfile();   
    $profileContent = ob_get_contents(); 
ob_end_clean();
 

ob_start(); 
    $core->startSidePanel($_GET['url']);   
    $startSidePanel = ob_get_contents(); 
ob_end_clean();


$params['user_profile'] = $profileContent; 
$params['dynamic_area'] = $middleContent;
$params['panel_side'] = $startSidePanel;  
$params['user_email'] = "email@gmail.com"; 


$params[''] = $startSidePanel;  

$content = $template->render($params);

echo $content;

    