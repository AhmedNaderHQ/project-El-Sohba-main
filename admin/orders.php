<?php
  ob_start(); //Output buffer start
  session_start();
  $pageTitle = 'Orders'; ;
  $pageIcon = 'ordersicon.ico' ;
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
                          $stmt = $conn->prepare("SELECT COUNT(`ID`) AS `COUNT` FROM `orders` WHERE `Payment` != 1 ");
                          $stmt->execute();
                          $ordersNum = $stmt->fetch(PDO::FETCH_ASSOC);
                          $pagesNum = ceil($ordersNum['COUNT']/$onePageItems);
                          $pageNum = (isset($_GET['pageNum'])) ? $_GET['pageNum'] : 1 ;
                          if($pageNum > $pagesNum-1 && $pagesNum != 0){ $pageNum = $pagesNum; }
                          $num = ($pageNum - 1)*$onePageItems ;
                          $stmt = $conn->prepare("SELECT * FROM `orders` WHERE `Payment` != 1 LIMIT $onePageItems  OFFSET $num");
                          $stmt->execute();
                          $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
                          $count = $stmt->rowCount();
                          if($count > 0){
                            ?>
                              <div class="card-header pb-0">
                                <h3>Orders table</h3>
                                <div class="ms-md-auto pe-md-3 d-flex align-items-start float-end">
                                  <div class="input-group" style="width:auto;">
                                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control OrderIDSearch" placeholder="Search by OrderID...">
                                  </div>
                                </div>
                              </div>
                              <div class="card-body px-0 pt-0 pb-2">
                                <div class="table-responsive p-0 ordersTable">
                                  <table class="table align-items-center mb-0">
                                    <thead>
                                      <tr>
                                        <th class="text-secondary text-xxs font-weight-bolder opacity-7 ps-2">OrderID</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Customer-Name</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Customer-Phone</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Customer-Email</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Notes</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">location</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Order</th>  
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Price</th>  
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Payment</th>  
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>  
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Adding-Date</th>
                                        <th class="text-secondary opacity-7 ps-2">Status-Actions</th>   
                                        <th class="text-secondary opacity-7 ps-2">Actions</th>   
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        foreach ($orders as $order){
                                          ?>
                                            <tr>
                                              <td>
                                                <p class="text-xs font-weight-bold mb-0 "><?=$order['Order_ID']?></p>
                                              </td>
                                              <td>
                                                <div class="d-flex px-2 py-1">
                                                  <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm"><?=$order['Customer_Name']?></h6>
                                                  </div>
                                                </div>
                                              </td>
                                              <td>
                                                <p class="text-xs font-weight-bold mb-0"><?=$order['Customer_Phone']?></p>
                                              </td>
                                              <td>
                                                <p class="text-xs font-weight-bold mb-0"><?=$order['Customer_Email']?></p>
                                              </td>
                                              <td>
                                                <?php 
                                                  if(!empty($order['Notes'])){
                                                    ?>
                                                      <button type="button" class="btn btn-primary me-2 mt-2" data-bs-toggle="modal" data-bs-target="#viewOrder<?=$order['ID']?>notes">
                                                        <i class="fa-solid fa-sticky-note"></i>
                                                      </button>
                                                    <?php
                                                  }else{
                                                    echo 'no notes';
                                                  }
                                                ?>
                                              </td>
                                              <?php
                                                if(!empty($order['Notes'])){
                                                  ?>
                                                    <div class="modal fade" id="viewOrder<?=$order['ID']?>notes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Order Notes</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                          <div class="modal-body">
                                                            <?=$order['Notes']?>
                                                          </div>
                                                          <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>    
                                                  <?php
                                                }
                                              ?>
                                              <td>
                                                <a href="<?=$order['LocationLink']?>"><?=$order['Location']?></a>
                                              </td>
                                              <td>
                                                <button type="button" class="btn btn-primary me-2 mt-2" data-bs-toggle="modal" data-bs-target="#viewOrder<?=$order['ID']?>">
                                                  <i class="fa fa-circle-info"></i>
                                                </button>
                                                <div class="modal fade" id="viewOrder<?=$order['ID']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Order Details</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                      </div>
                                                      <div class="modal-body">
                                                        
                                                        <p class="mb-2">Order id: <span class="text-primary"><?=$order['Order_ID']?></span></p>
                                                        <?php 
                                                          if($order['CouponValue'] != 0){
                                                            ?>
                                                              <span>Coupon Value = - <?=$order['CouponValue']?>%</span>
                                                            <?php
                                                          }
                                                        ?>
                                                        <?php
                                                        $itemsOrder = json_decode($order['OrderInfo']);
                                                          if(count($itemsOrder) > 0){
                                                            ?>
                                                              <div class="table-responsive">
                                                                <table class="table align-middle table-nowrap">
                                                                  <thead>
                                                                    <tr>
                                                                      <th scope="col">Product</th>
                                                                      <th scope="col">EXTRAs</th>
                                                                      <th scope="col">Type</th>
                                                                      <th scope="col">Quantity</th>
                                                                      <th scope="col">Price</th>
                                                                      <th scope="col">Total</th>
                                                                    </tr>
                                                                  </thead>
                                                                  <tbody>
                                                                    <?php
                                                                      foreach ($itemsOrder as $item) {
                                                                        ?>
                                                                          <tr>
                                                                            <th>
                                                                              <div style="width: 106px;">
                                                                                <img src="<?= $item->image ?>" alt="img-blur-shadow" style="width: 100%; ">
                                                                              </div>
                                                                              <div class="d-flex flex-column justify-content-center">
                                                                                <h6 class="mb-0 text-sm"><?= $item->name ?></h6>
                                                                              </div>
                                                                            </th>
                                                                            <td>
                                                                              <?php
                                                                                $totalExtrasCount = 0;
                                                                                $totalExtrasPrice = 0;
                                                                                  foreach($item->extras as $extra){
                                                                                    $totalExtrasCount += $extra->count;
                                                                                    $totalExtrasPrice += $extra->count* $extra->price;
                                                                                  }
                                                                                if($totalExtrasCount > 0){
                                                                                  ?>
                                                                                    <table class="table align-middle table-border">
                                                                                      <thead>
                                                                                        <tr>
                                                                                          <th scope="col">Extra</th>
                                                                                          <th scope="col">Quantity</th>
                                                                                          <th scope="col">Price</th>
                                                                                          <th scope="col">Total</th>
                                                                                        </tr>
                                                                                      </thead>
                                                                                      <tbody>
                                                                                        <?php
                                                                                          foreach ($item->extras as $extra) {
                                                                                            if($extra->count > 0){
                                                                                              ?>
                                                                                                <tr>
                                                                                                  <th>
                                                                                                    <div class="d-flex flex-column justify-content-center">
                                                                                                      <h6 class="mb-0 text-sm">
                                                                                                        <?= $extra->name ?>
                                                                                                      </h6>
                                                                                                    </div>
                                                                                                  </th>
                                                                                                  <td class="text-center">
                                                                                                    <?= $extra->count ?>
                                                                                                  </td>
                                                                                                  <td class="text-center">
                                                                                                    <?= $extra->count ?>
                                                                                                  </td>
                                                                                                  <td class="text-center">
                                                                                                    <?= $extra->count * $extra->price ?>
                                                                                                  </td>
                                                                                
                                                                                                </tr>
                                                                                              <?php
                                                                                            }  
                                                                                          }
                                                                                        ?>
                                                                                      </tbody>
                                                                                    </table>
                                                                                  <?php
                                                                                }else{
                                                                                  echo 'none';
                                                                                }
                                                                              ?>
                                                                            </td>
                                                                            <td class="text-center">
                                                                              <?php
                                                                                $itemType = getSpecificRecord('Type', 'items', "WHERE `ID` = '$item->id'"); 
                                                                                if($itemType['Type'] == 1){
                                                                                  echo 'Healthy';
                                                                                }elseif($itemType['Type'] == 0){
                                                                                  echo 'Unhealthy';
                                                                                }                      
                                                                              ?>
                                                                            </td>
                                                                            <td class="text-center">
                                                                              <?= $item->count ?>
                                                                            </td>
                                                                            <td class="text-center">
                                                                              <?=$item->price?>
                                                                            </td>
                                                                            <td class="text-center">
                                                                              <?= ($item->count* $item->price) + $totalExtrasPrice ?>
                                                                            </td>    
                                                                            
                                                                          </tr>
                                                                        <?php
                                                                      }

                                                                      echo '<pre>';
                                                                      // print_r($itemsOrder);
                                                                      echo '</pre>';
                                                                    ?>
                                                                    <tr>
                                                                      <td colspan="2">
                                                                        <h6 class="m-0 text-right">Total:</h6>
                                                                      </td>
                                                                      <td>
                                                                        
                                                                        <?php
                                                                          if($order['CouponValue'] != 0){
                                                                            ?>
                                                                              
                                                                              <span style="text-decoration:line-through;"><?=ceil($order['Price']/(1-($order['CouponValue']/100)))?></span>
                                                                              <br>
                                                                               <?=$order['Price']?>
                                                                            <?php
                                                                          }else{
                                                                            ?>
                                                                               <?=$order['Price']?>
                                                                            <?php
                                                                          }
                                                                        ?>
                                                                      </td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </div>
                                                            <?php
                                                          }
                                                        ?>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                              </td>
                                              <td>
                                                <?=$order['Price']?>
                                              </td>
                                              <td>
                                                <?php
                                                  if($order['Payment'] == 2){
                                                    ?>
                                                      <span class="badge badge-sm bg-gradient-warning">Upon Receive</span>
                                                    <?php
                                                  }
                                                  elseif($order['Payment'] == 3){
                                                    ?>
                                                      <span class="badge badge-sm bg-gradient-success">Paid Online</span>
                                                    <?php
                                                  }
                                                ?>
                                              </td>

                                              <td>
                                                <?php
                                                  if($order['Status'] == 0){
                                                    ?>
                                                      <span class="badge badge-sm bg-gradient-warning">Preparing</span>
                                                    <?php
                                                  }
                                                  elseif($order['Status'] == 1){
                                                    ?>
                                                      <span class="badge badge-sm bg-gradient-success">Delivered</span>
                                                    <?php
                                                  }
                                                  elseif($order['Status'] == 2){
                                                    ?>
                                                      <span class="badge badge-sm bg-gradient-danger">Canceled</span>
                                                    <?php
                                                  }
                                                ?>
                                              </td>
                                              <td class="align-middle ">
                                                <span class="text-secondary text-xs font-weight-bold"><?=$order['Adding-Date']?></span>
                                              </td>
                                              <td>
                                                <?php
                                                  if($order['Status'] == 0){
                                                    ?>
                                                      <a href="?do=Deliver&orderId=<?=$order['ID']?>" class="text-secondary font-weight-bold text-s" data-toggle="tooltip" data-original-title="Edit order">
                                                        Deliver
                                                      </a>
                                                      <br>
                                                      <a href="?do=Cancel&orderId=<?=$order['ID']?>" class="text-secondary font-weight-bold text-s confirm" data-toggle="tooltip" data-original-title="Delete order">
                                                        Cancel
                                                      </a>
                                                    <?php
                                                  }else{
                                                    echo 'No-Actions';
                                                  }
                                                ?>
                                              </td>
                                              <td class="align-middle">
                                                <a href="?do=Edit&orderId=<?=$order['ID']?>" class="text-secondary font-weight-bold text-s" data-toggle="tooltip" data-original-title="Edit order">
                                                  Edit
                                                </a>
                                                <br>
                                                <a href="?do=Delete&orderId=<?=$order['ID']?>" class="text-secondary font-weight-bold text-s confirm" data-toggle="tooltip" data-original-title="Delete order">
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
                                      <span class="text-dark font-weight-bold ms-sm-2">There's no orders to show.</span>
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
                  elseif($do == 'Edit'){
                    ?>
                      <div class="card mb-4">
                        <div class="card-header pb-0">
                          <h3>Edit Order</h3>
                          <?php
                            if(isset($_GET['orderId']) && is_numeric($_GET['orderId'])){
                              $orderId = $_GET['orderId'];
                              $check = checkItem('ID', 'orders', $orderId);
                              if($check > 0){
                                $stmt= $conn->prepare("SELECT * FROM `orders` WHERE `ID` = ?");
                                $stmt->execute(array($orderId));
                                $order = $stmt->fetch(PDO::FETCH_ASSOC);
                                ?>
                                  <form class="form-horizontal" action="?do=Update" method="POST" enctype="multipart/form-data">
                                    <!-- Start Customer Name Field -->
                                    <input type="hidden" name="id" value="<?=$order['ID']?>">
                                    <div class="row form-group my-5 form-group-lg">
                                      <label class="col-sm-2 control-label">Customer Name</label>
                                      <div class="col-sm-10 col-md-6">
                                        <input type="text" class="form-control" name="customer_name" required="required" placeholder="Name of the customer"  value="<?=$order['Customer_Name']?>"/>
                                      </div>
                                    </div>
                                    <!-- End Customer Name Field -->
                                    <!-- Start Customer Phone Field -->
                                    <div class="row form-group  my-5 form-group-lg">
                                      <label class="col-sm-2 control-label">Customer Phone</label>
                                      <div class="col-sm-10 col-md-6">
                                        <input type="text" class="form-control" name="customer_phone" required="required" placeholder="Phone of the customer" value="<?=$order['Customer_Phone']?>"/>
                                      </div>
                                    </div>
                                    <!-- End Customer Phone Field -->
                                    <!-- Start Customer Email Field -->
                                    <div class="row form-group  my-5 form-group-lg">
                                      <label class="col-sm-2 control-label">Customer Email</label>
                                      <div class="col-sm-10 col-md-6">
                                        <input type="email" class="form-control" name="customer_email" required="required" placeholder="Email of the customer" value="<?=$order['Customer_Email']?>"/>
                                      </div>
                                    </div>
                                    <!-- End Customer Email Field -->
                                    <!-- Start Location Field -->
                                    <div class="row form-group  my-5 form-group-lg">
                                      <label class="col-sm-2 control-label">Location</label>
                                      <div class="col-sm-10 col-md-6">
                                        <textarea class="form-control" name="location" placeholder="Location of the new order"><?=$order['Location']?></textarea>
                                      </div>
                                    </div>
                                    <!-- End Location Field -->
                                    <!-- Start LocationLink Field -->
                                    <div class="row form-group  my-5 form-group-lg">
                                      <label class="col-sm-2 control-label">Location Link</label>
                                      <div class="col-sm-10 col-md-6">
                                        <textarea class="form-control" name="locationLink" placeholder="LocationLink of the new order"><?=$order['LocationLink']?></textarea>
                                      </div>
                                    </div>
                                    <!-- End LocationLink Field -->
                                    <!-- Start Submit Field -->
                                    <div class="row form-group my-5">
                                      <div class="offset-sm-2 col-sm-10">
                                        <input type="submit" class="btn bg-gradient-dark mb-0" value="Update Order"/>
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
                                        <?php redirectHome(null,$url='orders.php'); ?>
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
                                      <?php redirectHome(null,$url='orders.php'); ?>
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
                          <h3>Update Order</h3>
                          <div class="card-body px-0 pt-0 pb-2">
                            <?php
                              if($_SERVER['REQUEST_METHOD']=='POST'){
                                $id = $_POST['id'];
                                $customer_name = $_POST['customer_name'];
                                $customer_email = $_POST['customer_email'];
                                $customer_phone = $_POST['customer_phone'];
                                $location = $_POST['location'];
                                $locationLink = $_POST['locationLink'];
                                $formErrors = array();

                                
                                if(empty($customer_name)){$formErrors[] = '<strong>Customer Name</strong> must not be empty.';}
                                if(empty($customer_email)){$formErrors[] = '<strong>Customer Email</strong> must not be empty.';}
                                if(empty($customer_phone)){$formErrors[] = '<strong>Customer Phone</strong> must not be empty.';}
                                if(empty($location)){$formErrors[] = '<strong>Location</strong> must not be empty.';}
                                if(empty($locationLink)){$formErrors[] = '<strong>Location Link</strong> must not be empty.';}
                                
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
                                        $stmt = $conn -> prepare("UPDATE `orders` SET `LocationLink`= '$locationLink', `Location` = '$location', `Customer_Name` = '$customer_name',`Customer_Phone` = '$customer_phone', `Customer_Email` = '$customer_email' WHERE `ID`= '$id'");
                                        $stmt -> execute();
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
                                        redirectHome(null,$url='orders.php');
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
                                        <?php redirectHome(null,$url='orders.php'); ?>
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
                          <h3>Delete Order</h3>
                          <?php
                            if(isset($_GET['orderId']) && is_numeric($_GET['orderId'])){
                              $orderId = $_GET['orderId'];
                              $check = checkItem('ID', 'orders', $orderId) ;
                              if($check > 0){
                                
                                $stmt = $conn->prepare("DELETE FROM `orders` WHERE `ID` = ? ");
                                $stmt->execute(array($orderId));
                                $count = $stmt->rowCount();
                                if($count > 0){
                                  
                                  ?>
                                    <ul class="list-group">
                                      <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                        <div class="d-flex flex-column">
                                          <span class="text-dark font-weight-bold ms-sm-2"><?=$count?> Record successfully deleted.</span>
                                          <?php redirectHome(null,$url='orders.php'); ?>
                                        </div>
                                      </li>
                                    </ul> 
                                  <?php
                                }
                                else{
                                  ?>
                                    <ul class="list-group">
                                      <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                        <div class="d-flex flex-column">
                                          <span class="text-danger font-weight-bold ms-sm-2">Something went wrong, Please try again.</span>
                                          <?php redirectHome(null,$url='orders.php'); ?>
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
                                        <?php redirectHome(null,$url='orders.php'); ?>
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
                                      <?php redirectHome(null,$url='orders.php'); ?>
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
                  elseif($do == 'Deliver'){
                    ?>
                      <div class="card mb-4">
                        <div class="card-header pb-0">
                          <h3>Deliver Order</h3>
                          <?php
                            if(isset($_GET['orderId']) && is_numeric($_GET['orderId'])){
                              $orderId = $_GET['orderId'];
                              $check = checkItem('ID', 'orders', $orderId) ;
                              if($check > 0){
                                
                            
                                $stmt = $conn->prepare("UPDATE `orders` SET `Status` = 1 WHERE `ID` = ? ");
                                $stmt->execute(array($orderId));
                                $count = $stmt->rowCount();
                                if($count > 0){  
                                  ?>
                                    <ul class="list-group">
                                      <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                        <div class="d-flex flex-column">
                                          <span class="text-dark font-weight-bold ms-sm-2"><?=$count?> Record successfully delivered.</span>
                                          <?php redirectHome(null,$url='orders.php'); ?>
                                        </div>
                                      </li>
                                    </ul> 
                                  <?php
                                }
                                else{
                                  ?>
                                    <ul class="list-group">
                                      <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                        <div class="d-flex flex-column">
                                          <span class="text-danger font-weight-bold ms-sm-2">Something went wrong, Please try again.</span>
                                          <?php redirectHome(null,$url='orders.php'); ?>
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
                                        <?php redirectHome(null,$url='orders.php'); ?>
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
                                      <?php redirectHome(null,$url='orders.php'); ?>
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
                  elseif($do == 'Cancel'){
                    ?>
                      <div class="card mb-4">
                        <div class="card-header pb-0">
                          <h3>Cancel Order</h3>
                          <?php
                            if(isset($_GET['orderId']) && is_numeric($_GET['orderId'])){
                              $orderId = $_GET['orderId'];
                              $check = checkItem('ID', 'orders', $orderId) ;
                              if($check > 0){
                                
                            
                                $stmt = $conn->prepare("UPDATE `orders` SET `Status` = 2 WHERE `ID` = ? ");
                                $stmt->execute(array($orderId));
                                $count = $stmt->rowCount();
                                if($count > 0){  
                                  ?>
                                    <ul class="list-group">
                                      <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                        <div class="d-flex flex-column">
                                          <span class="text-dark font-weight-bold ms-sm-2"><?=$count?> Record successfully delivered.</span>
                                          <?php redirectHome(null,$url='orders.php'); ?>
                                        </div>
                                      </li>
                                    </ul> 
                                  <?php
                                }
                                else{
                                  ?>
                                    <ul class="list-group">
                                      <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                        <div class="d-flex flex-column">
                                          <span class="text-danger font-weight-bold ms-sm-2">Something went wrong, Please try again.</span>
                                          <?php redirectHome(null,$url='orders.php'); ?>
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
                                        <?php redirectHome(null,$url='orders.php'); ?>
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
                                      <?php redirectHome(null,$url='orders.php'); ?>
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
                  elseif($do == 'EditItem'){
                    ?>
                      <div class="card mb-4">
                        <div class="card-header pb-0">
                          <h3>Edit Order</h3>
                          <?php
                            if(isset($_GET['itemId']) && is_numeric($_GET['itemId'])){
                              $itemId = $_GET['itemId'];
                              $check = checkItem('ID', 'orders-items', $itemId);
                              if($check > 0){
                                #itemOrder info
                                $stmt = $conn -> prepare("SELECT * FROM `orders-items` WHERE `ID` = ?");
                                $stmt -> execute(array($itemId));
                                $itemOrder = $stmt -> fetch(PDO::FETCH_ASSOC);


                                #item info
                                $stmt = $conn -> prepare("SELECT * FROM `items` WHERE `ID` = ?");
                                $stmt -> execute(array($itemOrder['Item_ID']));
                                $item = $stmt -> fetch(PDO::FETCH_ASSOC);

                                if($itemOrder['Model'] != null){
                                  
                                  #item category properties info
                                  $stmt = $conn -> prepare("SELECT * FROM `categories-properties` WHERE `Property` = 'Model' AND `Category_ID` = ?");
                                  $stmt -> execute(array($item['Cat_ID']));
                                  $models = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                                }

                                if($itemOrder['Color'] != null){
                                  #item color properties info
                                  $stmt = $conn -> prepare("SELECT * FROM `items-properties` WHERE `Property` = 'Color' AND `Item_ID` = ?");
                                  $stmt -> execute(array($item['ID']));
                                  $colors = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                                }
                                if($itemOrder['Size'] != null){
                                  #item size properties info
                                  $stmt = $conn -> prepare("SELECT * FROM `items-properties` WHERE `Property` = 'Size' AND `Item_ID` = ?");
                                  $stmt -> execute(array($item['ID']));
                                  $sizes = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                                }
                                ?>
                                  <form class="form-horizontal" action="?do=UpdateItem" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?=$itemOrder['ID']?>">
                                    <?php
                                      if($itemOrder['Model'] != null && count($models) > 0){
                                        ?>
                                           <!-- Start Model Field -->
                                            <div class="row form-group  my-5 form-group-lg">
                                              <label class="col-sm-2 control-label">Model</label>
                                              <div class="col-sm-10 col-md-6">
                                                <select name="model" class="form-control" required="required">
                                                  <?php
                                                    foreach ($models as $model) {
                                                      ?>
                                                        <option class="form-control" <?php if($itemOrder['Model'] == $model['Value'].'-'.$model['Price']){echo 'selected';} ?> value="<?=$model['Value']?>-<?=$model['Price']?>"><?=$model['Value']?></option>
                                                      <?php
                                                    }
                                                  ?>
                                                </select>
                                              </div>
                                            </div>
                                            <!-- Start Model Field -->
                                        <?php
                                      }
                                    ?>
                                    <?php
                                      if($itemOrder['Color'] != null && count($colors) > 0){
                                        ?>
                                           <!-- Start Color Field -->
                                            <div class="row form-group  my-5 form-group-lg">
                                              <label class="col-sm-2 control-label">Color</label>
                                              <div class="col-sm-10 col-md-6">
                                                <select name="color" class="form-control" required="required"> 
                                                  <?php
                                                    foreach ($colors as $color) {
                                                      ?>
                                                        <option class="form-control" <?php if($itemOrder['Color'] == $color['Value']){echo 'selected';} ?> value="<?=$color['Value']?>"><?=$color['Value']?></option>
                                                      <?php
                                                    }
                                                  ?>
                                                </select>
                                              </div>
                                            </div>
                                            <!-- Start Color Field -->
                                        <?php
                                      }
                                    ?>
                                    <?php
                                      if($itemOrder['Size'] != null && count($sizes) > 0){
                                        ?>
                                           <!-- Start Size Field -->
                                            <div class="row form-group  my-5 form-group-lg">
                                              <label class="col-sm-2 control-label">Size</label>
                                              <div class="col-sm-10 col-md-6">
                                                <select name="size" class="form-control" required="required">
                                                  <?php
                                                    foreach ($sizes as $size) {
                                                      ?>
                                                        <option class="form-control" <?php if($itemOrder['Size'] == $size['Value']){echo 'selected';} ?> value="<?=$size['Value']?>"><?=$size['Value']?></option>
                                                      <?php
                                                    }
                                                  ?>
                                                </select>
                                              </div>
                                            </div>
                                            <!-- Start Size Field -->
                                        <?php
                                      }
                                    ?>
                                    <!-- Start Count Field -->
                                    <div class="row form-group  my-5 form-group-lg">
                                      <label class="col-sm-2 control-label">Count</label>
                                      <div class="col-sm-10 col-md-6">
                                        <input type="number" class="form-control" min="1" name="count" required="required" placeholder="Count of the item" value="<?=$itemOrder['Count']?>"/>
                                      </div>
                                    </div>
                                    <!-- End Count Field -->
                                    <!-- Start Submit Field -->
                                    <div class="row form-group my-5">
                                      <div class="offset-sm-2 col-sm-10">
                                        <input type="submit" class="btn bg-gradient-dark mb-0" value="Update Item"/>
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
                                        <?php redirectHome(null,$url='orders.php'); ?>
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
                                      <?php redirectHome(null,$url='orders.php'); ?>
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
                  elseif($do == 'UpdateItem'){
                    ?>
                      <div class="card mb-4">
                        <div class="card-header pb-0">
                          <h3>Update Order</h3>
                          <div class="card-body px-0 pt-0 pb-2">
                           <?php
                              if($_SERVER['REQUEST_METHOD']=='POST'){
                                $id = $_POST['id'];
                                $stmt = $conn -> prepare("SELECT * FROM `orders-items` WHERE `ID` = '$id'");
                                $stmt -> execute();
                                $itemInfo = $stmt -> fetch(PDO::FETCH_ASSOC);
                                $model = (isset($_POST['model'])) ? $_POST['model'] : null;
                                $color = (isset($_POST['color'])) ? $_POST['color'] : null;
                                $size = (isset($_POST['size'])) ? $_POST['size'] : null;
                                $count = $_POST['count'];
                                $formErrors = array();

                                if(empty($model) && $model != null){$formErrors[] = 'You have to choose a <strong>model</strong>.';}
                                if(empty($color) && $color != null){$formErrors[] = 'You have to choose a <strong>color</strong>.';}
                                if(empty($size) && $size != null){$formErrors[] = 'You have to choose a <strong>size</strong>.';}
                                if(empty($count) && $count != 0){$formErrors[] = '<strong>Count</strong> must not be empty.';}
                                
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
                                        // print_r($itemInfo);
                                        if($count != $itemInfo['Count']){
                                          if($model != $itemInfo['Model']){
                                            $piecePrice = ceil($itemInfo['ItemPrice'] - ($itemInfo['ItemPrice']*$itemInfo['SaleValue']/100)) + explode('-',$model)[1];
                                          }
                                          else{
                                            $piecePrice = ceil($itemInfo['ItemPrice'] - ($itemInfo['ItemPrice']*$itemInfo['SaleValue']/100)) + explode('-',$itemInfo['Model'])[1];
                                          }
                                          $total = ceil($piecePrice * $count);
                                        }
                                        else{
                                          if($model != $itemInfo['Model']){
                                            $piecePrice = ceil($itemInfo['ItemPrice'] - ($itemInfo['ItemPrice']*$itemInfo['SaleValue']/100)) + explode('-',$model)[1];
                                          }
                                          else{
                                            $piecePrice = ceil($itemInfo['ItemPrice'] - ($itemInfo['ItemPrice']*$itemInfo['SaleValue']/100)) + explode('-',$itemInfo['Model'])[1];
                                          }
                                          $total = ceil($piecePrice * $count);
                                        }
                                        // echo $total;
                                        $stmt = $conn -> prepare("UPDATE `orders-items` SET `Model` = '$model', `Color` = '$color', `Size` = '$size', `Count` = '$count', `Total` = '$total' WHERE `ID` = '$id'");
                                        $stmt -> execute();
                                        if(($stmt -> rowCount()) == 1){
                                          // echo 'update order';
                                          $stmt = $conn -> prepare("SELECT `Price`, `CouponValue` FROM `orders` WHERE `ID` = ?");
                                          $stmt -> execute(array($itemInfo['Order_ID']));
                                          $orderInfo = $stmt ->fetch(PDO::FETCH_ASSOC);
                                          // print_r($orderInfo);
                                          
                                          // echo 'update order';
                                          $orderPrice = ceil($orderInfo['Price']/(1-($orderInfo['CouponValue']/100))) - $itemInfo['Total'] + $total;
                                          $price = ceil($orderPrice*(1-($orderInfo['CouponValue']/100)));
                                          // echo '<br>'. $price;
                                          $stmt = $conn -> prepare("UPDATE `orders` SET `Price`= ? WHERE `ID` = ?");
                                          $stmt -> execute(array($price, $itemInfo['Order_ID']));
                                          if( ($stmt -> rowCount()) == 1){
                                            // echo 'update order';
                                            ?>
                                              <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                                <div class="d-flex flex-column">
                                                  <span class="text-dark font-weight-bold ms-sm-2"><?=($stmt -> rowCount())?> Record updated successfully.</span>
                                                </div>
                                              </li>
                                            <?php
                                          }
                                        }
                                        redirectHome(null,$url='orders.php');
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
                                        <?php redirectHome(null,$url='orders.php'); ?>
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
                  elseif($do == 'DeleteItem'){
                    ?>
                      <div class="card mb-4">
                        <div class="card-header pb-0">
                          <h3>Delete Order</h3>
                          <?php
                            if(isset($_GET['itemId']) && is_numeric($_GET['itemId'])){
                              $itemId = $_GET['itemId'];
                              $check = checkItem('ID', 'orders-items', $itemId) ;
                              if($check > 0){
                                
                                $stmt = $conn->prepare("SELECT `Total`, `Order_ID` FROM `orders-items` WHERE `ID` = ? ");
                                $stmt -> execute(array($itemId));
                                $itemInfo = $stmt -> fetch(PDO::FETCH_ASSOC);
                                $stmt = $conn -> prepare("SELECT COUNT(`ID`)  FROM `orders-items` WHERE `Order_ID` = ? AND `ID` != ? ");
                                $stmt -> execute(array($itemInfo['Order_ID'], $itemId));
                                $countItems = $stmt -> fetch(PDO::FETCH_ASSOC);
                                if($countItems['COUNT(`ID`)'] > 0){
                                  $stmt = $conn->prepare("SELECT `Price`, `CouponValue` FROM `orders` WHERE `ID` = ? ");
                                  $stmt -> execute(array($itemInfo['Order_ID']));
                                  $orderInfo = $stmt -> fetch(PDO::FETCH_ASSOC);
                                  $newOrderPrice = ceil((ceil($orderInfo['Price']/(1-($orderInfo['CouponValue']/100))) - $itemInfo['Total'])*(1-($orderInfo['CouponValue']/100)));
                                  $stmt = $conn->prepare("DELETE FROM `orders-items` WHERE `ID` = ? ");
                                  $stmt->execute(array($itemId));
                                  $count = $stmt->rowCount();
                                  if($count > 0){
                                    $stmt = $conn -> prepare("UPDATE `orders` SET `Price`='$newOrderPrice' WHERE `ID`= ?");
                                    $stmt -> execute(array($itemInfo['Order_ID']));
                                  }
                                }else{
                                  $stmt = $conn-> prepare("DELETE FROM `orders-items` WHERE `ID` = ? ");
                                  $stmt -> execute(array($itemId));
                                  $count = $stmt->rowCount();
                                  if($count > 0){
                                    $stmt = $conn-> prepare("DELETE FROM `orders` WHERE `ID` = ? ");
                                    $stmt -> execute(array($itemInfo['Order_ID']));
                                  }
                                }
                                if($count > 0){
                                  ?>
                                    <ul class="list-group">
                                      <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                        <div class="d-flex flex-column">
                                          <span class="text-dark font-weight-bold ms-sm-2"><?=$count?> Record successfully deleted.</span>
                                          <?php redirectHome(null,$url='orders.php'); ?>
                                        </div>
                                      </li>
                                    </ul> 
                                  <?php
                                }
                                else{
                                  ?>
                                    <ul class="list-group">
                                      <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                        <div class="d-flex flex-column">
                                          <span class="text-danger font-weight-bold ms-sm-2">Something went wrong, Please try again.</span>
                                          <?php redirectHome(null,$url='orders.php'); ?>
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
                                        <?php redirectHome(null,$url='orders.php'); ?>
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
                                      <?php redirectHome(null,$url='orders.php'); ?>
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
                                <?php redirectHome(null,$url='orders.php'); ?>
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
          
        </script>
      </body>

      </html>
    <?php  
  }else{
    header('Location:index.php');
  }
  ob_end_flush();
?>  