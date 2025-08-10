<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testChat";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// استقبال الرسائل من قاعدة البيانات
$result = $conn->query("SELECT * FROM messages");
$messages = array();

while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

// إرسال الرسائل كـ JSON
header('Content-Type: application/json');
echo json_encode($messages);

// إغلاق الاتصال بقاعدة البيانات
$conn->close();
?>
