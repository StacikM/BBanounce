<?php
// Start the session
session_start();

// Replace 'YOUR_DISCORD_WEBHOOK_URL' with your actual Discord webhook URL
$discordWebhookUrl = 'https://discord.com/api/webhooks/1192912033679679628/yPddXsv6oAO4BfI-aev_A8GVwx03H3xXU9csTMnfF2FZZElu428p5kkRvAd83Jw15oEH';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the message from the POST request
    $data = json_decode(file_get_contents('php://input'), true);
    $message = $data['message'];

    // Build the embed for the Discord webhook
    $embed = [
        'color' => hexdec('00FF00'), // Green color
        'title' => 'Basket Battle Announcement',
        'author' => [
            'name' => '[CTK SYSTEMS]',
        ],
        'description' => $message, // Include the user's message in the description
    ];

    // Send the message with the embed to Discord
    $payload = json_encode(['embeds' => [$embed]]);
    $ch = curl_init($discordWebhookUrl);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Return a response based on the result
    if ($statusCode == 200) {
        echo json_encode(['status' => 'success', 'message' => 'Message sent to Discord']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error sending message to Discord']);
    }
} else {
    // If the request method is not POST, return an error response
    echo json_encode(['status' => 'error', 'message' => 'Method Not Allowed']);
}
?>
