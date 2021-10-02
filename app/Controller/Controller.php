<?php
    namespace App\Controller; 
    use App\Model\User as User;

    abstract class Controller      
    {
        protected static $user_info;   

        function __construct() {

            if(!User::is_user_logged_in())
            {
                header('Location: login');     
            } 

            self::$user_info = User::user_infor();  
        } 
 
        public function index()
        {    
            if(User::is_user_logged_in())
            {
                $loader = new \Twig\Loader\FilesystemLoader('app/Template'); 
                $twig = new \Twig\Environment($loader); 

                $template =  $twig->load('template.html');
  
                $params['col_left'] = $this->render_left_content(); 
                $params['col_middle'] = $this->render_center_content();
                $params['col_right'] = $this->render_right_content();   
     
                $params['user_email'] = self::$user_info['user_email'];   
 
                $content = $template->render($params); 
                echo $content; 
            } 
            else 
            {
                header('Location: login');   
            }
        }
  
        abstract protected function render_right_content(); 
        abstract protected function render_center_content(); 
        abstract protected function render_left_content();  
    }