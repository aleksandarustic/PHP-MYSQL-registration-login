<?php
require 'session.php';
if($_SESSION['user_type'] != 'admin'){
    header('location:userpanel.php');
}
require_once( "classes/Database.php" );
require_once( "classes/User.php" );

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['points'])) {
        $db = Database::getInstance();
        $validation = User::addUser($_POST['username'], $_POST['password'],$_POST['points'], $db->getConn());
        if ($validation !== true) {
            $error = $validation;
        }
    } else {
        $error = "All field are required";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Add new user</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <h3>Add new user</h3>
            </div>
            <div class="row">
                <form action = "" method = "post">
                    <table>
                        <tr>
                            <td>Username:</td>
                            <td><input type = "text" name = "username" maxlength="50" class = "box"/></td>
                        </tr>
                        <tr>
                            <td>Password:</td>
                            <td><input type='password' name='password' id='password' maxlength="50" /></td>
                        </tr>
                        <tr>
                            <td>Points:</td>
                            <td><input type='number' name='points' id='points' value="100" /></td>
                        </tr>
                        <tr>
                            <td>
                                <input type = "submit" value = " Submit "/><br />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div> 
    </body>
    <div>
        <a href="adminpanel.php" > Back to admin panel</a>
    </div>
    <div style = "font-size:11px; color:#cc0000; margin-top:10px">
    <?php
    if (isset($error)) {
        echo $error;
    } ?>
</div>
</html>

