<?php
session_start();
unset($_SESSION['user_id']);
unset($_SESSION['user_type']);
unset($_SESSION['username']);
unset($_SESSION['points']);
session_destroy();
header("Location: index.php");
exit;

