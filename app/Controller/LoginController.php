<?php
    namespace App\Controller;
    use App\Model\User as User;

    class LoginController     
    {
        function __construct() {
            if(User::is_user_logged_in()) header('Location: home');
        }

        public function index() 
        { 
            if(!User::is_user_logged_in())
            {
                $loader = new \Twig\Loader\FilesystemLoader('app/Template');
                $twig = new \Twig\Environment($loader); 
 
                $template = $twig->load('login-template.html');    
                $content = $template->render();
                echo $content;  
            }
            else
            { 
                header('Location: home'); 
            }
        } 
    }