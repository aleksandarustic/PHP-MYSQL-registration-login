<?php
require 'session.php';
if ($_SESSION['user_type'] != 'admin') {
    header('location:userpanel.php');
}
require_once( "classes/Database.php" );
require_once( "classes/User.php" );
$db = Database::getInstance();
if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $user = USER::getUser($_GET['edit'], $db->getConn());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['userid']) && isset($_POST['points'])) {
        USER::updatePoints($_POST['userid'], $_POST['points'], $db->getConn());
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Edit Points</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <h3>Edit Points</h3>
            </div>
            <div class="row">
                <form action = "" method = "post">
                    <table>
                        <input type="hidden" name="userid" value="<?php echo $user['id'] ?>"/>
                        <tr>
                            <td>Username:</td>
                            <td><input disabled="" value="<?php echo $user['username'] ?>" type = "text" name = "username" class = "box"/></td>
                        </tr>
                        <tr>
                            <td>Points:</td>
                            <td><input value="<?php echo $user['points'] ?>" type = "number" name = "points" class = "box" /></td>
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
</html>