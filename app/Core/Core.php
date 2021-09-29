<?php  
    namespace App\Core;   
    use App\Model\User as User; 
    use Lib\Database\Connection as Connection;
     
    class Core
    { 
        public function start()
        { 
            $loader = new \Twig\Loader\FilesystemLoader('app/Template'); 
            $twig = new \Twig\Environment($loader); 

            if(!isset($_GET['url']))
            {
                $controller = "LoginController";
            }
            else
            { 
                $strArray = explode('/', $_GET['url']);    
                $controller = ucfirst($strArray[0] . "Controller");  
            } 
             
            $controller = 'App\Controller\\' . $controller;

            if(User::is_user_logged_in())   
            { 
                $template =  $twig->load('template.html');
 
                $profileController = 'App\Controller\\ProfileController'; 
                $panelController = 'App\Controller\\PanelController';

                if(!class_exists($controller))
                    $controller = "HomeController"; 
  
                $params['user_profile'] = $this->user_func($profileController);
                $params['dynamic_area'] = $this->user_func($controller);
                $params['panel_side'] = $this->user_func($panelController); 
                $params['user_email'] = "email@gmail.com"; 

                $content = $template->render($params);
                echo $content; 
            }
            else
            {
                echo $this->user_func($controller);
            } 
        } 

        public function user_func($controller)  
        {
            $action = "index"; 
            $tmp = $controller; 

            ob_start();
                call_user_func_array(array(new $tmp, $action), array());   
                $user_func = ob_get_contents(); 
            ob_end_clean();
            return $user_func; 
        }

        function get_site_url()
        {  
            return "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
        } 
    }