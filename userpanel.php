<?php
require_once( 'session.php');
require_once( 'classes/Database.php' );
require_once( 'classes/User.php' );
$db = Database::getInstance();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['send_user']) && !empty($_POST['points'])) {
        User::sendPoints($_POST['user_id'], $_POST['send_user'], $_POST['points'], $db->getConn());
    }
}


$users = User::getAllUsers($db->getConn());
?>
<!DOCTYPE html>
<html>
    <head>
        <title>User Panel</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>
        <div class="container">
            <div class="row">
                <h1>Welcome <?php echo $_SESSION['username']; ?></h1>
                <h4>Send points</h4>
            </div>
            <form method = "post" action = "">
                <table>
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>"/>
                    <tr>
                        <td>Available points:</td> 
                        <td><?php echo $_SESSION['points'] ?></td>
                    </tr>
                    <tr>
                        <td>Point for sending</td>
                        <td><input type = "number" name = "points" max = "<?php echo $_SESSION['points'] ?>"></td>
                    </tr>
                    <tr>
                        <td>User</td>
                        <td>
                            <select name = "send_user">
                                <?php
                                foreach ($users as $user) {
                                    if ($user['id'] != $_SESSION['user_id']) {
                                        echo '<option value=' . $user['id'] . '>' . $user['username'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type = "submit" name = "submit" value = "Send"> 
                        </td>
                    </tr>
                </table>
            </form>
        </div> 
        <div>
            <br>
            <a href="logout.php" > Logout</a>
        </div>
    </body>
</html>


