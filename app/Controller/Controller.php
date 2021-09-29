<?php
    namespace App\Controller; 
    use App\Model\User as User;

    class Controller     
    {
        function __construct() {
            if(!User::is_user_logged_in()) header('Location: login');   
            die();
        }
    }