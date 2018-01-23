<?php
session_start();
require_once( "classes/Database.php" );
require_once( "classes/User.php" );

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $db = Database::getInstance();
        $validation = User::register($_POST['username'], $_POST['password'], $db->getConn());
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
        <title>Register</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <h3>Register</h3>
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
                            <td>
                                <input type = "submit" value = " Submit "/><br />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div> 
        <div style = "font-size:11px; color:#cc0000; margin-top:10px">
            <?php
            if (isset($error)) {
                echo $error;
            }
            ?>
        </div>
    </body>

</html>

