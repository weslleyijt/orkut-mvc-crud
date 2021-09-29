<?php
    namespace App\Controller;
    use App\Model\User as User;
 
    class AuthenticateController     
    {
        public function index()
        { 
            if(!User::is_user_logged_in())
            {
                if(isset($_POST['email']) && isset($_POST['password']))
                {
                   var_dump(User::login($_POST['email'], $_POST['password'])); 
                }else {
                    header('Location: login'); 
                }
            }else {
                header('Location: home');
            }
        } 
    }