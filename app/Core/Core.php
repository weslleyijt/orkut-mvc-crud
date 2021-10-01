<?php  
    namespace App\Core;   
    use App\Model\User as User; 
    use Lib\Database\Connection as Connection;
     
    class Core
    { 
        function __construct() 
        {
            if(session_id() == '') {
                session_start();
            }
        }
       
        public function start()
        {  
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

            if(!class_exists($controller))
                $controller = "HomeController";
                 
            echo $this->user_func($controller);  
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
    }