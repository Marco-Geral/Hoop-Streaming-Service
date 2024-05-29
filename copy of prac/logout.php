<?php
// Start the session
session_start();

// Unset the session variable
unset($_SESSION['apikey']);

// Destroy the session
session_destroy();

// Redirect to the login_register.php page
header('Location: login_register.php');
exit;
?>
