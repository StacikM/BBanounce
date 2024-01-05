<?php
// Start the session
session_start();

// Destroy the session data
session_destroy();

// Redirect to the main page
header("Location: index.php");
exit();
?>
