<?php
    session_start();
    $language = (isset($_COOKIE['lang']) && in_array($_COOKIE['lang'], ['du', 'ar'])) ? $_COOKIE['lang'] : 'ar';
    include '../../databaseconnect.php';
    include "../languages/lang-$language.php";
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        // echo '<pre>';
        // print_r($_GET);
        $coupon = $_GET['coupon'];
        $stmt = $conn -> prepare("SELECT * FROM `coupons` WHERE `Coupon` = '$coupon'");
        $stmt -> execute();
        $count = $stmt -> rowCount();
        if($count == 1){
            $coupon = $stmt -> fetch(PDO::FETCH_ASSOC);
            if($coupon['Limit'] > 0){
                
                $respond = array();
                $respond['status'] = 'success';
                $respond['message'] = lang('COUPON ADDED SUCCESSFULLY');
                $respond['couponValue'] = $coupon['Value'];
                echo json_encode($respond);
                
            }
            else {
                $respond = array();
                $respond['status'] = 'success';
                $respond['message'] = lang('COUPON ENDED');
                $respond['couponValue'] = 0; 
                echo json_encode($respond);   
            }
        }else{
            $respond = array();
            $respond['status'] = 'success';
            $respond['message'] = lang('NO COUPON');
            $respond['couponValue'] = 0; 
            echo json_encode($respond);   
        }
        
        
    }

?>