<?php    
    namespace App\Model;   
    use Lib\Database\Connection as Connection; 

    class User 
    {
        public static function is_user_logged_in() 
        { 
            return isset($_SESSION['user_id']);     
        }   

        public static function user_infor()
        {
            $conn = Connection::getConn(); 

            $sql = "SELECT email, user_name, user_status, country, user_profile FROM users WHERE id=:id LIMIT 1";
            $stmt = $conn->prepare($sql);  
            $stmt->bindValue(':id', $_SESSION['user_id']);   
            $stmt->execute();

            $stmt->bindColumn(1, $user_email);  
            $stmt->bindColumn(2, $user_name);
            $stmt->bindColumn(3, $user_status);
            $stmt->bindColumn(4, $country);
            $stmt->bindColumn(5, $user_profile);

            while ($row = $stmt->fetch(\PDO::FETCH_BOUND))
            {
                $user_inf = array("user_email" => $user_email,
                                "user_name" => $user_name,
                                "user_status" => $user_status,
                                "country" => $country,
                                "user_profile" => $user_profile); 

                return $user_inf;     
            }
        }

        public static function login($email, $password)
        {
            $conn = Connection::getConn();  
 
            $sql = "SELECT id, password FROM users WHERE email=:email LIMIT 1"; 
            $stmt = $conn->prepare($sql);    
            $stmt->bindValue(':email', $email);    
            $stmt->execute();
  
            $stmt->bindColumn(1, $id);
            $stmt->bindColumn(2, $pw); 
 
            while ($row = $stmt->fetch(\PDO::FETCH_BOUND))
            {
                if(password_verify($password, $pw))
                {
                    session_start();  
                    $_SESSION['user_id'] = $id;
                    return true; 
                }
                else 
                {
                    return false;
                }
            }  
        } 
    }   