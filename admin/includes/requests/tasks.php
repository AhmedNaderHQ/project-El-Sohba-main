<?php
    session_start();
    include '../../databaseconnect.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $text = $_POST['text'];
        $deadline = $_POST['deadline'];
        $assign = $_POST['assign'];
        $priority = $_POST['priority'];

        $stmt = $conn->prepare("INSERT INTO `to-do-list`(`Task`, `Priority`, `Admin_ID`, `Deadline`, `Assign-To`) VALUES(:ztask, :zpriority, :zadmin, :zdeadline, :assign)");
        $stmt->execute(array('ztask' => $text, 'zpriority' => $priority, 'zadmin' => $_SESSION['user']['ID'], 'zdeadline' => $deadline, 'assign' => $assign));
        $count = $stmt->rowCount();
        $id = $conn->lastInsertId();
        if($count > 0 ){
            
            
            $stmt = $conn->prepare("INSERT INTO `notifications`(`Type`, `TypeID`) VALUES (:ztype, :zid)");
            $stmt->execute(array('ztype' => 'Task', 'zid' => $id));
            
            
            ?>
                <ul class="list-group success-message">
                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                        <div class="d-flex flex-column">
                            <span class="text-dark font-weight-bold ms-sm-2">Task added successfully.</span>
                        </div>
                    </li>
                </ul> 
            <?php
        }
    }
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        
        if(isset($_GET['do']) && $_GET['do'] == 'Update'){
            $stmt = $conn->prepare("SELECT * FROM `to-do-list`");
            $stmt->execute();
            $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($tasks as $task){
                ?>
                    <tr>
                        <td>
                        <div class="d-flex px-2 py-1">
                            <?php
                            if($task['Assign-To'] == 'none'){
                                ?>
                                <div>
                                    <img src="assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">Everyone</h6>
                                </div>
                                <?php
                            }else{
                                $stmt = $conn->prepare("SELECT `Name`, `Image-Name` FROM `users` WHERE `ID` = ?");
                                $stmt ->execute(array($task['Assign-To']));
                                $member = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                ?>
                                <div>
                                    <img src="uploads/images/admins-images/<?=$member['0']['Image-Name']?>" class="avatar avatar-sm me-3" alt="user1">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm"><?=$member['0']['Name']?></h6>
                                </div>
                                <?php
                            }
                            ?>

                        </div>
                        </td>
                        <td>
                        <p class="text-xs font-weight-bold mb-0"> <?=$task['Task']?></p>
                        </td>
                        <td class="align-middle text-center text-sm">
                        <?php
                            if($task['Priority'] == 1 ){
                                ?>
                                    <span class="badge badge-sm bg-gradient-danger">High priority</span>
                                <?php
                            }
                            elseif($task['Priority'] == 2 ){
                                ?>
                                    <span class="badge badge-sm bg-gradient-warning">Middle priority</span>
                                <?php
                            }
                            elseif($task['Priority'] == 3 ){
                                ?>
                                    <span class="badge badge-sm bg-gradient-success">Low priority</span>
                                <?php
                            }
                        ?>
                        
                        </td>
                        <td class="align-middle text-center">
                            <span class="doneTasks text-secondary font-weight-bold" title="Done"><i class="fa-solid fa-check"></i></span>
                            <span class="removeTasks text-secondary ms-2 font-weight-bold" data-bs-toggle="modal" data-bs-target="#exampleModalDelete<?=$task['ID']?>" title="Remove"><i class="fa-solid fa-trash-can"></i></span>
                        </td>
                        <!-- Modal task delete -->
                        <div class="modal fade" id="exampleModalDelete<?=$task['ID']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Task</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this task ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary deleteTask" data-bs-dismiss="modal">Delete</button>
                                        <span class="taskID" hidden><?=$task['ID']?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tr>

                <?php
            }
        }
        if(isset($_GET['do']) && $_GET['do'] == 'Delete'){
            if(isset($_GET['taskID']) && is_numeric($_GET['taskID']) ){
                $taskID = $_GET['taskID'];
                $stmt = $conn->prepare("DELETE FROM `to-do-list` WHERE `ID` = ?");
                $stmt ->execute(array($taskID));
                $count = $stmt->rowCount();
                if($count == 1){
                    $stmt = $conn->prepare("SELECT * FROM `to-do-list`");
                    $stmt->execute();
                    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach($tasks as $task){
                        ?>
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <?php
                                            if($task['Assign-To'] == 'none'){
                                                ?>
                                                    <div>
                                                        <img src="assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">Everyone</h6>
                                                    </div>
                                                <?php
                                            }else{
                                                $stmt = $conn->prepare("SELECT `Name`, `Image-Name` FROM `users` WHERE `ID` = ?");
                                                $stmt ->execute(array($task['Assign-To']));
                                                $member = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                ?>
                                                    <div>
                                                        <img src="uploads/images/admins-images/<?=$member['0']['Image-Name']?>" class="avatar avatar-sm me-3" alt="user1">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm"><?=$member['0']['Name']?></h6>
                                                    </div>
                                                <?php
                                            }
                                        ?>

                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0"> <?=$task['Task']?></p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <?php
                                        if($task['Priority'] == 1 ){
                                            ?>
                                                <span class="badge badge-sm bg-gradient-danger">High priority</span>
                                            <?php
                                        }
                                        elseif($task['Priority'] == 2 ){
                                            ?>
                                                <span class="badge badge-sm bg-gradient-warning">Middle priority</span>
                                            <?php
                                        }
                                        elseif($task['Priority'] == 3 ){
                                            ?>
                                                <span class="badge badge-sm bg-gradient-success">Low priority</span>
                                            <?php
                                        }
                                    ?>
                                
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary font-weight-bold" title="Done"><i class="fa-solid fa-check"></i></span>
                                    <span class="text-secondary ms-2 font-weight-bold" data-bs-toggle="modal" data-bs-target="#exampleModalDelete<?=$task['ID']?>" title="Remove"><i class="fa-solid fa-trash-can"></i></span>
                                </td>
                                <!-- Modal task delete -->
                                <div class="modal fade" id="exampleModalDelete<?=$task['ID']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Task</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this task ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary deleteTask">Delete</button>
                                        <span class="taskID" hidden><?=$task['ID']?></span>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                
                            </tr>
                        <?php
                    }
                }
            }
        }
    }
?>