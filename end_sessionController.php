<?php
session_start();

// Unset all session values
$_SESSION = array();

// Destroy the session
session_destroy();
header("Location: index.html");
?>