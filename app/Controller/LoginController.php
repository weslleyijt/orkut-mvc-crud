<?php
    namespace App\Controller;

    class LoginController   
    {
        public function index()
        { 
            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader); 

            $template =  $twig->load('panel.html'); 
 
            $content = $template->render();
            echo $content;  
        }
    }