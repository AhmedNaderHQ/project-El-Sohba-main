<?php
  ob_start(); //Output buffer start
  session_start();
  $pageTitle = 'Courses'; ;
  $pageIcon = 'coursesicon.ico' ;
  if(isset($_SESSION['user'])){
    include 'int.php';
    include 'includes/templates/header.php'; 
    ?>
        <body class="g-sidenav-show  bg-gray-100">
            <!-- Start sidebar -->
            <?php include 'includes/templates/sidebar.php'; ?>
            <!-- End sidebar -->
            <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
                <!-- Navbar -->
                <?php include 'includes/templates/nav-bar.php' ?>
                <!-- End Navbar -->
                <div class="container-fluid py-4">
                    <div class="row">
                        <div class="col-12">
                            <?php
                                $do = (isset($_GET['do'])) ? $_GET['do'] : 'Manage' ;
                                if($do =='Manage'){
                                    $onePageCourses = 10;
                                    if(isset($_GET['catId'])){
                                        $catId = $_GET['catId'];
                                        $option = 'WHERE `Cat_ID` = ' . $catId;
                                        $stmt = $conn->prepare("SELECT COUNT(`ID`) AS `COUNT` FROM `courses` WHERE `Cat_ID` =  ?  ");
                                        $stmt->execute(array($catId));
                                        $coursesNum = $stmt->fetch(PDO::FETCH_ASSOC);
                                        $pagesNum = ceil($coursesNum['COUNT']/$onePageCourses);
                                        $stmt = $conn->prepare("SELECT `Name` FROM `categories` WHERE `ID` =  ? ");
                                        $stmt->execute(array($catId));
                                        $catName = $stmt->fetch(PDO::FETCH_ASSOC);
                                        $title = $catName['Name'].' ';
                                    }else{
                                        $stmt = $conn->prepare("SELECT COUNT(`ID`) AS `COUNT` FROM `courses`");
                                        $stmt->execute();
                                        $coursesNum = $stmt->fetch(PDO::FETCH_ASSOC);
                                        $pagesNum = ceil($coursesNum['COUNT']/$onePageCourses);
                                        $title = '';
                                        $option='';
                                    }
                                    ?>  
                                        <div class="card mb-4">
                                            <?php
                                                $pageNum = (isset($_GET['pageNum'])) ? $_GET['pageNum'] : 1 ;
                                                if($pageNum > $pagesNum-1 && $pagesNum != 0){ $pageNum = $pagesNum; }
                                                $num = ($pageNum - 1)*$onePageCourses ;
                                                $stmt = $conn->prepare("SELECT * FROM `courses` $option LIMIT $onePageCourses  OFFSET $num");
                                                $stmt->execute();
                                                $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                $count = $stmt->rowCount();
                                                if($count > 0){
                                                    ?>
                                                        <div class="card-header pb-0">
                                                            <h3><?=$title?>Courses table</h3>
                                                        </div>
                                                        <div class="ms-md-auto pe-md-3 d-flex align-courses-start float-end">
                                                            <div class="input-group" style="width:auto;">
                                                                <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                                                                <input type="text" class="form-control coursesearch" placeholder="Search by Name...">
                                                            </div>
                                                        </div>
                                                        <div class="card-body px-0 pt-0 pb-2">
                                                            <div class="table-responsive p-0 coursesTable">
                                                                <table class="table align-courses-center justify-content-center mb-0 ">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" >Image<span style="font-weight: bold;color: black;">(width:600,height:600)</span></th>
                                                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Description</th>
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
                                                                            
                                                                            foreach ($courses as $course) {
                                                                                ?>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="d-flex px-2">
                                                                                            <div>
                                                                                                <img src="uploads/images/courses-images/<?=$course['Image']?>" style="width:5rem;height:auto;" class="me-2" alt="<?=$course['Name']?>">
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="d-flex px-2">
                                                                                            <div class="my-auto">
                                                                                                <h6 class="mb-0 text-lg"><?=$course['Name']?></h6>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td class="align-middle text-center">
                                                                                        <!-- Button trigger modal -->
                                                                                        <button type="button" class="btn btn-primary me-2 mt-2" data-bs-toggle="modal" data-bs-target="#Description<?=$course['ID']?>">
                                                                                            <i class="fa-solid fa-circle-info"></i>
                                                                                        </button>
                                                                                    </td>
                                                                                    <!-- Modal review -->
                                                                                    <div class="modal fade" id="Description<?=$course['ID']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                        <div class="modal-dialog">
                                                                                            <div class="modal-content">
                                                                                                <div class="modal-header">
                                                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Description</h1>
                                                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                                </div>
                                                                                                <div class="modal-body">
                                                                                                    <?=$course['Description']?>
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
                                                                                                <p class="text-xs font-weight-bold mb-0"><?=$course['Price']?></p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td class="align-middle text-center">
                                                                                        <div class="d-flex">
                                                                                            <span class="me-2 text-xs font-weight-bold">
                                                                                                <?php
                                                                                                    $stmt = $conn->prepare("SELECT `Name` FROM `categories` WHERE `ID` = ? ");
                                                                                                    $stmt->execute(array($course['Cat_ID']));
                                                                                                    $cat = $stmt->fetch(PDO::FETCH_ASSOC);
                                                                                                    echo $cat['Name'];
                                                                                                ?>
                                                                                            </span>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="d-flex px-2">
                                                                                            <div>
                                                                                                <p class="text-xs font-weight-bold mb-0">
                                                                                                    <?php
                                                                                                        if($course['Type'] == 1){
                                                                                                            echo 'Healthy';
                                                                                                        }elseif($course['Type'] == 0){
                                                                                                            echo 'Unhealthy';
                                                                                                        }  
                                                                                                    ?>
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td class="text-centre">
                                                                                        <?php
                                                                                            if($course['Availability'] == 1){
                                                                                                ?>
                                                                                                    <span class=" availability" data-courseId="<?=$course['ID']?>" style="cursor:pointer;" title="available"><i class="fa-solid fa-check"></i></span>
                                                                                                <?php
                                                                                            }
                                                                                            elseif($course['Availability'] == 0){
                                                                                                ?>
                                                                                                    <span class=" availability" data-courseId="<?=$course['ID']?>" style="cursor:pointer;" title="unavailable"><i class="fa-solid fa-xmark"></i></span>
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
                                                                                                            $stmt->execute(array($course['Admin_ID']));
                                                                                                            $admin = $stmt->fetch(PDO::FETCH_ASSOC);
                                                                                                            echo $admin['Name'];
                                                                                                        ?>
                                                                                                    </p>
                                                                                                </td>
                                                                                            <?php
                                                                                        }
                                                                                    ?>
                                                                                    <td>
                                                                                        <span class="text-xs font-weight-bold text-center"><?=$course['Add_Date']?></span>
                                                                                    </td>
                                                                                    <td class="align-middle">
                                                                                        <a href="?do=Edit&courseId=<?=$course['ID']?>" class="text-secondary font-weight-bold text-s" data-toggle="tooltip" data-original-title="Edit course">
                                                                                            Edit
                                                                                        </a>
                                                                                        <br>
                                                                                        <a href="?do=Delete&courseId=<?=$course['ID']?>" class="text-secondary font-weight-bold text-s confirm" data-toggle="tooltip" data-original-title="Delete course">
                                                                                            Delete
                                                                                        </a>
                                                                                    </td>
                                                                                    <td class="options">
                                                                                        <div class="dropdown float-lg-end pe-4">
                                                                                            <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                                <i class="fa fa-ellipsis-v text-secondary"></i>
                                                                                            </a>
                                                                                            <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable">
                                                                                            
                                                                                                <li><a class="dropdown-item border-radius-md" href="?do=AddProperty&courseId=<?=$course['ID']?>">Add Extras</a></li>                                                                                                        
                                                                                                    
                                                                                                <?php
                                                                                                    if($course['Sale'] == 0){
                                                                                                        ?>
                                                                                                            <li><a class="dropdown-item border-radius-md" href="?do=AddSale&courseId=<?=$course['ID']?>">Add Sale</a></li>
                                                                                                        <?php
                                                                                                    }
                                                                                                    elseif($course['Sale'] == 1){
                                                                                                        ?>
                                                                                                            <li><a class="dropdown-item border-radius-md" href="?do=RemoveSale&courseId=<?=$course['ID']?>">Remove Sale</a></li>
                                                                                                        <?php
                                                                                                    } 
                                                                                                ?>
                                                                                                <?php
                                                                                                    $stmt = $conn -> prepare("SELECT COUNT(`ID`) FROM `courses-properties` WHERE `Course_ID` = ?");
                                                                                                    $stmt -> execute(array($course['ID']));
                                                                                                    $count = $stmt -> fetch(PDO::FETCH_ASSOC);
                                                                                                    if($count['COUNT(`ID`)'] > 0){
                                                                                                        ?>
                                                                                                            <li class="dropdown-item border-radius-md addProperty" data-bs-toggle="modal" data-bs-target="#propertiesView<?=$item['ID']?>" data-id="<?=$item['ID']?>">View Extras</li>
                                                                                                        <?php
                                                                                                    }
                                                                                                ?>
                                                                                                
                                                                                            </ul>
                                                                                            <!-- Properties Model -->
                                                                                            <div class="modal fade" id="propertiesView<?=$course['ID']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                                <div class="modal-dialog">
                                                                                                    <div class="modal-content">
                                                                                                        <div class="modal-header">
                                                                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Extras</h1>
                                                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                                        </div>
                                                                                                        <div class="modal-body">
                                                                                                            
                                                                                                            <?php
                                                                                                                $stmt = $conn -> prepare("SELECT * FROM `courses-properties` WHERE `Course_ID` = ? AND `Property` = 'Extra'");
                                                                                                                $stmt -> execute(array($course['ID']));
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
                                                                                                                                                            <?=$property['Value']?>
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
                                                                <hr style="border: solid 1px #888;">
                                                                <div class="text-center">
                                                                    <div class="paginationItem">
                                                                        <?php
                                                                            if(isset($_GET['catId'])){
                                                                                $catId = $_GET['catId'];
                                                                                ?>
                                                                                    <a href="?catId=<?=$catId?>&pageNum=<?=$pageNum-1?>" class="<?php if($pageNum == 1) {echo 'disabled';}?>">&laquo;</a>
                                                                                <?php
                                                                            }else{
                                                                                ?>
                                                                                    <a href="?pageNum=<?=$pageNum-1?>" class="<?php if($pageNum == 1) {echo 'disabled';}?>">&laquo;</a>
                                                                                <?php
                                                                            }
                                                                            for ($i=1; $i <= $pagesNum ; $i++) { 
                                                                                if(isset($_GET['catId'])){
                                                                                    $catId = $_GET['catId'];
                                                                                    ?>
                                                                                        <a href="?catId=<?=$catId?>&pageNum=<?=$i?>" class="<?php if($pageNum == $i){echo 'active';} ?>"><?=$i?></a>
                                                                                    <?php

                                                                                }else{
                                                                                    ?>
                                                                                        <a href="?pageNum=<?=$i?>" class="<?php if($pageNum == $i){echo 'active';} ?>"><?=$i?></a>
                                                                                    <?php
                                                                                }
                                                                                
                                                                            }
                                                                            if(isset($_GET['catId'])) {
                                                                                $catId = $_GET['catId'];
                                                                                ?>
                                                                                    <a href="?catId=<?=$catId?>&pageNum=<?=$pageNum+1?>" class="<?php if($pageNum == $pagesNum) {echo 'disabled';}?>">&raquo;</a>
                                                                                <?php
                                                                            }else{
                                                                                ?>
                                                                                    <a href="?pageNum=<?=$pageNum+1?>" class="<?php if($pageNum == $pagesNum) {echo 'disabled';}?>">&raquo;</a>
                                                                                <?php
                                                                            }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php
                                                }
                                                else{
                                                    ?>
                                                        <div class="card-body px-0 pt-2 pb-2">
                                                            <ul class="list-group">
                                                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                                    <div class="d-flex flex-column">
                                                                        <span class="text-dark font-weight-bold ms-sm-2">There's no courses to show.</span>
                                                                    </div>
                                                                </li>
                                                            </ul> 
                                                        </div>
                                                    <?php
                                                }
                                            ?>
                                            
                                        </div>
                                    
                                        <a href="?do=Add" class="btn bg-gradient-dark mb-0"><i class="fa fa-plus"></i>  Add a new Course</a>
                                    <?php
                                }
                                elseif($do == 'Add'){
                                    ?>
                                        <div class="card mb-4">
                                            <?php
                                                $stmt = $conn->prepare("SELECT COUNT(*) FROM `categories`");
                                                $stmt -> execute();
                                                $categoriesCount = $stmt->fetch(PDO::FETCH_ASSOC);
                                                if($categoriesCount['COUNT(*)'] > 0){
                                                    ?>
                                                        <div class="card-header pb-0">
                                                            <h3>Add Course</h3>
                                                        </div>
                                                        <div class="card-body px-0 pt-0 pb-2">
                                                            <form class="form-horizontal ms-4" action="?do=Insert" method="POST" enctype="multipart/form-data">
                                                                <!-- Start Name Field -->
                                                                <div class="row form-group  my-5 form-group-lg">
                                                                    <label class="col-sm-2 control-label">Name</label>
                                                                    <div class="col-sm-10 col-md-6">
                                                                        <input type="text" class="form-control" name="name" required="required" placeholder="Name of the new item" />
                                                                    </div>
                                                                </div>
                                                                <!-- End Name Field -->
                                                                <!-- Start Description Field -->
                                                                <div class="row form-group  my-5 form-group-lg">
                                                                    <label class="col-sm-2 control-label">Description</label>
                                                                    <div class="col-sm-10 col-md-6">
                                                                        <textarea type="text" class="form-control" required name="description"  placeholder="Description of the new item"></textarea>
                                                                    </div>
                                                                </div>
                                                                <!-- End Description Field -->
                                                                <!-- Start Price Field -->
                                                                <div class="row form-group  my-5 form-group-lg">
                                                                    <label class="col-sm-2 control-label">Price</label>
                                                                    <div class="col-sm-10 col-md-6">
                                                                        <input type="number" pattern="[0-9]+" min="1" class="form-control" name="price" required="required" placeholder="Price of the new item" />
                                                                    </div>
                                                                </div>
                                                                <!-- End Price Field -->
                                                                <!-- Start Category Field -->
                                                                <div class="row form-group  my-5 form-group-lg">
                                                                    <label class="col-sm-2 control-label">Category</label>
                                                                    <div class="col-sm-10 col-md-6">
                                                                        <select name="category" class="form-control" required="required">
                                                                            <option class="form-control" selected disabled > ... </option>
                                                                            <?php
                                                                                $stmt = $conn->prepare("SELECT `Name`, `ID` FROM `categories`");
                                                                                $stmt->execute();
                                                                                $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                                                foreach ($categories as $category) {
                                                                                    ?>
                                                                                        <option class="form-control" value="<?=$category['ID']?>"><?=$category['Name']?></option>
                                                                                    <?php
                                                                                }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <!-- End Category Field -->
                                                                <!-- Start Type Field -->
                                                                <div class="row form-group  my-5 form-group-lg">
                                                                    <label class="col-sm-2 control-label">Type</label>
                                                                    <div class="col-sm-10 col-md-6">
                                                                        <select name="type" class="form-control" required="required">
                                                                            <option class="form-control" selected disabled > ... </option> 
                                                                            <option class="form-control" value="1">Healthy</option>        
                                                                            <option class="form-control" value="0">Unhealthy</option>        
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <!-- End Type Field -->
                                                                <!-- Start Image Field -->
                                                                <div class="row form-group  my-5 form-group-lg">
                                                                    <label class="col-sm-2 control-label">Image</label>
                                                                    <div class="col-sm-10 col-md-6">
                                                                    <p style="font-weight: bold;color: black;margin-bottom: 0;">(width:400,height:500)</p>
                                                                        <input type="file" class="form-control" name="image" accept=".png, .jpg, .jpeg, .webp, .avif" required="required" />
                                                                    </div>
                                                                </div>
                                                                <!-- End Image Field -->
                                                                <!-- Start Submit Field -->
                                                                <div class="row form-group my-5">
                                                                    <div class="offset-sm-2 col-sm-10">
                                                                        <input type="submit" class="btn bg-gradient-dark mb-0" value="Add item"/>
                                                                    </div>
                                                                </div>
                                                                <!-- End Submit Field -->
                                                            </form>
                                                        </div>
                                                    <?php
                                                }
                                                else{
                                                    ?>
                                                        <div class="card-body px-0 pt-2 pb-2">
                                                            <ul class="list-group">
                                                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                                    <div class="d-flex flex-column">
                                                                        <span class="text-dark font-weight-bold ms-sm-2">You have to add a category first.</span>
                                                                        <?php redirectHome(null, $url='categories.php'); ?>
                                                                    </div>
                                                                </li>
                                                            </ul> 
                                                        </div>
                                                    <?php
                                                }

                                            ?>
                                            
                                        </div>
                                    <?php
                                }
                                elseif($do == 'Insert'){
                                    ?>
                                        <div class="card mb-4">
                                            <div class="card-header pb-0">
                                                <h3>Insert Course</h3>
                                            </div>
                                            <div class="card-body px-4 pt-0 pb-2">
                                                <?php 
                                                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                                                        $name= $_POST['name'];
                                                        $description = $_POST['description'];
                                                        $price = $_POST['price'];
                                                        
                                                        if(isset($_POST['category'])){
                                                            $category = $_POST['category'];
                                                        }else{
                                                            $category = null;
                                                        }
                                                        if(isset($_POST['type'])){
                                                            $type = $_POST['type'];
                                                        }else{
                                                            $type = null;
                                                        }
                                                        
                                                        $image = $_FILES['image'];
                                                        $formErrors = array();
                                                        if(empty($name)){$formErrors[] = '<strong>Name</strong> must not be empty.';}
                                                        if (checkItem('Name', 'courses', $name) > 0) { $formErrors[] = 'This Name is already taken.' ; }
                                                        if (strpos($name,'-')) { $formErrors[] = 'Name can\'t have <strong>[ - ]</strong>.' ; }
                                                        if (strpos($name,'’')) { $formErrors[] = 'Name can\'t have <strong>[ ’ ]</strong>.' ; }
                                                        if (strpos($name,"'")) { $formErrors[] = 'Name can\'t have <strong>[ \' ]</strong>.' ; }
                                                        if (strpos($name,'&')) { $formErrors[] = 'Name can\'t have <strong>[ & ]</strong>.' ; }
                                                        if(empty($description)){$formErrors[] = '<strong>Description</strong> must not be empty.';}
                                                        if(empty($price)){$formErrors[] = '<strong>Price</strong> must not be empty.';}
                                                        if(empty($price)){$formErrors[] = '<strong>Price</strong> must not be empty.';}
                                                        if(empty($category)){$formErrors[] = 'You must choose a <strong>category</strong>.';}
                                                        if($type === null || ! in_array($type, [0, 1])){$formErrors[] = 'You must choose a valid <strong>type</strong>.';}
                                                        if(empty($image['name'])){$formErrors[] = 'You have to choose an <strong>image</strong>.';}
                                                        $AllowedImgExt = array('png', 'jpg', 'jpeg', 'webp', 'avif');
                                                        $img_name_array = explode('.', $image['name']);
                                                        $ImgActExt = strtolower(end($img_name_array));
                                                        if(! empty($image['name']) && ! in_array($ImgActExt, $AllowedImgExt)){$formErrors[] = 'The image extension is <strong>Not Allowed</strong>.';}
                                                        if($image['size'] > 4194304){$formErrors[] = 'The image can\'t exceed <strong>4MB</strong>.';}
                                                        
                                                        ?>
                                                            <ul class="list-group">
                                                                <?php if(! empty($formErrors)){echo '<h5 class="mb-3 text-sm">Form errors</h5>';} ?>
                                                                <?php 
                                                                    foreach ($formErrors as $error) {
                                                                        ?>
                                                                            <ul class="list-group">
                                                                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                                                    <div class="d-flex flex-column">
                                                                                        <span class="text-danger font-weight-bold ms-sm-2"><?=$error?></span>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        <?php
                                                                    }
                                                                    if(empty($formErrors)){
                                                                        $imageName = rand(0, 10000) . '_' . $image['name'];
                                                                        $stmt = $conn->prepare("INSERT INTO `courses`(`Name`, `Description`, `Image`, `Price`,  `Cat_ID`, `Admin_ID`, `Type`) VALUES (:zname, :zdescription, :zimage, :zprice,  :zcat, :zadmin, :ztype)");
                                                                        $stmt->execute(array('zname' => $name, 'zdescription' => $description, 'zimage' => $imageName, 'zprice' => $price, 'zcat' => $category, 'zadmin' => $_SESSION['user']['ID'], 'ztype' => $type));
                                                                        $count = $stmt->rowCount();
                                                                        $item_id = $conn->lastInsertId();
                                                                        move_uploaded_file($image['tmp_name'], "uploads/images/courses-images/".$imageName);
                                                                        $stmt = $conn->prepare("INSERT INTO `notifications`(`Type`, `TypeID`) VALUES (:ztype, :zid)");
                                                                        $stmt->execute(array('ztype' => 'Item', 'zid' => $item_id));
                                                                        
                                                                        ?>
                                                                            <ul class="list-group">
                                                                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                                                    <div class="d-flex flex-column">
                                                                                        <span class="text-dark font-weight-bold ms-sm-2"><?=$count?> record inserted successfully.</span>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        <?php
                                                                        redirectHome(null, $url='courses.php');
                                                                    }
                                                                ?>
                                                            </ul>
                                                        <?php

                                                    }else{
                                                        ?>
                                                            <ul class="list-group">
                                                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                                    <div class="d-flex flex-column">
                                                                        <span class="text-danger font-weight-bold ms-sm-2">Sorry, you can't browse this page directly.</span>
                                                                        <?php redirectHome(null, $url='courses.php'); ?>
                                                                    </div>
                                                                </li>
                                                            </ul> 
                                                        <?php
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    <?php 
                                }
                                elseif($do == 'Edit'){
                                    ?>  
                                    <div class="card mb-4">
                                        <div class="card-header pb-0">
                                            <h3>Edit Course</h3>
                                            <div class="card-body px-0 pt-0 pb-2">
                                                <?php
                                                if(isset($_GET['courseId']) && is_numeric($_GET['courseId'])){
                                                    $courseId = $_GET['courseId'];
                                                    $check = checkItem('ID', 'courses', $courseId);
                                                    if($check > 0){
                                                        $stmt= $conn->prepare("SELECT * FROM `courses` WHERE `ID` = ?");
                                                        $stmt->execute(array($courseId));
                                                        $item = $stmt->fetch(PDO::FETCH_ASSOC);
                                                        ?>
                                                            <form class="form-horizontal" action="?do=Update" method="POST" enctype="multipart/form-data">
                                                                <input type="hidden" name="id" value="<?=$courseId?>">
                                                                <!-- Start Name Field -->
                                                                <div class="row form-group  my-5 form-group-lg">
                                                                    <label class="col-sm-2 control-label">Name</label>
                                                                    <div class="col-sm-10 col-md-6">
                                                                        <input type="text" class="form-control" name="name" required="required" placeholder="Name of the new item" value="<?=$item['Name']?>"/>
                                                                    </div>
                                                                </div>
                                                                <!-- End Name Field -->
                                                                <!-- Start Description Field -->
                                                                <div class="row form-group  my-5 form-group-lg">
                                                                    <label class="col-sm-2 control-label">Description</label>
                                                                    <div class="col-sm-10 col-md-6">
                                                                        <textarea type="text" class="form-control" name="description" placeholder="Description of the new item"><?=$item['Description']?></textarea>
                                                                    </div>
                                                                </div>
                                                                <!-- End Description Field -->
                                                                <!-- Start Price Field -->
                                                                <div class="row form-group  my-5 form-group-lg">
                                                                    <label class="col-sm-2 control-label">Price</label>
                                                                    <div class="col-sm-10 col-md-6">
                                                                        <input type="number" pattern="[0-9]+" min="1" class="form-control" name="price" required="required" placeholder="Price of the new item" value="<?=$item['Price']?>"/>
                                                                    </div>
                                                                </div>
                                                                <!-- End Price Field -->
                                                                <!-- Start Category Field -->
                                                                <div class="row form-group  my-5 form-group-lg">
                                                                    <label class="col-sm-2 control-label">Category</label>
                                                                    <div class="col-sm-10 col-md-6">
                                                                        <select name="category" class="form-control" required="required">
                                                                            <option value="0" class="form-control" selected disabled> ... </option>
                                                                            <?php
                                                                                $stmt = $conn->prepare("SELECT `ID`, `Name` FROM `categories`");
                                                                                $stmt->execute();
                                                                                $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                                                foreach ($categories as $category) {
                                                                                    ?>
                                                                                        <option class="form-control" <?php if($category['ID'] == $item['Cat_ID']){ echo 'selected' ;} ?> value="<?=$category['ID']?>"><?=$category['Name']?></option>
                                                                                    <?php
                                                                                }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <!-- End Category Field -->
                                                                <!-- Start Image Field -->
                                                                <!-- Start Type Field -->
                                                                <div class="row form-group  my-5 form-group-lg">
                                                                    <label class="col-sm-2 control-label">Type</label>
                                                                    <div class="col-sm-10 col-md-6">
                                                                        <select name="type" class="form-control" required="required">
                                                                            <option class="form-control" selected disabled> ... </option>
                                                                            <option class="form-control" <?php if($item['Type'] == 1){ echo 'selected' ;} ?> value="1">Healthy</option>
                                                                            <option class="form-control" <?php if($item['Type'] == 0){ echo 'selected' ;} ?> value="0">Unhealthy</option>
                                                                            
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <!-- End Type Field -->
                                                                <!-- Start Image Field -->
                                                                <div class="row form-group  my-5 form-group-lg">
                                                                    <label class="col-sm-2 control-label">Image</label>
                                                                    <div class="col-sm-10 col-md-6">
                                                                        <p style="font-weight: bold;color: black;margin-bottom: 0;">(width:600,height:600)</p>
                                                                        <input type="hidden" name="oldImage" value="<?=$item['Image']?>">
                                                                        <input type="file" class="form-control" name="image" accept=".png, .jpg, .jpeg, .webp, .avif" />
                                                                        <span style="color:#253134;">Leave blank if you do not want it to be changed.</span>
                                                                    </div>
                                                                </div>
                                                                <!-- End Image Field -->
                                                                <!-- Start Submit Field -->
                                                                <div class="row form-group my-5">
                                                                    <div class="offset-sm-2 col-sm-10">
                                                                        <input type="submit" class="btn bg-gradient-dark mb-0" value="Update item"/>
                                                                    </div>
                                                                </div>
                                                                <!-- End Submit Field -->
                                                            </form>
                                                        <?php
                                                    }else{
                                                        ?>
                                                            <ul class="list-group">
                                                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                                    <div class="d-flex flex-column">
                                                                        <span class="text-danger font-weight-bold ms-sm-2">There's no such an ID.</span>
                                                                        <?php redirectHome(null,$url='courses.php'); ?>
                                                                    </div>
                                                                </li>
                                                            </ul> 
                                                        <?php
                                                    }

                                                }else{
                                                    ?>
                                                        <ul class="list-group">
                                                            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                                <div class="d-flex flex-column">
                                                                    <span class="text-danger font-weight-bold ms-sm-2">Sorry, you can't browse this page directly.</span>
                                                                    <?php redirectHome(null,$url='courses.php'); ?>
                                                                </div>
                                                            </li>
                                                        </ul> 
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                elseif($do == 'Update'){
                                    ?>
                                        <div class="card mb-4">
                                            <div class="card-header pb-0">
                                            <h3>Update Course</h3>
                                            <div class="card-body px-0 pt-0 pb-2">
                                                <?php
                                                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                                                    $id = $_POST['id'];
                                                    $name = $_POST['name'];
                                                    $description = $_POST['description'];
                                                    $price = $_POST['price'];
                                                   
                                                    $category = $_POST['category'];
                                                    $type = $_POST['type'];
                                                    $formErrors = array();
                                                    if(empty($name)){$formErrors[] = '<strong>Name</strong> must not be empty.';}
                                                    if(checkItemEdit('Name', 'courses', $name, 'ID', $id) > 0) { $formErrors[] = 'This Name is already taken.' ; }
                                                    if (strpos($name,'-')) { $formErrors[] = 'Name can\'t have <strong>[ - ]</strong>.' ; }
                                                    if (strpos($name,'’')) { $formErrors[] = 'Name can\'t have <strong>[ ’ ]</strong>.' ; }
                                                    if (strpos($name,"'")) { $formErrors[] = 'Name can\'t have <strong>[ \' ]</strong>.' ; }
                                                    if (strpos($name,'&')) { $formErrors[] = 'Name can\'t have <strong>[ & ]</strong>.' ; }
                                                    if(empty($price)){$formErrors[] = '<strong>Price</strong> must not be empty.';}
                                                    if(empty($description)){$formErrors[] = '<strong>Description</strong> must not be empty.';}
                                                    if(empty($category)){$formErrors[] = 'You must choose a <strong>category</strong>.';}
                                                    if($type === null || ! in_array($type, [0, 1])){$formErrors[] = 'You must choose a valid <strong>type</strong>.';}
                                                    if(! empty($_FILES['image']['name'])){
                                  
                                                        $AllowedImgExt = array('png', 'jpg', 'jpeg', 'webp', 'avif');
                                                        $img_name_array = explode('.', $_FILES['image']['name']);
                                                        $ImgActExt = strtolower(end($img_name_array));
                                                        if(! in_array($ImgActExt, $AllowedImgExt)){$formErrors[] = 'The  image extension is <strong>Not Allowed</strong>.';}
                                                        if($_FILES['image']['size'] > 4194304){$formErrors[] = 'The image can\'t exceed <strong>4MB</strong>.';}
                                                        
                                                        if(empty($formErrors)){
                                                         
                                                            $path = "uploads/images/courses-images/" ;
                                                            unlink($path.$_POST['oldImage']);
                                                            $img =rand(0, 10000).'_'.$_FILES['image']['name'];
                                                            move_uploaded_file($_FILES['image']['tmp_name'], "uploads/images/courses-images/".$img);
                                                            
                                                        }
                                                    }else{
                                                        $img = $_POST['oldImage'];
                                                    }
                                                    ?>
                                                        <ul class="list-group">
                                                            <?php if(! empty($formErrors)){echo '<h5 class="mb-3 text-sm">Form errors</h5>';} ?>
                                                            <?php 
                                                                foreach ($formErrors as $error) {
                                                                    ?>
                                                                        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                                            <div class="d-flex flex-column">
                                                                                <span class="text-danger font-weight-bold ms-sm-2"><?=$error?></span>
                                                                            </div>
                                                                        </li>
                                                                    <?php
                                                                }
                                                                if(empty($formErrors)){
                                                                    
                                                                    $stmt = $conn->prepare("UPDATE `courses` SET `Name` = ?, `Description` = ?, `Image` = ?, `Price` = ?, `Cat_ID` = ?, `Type` = ? WHERE `ID` = ?");
                                                                    $stmt->execute(array($name, $description, $img, $price, $category, $type, $id));
                                                                    $count = $stmt->rowCount();
                                                                    ?>
                                                                        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                                            <div class="d-flex flex-column">
                                                                                <span class="text-dark font-weight-bold ms-sm-2"><?=$count?> record updated successfully.</span>
                                                                            </div>
                                                                        </li>
                                                                    <?php
                                                                    redirectHome(null, $url='courses.php');
                                                                }
                                                            ?>
                                                        </ul>
                                                    <?php
                                                }else{
                                                    ?>
                                                    <ul class="list-group">
                                                        
                                                        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                            <div class="d-flex flex-column">
                                                                <span class="text-danger font-weight-bold ms-sm-2">Sorry, you can't browse this page directly.</span>
                                                                <?php redirectHome(null,$url='courses.php'); ?>
                                                            </div>
                                                        </li>
                                                    </ul> 
                                                    <?php
                                                }
                                                ?>
                                            </div>  
                                            </div>  
                                        </div>  
                                    <?php  
                                }
                                elseif($do == 'Delete'){
                                    ?>  
                                        <div class="card mb-4">
                                            <div class="card-header pb-0">
                                                <h3>Delete Course</h3>
                                            </div>
                                            <div class="card-body px-0 pt-0 pb-2">
                                                <?php
                                                if(isset($_GET['courseId']) && is_numeric($_GET['courseId'])){
                                                    $courseId = $_GET['courseId'];
                                                    $check = checkItem('ID', 'courses', $courseId);
                                                    if($check > 0){

                                                        
                                                        $stmt= $conn->prepare("DELETE  FROM `courses-properties` WHERE `Course_ID` = ?");
                                                        $stmt-> execute(array($courseId));
                                                        $stmt= $conn->prepare("SELECT `Image` FROM `courses` WHERE `ID` = ?");
                                                        $stmt->execute(array($courseId));
                                                        $image = $stmt->fetch(PDO::FETCH_ASSOC);
                                                        $path = "uploads/images/courses-images//";
                                                        unlink($path.$image['Image']);
                                                        $stmt= $conn->prepare("DELETE FROM `courses` WHERE `ID` = ?");
                                                        $stmt-> execute(array($courseId));
                                                        $count = $stmt->rowCount();
                                                        ?>
                                                            <ul class="list-group">
                                                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                                    <div class="d-flex flex-column">
                                                                        <span class="text-dark font-weight-bold ms-sm-2"><?=$count?> record deleted successfully.</span>
                                                                        <?php redirectHome(null,$url='courses.php'); ?>
                                                                    </div>
                                                                </li>
                                                            </ul> 
                                                        <?php

                                                
                                                    }else{
                                                        ?>
                                                            <ul class="list-group">
                                                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                                    <div class="d-flex flex-column">
                                                                        <span class="text-danger font-weight-bold ms-sm-2">There's no such an ID.</span>
                                                                        <?php redirectHome(null,$url='courses.php'); ?>
                                                                    </div>
                                                                </li>
                                                            </ul> 
                                                        <?php
                                                    }

                                                }else{
                                                    ?>
                                                        <ul class="list-group">
                                                            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                                <div class="d-flex flex-column">
                                                                    <span class="text-danger font-weight-bold ms-sm-2">Sorry, you can't browse this page directly.</span>
                                                                    <?php redirectHome(null,$url='courses.php'); ?>
                                                                </div>
                                                            </li>
                                                        </ul> 
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            
                                        </div>
                                    <?php
                                    
                                }
                                elseif($do == 'AddSale'){
                                    ?>
                                        <div class="card mb-4">
                                            <div class="card-header pb-0">
                                                <h3>Add Sale</h3>
                                                <div class="card-body px-0 pt-0 pb-2">
                                                    <?php
                                                        if($_SERVER['REQUEST_METHOD'] == 'GET'){
                                                            if(isset($_GET['courseId']) && is_numeric($_GET['courseId'])){
                                                                $courseId = $_GET['courseId'];
                                                                $check = checkItem('ID', 'courses', $courseId);

                                                                if($check > 0){
                                                        
                                                                    ?>
                                                                        
                                                                        <form class="form-horizontal" action="?do=AddSale" method="POST" enctype="multipart/form-data">
                                                                            <input type="hidden" name="courseid" value="<?=$courseId?>">
                                                                            
                                                                            <!-- Start Sale Field -->
                                                                            <div class="row form-group  my-5 form-group-lg">
                                                                                <label class="col-sm-2 control-label">Sale</label>
                                                                                    <div class="col-sm-10 col-md-6">
                                                                                        <input type="number" class="form-control" name="value" min="1" max="99" required="required"/>
                                                                                    </div>
                                                                            </div>
                                                                            <!-- End Sale Field -->
                                                                            <!-- Start Submit Field -->
                                                                            <div class="row form-group my-5">
                                                                                <div class="offset-sm-2 col-sm-10">
                                                                                    <input type="submit" class="btn bg-gradient-dark mb-0" value="Add Sale"/>
                                                                                </div>
                                                                            </div>
                                                                            <!-- End Submit Field -->
                                                                        </form>
                                                                    <?php
                                                                }else{
                                                                    ?>
                                                                        <ul class="list-group">
                                                                            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                                                <div class="d-flex flex-column">
                                                                                    <span class="text-danger font-weight-bold ms-sm-2">There's no such an ID.</span>
                                                                                    <?php redirectHome(null,$url='courses.php'); ?>
                                                                                </div>
                                                                            </li>
                                                                        </ul> 
                                                                    <?php
                                                                }

                                                            }
                                                            else{
                                                                ?>
                                                                <ul class="list-group">
                                                                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                                        <div class="d-flex flex-column">
                                                                            <span class="text-danger font-weight-bold ms-sm-2">Sorry, something went wrong, please try again later.</span>
                                                                            <?php redirectHome(null, $url='courses.php'); ?>
                                                                        </div>
                                                                    </li>
                                                                </ul> 
                                                                <?php
                                                            }
                                                        }
                                                        elseif($_SERVER['REQUEST_METHOD'] == 'POST'){
                                                            $id = $_POST['courseid'];
                                                            $value = $_POST['value'];

                                                            $formErrors = array();
                                                            $check = checkItem('ID', 'courses', $id);
                                                            if($check == 0){$formErrors[] = 'There\'s no such an <strong>ID</strong>.';}
                                                            if($value <= 0 || $value >= 100){$formErrors[] = 'The value is not valid <strong>( 0 > and < 100 )</strong>.';}
                                                            ?>
                                                                <ul class="list-group">
                                                                    <?php
                                                                        foreach ($formErrors as $error) {
                                                                            ?>
                                                                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                                                    <div class="d-flex flex-column">
                                                                                        <span class="text-danger font-weight-bold ms-sm-2"><?=$error?></span>
                                                                                    </div>
                                                                                </li>
                                                                            <?php
                                                                        }
                                                                        if(empty($formErrors)){
                                                                            $stmt = $conn -> prepare("UPDATE `courses` SET `Sale` = 1, `SaleValue` = ? WHERE `ID` = ?");
                                                                            $stmt -> execute(array($value, $id));
                                                                            $count = $stmt->rowCount();
                                                                            ?>
                                                                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                                                    <div class="d-flex flex-column">
                                                                                        <span class="text-dark font-weight-bold ms-sm-2">Sale added successfully.</span>
                                                                                    </div>
                                                                                </li>
                                                                            <?php
                                                                            redirectHome(null, $url='courses.php');
                                                                        }
                                                                    ?>
                                                                </ul>
                                                            <?php
                                                            

                                                        }
                                                        else{
                                                            ?>
                                                                <ul class="list-group">
                                                                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                                        <div class="d-flex flex-column">
                                                                            <span class="text-danger font-weight-bold ms-sm-2">Sorry, you can't browse this page directly.</span>
                                                                            <?php redirectHome(null,$url='courses.php'); ?>
                                                                        </div>
                                                                    </li>
                                                                </ul> 
                                                            <?php
                                                        }
                                                        
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                }
                                elseif($do == 'RemoveSale'){
                                    ?>
                                        <div class="card mb-4">
                                            <div class="card-header pb-0">
                                                <h3>Remove Sale</h3>
                                                <div class="card-body px-0 pt-0 pb-2">
                                                    <?php
                                                        if($_SERVER['REQUEST_METHOD'] == 'GET'){
                                                            if(isset($_GET['courseId']) && is_numeric($_GET['courseId'])){
                                                                $courseId = $_GET['courseId'];
                                                                $check = checkItem('ID', 'courses', $courseId);

                                                                if($check > 0){
                                                        
                                                                    ?>
                                                                        <ul class="list-group">
                                                                            <?php
                                                                                
                                                                                $stmt = $conn -> prepare("UPDATE `courses` SET `Sale` = 0, `SaleValue` = NULL WHERE `ID` = ?");
                                                                                $stmt -> execute(array($courseId));
                                                                                $count = $stmt->rowCount();
                                                                                ?>
                                                                                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                                                        <div class="d-flex flex-column">
                                                                                            <span class="text-dark font-weight-bold ms-sm-2">Sale removed successfully.</span>
                                                                                        </div>
                                                                                    </li>
                                                                                <?php
                                                                                redirectHome(null, $url='courses.php');
                                                                                
                                                                            ?>
                                                                        </ul>
                                                                        
                                                                    <?php
                                                                }else{
                                                                    ?>
                                                                        <ul class="list-group">
                                                                            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                                                <div class="d-flex flex-column">
                                                                                    <span class="text-danger font-weight-bold ms-sm-2">There's no such an ID.</span>
                                                                                    <?php redirectHome(null,$url='courses.php'); ?>
                                                                                </div>
                                                                            </li>
                                                                        </ul> 
                                                                    <?php
                                                                }

                                                            }
                                                        }
                                                        else{
                                                            ?>
                                                                <ul class="list-group">
                                                                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                                        <div class="d-flex flex-column">
                                                                            <span class="text-danger font-weight-bold ms-sm-2">Sorry, you can't browse this page directly.</span>
                                                                            <?php redirectHome(null,$url='courses.php'); ?>
                                                                        </div>
                                                                    </li>
                                                                </ul> 
                                                            <?php
                                                        }
                                                        
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                }
                                elseif($do == 'AddProperty'){
                                    ?>
                                        <div class="card mb-4">
                                            <div class="card-header pb-0">
                                                <h3>Add Extras</h3>
                                            
                                            <div class="card-body px-0 pt-0 pb-2">
                                                <?php
                                                    if($_SERVER['REQUEST_METHOD'] == 'GET'){
                                                        if(isset($_GET['courseId']) && is_numeric($_GET['courseId'])){
                                                            $courseId = $_GET['courseId'];
                                                            $check = checkItem('ID', 'courses', $courseId);

                                                            if($check > 0){
                                                    
                                                                ?>
                                                                    <form  class="form-horizontal propertiesForm ms-1">
                                                                        <!-- Start Number Field -->
                                                                        <div class="row form-group  my-5 form-group-lg">
                                                                            <label class="col-sm-2 control-label">Number</label>
                                                                            <div class="col-sm-10 col-md-6">
                                                                                <input type="number" name="number" min="1" class="form-control" required="required" placeholder="How many do you want to add ?">
                                                                            </div>
                                                                        </div>
                                                                        <!-- End Number Field -->
                                                                        <!-- Start Submit Field -->
                                                                        <div class="row form-group my-2">
                                                                            <div class="offset-sm-2 col-sm-10">
                                                                                <input type="submit" class="btn bg-gradient-dark mb-0" value="Submit"/>
                                                                            </div>
                                                                        </div>
                                                                        <!-- End Submit Field -->
                                                                        
                                                                    </form>
                                                                    <form class="form-horizontal propertiesFormAdd ms-1 d-none" action="?do=AddProperty" method="POST">
                                                                                                    
                                                                        <input type="hidden" name="courseId" value="<?=$courseId?>">
                                                                        <!-- Start Submit Field -->
                                                                        <div class="row form-group my-2">
                                                                            <div class="offset-sm-2 col-sm-10">
                                                                                <input type="submit" class="btn bg-gradient-dark mb-0" value="Submit"/>
                                                                            </div>
                                                                        </div>
                                                                        <!-- End Submit Field -->
                                                                    </form>
                                                                    
                                                                <?php
                                                            }else{
                                                                ?>
                                                                    <ul class="list-group">
                                                                        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                                            <div class="d-flex flex-column">
                                                                                <span class="text-danger font-weight-bold ms-sm-2">There's no such an ID.</span>
                                                                                <?php redirectHome(null,$url='courses.php'); ?>
                                                                            </div>
                                                                        </li>
                                                                    </ul> 
                                                                <?php
                                                            }

                                                        }
                                                        else{
                                                            ?>
                                                                <ul class="list-group">
                                                                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                                        <div class="d-flex flex-column">
                                                                            <span class="text-danger font-weight-bold ms-sm-2">Sorry, something went wrong, please try again later.</span>
                                                                            <?php redirectHome(null, $url='courses.php'); ?>
                                                                        </div>
                                                                    </li>
                                                                </ul> 
                                                            <?php
                                                        }
                                                    }
                                                    elseif($_SERVER['REQUEST_METHOD'] == 'POST'){
                                                        $id = $_POST['courseId'];
                                                        $number = $_POST['number'];
                                                        $check = checkItem('ID', 'courses', $id);
                                                        ?>
                                                            <ul class="list-group">
                                                                <?php
                                                                    if($check == 1){
                                                                        $count = 0;
                                                                        for($i = 1; $i <= $number; $i++){
                                                                        
                                                                            $extra_ar = $_POST['extra_ar'.$i];
                                                                            $extra_du = $_POST['extra_du'.$i];
                                                                            $price = $_POST['extraPrice'.$i];
                                                                            $stmt = $conn -> prepare("INSERT INTO `courses-properties`(`Property`, `Value_ar`, `Value_du`, `Price`,`Item_ID`) VALUES ('Extra', :zvalue_ar, :zvalue_du, :zprice, :zitem)");
                                                                            $stmt -> execute(array('zvalue_ar' => $extra_ar, 'zvalue_du' => $extra_du, 'zprice' => $price, 'zitem' => $id));
                                                                            $count++;
                                                                    
                                                                        }
                                                                        if ($count == $number){
                                                                            ?>
                                                                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                                                    <div class="d-flex flex-column">
                                                                                        <span class="text-dark font-weight-bold ms-sm-2"><?=$count?> records added successfully.</span>
                                                                                    </div>
                                                                                </li>
                                                                            <?php
                                                                            redirectHome(null, $url='courses.php');
                                                                        }else{
                                                                            ?>
                                                                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                                                    <div class="d-flex flex-column">
                                                                                        <span class="text-danger font-weight-bold ms-sm-2">something went wrong, please try again.</span>
                                                                                    </div>
                                                                                </li>
                                                                            <?php
                                                                            redirectHome(null, $url='courses.php');
                                                                        }
                                                                    }
                                                                    else{
                                                                        ?>
                                                                            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                                                <div class="d-flex flex-column">
                                                                                    <span class="text-danger font-weight-bold ms-sm-2">there's no such ID.</span>
                                                                                </div>
                                                                            </li>
                                                                        <?php
                                                                        redirectHome(null, $url='courses.php');
                                                                    }
                                                                ?>
                                                            </ul>
                                                        <?php
                                                    }
                                                    else{
                                                        ?>
                                                        <ul class="list-group">
                                                            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                                <div class="d-flex flex-column">
                                                                    <span class="text-danger font-weight-bold ms-sm-2">Sorry, you can't browse this page directly.</span>
                                                                    <?php redirectHome(null,$url='courses.php'); ?>
                                                                </div>
                                                            </li>
                                                        </ul> 
                                                        <?php
                                                    }
                                                    
                                                ?>
                                            </div>
                                            
                                        </div>
                                    <?php
                                }
                                elseif($do == 'Property'){
                                    ?>
                                        <div class="card mb-4">
                                            <div class="card-header pb-0">
                                            <h3>Extra</h3>
                                            <div class="card-body px-0 pt-0 pb-2">
                                                <?php
                                                    if($_SERVER['REQUEST_METHOD'] == 'GET'){
                                                        if(isset($_GET['propertyId']) && is_numeric($_GET['propertyId'])){
                                                            $propertyId = $_GET['propertyId'];
                                                            $check = checkItem('ID', 'courses-properties', $propertyId);

                                                            if($check > 0){
                                                                $toDo = $_GET['toDo'];
                                                                if($toDo == 'Edit'){
                                                                    $stmt = $conn->prepare("SELECT * FROM `courses-properties` WHERE `ID` = ?");
                                                                    $stmt -> execute(array($propertyId));
                                                                    $property = $stmt->fetch(PDO::FETCH_ASSOC);
                                                                    ?>
                                                                        <form class="form-horizontal" action="?do=Property" method="POST">
                                                                            <input type="hidden" name="id" value="<?=$propertyId?>">
                                                                            <!-- Start Arabic Extra Field -->
                                                                            <div class="row form-group  my-5 form-group-lg">
                                                                                <label class="col-sm-2 control-label">Arabic Extra</label>
                                                                                <div class="col-sm-10 col-md-6">
                                                                                    <input type="text" class="form-control" name="extra_ar" value="<?=$property['Value_ar']?>" required="required"/>
                                                                                    
                                                                                </div>
                                                                            </div>
                                                                            <!-- End Arabic Extra Field -->
                                                                            <!-- Start Dutch Extra Field -->
                                                                            <div class="row form-group  my-5 form-group-lg">
                                                                                <label class="col-sm-2 control-label">Dutch Extra</label>
                                                                                <div class="col-sm-10 col-md-6">
                                                                                    <input type="text" class="form-control" name="extra_du" value="<?=$property['Value_du']?>" required="required"/>
                                                                                    
                                                                                </div>
                                                                            </div>
                                                                            <!-- End Dutch Extra Field -->
                                                                            <!-- Start Property Field -->
                                                                            <div class="row form-group  my-5 form-group-lg">
                                                                                <label class="col-sm-2 control-label">Price</label>
                                                                                <div class="col-sm-10 col-md-6">
                                                                                    <input type="number" pattern="[0-9]+" class="form-control" name="price" required="required" value="<?=$property['Price']?>" min="1"/>
                                                                                    
                                                                                </div>
                                                                            </div>
                                                                            <!-- End Property Field -->
                                                                            <!-- Start Submit Field -->
                                                                            <div class="row form-group my-5">
                                                                                <div class="offset-sm-2 col-sm-10">
                                                                                    <input type="submit" class="btn bg-gradient-dark mb-0" value="Edit Extra"/>
                                                                                </div>
                                                                            </div>
                                                                            <!-- End Submit Field -->
                                                                        </form>
                                                                    <?php
                                                                }elseif($toDo == 'Delete'){
                                                                    $stmt = $conn -> prepare("DELETE FROM `courses-properties` WHERE `ID` = '$propertyId'");
                                                                    $stmt -> execute();
                                                                    $count = $stmt -> rowCount();
                                                                    if($count == 1){
                                                                        ?>
                                                                            <ul class="list-group">
                                                                                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                                                        <div class="d-flex flex-column">
                                                                                            <span class="text-dark font-weight-bold ms-sm-2"><?=$count?> Extra successfully deleted.</span>
                                                                                            <?php redirectHome(null,$url='courses.php'); ?>
                                                                                        </div>
                                                                                    </li>
                                                                            </ul> 
                                                                        <?php
                                                                    }else{
                                                                        ?>
                                                                            <ul class="list-group">
                                                                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                                                    <div class="d-flex flex-column">
                                                                                        <span class="text-danger font-weight-bold ms-sm-2">Something went wrong, please try again.</span>
                                                                                        <?php redirectHome(null,$url='courses.php'); ?>
                                                                                    </div>
                                                                                </li>
                                                                            </ul> 
                                                                        <?php
                                                                    }
                                                                }
                                                                
                                                            }else{
                                                                ?>
                                                                    <ul class="list-group">
                                                                        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                                            <div class="d-flex flex-column">
                                                                                <span class="text-danger font-weight-bold ms-sm-2">There's no such an ID.</span>
                                                                                <?php redirectHome(null,$url='courses.php'); ?>
                                                                            </div>
                                                                        </li>
                                                                    </ul> 
                                                                <?php
                                                            }

                                                        }
                                                    }                                                        
                                                    elseif($_SERVER['REQUEST_METHOD'] == 'POST'){
                                                        ?>
                                                            <ul class="list-group">
                                                                <?php
                                                                    $id = $_POST['id'];
                                                                    $extra_ar = $_POST['extra_ar'];
                                                                    $extra_du = $_POST['extra_du'];
                                                                    $price = $_POST['price'];
                                                                    $formErrors = array();
                                                                    if(empty($extra_ar)){$formErrors[]= 'Arabic Extra can\'t be empty.';}
                                                                    if(empty($extra_du)){$formErrors[]= 'Dutch Extra can\'t be empty.';}
                                                                    foreach($formErrors as $error){
                                                                        ?>
                                                                            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                                                <div class="d-flex flex-column">
                                                                                <span class="text-danger font-weight-bold ms-sm-2"><?=$error?></span>
                                                                                </div>
                                                                            </li>
                                                                        <?php
                                                                    }
                                                                    if(empty($formErrors)){
                                                                        $stmt = $conn -> prepare("UPDATE `courses-properties` SET `Value_ar`='$extra_ar', `Value_du`='$extra_du', `Price`='$price' WHERE `ID` = '$id'");
                                                                        $stmt -> execute();
                                                                        $count = $stmt -> rowCount();
                                                                        if($count == 1){
                                                                            ?>
                                                                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                                                    <div class="d-flex flex-column">
                                                                                        <span class="text-dark font-weight-bold ms-sm-2"><?=$count?> Extra successfully updated.</span>
                                                                                    </div>
                                                                                </li>
                                                                            <?php
                                                                            redirectHome(null,$url='courses.php');
                                                                        } 
                                                                        else{
                                                                            ?>
                                                                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                                                    <div class="d-flex flex-column">
                                                                                        <span class="text-danger font-weight-bold ms-sm-2">Something went wrong, please try again.</span>
                                                                                    </div>
                                                                                </li>
                                                                            <?php
                                                                        }
                                                                    }
                                                                ?>
                                                            </ul> 
                                                        <?php
                                                    }
                                                    else{
                                                        ?>
                                                            <ul class="list-group">
                                                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                                    <div class="d-flex flex-column">
                                                                        <span class="text-danger font-weight-bold ms-sm-2">Sorry, you can't browse this page directly.</span>
                                                                        <?php redirectHome(null,$url='courses.php'); ?>
                                                                    </div>
                                                                </li>
                                                            </ul> 
                                                        <?php
                                                    }
                                                        
                                                ?>
                                            </div>
                                            </div>
                                        </div>
                                    <?php
                                }
                                else{
                                    ?>
                                        <div class="card mb-4">
                                            <div class="card-header pb-0">
                                            
                                            <div class="card-body px-0 pt-0 pb-2">
                                                <ul class="list-group">
                                                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                        <div class="d-flex flex-column">
                                                            <span class="text-danger font-weight-bold ms-sm-2">Sorry, Something went wrong.</span>
                                                            <?php redirectHome(null,$url='courses.php'); ?>
                                                        </div>
                                                    </li>
                                                </ul> 
                                                        
                                                
                                            </div>
                                            </div>
                                        </div>
                                    <?php
                                }
                            ?>
                            
                        </div>
                    </div>
                    <!-- Start footer -->
                    <?php include 'includes/templates/footer.php' ?>
                    <!-- End footer -->
                </div>
            </main> 
            <!--   Core JS Files   -->
            <?php include 'includes/templates/footer-script.php' ?>
            
            <script>
                var win = navigator.platform.indexOf('Win') > -1;
                if (win && document.querySelector('#sidenav-scrollbar')) {
                    var options = {
                        damping: '0.5'
                    }
                    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
                }
            </script>
            <!-- Github buttons -->
            <script async defer src="https://buttons.github.io/buttons.js"></script>
            <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
            <script src="assets/js/z2a-dashboard.min.js?v=1.0.6"></script>
            <script>
                $(".propertiesForm").submit(function () {
                    //1 - stop default behavior
                    event.preventDefault();

                    // 2 - get form data
                    

                    var number = $(this).find('input[name="number"]').val();
                    $(this).addClass('d-none');
                    for (var i = number; i > 0; i--) {
                        $(this).next('.propertiesFormAdd').prepend('<!-- Start Arabic Extra Number '+i+' Field --><div class="row form-group  my-5 form-group-lg"><label class="col-sm-2 control-label">Arabic Extra Name Number '+i+'</label><div class="col-sm-10 col-md-6"><input type="text" name="extra_ar'+i+'" class="form-control" required="required" placeholder="Arabic Extra Name"></div></div><!-- End Arabic Extra Number '+i+' Field --><!-- Start Dutch Extra Number '+i+' Field --><div class="row form-group  my-5 form-group-lg"><label class="col-sm-2 control-label">Dutch Extra Name Number '+i+'</label><div class="col-sm-10 col-md-6"><input type="text" name="extra_du'+i+'" class="form-control" required="required" placeholder="Dutch Extra Name"></div></div><!-- End Dutch Extra Number '+i+' Field --><!-- Start Extra Price Number '+i+' Field --><div class="row form-group  my-5 form-group-lg"><label class="col-sm-2 control-label">Number '+i+' Price</label><div class="col-sm-10 col-md-6"><input type="number" min="1" name="extraPrice'+i+'" class="form-control" required="required" placeholder="Extra Price"></div></div><!-- End Extra Price Number '+i+' Field -->');    
                    }
                    $(this).next('.propertiesFormAdd').prepend('<input type="hidden" name="number" class="btn bg-gradient-dark mb-0" value="'+number+'"/>');
                    $(this).next('.propertiesFormAdd').removeClass('d-none');

                });
            </script>
        </body>

        </html>
    <?php  
  }else{
    header('Location:index.php');
  }
  ob_end_flush();
?>
