<?php
  ob_start(); //Output buffer start
  session_start();
  $pageTitle = 'Customers'; ;
  $pageIcon = 'customersicon' ;
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
                    if($do == 'Manage'){
                      
                      ?> 
                        <div class="card mb-4">
                          <?php
                            $onePageItems = 5;
                            $stmt = $conn->prepare("SELECT COUNT(`ID`) AS `COUNT` FROM `customers` WHERE `VerificationStatus` = 1");
                            $stmt->execute();
                            $customersNum = $stmt->fetch(PDO::FETCH_ASSOC);
                            $pagesNum = ceil($customersNum['COUNT']/$onePageItems);
                            $pageNum = (isset($_GET['pageNum'])) ? $_GET['pageNum'] : 1 ;
                            if($pageNum > $pagesNum-1 && $pagesNum != 0){ $pageNum = $pagesNum; }
                            $num = ($pageNum - 1)*$onePageItems ;
                            $stmt = $conn->prepare("SELECT * FROM `customers` WHERE `VerificationStatus` = 1 LIMIT $onePageItems  OFFSET $num");
                            $stmt->execute();
                            $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            $count = $stmt->rowCount();
                            if($count > 0){
                              ?>
                                <div class="card-header pb-0">
                                  <h3>Customers table</h3>
                                  <div class="ms-md-auto pe-md-3 d-flex align-items-start float-end">
                                    <div class="input-group" style="width:auto;">
                                      <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                                      <input type="text" class="form-control usernameSearch" placeholder="Search by Username...">
                                    </div>
                                  </div>
                                </div>
                                <div class="card-body px-0 pt-0 pb-2">
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
                                    <hr style="border: solid 1px #888;">
                                    <div class="text-center">
                                      <div class="paginationItem">
                                        <?php
                                          ?>
                                            <a href="?pageNum=<?=$pageNum-1?>" class="<?php if($pageNum == 1) {echo 'disabled';}?>">&laquo;</a>
                                          <?php
                                          for ($i=1; $i <= $pagesNum ; $i++) { 
                                            ?>
                                              <a href="?pageNum=<?=$i?>" class="<?php if($pageNum == $i){echo 'active';} ?>"><?=$i?></a>
                                            <?php
                                          }
                                          ?>
                                            <a href="?pageNum=<?=$pageNum+1?>" class="<?php if($pageNum == $pagesNum) {echo 'disabled';}?>">&raquo;</a>
                                          <?php
                                        ?>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              <?php
                            }else{
                              ?>
                                <div class="card-body px-0 pt-2 pb-2">
                                  <ul class="list-group">
                                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                      <div class="d-flex flex-column">
                                        <span class="text-dark font-weight-bold ms-sm-2">There's no customers to show.</span>
                                      </div>
                                    </li>
                                  </ul> 
                                </div>
                              <?php
                            }
                          ?>
                          
                        </div>
                        <a href="?do=Add" class="btn bg-gradient-dark mb-0"><i class="fa fa-plus"></i> Add a new customer</a>
                      <?php
                    }
                    elseif($do == 'Add'){
                      ?>
                        <div class="card mb-4">
                          <div class="card-header pb-0">
                            <h3>Add Customer</h3>
                            <div class="card-body px-0 pt-0 pb-2">                   
                              <form class="form-horizontal" action="?do=Insert" method="POST">
                                <!-- Start Name Field -->
                                <div class="row form-group  my-5 form-group-lg">
                                  <label class="col-sm-2 control-label">Name</label>
                                  <div class="col-sm-10 col-md-6">
                                    <input type="text" class="form-control" name="name" required="required" placeholder="Name of the new customer" />
                                  </div>
                                </div>
                                <!-- End Name Field -->
                                <!-- Start Username Field -->
                                <div class="row form-group  my-5 form-group-lg">
                                  <label class="col-sm-2 control-label">Username</label>
                                  <div class="col-sm-10 col-md-6">
                                    <input type="text" class="form-control" name="username" required="required" placeholder="Username of the new customer" />
                                  </div>
                                </div>
                                <!-- End Username Field -->
                                <!-- Start Password Field -->
                                <div class="row form-group  my-5 form-group-lg">
                                  <label class="col-sm-2 control-label">Password</label>
                                  <div class="col-sm-10 col-md-6">
                                    <input type="password" class="form-control" name="password" required="required" placeholder="Password of the new customer" />
                                  </div>
                                </div>
                                <!-- End Password Field -->
                                <!-- Start Email Field -->
                                <div class="row form-group  my-5 form-group-lg">
                                  <label class="col-sm-2 control-label">Email</label>
                                  <div class="col-sm-10 col-md-6">
                                    <input type="text" class="form-control" name="email" required="required" placeholder="Email of the new customer" />
                                  </div>
                                </div>
                                <!-- End Email Field -->
                                <!-- Start Phone Field -->
                                <div class="row form-group  my-5 form-group-lg">
                                  <label class="col-sm-2 control-label">Phone</label>
                                  <div class="col-sm-10 col-md-6">
                                    <input type="text" class="form-control" name="phone" required="required" placeholder="Phone of the new customer" />
                                  </div>
                                </div>
                                <!-- End Phone Field -->
                                <!-- Start Street Field -->
                                <div class="row form-group  my-5 form-group-lg">
                                  <label class="col-sm-2 control-label">Street</label>
                                  <div class="col-sm-10 col-md-6">
                                    <input type="text" class="form-control" name="street" required="required" placeholder="Street of the new customer" />
                                  </div>
                                </div>
                                <!-- End Street Field -->
                                <!-- Start ZipCode Field -->
                                <div class="row form-group  my-5 form-group-lg">
                                  <label class="col-sm-2 control-label">ZipCode</label>
                                  <div class="col-sm-10 col-md-6">
                                    <input type="text" class="form-control" name="zipCode" required="required" placeholder="ZipCode of the new customer" />
                                  </div>
                                </div>
                                <!-- End ZipCode Field -->
                                <!-- Start Submit Field -->
                                <div class="row form-group my-5">
                                  <div class="offset-sm-2 col-sm-10">
                                    <input type="submit" class="btn bg-gradient-dark mb-0" value="Add customer"/>
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
                            <h3>Insert Customer</h3>
                            <div class="card-body px-0 pt-0 pb-2">
                              <?php
                                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                                  
                                  $name = $_POST['name'];
                                  $username = $_POST['username'];
                                  $password = $_POST['password'];
                                  $email = $_POST['email'];
                                  $phone = $_POST['phone'];
                                  $street = $_POST['street'];
                                  $zipCode = $_POST['zipCode'];
                                  
                                  $hashPassword = sha1($password);

                                  
                                  
                                  // Validate The Form.
                                  $formErrors = array();
                                  if (empty($username)) { $formErrors[] = 'Username can\'t Be <strong>Empty</strong>.' ; }
                                  if (checkItem('Username', 'customers', $username) > 0) { $formErrors[] = 'This username is already taken.' ; }
                                  if (checkItem('Email', 'customers', $email) > 0) { $formErrors[] = 'This email is already taken.' ; }
                                  if (empty($password)) { $formErrors[] = 'Password can\'t Be <strong>Empty</strong>.' ; }
                                  if (! empty($username) && strlen($username) < 4) { $formErrors[] = 'Username can\'t Be Less Than <strong>4 Characters</strong>.' ; }
                                  if (! empty($username) && strlen($username) > 20) { $formErrors[] = 'Username can\'t Be More Than <strong>20 Characters</strong>.' ; }
                                  if (empty($name)) { $formErrors[] = 'Name can\'t Be <strong>Empty</strong>.' ; }
                                  if (empty($email)) { $formErrors[] = 'Email can\'t Be <strong>Empty</strong>.' ; }
                                  if (empty($phone)) { $formErrors[] = 'Phone can\'t Be <strong>Empty</strong>.' ; }
                                  if (empty($street)) { $formErrors[] = 'Street can\'t Be <strong>Empty</strong>.' ; }
                                  if (empty($zipCode)) { $formErrors[] = 'ZipCode can\'t Be <strong>Empty</strong>.' ; }
                                  
                                  // if( empty($imageName)) { $formErrors[] = 'You have to upload an <strong>Image</strong>.' ; }
                                  // if( ! empty($imageName) && $imageSize > 4194304 ) { $formErrors[] = 'Image size can\'t exceed<strong>4MB</strong>.' ; }
                                  // if(! empty($imageName) && ! in_array($imageExt, $AllowedImageExt)) { $formErrors[] = 'This extension is <strong>Not Allowed</strong>.' ; }
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
                                      ?>
                                      <?php 
                                        if(empty($formErrors)){
                                          
                                          $stmt = $conn->prepare("INSERT INTO `customers`( `Username`, `Password`, `Name`, `Email`, `Phone`, `Street`, `ZipCode`, `VerificationStatus`) VALUES (:zusername, :zpassword, :zname, :zemail, :zphone, :zstreet, :zzip, 1)");
                                          $stmt->execute(array('zname' => $name, 'zemail' => $email, 'zusername' => $username, 'zpassword' => $hashPassword, 'zphone' => $phone, 'zstreet' => $street, 'zzip' => $zipCode));
                                          $count = $stmt->rowCount();
                                          if($count > 0){
                                            ?>
                                              <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                <div class="d-flex flex-column">
                                                  <span class="text-dark font-weight-bold ms-sm-2"><?=$count?> Record inserted successfully.</span>
                                                </div>
                                              </li>
                                            <?php
                                          }
                                          redirectHome(null,$url='customers.php');
                                        
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
                                          <?php redirectHome(null, $url='customers.php'); ?>
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
                    elseif($do == 'Edit'){
                      ?>
                        <div class="card mb-4">
                          <div class="card-header pb-0">
                            <h3>Edit Customer</h3>
                            <?php
                              if(isset($_GET['customerId']) && is_numeric($_GET['customerId'])){
                                $customerId = $_GET['customerId'];
                                $check = checkItem('ID', 'customers', $customerId);
                                if($check > 0){
                                  $stmt= $conn->prepare("SELECT * FROM `customers` WHERE `ID` = ?");
                                  $stmt->execute(array($customerId));
                                  $user = $stmt->fetch(PDO::FETCH_ASSOC);
                                  ?>
                                    <form class="form-horizontal" action="?do=Update" method="POST">
                                      <!-- Start Name Field -->
                                      <input type="hidden" name="id" value="<?=$customerId?>">
                                      <div class="row form-group  my-5 form-group-lg">
                                        <label class="col-sm-2 control-label">Name</label>
                                        <div class="col-sm-10 col-md-6">
                                          <input type="text" class="form-control" name="name" required="required" placeholder="Name of the member" value="<?=$user['Name']?>" />
                                        </div>
                                      </div>
                                      <!-- End Name Field -->
                                      <!-- Start Username Field -->
                                      <div class="row form-group  my-5 form-group-lg">
                                        <label class="col-sm-2 control-label">Username</label>
                                        <div class="col-sm-10 col-md-6">
                                          <input type="text" class="form-control" name="username" required="required" placeholder="Username of the  member" value="<?=$user['Username']?>" />
                                        </div>
                                      </div>
                                      <!-- End Username Field -->
                                      <!-- Start Password Field -->
                                      <div class="row form-group  my-5 form-group-lg">
                                        <label class="col-sm-2 control-label">Password</label>
                                        <div class="col-sm-10 col-md-6">
                                          <input type="hidden" name="oldpassword" value="<?=$user['Password']?>">
                                          <input type="password" class="form-control" name="newpassword" placeholder="Password of the member" />
                                          <span style="color:#253134;">Leave blank if you do not want it to be changed.</span>
                                        </div>
                                      </div>
                                      <!-- End Password Field -->
                                      <!-- Start Email Field -->
                                      <div class="row form-group  my-5 form-group-lg">
                                        <label class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-10 col-md-6">
                                          <input type="text" class="form-control" name="email" required="required" placeholder="Email of the new member" value="<?=$user['Email']?>" />
                                        </div>
                                      </div>
                                      <!-- End Email Field -->
                                      <!-- Start Phone Field -->
                                      <div class="row form-group  my-5 form-group-lg">
                                        <label class="col-sm-2 control-label">Phone</label>
                                        <div class="col-sm-10 col-md-6">
                                          <input type="text" class="form-control" name="phone" required="required" placeholder="Phone of the new member" value="<?=$user['Phone']?>"/>
                                        </div>
                                      </div>
                                      <!-- End Phone Field -->
                                      <!-- Start Street Field -->
                                      <div class="row form-group  my-5 form-group-lg">
                                        <label class="col-sm-2 control-label">Street</label>
                                        <div class="col-sm-10 col-md-6">
                                          <input type="text" class="form-control" name="street" required="required" placeholder="Street of the new member" value="<?=$user['Street']?>"/>
                                        </div>
                                      </div>
                                      <!-- End Street Field -->
                                      <!-- Start ZipCode Field -->
                                      <div class="row form-group  my-5 form-group-lg">
                                        <label class="col-sm-2 control-label">ZipCode</label>
                                        <div class="col-sm-10 col-md-6">
                                          <input type="text" class="form-control" name="zipCode" required="required" placeholder="ZipCode of the new member" value="<?=$user['ZipCode']?>"/>
                                        </div>
                                      </div>
                                      <!-- End ZipCode Field -->
                                      <!-- Start Submit Field -->
                                      <div class="row form-group my-5">
                                        <div class="offset-sm-2 col-sm-10">
                                            <input type="submit" class="btn bg-gradient-dark mb-0" value="Update customer"/>
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
                                          <?php redirectHome(null,$url='customers.php'); ?>
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
                                        <?php redirectHome(null,$url='customers.php'); ?>
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
                    elseif($do == 'Update'){
                      ?>
                        <div class="card mb-4">
                          <div class="card-header pb-0">
                            <h3>Update Customer</h3>
                            <div class="card-body px-0 pt-0 pb-2">
                              <?php
                                if($_SERVER['REQUEST_METHOD']=='POST'){
                                  
                                  $id = $_POST['id'];
                                  $name = $_POST['name'];
                                  $username = $_POST['username'];
                                  
                                  if(! empty($_POST['newpassword'])){
                                    $password = $_POST['newpassword'];
                                    $hashPassword = sha1($password);
                                  }else{
                                    $hashPassword = $_POST['oldpassword'];
                                  }

                                  $email = $_POST['email'];
                                  $phone = $_POST['phone'];
                                  $street = $_POST['street'];
                                  $zipCode = $_POST['zipCode'];
                                      
                                  

                                  // Validate The Form.
                                  $formErrors = array();
                                  if (checkItemEdit('Username', 'customers', $username, 'ID', $id) > 0) { $formErrors[] = 'This username is already taken.' ; } 
                                  if (checkItemEdit('Email', 'customers', $email, 'ID', $id) > 0) { $formErrors[] = 'This email is already taken.' ; } 
                                  if (empty($username)) { $formErrors[] = 'Username can\'t Be <strong>Empty</strong>.' ; }
                                  if (empty($hashPassword)) { $formErrors[] = 'Password can\'t Be <strong>Empty</strong>.' ; }
                                  if (! empty($username) && strlen($username) < 4) { $formErrors[] = 'Username can\'t Be Less Than <strong>4 Characters</strong>.' ; }
                                  if (! empty($username) && strlen($username) > 20) { $formErrors[] = 'Username can\'t Be More Than <strong>20 Characters</strong>.' ; }
                                  if (empty($name)) { $formErrors[] = 'Name can\'t Be <strong>Empty</strong>.' ; }
                                  if (empty($email)) { $formErrors[] = 'Email can\'t Be <strong>Empty</strong>.' ; }
                                  if (empty($phone)) { $formErrors[] = 'Phone can\'t Be <strong>Empty</strong>.' ; }
                                  if (empty($street)) { $formErrors[] = 'Street can\'t Be <strong>Empty</strong>.' ; }
                                  if (empty($zipCode)) { $formErrors[] = 'ZipCode can\'t Be <strong>Empty</strong>.' ; }
                                      
                                  ?>
                                    
                                    <ul class="list-group">
                                      <?php if(! empty($formErrors)){echo '<h4 class="mb-3 text-sm">Form errors</h4>';} ?>
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
                                      ?>
                                      <?php 
                                        if(empty($formErrors)){
                                          $stmt = $conn->prepare("UPDATE `customers` SET `Name` = ? , `Username` = ?, `Password` = ?, `Email` = ? , `Phone` = ?, `Street` = ?, `ZipCode` = ? WHERE `ID` = ?");
                                          $stmt->execute(array($name, $username, $hashPassword, $email, $phone, $street, $zipCode, $id));
                                          $count = $stmt->rowCount();
                                          if($count > 0){
                                            ?>
                                              <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                <div class="d-flex flex-column">
                                                  <span class="text-dark font-weight-bold ms-sm-2"><?=$count?> Record updated successfully.</span>
                                                </div>
                                              </li>
                                            <?php
                                          }
                                          redirectHome(null,$url='customers.php');
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
                                          <?php redirectHome(null,$url='customers.php'); ?>
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
                            <h3>Delete Customer</h3>
                            <?php
                              if(isset($_GET['customerId']) && is_numeric($_GET['customerId'])){
                                $customerId = $_GET['customerId'];
                                $check = checkItem('ID', 'customers', $customerId) ;
                                if($check > 0){
                                  $stmt = $conn->prepare("DELETE FROM `customers` WHERE `ID` = ? ");
                                  $stmt->execute(array($customerId));
                                  $count = $stmt->rowCount();
                                  if($count > 0){
                                    ?>
                                      <ul class="list-group">
                                        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                          <div class="d-flex flex-column">
                                            <span class="text-dark font-weight-bold ms-sm-2"><?=$count?> Record successfully deleted.</span>
                                            <?php redirectHome(null,$url='customers.php'); ?>
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
                                          <span class="text-danger font-weight-bold ms-sm-2">There's no such an ID.</span>
                                          <?php redirectHome(null,$url='customers.php'); ?>
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
                                        <?php redirectHome(null,$url='customers.php'); ?>
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
                    else{
                      ?>
                        <div class="card mb-4">
                          <div class="card-header pb-0">
                          
                          <div class="card-body px-0 pt-0 pb-2">
                            <ul class="list-group">
                              <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                <div class="d-flex flex-column">
                                  <span class="text-danger font-weight-bold ms-sm-2">Sorry, Something went wrong.</span>
                                  <?php redirectHome(null,$url='customers.php'); ?>
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
        </body>

      </html>
    <?php  
  }else{
    header('Location:index.php');
  }
  ob_end_flush();
?>
