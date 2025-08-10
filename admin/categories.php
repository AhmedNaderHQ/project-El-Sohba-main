<?php
  ob_start(); //Output buffer start
  session_start();
  $pageTitle = 'Categories'; ;
  $pageIcon = 'category.ico' ;
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
                    
                    ?>  
                      <div class="card mb-4">
                        <?php
                          $stmt = $conn->prepare("SELECT * FROM `categories`");
                          $stmt->execute();
                          $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                          $count = $stmt->rowCount();
                          if($count > 0){
                            ?>
                              <div class="card-header pb-0">
                                <h3>Categories table</h3>
                              </div>
                              <div class="card-body px-0 pt-0 pb-2">
                                <div class="table-responsive p-0">
                                  <table class="table align-items-center justify-content-center mb-0">
                                    <thead>
                                      <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" >Image<span style="font-weight: bold;color: black;">(width:600,height:600)</span></th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Courses Count</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Show-Courses</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Quota</th>
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
                                        
                                        foreach ($categories as $category) {
                                          ?>
                                            <tr>
                                              <td>
                                                <div class="d-flex px-2">
                                                  <div>
                                                    <img src="uploads/images/categories-images/<?=$category['Image']?>" style="width:5rem;height:auto;" class="me-2" alt="<?=$category['Name']?>">
                                                  </div>
                                                </div>
                                              </td>
                                              <td>
                                                <div class="d-flex px-2">
                                                  <div class="my-auto">
                                                    <h6 class="mb-0 text-lg"><?=$category['Name']?></h6>
                                                  </div>
                                                </div>
                                              </td>
                                              <td>
                                                <span class="text-xs font-weight-bold text-center">
                                                  <?php
                                                    $stmt = $conn->prepare("SELECT COUNT(`ID`) AS `count` FROM `items` WHERE `Cat_ID` = ?"); 
                                                    $stmt->execute(array($category['ID'])); 
                                                    $count = $stmt->fetch(PDO::FETCH_ASSOC);
                                                    echo $count['count'];
                                                  ?>
                                                </span>
                                              </td>
                                              <td>
                                                <a href="items.php?catId=<?=$category['ID']?>"><span class="text-xs font-weight-bold text-center">
                                                  <?php
                                                    $stmtTotal = $conn->prepare("SELECT COUNT(`ID`) AS `countTotal` FROM `items` ");
                                                    $stmtTotal->execute(); 
                                                    $countTotal = $stmtTotal->fetch(PDO::FETCH_ASSOC);
                                                    $total = $countTotal['countTotal'];
                                                    if( $total > 0){ 
                                                      $quota = floor($count['count']/$total*100) ;
                                                    }else{
                                                      $quota = 0;
                                                    }
                                                    
                                                  ?>
                                                  <button class="btn btn-outline-primary">Show</button>
                                                </span>
                                              </td>
                                              <td class="align-middle text-center">
                                                <div class="d-flex align-items-center justify-content-center">
                                                  <span class="me-2 text-xs font-weight-bold"><?=$quota?>%</span>
                                                  <div>
                                                    <div class="progress">
                                                      <?php $red = rand(0,255)?>
                                                      <?php $green = rand(0,255)?>
                                                      <?php $blue = rand(0,255)?>
                                                      <div class="progress-bar" role="progressbar" aria-valuenow="<?=$quota?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$quota?>%;  background-color: rgb(<?=$red?>, <?=$green?>, <?=$blue?>) !Important;"></div>
                                                    </div>
                                                  </div>
                                                </div>
                                              </td>
                                              <?php
                                                if($_SESSION['user']['Status'] == 1 ){
                                                  ?>
                                                    <td>
                                                      <p class="text-xs font-weight-bold mb-0">
                                                        <?php
                                                          $stmt = $conn->prepare("SELECT `Name` FROM `users` WHERE `ID` = ? ");
                                                          $stmt->execute(array($category['Admin_ID']));
                                                          $admin = $stmt->fetch(PDO::FETCH_ASSOC);
                                                          echo $admin['Name'];
                                                        
                                                        ?>
                                                      </p>
                                                    </td>
                                                  <?php
                                                }
                                              ?>
                                              <td>
                                                <span class="text-xs font-weight-bold text-center"><?=$category['Add_Date']?></span>
                                              </td>
                                              <td class="align-middle">
                                                <!-- <button class="btn btn-link text-secondary mb-0">
                                                  <i class="fa fa-ellipsis-v text-s"></i>
                                                </button> -->
                                                <a href="?do=Edit&catId=<?=$category['ID']?>" class="text-secondary font-weight-bold text-s" data-toggle="tooltip" data-original-title="Edit category">
                                                  Edit
                                                </a>
                                                <br>
                                                <?php
                                                  if($count['count'] == 0){
                                                    ?>
                                                      <a href="?do=Delete&catId=<?=$category['ID']?>&image=<?=$category['Image']?>" class="text-secondary font-weight-bold text-s confirm" data-toggle="tooltip" data-original-title="Delete category">
                                                        Delete
                                                      </a>
                                                    <?php
                                                  } 
                                                ?>
                                                
                                              </td>
                                              <td>
                                                <div class="dropdown float-lg-end pe-4">
                                                  <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v text-secondary"></i>
                                                  </a>
                                                  <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable">
                                                    <li><a class="dropdown-item border-radius-md" href="?do=AddProperty&catId=<?=$category['ID']?>">Add Extars</a></li>
                                                    <?php
                                                      
                                                      if($category['Sale'] == 0){
                                                        ?>
                                                          <li><a class="dropdown-item border-radius-md" href="?do=AddSale&catId=<?=$category['ID']?>">Add Sale</a></li>
                                                        <?php
                                                      }
                                                      elseif($category['Sale'] == 1){
                                                        ?>
                                                          <li><a class="dropdown-item border-radius-md" href="?do=RemoveSale&catId=<?=$category['ID']?>">Remove Sale</a></li>
                                                        <?php
                                                      } 
                                                    ?>
                                                  </ul>
                                                </div>
                                              </td>
                                            </tr>
                                          <?php
                                        }
                                      ?>
                                    </tbody>
                                  </table>
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
                                      <span class="text-dark font-weight-bold ms-sm-2">There's no categories to show.</span>
                                    </div>
                                  </li>
                                </ul> 
                              </div>
                            <?php
                          }
                        ?>
                        
                      </div>
                      <a href="?do=Add" class="btn bg-gradient-dark mb-0"><i class="fa fa-plus"></i>  Add a new category</a>
                    <?php
                  }
                  elseif($do == 'Add'){
                    ?>
                      <div class="card mb-4">
                        <div class="card-header pb-0">
                          <h3>Add Category</h3>
                          <div class="card-body px-0 pt-0 pb-2">
                            <form class="form-horizontal" action="?do=Insert" method="POST" enctype="multipart/form-data">
                              <!-- Start Name Field -->
                              <div class="row form-group  my-5 form-group-lg">
                                <label class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-10 col-md-6">
                                  <input type="text" class="form-control"  name="name" required="required" placeholder="Name of the new category" />
                                </div>
                              </div>
                              <!-- End Name Field -->
                              <!-- Start Image Field -->
                              <div class="row form-group  my-5 form-group-lg">
                                <label class="col-sm-2 control-label">Image</label>
                                <div class="col-sm-10 col-md-6">
                                  <p style="font-weight: bold;color: black;margin-bottom: 0;">(width:600,height:600)</p>
                                  <input type="file" class="form-control" name="image"  accept=".png, .jpg, .jpeg, .webp, .avif" required="required" />
                                </div>
                              </div>
                              <!-- End Image Field -->
                              <!-- Start Submit Field -->
                              <div class="row form-group my-5">
                                <div class="offset-sm-2 col-sm-10">
                                    <input type="submit" class="btn bg-gradient-dark mb-0" value="Add category"/>
                                </div>
                              </div>
                              <!-- End Submit Field -->
                            </form>
                          </div>
                        </div>
                      </div>
                    <?php
                  }
                  elseif($do == 'Insert'){
                    ?>
                      <div class="card mb-4">
                        <div class="card-header pb-0">
                          <h3>Insert Category</h3>
                          <div class="card-body px-0 pt-0 pb-2">
                          <?php 
                            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                              $name = $_POST['name'];
                              $image = $_FILES['image'];
                              $formErrors = array();
                              $check = checkItem('Name', 'categories', $name);
                            
                              if($check >= 1){$formErrors[] = 'This name is already taken.';}
                              if(empty($name)){$formErrors[] = 'Name must not be empty';}
                              if (strpos($name,'-')) { $formErrors[] = 'Name can\'t have <strong>[ - ]</strong>.' ; }
                              if (strpos($name,'’')) { $formErrors[] = 'Name can\'t have <strong>[ ’ ]</strong>.' ; }
                              if (strpos($name,"'")) { $formErrors[] = 'Name can\'t have <strong>[ \' ]</strong>.' ; }
                              if (strpos($name,'&')) { $formErrors[] = 'Name can\'t have <strong>[ & ]</strong>.' ; }
                              if(empty($image['name'])){$formErrors[] = 'You have to chose an <strong>image</strong>.';}
                              
                            
                              
                              
                              
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
                                        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                          <div class="d-flex flex-column">
                                            <span class="text-danger font-weight-bold ms-sm-2"><?=$error?></span>
                                          </div>
                                        </li>
                                      <?php
                                    }
                                    if(empty($formErrors)){
                                      
                                      $img=rand(0, 10000).'_'.$image['name'];
                                      move_uploaded_file($image['tmp_name'], "uploads/images/categories-images/".$img);
                                      
                                      $stmt = $conn->prepare("INSERT INTO `categories`(`Name`, `Image`, `Add_Date`, `Admin_ID`) VALUES (:zname, :zimg, now(), :zadmin)");
                                      $stmt->execute(array('zname' => $name, 'zimg' => $img, 'zadmin' => $_SESSION['user']['ID']));
                                      $count = $stmt->rowCount();
                                      ?>
                                        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                          <div class="d-flex flex-column">
                                            <span class="text-dark font-weight-bold ms-sm-2"><?=$count?> record inserted successfully.</span>
                                          </div>
                                        </li>
                                      <?php
                                      redirectHome(null, $url='categories.php');
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
                                      <?php redirectHome(null, $url='categories.php'); ?>
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
                          <h3>Edit Category</h3>
                          <div class="card-body px-0 pt-0 pb-2">
                            <?php
                              if(isset($_GET['catId']) && is_numeric($_GET['catId'])){
                                $catId = $_GET['catId'];
                                $check = checkItem('ID', 'categories', $catId);
                                if($check > 0){
                                  $stmt= $conn->prepare("SELECT * FROM `categories` WHERE `ID` = ?");
                                  $stmt->execute(array($catId));
                                  $category = $stmt->fetch(PDO::FETCH_ASSOC);
                                  ?>
                                    <form class="form-horizontal" action="?do=Update" method="POST" enctype="multipart/form-data">
                                      <input type="hidden" name="id" value="<?=$catId?>">
                                      <!-- Start Name Field -->
                                      <div class="row form-group  my-5 form-group-lg">
                                        <label class="col-sm-2 control-label">Name</label>
                                        <div class="col-sm-10 col-md-6">
                                          <input type="text" class="form-control" name="name" required="required" placeholder="Name of the new category" value="<?=$category['Name']?>"/>
                                        </div>
                                      </div>
                                      <!-- End Name Field -->
                                      <!-- Start Image Field -->
                                      <div class="row form-group  my-5 form-group-lg">
                                        <label class="col-sm-2 control-label">Image</label>
                                        <div class="col-sm-10 col-md-6">
                                        <p style="font-weight: bold;color: black;margin-bottom: 0;">(width:600,height:600)</p>
                                          <input type="hidden" name="oldImage" value="<?=$category['Image']?>">
                                          <input type="file" class="form-control" name="image" accept=".png, .jpg, .jpeg, .webp, .avif" />
                                          <span style="color:#253134;">Leave blank if you do not want it to be changed.</span>
                                        </div>
                                      </div>
                                      <!-- End Image Field -->
                                      <!-- Start Submit Field -->
                                      <div class="row form-group my-5">
                                        <div class="offset-sm-2 col-sm-10">
                                            <input type="submit" class="btn bg-gradient-dark mb-0" value="Update category"/>
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
                                          <?php redirectHome(null,$url='categories.php'); ?>
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
                                        <?php redirectHome(null,$url='categories.php'); ?>
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
                          <h3>Update Category</h3>
                          <div class="card-body px-0 pt-0 pb-2">
                            <?php
                              if($_SERVER['REQUEST_METHOD'] == 'POST'){

                                $id = $_POST['id'];
                                $name = $_POST['name'];
                                $formErrors = array();
                               
                                if(empty($name)){$formErrors[] = 'Name must not be empty';}
                                if (checkItemEdit('Name', 'categories', $name, 'ID', $id) > 0) { $formErrors[] = 'This name is already taken.' ; }
                                if (strpos($name,'-')) { $formErrors[] = 'Name can\'t have <strong>[ - ]</strong>.' ; }
                                if (strpos($name,'’')) { $formErrors[] = 'Name can\'t have <strong>[ ’ ]</strong>.' ; }
                                if (strpos($name,"'")) { $formErrors[] = 'Name can\'t have <strong>[ \' ]</strong>.' ; }
                                if (strpos($name,'&')) { $formErrors[] = 'Name can\'t have <strong>[ & ]</strong>.' ; }
                                if(! empty($_FILES['image']['name'])){
                                  
                                    
                                  $AllowedImgExt = array('png', 'jpg', 'jpeg', 'webp', 'avif');
                                  $img_name_array = explode('.', $_FILES['image']['name']);
                                  $ImgActExt = strtolower(end($img_name_array));
                                  if(! in_array($ImgActExt, $AllowedImgExt)){$formErrors[] = 'The  image extension is <strong>Not Allowed</strong>.';}
                                  if($_FILES['image']['size'] > 4194304){$formErrors[] = 'The image can\'t exceed <strong>4MB</strong>.';}
                                  
                                  if(empty($formErrors)){
                                    
                                    
                                    $path = "uploads/images/categories-images/" ;
                                    unlink($path.$_POST['oldImage']);
                                    $img =rand(0, 10000).'_'.$_FILES['image']['name'];
                                    move_uploaded_file($_FILES['image']['tmp_name'], "uploads/images/categories-images//".$img);
                                    
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
                                    
                                        $stmt = $conn->prepare("UPDATE `categories` SET `Name` = ?, `Image` = ? WHERE `ID` = ?");
                                        $stmt->execute(array($name, $img, $id));
                                        $count = $stmt->rowCount();
                                        ?>
                                          <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                            <div class="d-flex flex-column">
                                              <span class="text-dark font-weight-bold ms-sm-2"><?=$count?> record updated successfully.</span>
                                            </div>
                                          </li>
                                        <?php
                                        redirectHome(null, $url='categories.php');
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
                                        <?php redirectHome(null,$url='categories.php'); ?>
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
                          <h3>Delete Category</h3>
                          <div class="card-body px-0 pt-0 pb-2">
                            <?php
                              if(isset($_GET['catId']) && is_numeric($_GET['catId'])){
                                $catId = $_GET['catId'];
                                $check = checkItem('ID', 'categories', $catId);

                                if($check > 0){
                                  $stmt= $conn->prepare("DELETE FROM `categories-properties` WHERE `Category_ID` = ?");
                                  $stmt-> execute(array($catId));
                                  $stmt= $conn->prepare("SELECT * FROM `categories` WHERE `ID` = ?");
                                  $stmt->execute(array($catId));
                                  $category = $stmt->fetch(PDO::FETCH_ASSOC);

                                  $deleted_images = 0;
                                  
                                  if(isset($_GET['image']) && ($_GET['image'] == $category['Image'] )){
                                    $deleted_images++;
                                  }else{
                                    ?>
                                      <ul class="list-group">
                                        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                          <div class="d-flex flex-column">
                                            <span class="text-danger font-weight-bold ms-sm-2">Sorry, something went wrong, please try again.</span>
                                            <?php redirectHome(null, $url='categories.php'); ?>
                                          </div>
                                        </li>
                                      </ul> 
                                    <?php
                                  }
                                
                                  
                                  if($deleted_images == 1){

                                    
                                    $path = "uploads/images/categories-images//";
                                    unlink($path.$_GET['image']);
                                    

                                    $stmt = $conn->prepare("DELETE FROM `categories` WHERE `ID` = ?");
                                    $stmt->execute(array($catId));
                                    $count = $stmt->rowCount();
                                    if ($count > 0){
                                      ?>
                                        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                          <div class="d-flex flex-column">
                                            <span class="text-dark font-weight-bold ms-sm-2"><?=$count?> record deleted successfully.</span>
                                          </div>
                                        </li>
                                      <?php
                                      redirectHome(null, $url='categories.php');
                                    }else{
                                      ?>
                                        <ul class="list-group">
                                          <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                            <div class="d-flex flex-column">
                                              <span class="text-danger font-weight-bold ms-sm-2">Sorry, something went wrong, please try again.</span>
                                              <?php redirectHome(null,$url='categories.php'); ?>
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
                                          <?php redirectHome(null,$url='categories.php'); ?>
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
                                        <?php redirectHome(null,$url='categories.php'); ?>
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
                  elseif($do == 'AddSale'){
                    ?>
                      <div class="card mb-4">
                        <div class="card-header pb-0">
                          <h3>Add Sale</h3>
                          <div class="card-body px-0 pt-0 pb-2">
                            <?php
                              if($_SERVER['REQUEST_METHOD'] == 'GET'){
                                if(isset($_GET['catId']) && is_numeric($_GET['catId'])){
                                  $catId = $_GET['catId'];
                                  $check = checkItem('ID', 'categories', $catId);

                                  if($check > 0){
                        
                                    ?>
                                        
                                      <form class="form-horizontal" action="?do=AddSale" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="catId" value="<?=$catId?>">
                                        
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
                                            <?php redirectHome(null,$url='categories.php'); ?>
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
                                          <?php redirectHome(null,$url='categories.php'); ?>
                                        </div>
                                      </li>
                                    </ul> 
                                  <?php
                                }
                              }
                              elseif($_SERVER['REQUEST_METHOD'] == 'POST'){
                                $id = $_POST['catId'];
                                $value = $_POST['value'];

                                $formErrors = array();
                                $check = checkItem('ID', 'categories', $id);
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
                                        $stmt = $conn -> prepare("UPDATE `categories` SET `Sale` = 1, `SaleValue` = ? WHERE `ID` = ?");
                                        $stmt -> execute(array($value, $id));
                                        $count = $stmt->rowCount();
                                        ?>
                                          <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                            <div class="d-flex flex-column">
                                              <span class="text-dark font-weight-bold ms-sm-2">Sale added successfully.</span>
                                            </div>
                                          </li>
                                        <?php
                                        redirectHome(null, $url='categories.php');
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
                                        <?php redirectHome(null,$url='categories.php'); ?>
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
                                  if(isset($_GET['catId']) && is_numeric($_GET['catId'])){
                                    $catId = $_GET['catId'];
                                    $check = checkItem('ID', 'categories', $catId);

                                    if($check > 0){
                            
                                      ?>
                                        <ul class="list-group">
                                          <?php
                                              
                                            $stmt = $conn -> prepare("UPDATE `categories` SET `Sale` = 0, `SaleValue` = NULL WHERE `ID` = ?");
                                            $stmt -> execute(array($catId));
                                            $count = $stmt->rowCount();
                                            ?>
                                              <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                <div class="d-flex flex-column">
                                                  <span class="text-dark font-weight-bold ms-sm-2">Sale removed successfully.</span>
                                                </div>
                                              </li>
                                            <?php
                                            redirectHome(null, $url='categories.php');
                                              
                                          ?>
                                        </ul>
                                          
                                      <?php
                                    }else{
                                      ?>
                                        <ul class="list-group">
                                          <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                            <div class="d-flex flex-column">
                                              <span class="text-danger font-weight-bold ms-sm-2">There's no such an ID.</span>
                                              <?php redirectHome(null,$url='categories.php'); ?>
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
                                            <?php redirectHome(null,$url='categories.php'); ?>
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
                                        <span class="text-danger font-weight-bold ms-sm-2">Sorry, you can't browse this page directly.</span>
                                        <?php redirectHome(null,$url='categories.php'); ?>
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
                                if(isset($_GET['catId']) && is_numeric($_GET['catId'])){
                                  $catId = $_GET['catId'];
                                  $check = checkItem('ID', 'categories', $catId);

                                  if($check > 0){
                          
                                    ?>
                                      <form  class="form-horizontal propertiesForm">
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
                                      <form class="form-horizontal propertiesFormAdd d-none" action="?do=AddProperty" method="POST">
                                                                          
                                        <input type="hidden" name="catId" value="<?=$catId?>">
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
                                            <?php redirectHome(null,$url='categories.php'); ?>
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
                                          <?php redirectHome(null, $url='categories.php'); ?>
                                        </div>
                                      </li>
                                    </ul> 
                                  <?php
                                }
                              }
                              elseif($_SERVER['REQUEST_METHOD'] == 'POST'){
                                $id = $_POST['catId'];
                                $number = $_POST['number'];
                                $check = checkItem('ID', 'categories', $id);
                                ?>
                                  <ul class="list-group">
                                    <?php
                                      if($check == 1){
                                        $count = 0;
                                        for($i = 1; $i <= $number; $i++){
                                          
                                          $extra_ar = $_POST['extra_ar'.$i];
                                          $extra_du = $_POST['extra_du'.$i];
                                          $price = $_POST['extraPrice'.$i];
                                          $stmt = $conn -> prepare("INSERT INTO `categories-properties`(`Property`, `Value_ar`, `Value_du`, `Price`,`Category_ID`) VALUES ('Extra', :zvalue_ar, :zvalue_du, :zprice, :zcat)");
                                          $stmt -> execute(array('zvalue_ar' => $extra_ar, 'zvalue_du' => $extra_du, 'zprice' => $price, 'zcat' => $id));
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
                                          redirectHome(null, $url='categories.php');
                                        }else{
                                          ?>
                                            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                              <div class="d-flex flex-column">
                                                <span class="text-danger font-weight-bold ms-sm-2">something went wrong, please try again.</span>
                                              </div>
                                            </li>
                                          <?php
                                          redirectHome(null, $url='categories.php');
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
                                        redirectHome(null, $url='categories.php');
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
                                        <?php redirectHome(null,$url='categories.php'); ?>
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
                                  $check = checkItem('ID', 'categories-properties', $propertyId);

                                  if($check > 0){
                                    $toDo = $_GET['toDo'];
                                    if($toDo == 'Edit'){
                                      $stmt = $conn->prepare("SELECT * FROM `categories-properties` WHERE `ID` = ?");
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
                                      $stmt = $conn -> prepare("DELETE FROM `categories-properties` WHERE `ID` = '$propertyId'");
                                      $stmt -> execute();
                                      $count = $stmt -> rowCount();
                                      if($count == 1){
                                        ?>
                                          <ul class="list-group">
                                            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                              <div class="d-flex flex-column">
                                                <span class="text-dark font-weight-bold ms-sm-2"><?=$count?> Extra successfully deleted.</span>
                                                <?php redirectHome(null,$url='categories.php'); ?>
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
                                                <?php redirectHome(null,$url='categories.php'); ?>
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
                                            <?php redirectHome(null,$url='categories.php'); ?>
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
                                        $stmt = $conn -> prepare("UPDATE `categories-properties` SET `Value_ar`='$extra_ar', `Value_du`='$extra_du', `Price`='$price' WHERE `ID` = '$id'");
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
                                          redirectHome(null,$url='categories.php');
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
                                        <?php redirectHome(null,$url='categories.php'); ?>
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
                                <?php redirectHome(null,$url='categories.php'); ?>
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
