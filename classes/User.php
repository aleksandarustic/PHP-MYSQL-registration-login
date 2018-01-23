<?php

/**
 * Description of User
 *
 * @author pc
 */
class User {
    public static function safestrip($string){
       $string = strip_tags($string);
       return $string;
    }
    public static function login ($username,$password,$conn){
        
        $username = self::safestrip($username);
        $password = self::safestrip($password);
        $sql = 'SELECT * FROM users WHERE username = :username AND password = :password';
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $password);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($user === FALSE){
            return 'Incorect username or password';
        }
        else{
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['points'] = $user['points'];
            $_SESSION['user_type'] = $user['user_type'];
            $_SESSION['username'] = $user['username'];

            if($user['user_type'] == 'user'){
                header('location:userpanel.php');
            }
            else{
                header('location:adminpanel.php');
            }
        }
        
    }
    public static function register($username,$password,$conn){
        
        $username = self::safestrip($username);
        $password = self::safestrip($password);
        $sql = "INSERT INTO users (username, password, points, user_type) VALUES (:username,:password,:points,:user_type)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':username',$username);
        $stmt->bindValue(':password',$password);
        $stmt->bindValue(':points', 100);
        $stmt->bindValue(':user_type','user');
        $check = $stmt->execute();
        if($check === TRUE){
            $_SESSION['user_id'] = $conn->lastInsertId();
            $_SESSION['user_type'] = 'user';
            $_SESSION['username'] = $username;
            $_SESSION['points'] = 100;
            header('location:userpanel.php');
        }
        else{
            return $stmt->errorCode();
        } 
    }
    public static function addUser($username,$password,$points,$conn){
        $username = self::safestrip($username);
        $password = self::safestrip($password);
        $points = self::safestrip($points);
        $sql = "INSERT INTO users (username, password, points, user_type) VALUES (:username,:password,:points,:user_type)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':username',$username);
        $stmt->bindValue(':password',$password);
        $stmt->bindValue(':points', $points);
        $stmt->bindValue(':user_type','user');
        $check = $stmt->execute();
        if($check === TRUE){
            header('location:adminpanel.php');
        }
        else{
            return $stmt->errorCode();
        } 
    }
    public static function getAllUsers($conn){
        
         $sql = 'SELECT * FROM users WHERE user_type <> :user_type ';
         $stmt = $conn->prepare($sql);
         $stmt->bindValue(':user_type','admin');
         $check = $stmt->execute();
         $users = $stmt->fetchAll();
         return $users;

    }
    public static function deleteUser($userid,$conn){
         $sql = "DELETE FROM users WHERE id=:userid";
         $stmt = $conn->prepare($sql);
         $stmt->bindValue(':userid',$userid);
         $stmt->execute();

    }
     public static function getUser($userid,$conn){
         $sql = 'SELECT * FROM users WHERE id = :userid';
         $stmt = $conn->prepare($sql);
         $stmt->bindValue(':userid', $userid);
         $stmt->execute();
         $user = $stmt->fetch(PDO::FETCH_ASSOC);
         if($user === FALSE){
             die("User does not exist");
        }
        else{
             return $user;
        }

    }
     public static function updatePoints($userid,$points,$conn){
         $sql = "UPDATE users SET points=:points WHERE id=:userid";
         $stmt = $conn->prepare($sql);
         $stmt->bindValue(':points', $points);
         $stmt->bindValue(':userid', $userid);
         $stmt->execute();
         header('location:adminpanel.php');
         
    }
    public static function sendPoints($userid,$senduserid,$points,$conn){
        $user = self::getUser($userid, $conn);
        $senduser = self::getUser($senduserid, $conn);
        if($user['points'] < $points){
            die('You have exceeded the number of points you can send');
        }
        $sql = "UPDATE users SET points=:points WHERE id=:userid";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':points', $user['points']-$points);
        $stmt->bindValue(':userid', $userid);
        $check = $stmt->execute();
        if($check == true){
            $_SESSION['points'] = $user['points']-$points;
        }
        else{
            die('error occured while updating points');
        }
        $stmt2 = $conn->prepare($sql);
        $stmt2->bindValue(':points', $senduser['points']+$points);
        $stmt2->bindValue(':userid', $senduserid);
        $stmt2->execute();
        header('location:userpanel.php');
        
    }
    
    
}
