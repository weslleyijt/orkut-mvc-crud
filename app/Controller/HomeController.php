<?php
    namespace App\Controller;

    class HomeController extends Controller
    {
        public function index()
        {
            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader); 

            $template =  $twig->load('home.html');  
            $content = $template->render();   
            echo $content;  
        }
    }