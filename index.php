<?php
session_start();    
?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP script</title>
</head>
<body>
    <?php
    if(!isset($_SESSION['user_id'])){
        ?>
        <h1>Please Login or Register</h1>
		<a href="login.php">Login</a> or
		<a href="register.php">Register</a>
        <?php
    }
    else{
        if($_SESSION['user_type'] == 'user'){
            header('location:userpanel.php');
        }
        else{
            header('location:adminpage.php');
        }
    }
    ?>
       
</body>
</html>