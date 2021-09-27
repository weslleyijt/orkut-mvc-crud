<?php
    namespace App\Core; 
    
    class Core
    {
        public function start($urlGet)
        {  
            if(isset($urlGet)) 
            {
                $strArray = explode('/', $urlGet);   
                $controller = ucfirst($strArray[0] . "Controller"); 
            } 
            else
                $controller = "HomeController";
            
            if(!class_exists($controller))
                $controller = "HomeController"; 

            $this->startFunction($controller);
        }
 
        public function startUserProfile()
        {
            $this->startFunction("ProfileController");
        }
        
        public function startSidePanel($urlGet) 
        {
            $this->startFunction("PanelController");  
        }

        public function startFunction($controller)
        {
            $action = "index"; 
            $tmp = 'App\Controller\\' . $controller; 
            call_user_func_array(array(new $tmp, $action), array());  
        }
    }