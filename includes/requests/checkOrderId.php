<?php
    session_start();
    include '../../databaseconnect.php';
    include '../functions/functions.php';
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        // echo '<pre>';
        // print_r($_GET);
        $orderId = $_GET['orderId'];
        $count = countItems('ID', 'orders', "`Order_ID` = '$orderId'");
        if($count == 1){
            echo 'checks';
        }else{
            echo 'doesn\'t check';
        }
    }

?>