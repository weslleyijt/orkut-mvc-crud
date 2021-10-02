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

            $sql = "SELECT DISTINCT u.email, u.user_name, u.user_status, u.country, u.user_profile, 
            count(s.id) as user_photos, count(f.id) as user_fans ,   count(m.id) as user_message ,   count(c.id) as user_scraps ,   count(v.id) as user_videos 
            FROM users u
            LEFT JOIN user_photos s ON s.user_id=u.id
            LEFT JOIN user_fans f ON f.subject=u.id
            LEFT JOIN user_message m ON m.user_id=u.id
            LEFT JOIN user_scraps c ON c.user_id=u.id
            LEFT JOIN user_videos v ON v.user_id=u.id 
            WHERE u.id=:id";
            
            $stmt = $conn->prepare($sql);  
            $stmt->bindValue(':id', $_SESSION['user_id']);   
            $stmt->execute();
 
            $stmt->bindColumn(1, $user_email);  
            $stmt->bindColumn(2, $user_name);
            $stmt->bindColumn(3, $user_status);
            $stmt->bindColumn(4, $country);
            $stmt->bindColumn(5, $user_profile); 

            $stmt->bindColumn(6, $user_photos);
            $stmt->bindColumn(7, $user_fans);
            $stmt->bindColumn(8, $user_message);
            $stmt->bindColumn(9, $user_scraps);
            $stmt->bindColumn(10, $user_videos); 
 
            while ($row = $stmt->fetch(\PDO::FETCH_BOUND))
            { 
                $user_inf = array("user_email" => $user_email,
                                "user_name" => $user_name,
                                "user_status" => $user_status,
                                "country" => $country,
                                "user_profile" => $user_profile, 
                                "user_photos" => $user_photos,
                                "user_fans" => $user_fans,
                                "user_message" => $user_message,
                                "user_scraps" => $user_scraps,
                                "user_videos" => $user_videos);   
            } 
 
            return $user_inf; 
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