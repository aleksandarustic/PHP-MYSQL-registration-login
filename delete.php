<?php

require 'session.php';
if ($_SESSION['user_type'] != 'admin') {
    header('location:userpanel.php');
}
require_once( "classes/Database.php" );
require_once( "classes/User.php" );
$db = Database::getInstance();

if (isset($_GET['delete']) && $_SESSION['user_type'] == 'admin') {
    if (is_numeric($_GET['delete'])) {
        $users = USER::deleteUser($_GET['delete'], $db->getConn());
        header('location:adminpanel.php');
    }
}

