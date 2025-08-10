<?php
    session_start();
    include '../../databaseconnect.php';
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $op = $_GET['op'];
        if($op == 'Search'){
            $username = $_GET['username'];
            $stmt = $conn->prepare("SELECT * FROM `customers` WHERE  `Username` LIKE '%$username%'");
            $stmt -> execute();
            $count = $stmt->rowCount();
            if($count > 0){
                $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>
                    <div class="table-responsive p-0 customersTable">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Customer</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Username</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Phone</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Street</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Zip Code</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Last-Log-In</th>  
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Adding-Date</th>
                                    <th class="text-secondary opacity-7">Actions</th>   
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($customers as $customer){
                                        ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm"><?=$customer['Name']?></h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0"><?=$customer['Username']?></p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0"><?=$customer['Email']?></p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0"><?=$customer['Phone']?></p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0"><?=$customer['Street']?></p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0"><?=$customer['ZipCode']?></p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0"><?=$customer['Last-Log-In']?></p>
                                                </td>
                                                <td class="align-middle ">
                                                    <span class="text-secondary text-xs font-weight-bold"><?=$customer['Adding-Date']?></span>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="?do=Edit&customerId=<?=$customer['ID']?>" class="text-secondary font-weight-bold text-s" data-toggle="tooltip" data-original-title="Edit customer">
                                                    Edit
                                                    </a>
                                                    <br>
                                                    <a href="?do=Delete&customerId=<?=$customer['ID']?>" class="text-secondary font-weight-bold text-s confirm" data-toggle="tooltip" data-original-title="Delete customer">
                                                    Delete
                                                    </a>
                                                </td>
                                                
                                            </tr>
                                        <?php
                                    
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                <?php


                
            }
            else{
                ?>
                    <ul class="list-group mt-2">
                        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h3 class="mb-0 text-lg font-weight-bold">There's no such Username.</h3>
                                </div>
                            </div>
                        </li>
                    </ul>
                <?php
            }
                
            

        }
        
    }

?>