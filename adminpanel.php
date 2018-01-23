<?php
require 'session.php';
if($_SESSION['user_type'] != 'admin'){
    header('location:userpanel.php');
}
require_once( "classes/Database.php" );
require_once( "classes/User.php" );
$db = Database::getInstance();
$users = USER::getAllUsers($db->getConn());
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin Panel</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>
        <div class="container">
            <div class="row">
                <h3>Admin Panel</h3>
            </div>
            <div class="row">
                <table border="0" cellpadding="10" cellspacing="1" width="500" class="tblListForm">
                    <thead>
                        <tr class="listheader">
                            <td>Username</td>
                            <td>Points</td>
                            <td>Action</td>
                        </tr>
                 
                        <?php
                       
                        foreach ($users as $user) {
                            echo '<tr class="evenRow">';
                            echo '<td>' . $user['username'] . '</td>';
                            echo '<td>' . $user['points'] . '</td>';
                            echo '<td> <a href="delete.php?delete='.$user['id'].'" class="link">Delete</a>  <a href="editpoints.php?edit='.$user['id'].'" class="link"> Edit Points</a></td>';
                            echo '</tr>';
                        }
                       
                        ?>
                </table>
            </div>
        </div> 
        <div>
            <br>
            <a href="adduser.php" > Add new user</a>
            <br>
            <a href="logout.php" > Logout</a>
        </div>
    </body>
</html>
