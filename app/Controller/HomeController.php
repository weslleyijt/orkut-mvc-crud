<?php
    namespace App\Controller;
    use App\Model\User as User;

    class HomeController extends Controller
    {    
        function render_right_content()
        {
            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader); 

            $template =  $twig->load('profile.html'); 
 
            $params = array();
            $params['user_profile'] = self::$user_info['user_profile']; 
            $params['user_name'] = self::$user_info['user_name'];
            $params['user_status'] = self::$user_info['user_status'];
            $params['country'] = self::$user_info['country']; 
            
            $content = $template->render($params);
            return $content;  
        } 
        
        function render_center_content() 
        {
            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader); 
  
            $strArray = explode(' ', self::$user_info['user_name']);    
            $params['user_name'] = $strArray[0];

            $template =  $twig->load('home.html');  
            $content = $template->render($params);  
            return $content;  
        }
         
        function render_left_content()
        {
            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader); 

            $template =  $twig->load('panel.html');  
 
            $content = $template->render();
            return $content;   
        }  
    }