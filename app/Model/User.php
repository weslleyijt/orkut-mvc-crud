<?php    
    namespace App\Model;   
    use Lib\Database\Connection as Connection; 

    class User 
    {
        public static function is_user_logged_in() 
        { 
            return isset($_SESSION['user_id']);  
        }   

        public static function login($email, $password)
        {
            $conn = Connection::getConn();  
 
            $sql = "SELECT id, email, password FROM users WHERE email=:email LIMIT 1";
            $stmt = $conn->prepare($sql);  
            $stmt->bindValue(':email', $email);    
            $stmt->execute();
  
            $stmt->bindColumn(3, $pw);
 
            while ($row = $stmt->fetch(\PDO::FETCH_BOUND)) {
                if(password_verify($password, $pw))
                {
                    echo "feito com successo";
                }else {
                    echo "Senha errada";
                }
            }  
        } 
    }   