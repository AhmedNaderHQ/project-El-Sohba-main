<?php
    session_start();
    include 'databaseconnect.php';
    $AllowedNotifications = array();

    if($_SESSION['user']['notifyMessage'] == 'on'){ $AllowedNotifications[] = 'Message'; }
    if($_SESSION['user']['notifyOrder'] == 'on'){ $AllowedNotifications[] = 'Order'; }
        
    $displayedNotifications = array();


    $do = $_GET['do'];
    if ($do == 'View'){
        
        $stmt = $conn->prepare("SELECT * FROM `notifications`");
        $stmt->execute();
        $notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($notifications as $notification){
            if(in_array($notification['Type'], $AllowedNotifications)){
                $displayedNotifications[] = $notification; 
            }
        }
        $count = count($displayedNotifications);
        if ($count > 0){
            foreach($notifications as $notification){
                
                ?>
                    <li class="mb-2" data-id="<?=$notification['ID']?>">
                        <a class="dropdown-item notificationItem border-radius-md" data-id="<?=$notification['ID']?>" href="<?php if($notification['Type'] == 'Order'){ echo 'orders.php';}else{echo 'profile.php';} ?>">
                            <div class="d-flex py-1">
                                <div class="my-auto">
                                    <img src="assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="text-sm font-weight-normal mb-1">
                                        <span class="font-weight-bold">New <?=$notification['Type']?></span>
                                    </h6>
                                    <p class="text-xs text-secondary mb-0 ">
                                        <i class="fa fa-clock me-1"></i>
                                        <?=$notification['AddingDate']?>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </li>
                <?php

            }
        }else{
            ?>  
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                    <div class="d-flex flex-column">
                        <span class="text-dark font-weight-bold ms-sm-2">There're no notifications to show.</span>
                    </div>
                </li>
            
            <?php
        }
    }
    elseif($do == 'Count'){
        $stmt = $conn->prepare("SELECT * FROM `notifications` WHERE `Status` = 'unread'");
        $stmt->execute();
        $notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($notifications as $notification){
            if(in_array($notification['Type'], $AllowedNotifications)){
                $displayedNotifications[] = $notification; 
            }
        }
        $count = count($displayedNotifications);
        echo $count;

    }
    elseif($do == 'Read'){
        $stmt = $conn->prepare("UPDATE `notifications` SET `Status` = 'read' WHERE `Status` = 'unread'");
        $stmt->execute();
        ?>
            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                <div class="d-flex flex-column">
                    <span class="text-dark font-weight-bold ms-sm-2">There're no notifications to show.</span>
                </div>
            </li>
        <?php
    }elseif($do == 'Delete'){
        $id = $_GET['id'];
        $stmt = $conn->prepare("DELETE FROM `notifications` WHERE `ID` =  ? ");
        $stmt->execute(array($id));
    }
    
    


?>