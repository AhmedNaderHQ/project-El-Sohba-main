<?php
    session_start();
    include '../../databaseconnect.php';
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $op = $_GET['op'];
        if($op == 'Search'){
            $name = $_GET['name'];
            $stmt = $conn->prepare("SELECT * FROM `items` WHERE  `Name_du` LIKE '%$name%'");
            $stmt -> execute();
            $count = $stmt->rowCount();
            if($count > 0){
                $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

                ?>
                    <div class="table-responsive p-0 itemsTable">
                        <table class="table align-items-center justify-content-center mb-0 ">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" >Image<span style="font-weight: bold;color: black;">(width:600,height:600)</span></th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Arabic Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dutch Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Arabic Description</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Dutch Description</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Price</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Category</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Type</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Availability</th>
                                    <?php
                                        if($_SESSION['user']['Status'] == 1 ){
                                            ?>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Added-By</th>
                                            <?php
                                        }
                                    ?>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Adding-Date</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    
                                    foreach ($items as $item) {
                                        ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2">
                                                <div>
                                                    <img src="uploads/images/items-images/<?=$item['Image']?>" style="width:5rem;height:auto;" class="me-2" alt="<?=$item['Name_du']?>">
                                                </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2">
                                                    <div class="my-auto">
                                                        <h6 class="mb-0 text-lg"><?=$item['Name_ar']?></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2">
                                                    <div class="my-auto">
                                                        <h6 class="mb-0 text-lg"><?=$item['Name_du']?></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            
                                            <td class="align-middle text-center">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary me-2 mt-2" data-bs-toggle="modal" data-bs-target="#Description_ar<?=$item['ID']?>">
                                                    <i class="fa-solid fa-circle-info"></i>
                                                </button>
                                            </td>
                                            <!-- Modal review -->
                                            <div class="modal fade" id="Description_ar<?=$item['ID']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Arabic Description</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?=$item['Description_ar']?>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <td class="align-middle text-center">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary me-2 mt-2" data-bs-toggle="modal" data-bs-target="#Description_du<?=$item['ID']?>">
                                                    <i class="fa-solid fa-circle-info"></i>
                                                </button>
                                            </td>
                                            <!-- Modal review -->
                                            <div class="modal fade" id="Description_du<?=$item['ID']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Dutch Description</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?=$item['Description_du']?>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <td>
                                                <div class="d-flex px-2">
                                                    <div>
                                                        <p class="text-xs font-weight-bold mb-0"><?=$item['Price']?></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex">
                                                    <span class="me-2 text-xs font-weight-bold">
                                                        <?php
                                                            $stmt = $conn->prepare("SELECT `Name_du` FROM `categories` WHERE `ID` = ? ");
                                                            $stmt->execute(array($item['Cat_ID']));
                                                            $cat = $stmt->fetch(PDO::FETCH_ASSOC);
                                                            echo $cat['Name_du'];
                                                        ?>
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2">
                                                    <div>
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            <?php
                                                                if($item['Type'] == 1){
                                                                    echo 'Healthy';
                                                                }elseif($item['Type'] == 0){
                                                                    echo 'Unhealthy';
                                                                }  
                                                            ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-centre">
                                                <?php
                                                    if($item['Availability'] == 1){
                                                        ?>
                                                            <span class=" availability" data-itemId="<?=$item['ID']?>" style="cursor:pointer;" title="available"><i class="fa-solid fa-check"></i></span>
                                                        <?php
                                                    }
                                                    elseif($item['Availability'] == 0){
                                                        ?>
                                                            <span class=" availability" data-itemId="<?=$item['ID']?>" style="cursor:pointer;" title="unavailable"><i class="fa-solid fa-xmark"></i></span>
                                                        <?php
                                                    }
                                                ?>
                                            </td>
                                            <?php
                                                if($_SESSION['user']['Status'] == 1 ){
                                                    ?>
                                                        <td>
                                                            <p class="text-xs font-weight-bold mb-0">
                                                                <?php
                                                                    $stmt = $conn->prepare("SELECT `Name` FROM `users` WHERE `ID` = ? ");
                                                                    $stmt->execute(array($item['Admin_ID']));
                                                                    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
                                                                    echo $admin['Name'];
                                                                ?>
                                                            </p>
                                                        </td>
                                                    <?php
                                                }
                                            ?>
                                            <td>
                                                <span class="text-xs font-weight-bold text-center"><?=$item['Add_Date']?></span>
                                            </td>
                                            <td class="align-middle">
                                                <a href="?do=Edit&itemId=<?=$item['ID']?>" class="text-secondary font-weight-bold text-s" data-toggle="tooltip" data-original-title="Edit item">
                                                    Edit
                                                </a>
                                                <br>
                                                <a href="?do=Delete&itemId=<?=$item['ID']?>" class="text-secondary font-weight-bold text-s confirm" data-toggle="tooltip" data-original-title="Delete item">
                                                    Delete
                                                </a>
                                            </td>
                                            <td class="options">
                                                <div class="dropdown float-lg-end pe-4">
                                                    <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v text-secondary"></i>
                                                    </a>
                                                    <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable">
                                                    
                                                        <li><a class="dropdown-item border-radius-md" href="?do=AddProperty&itemId=<?=$item['ID']?>">Add Extras</a></li>                                                                                                        
                                                            
                                                        <?php
                                                            if($item['Sale'] == 0){
                                                                ?>
                                                                    <li><a class="dropdown-item border-radius-md" href="?do=AddSale&itemId=<?=$item['ID']?>">Add Sale</a></li>
                                                                <?php
                                                            }
                                                            elseif($item['Sale'] == 1){
                                                                ?>
                                                                    <li><a class="dropdown-item border-radius-md" href="?do=RemoveSale&itemId=<?=$item['ID']?>">Remove Sale</a></li>
                                                                <?php
                                                            } 
                                                        ?>
                                                        <?php
                                                            $stmt = $conn -> prepare("SELECT COUNT(`ID`) FROM `items-properties` WHERE `Item_ID` = ?");
                                                            $stmt -> execute(array($item['ID']));
                                                            $count = $stmt -> fetch(PDO::FETCH_ASSOC);
                                                            if($count['COUNT(`ID`)'] > 0){
                                                                ?>
                                                                    <li class="dropdown-item border-radius-md addProperty" data-bs-toggle="modal" data-bs-target="#propertiesView<?=$item['ID']?>" data-id="<?=$item['ID']?>">View Extras</li>
                                                                <?php
                                                            }
                                                        ?>
                                                        
                                                    </ul>
                                                    <!-- Properties Model -->
                                                    <div class="modal fade" id="propertiesView<?=$item['ID']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Extras</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    
                                                                    <?php
                                                                        $stmt = $conn -> prepare("SELECT * FROM `items-properties` WHERE `Item_ID` = ? AND `Property` = 'Extra'");
                                                                        $stmt -> execute(array($item['ID']));
                                                                        $properties = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                                                                        if(count($properties) > 0){
                                                                            ?>
                                                                                <h2>Extras</h2>
                                                                                <div class="table-responsive">
                                                                                    <table class="table align-middle table-nowrap">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th scope="col" >Arabic Extra</th>
                                                                                                <th scope="col" >Dutch Extra</th>
                                                                                                
                                                                                                <th scope="col" class="text-center">Price</th>
                                                                                                <th scope="col" class="text-center">Actions</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <?php
                                                                                                foreach($properties as $property){
                                                                                                    ?>
                                                                                                        <tr>
                                                                                                            <th >
                                                                                                                <div class="border-0 d-flex p-4 mb-2 border-radius-lg">
                                                                                                                    <?=$property['Value_ar']?>
                                                                                                                </div>
                                                                                                            </th>
                                                                                                            <th >
                                                                                                                <div class="border-0 d-flex p-4 mb-2 border-radius-lg">
                                                                                                                    <?=$property['Value_du']?>
                                                                                                                </div>
                                                                                                            </th>
                                                                                                            <td scope="col" class="text-center"><?=$property['Price']?></td>
                                                                                                            <td>
                                                                                                                <div class="text-center">
                                                                                                                    <a  href="?do=Property&propertyId=<?=$property['ID']?>&toDo=Edit" title="Edit Property"><i class="fa-regular fa-pen-to-square"></i></a>
                                                                                                                    <a class="confirm" href="?do=Property&propertyId=<?=$property['ID']?>&toDo=Delete" title="Delete Property"><i class="fa-solid fa-trash"></i></a>
                                                                                                                </div>
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
                                                                    ?>
                                                                

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>    
                                                        </div>
                                                    </div>
                                                </div>
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
                                    <h3 class="mb-0 text-lg font-weight-bold">There's no such Name.</h3>
                                </div>
                            </div>
                        </li>
                    </ul>
                <?php
            }
                
            

        }
        
    }

?>