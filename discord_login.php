<?php
// Start the session
session_start();

// Replace 'YOUR_CLIENT_ID', 'YOUR_CLIENT_SECRET', 'YOUR_REDIRECT_URI' with your actual values
$clientID = 'YOUR_CLIENT_ID';
$clientSecret = 'YOUR_CLIENT_SECRET';
$redirectURI = 'YOUR_REDIRECT_URI';

// Redirect the user to Discord for OAuth login
header("Location: https://discord.com/api/oauth2/authorize?client_id=$clientID&redirect_uri=$redirectURI&response_type=code&scope=identify");
exit();
?>
