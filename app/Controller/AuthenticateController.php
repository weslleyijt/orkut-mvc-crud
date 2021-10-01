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
                   if(User::login($_POST['email'], $_POST['password']))
                   {
                        echo $_SESSION['user_id']; 
                        echo $_SESSION['user_profile'];
                        echo $_SESSION['user_name'];
                        echo $_SESSION['user_status'];
                        echo $_SESSION['country'] ;
                        echo $_SESSION['user_email'] ;
 
                        header('Location: home');
                   }else { 
                        header('Location: login'); 
                   }
                }
                else
                {
                    header('Location: login'); 
                }
            }
            else
            {
                header('Location: home');
            }
        } 
    }