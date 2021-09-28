<?php    
    namespace App\Model; 
    
    class User 
    {
        public static function is_user_logged_in() 
        {  
            return isset($_SESSION['user_id']); 
        }   
    }  