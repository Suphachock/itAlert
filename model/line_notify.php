<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$db = "it_alert";
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all data from db_items table
$sql = "SELECT * FROM db_items";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Error fetching items: " . mysqli_error($conn));
}

// Fetch token from db_token table
$sql_token = "SELECT token FROM db_token";
$result_token = mysqli_query($conn, $sql_token);
if (!$result_token) {
    die("Error fetching token: " . mysqli_error($conn));
}
$token_row = mysqli_fetch_assoc($result_token);
if (!$token_row) {
    die("No token found.");
}
$token = $token_row['token'];

// Store current date in $now
$now = date("Y-m-d");

// Iterate through each row in db_items
while ($row = mysqli_fetch_assoc($result)) {
    // Calculate the number of days remaining
    $new_end_date = (strtotime($row['end_date']) - strtotime($now)) / 86400;

    // Update the remaining days in the database
    $update_sql = "UPDATE db_items SET day_left = $new_end_date WHERE id = " . $row['id'];
    if (!mysqli_query($conn, $update_sql)) {
        die("Error updating item: " . mysqli_error($conn));
    }

    // Check if the remaining days are less than or equal to the alert threshold
    if (($new_end_date <= 0 || $new_end_date <= $row['day_alert']) && $row['status'] == 'on') {
        // Set the message to be sent
        $message = "\n⚠️แจ้งเตือนอุปกรณ์หมดอายุ!\nชื่ออุปกรณ์: " . $row['title'] .
            "\nเริ่มใช้: " . $row['start_date'] .
            "\nหมดอายุ: " . $row['end_date'] .
            "\nเหลือเวลา: " . $new_end_date . " วัน";

        // Send the notification via LINE Notify
        $ch = curl_init('https://notify-api.line.me/api/notify');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'message=' . urlencode($message));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization: Bearer ' . $token
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $notify_result = curl_exec($ch);
        if ($notify_result === false) {
            die('Curl error: ' . curl_error($ch));
        }
        curl_close($ch);

        // Display notification result
        var_dump($notify_result);
    }
}

// Close database connection
$conn->close();
?>
