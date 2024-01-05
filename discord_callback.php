<?php
// Start the session
session_start();

// Replace 'YOUR_CLIENT_ID', 'YOUR_CLIENT_SECRET', 'YOUR_REDIRECT_URI' with your actual values
$clientID = 'YOUR_CLIENT_ID';
$clientSecret = 'YOUR_CLIENT_SECRET';
$redirectURI = 'YOUR_REDIRECT_URI';

// Handle the callback from Discord
$code = $_GET['code'];

// Exchange the code for an access token
$tokenURL = 'https://discord.com/api/oauth2/token';
$tokenData = [
    'client_id' => $clientID,
    'client_secret' => $clientSecret,
    'grant_type' => 'authorization_code',
    'code' => $code,
    'redirect_uri' => $redirectURI,
];

$tokenOptions = [
    'http' => [
        'method' => 'POST',
        'header' => 'Content-Type: application/x-www-form-urlencoded',
        'content' => http_build_query($tokenData),
    ],
];

$tokenContext = stream_context_create($tokenOptions);
$tokenResult = file_get_contents($tokenURL, false, $tokenContext);
$accessToken = json_decode($tokenResult, true)['access_token'];

// Use the access token to get user information
$userURL = 'https://discord.com/api/users/@me';
$userOptions = [
    'http' => [
        'header' => "Authorization: Bearer $accessToken",
    ],
];

$userContext = stream_context_create($userOptions);
$userResult = file_get_contents($userURL, false, $userContext);
$userData = json_decode($userResult, true);

// Store user data in the session for later use
$_SESSION['discord_user'] = $userData;

// Redirect to the main page
header("Location: index.php");
exit();
?>
