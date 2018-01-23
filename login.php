<?php
session_start();

require_once( "classes/Database.php" );
require_once( "classes/User.php" );

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $db = Database::getInstance();
        $validation = User::login($_POST['username'], $_POST['password'], $db->getConn());
        if ($validation !== true) {
            $error = $validation;
        }
    } else {
        $error = "All field are required";
    }
}
?>
<div align = "center">
    <div style = "width:300px; border: solid 1px #333333; " align = "left">
        <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>

        <div style = "margin:30px">

            <form action = "" method = "post">
                <label>Username  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                <input type = "submit" value = " Submit "/><br />
            </form>

            <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php
                if (isset($error)) {
                    echo $error;
                }
                ?></div>

        </div>

    </div>

</div>
