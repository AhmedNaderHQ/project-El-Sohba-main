<?php
    include 'databaseconnect.php';
    $stmt = $conn->prepare("SELECT MIN(`Add_Date`) FROM `items`");
    $stmt->execute();
    $itemsMinDate = $stmt->fetch(PDO::FETCH_ASSOC);
    echo $itemsMinDate['MIN(`Add_Date`)'];
    echo '<br>';
    $stmt = $conn->prepare("SELECT MAX(`Add_Date`) FROM `items`");
    $stmt->execute();
    $itemsMaxDate = $stmt->fetch(PDO::FETCH_ASSOC);
    echo $itemsMaxDate['MAX(`Add_Date`)'];
    echo '<pre>';
    $lastMonthDateTime = date('Y-m-d H:i:s', time() - 30 * 24 * 60 * 60);
    $now = date('Y-m-d H:i:s');
    echo '<br>';
    echo $now;
    $stmt = $conn->prepare("SELECT * FROM `items` WHERE `Add_Date` BETWEEN  '$lastMonthDateTime' AND '$now'");
    $stmt->execute();
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo '<pre>';
    print_r($items);
?>