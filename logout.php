<?php
include 'config.php';

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page
redirect('admin.php');
?>
