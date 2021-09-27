<?php
    namespace App\Core;   
    use App\Model\User as User;

    class Core
    {
        public function start($urlGet)
        {   
            $loader = new \Twig\Loader\FilesystemLoader('app/Template'); 
            $twig = new \Twig\Environment($loader); 

            if(User::is_user_logged_in())  
            { 
                $template =  $twig->load('template.html');

                if(isset($urlGet))  
                {
                    $strArray = explode('/', $urlGet);   
                    $controller = ucfirst($strArray[0] . "Controller"); 
                } 
                else
                    $controller = "HomeController";
                
                if(!class_exists($controller))
                    $controller = "HomeController"; 
 
                $params['user_profile'] = $this->user_func('ProfileController', $urlGet);
                $params['dynamic_area'] = $this->user_func($controller, $urlGet);
                $params['panel_side'] = $this->user_func('PanelController', $urlGet); 
                $params['user_email'] = "email@gmail.com"; 

                $content = $template->render($params);
                echo $content; 
            }
            else
            {
                $template =  $twig->load('login-template.html'); 
                $content = $template->render();
                echo $content; 
            } 
        } 

        public function user_func($controller, $params)  
        {
            $action = "index"; 
            $tmp = 'App\Controller\\' . $controller; 

            ob_start();
                call_user_func_array(array(new $tmp, $action), array($params));   
                $user_func = ob_get_contents(); 
            ob_end_clean();
            return $user_func; 
        }
    }