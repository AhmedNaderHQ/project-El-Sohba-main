<?php
    session_start();
    include '../../databaseconnect.php';
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        if(isset($_GET['do'])){
            $do = $_GET['do'];
            if($do == 'Read'){
                $id = $_GET['id'];
                $stmt = $conn -> prepare("UPDATE `comments` SET `Status` = '1' WHERE `ID` = '$id'");
                $stmt -> execute();
            }
            elseif($do == 'Delete'){
                $id = $_GET['id'];
                $stmt = $conn -> prepare("DELETE FROM `comments` WHERE `ID` = '$id'");
                $stmt -> execute();
            }
        }
    }
?>