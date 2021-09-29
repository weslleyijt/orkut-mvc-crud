<?php
    namespace App\Controller;

    class ProfileController extends Controller
    {
        public function index()
        { 
            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader); 

            $template =  $twig->load('profile.html'); 

            $params = array();
            $params['user_profile'] = "assets/img/default.jpg";
            $params['user_name'] = "Fulano de tal";
            $params['user_status'] = "masculino, solteiro(a)";
            $params['country'] = "Brasil"; 

            $content = $template->render($params);
            echo $content; 
        }
    }