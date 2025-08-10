<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // تأكد من أن البيانات قد تم إرسالها عبر الطريقة POST
    $message = $_POST["message"];

    // يمكنك أيضًا أضافة المزيد من التحققات هنا حسب احتياجاتك

    // تكوين الاتصال بقاعدة البيانات
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "testChat";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // استخدام استعلام SQL لحفظ الرسالة في قاعدة البيانات
    $sql = "INSERT INTO messages (username, message) VALUES ('ahmed', '$message')";

    if ($conn->query($sql) === TRUE) {
        // إرسال استجابة ناجحة إذا تم حفظ الرسالة بنجاح
        echo "Message sent successfully";
    } else {
        // إرسال استجابة فاشلة إذا كان هناك خطأ
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // إغلاق الاتصال بقاعدة البيانات
    $conn->close();
} else {
    // إرسال رسالة خطأ إذا تم الوصول إلى هذا الملف بطريقة غير صحيحة
    echo "Invalid request";
}
?>
