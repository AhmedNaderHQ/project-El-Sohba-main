<?php
    session_start();
    include '../../databaseconnect.php';
    include '../functions/functions.php';
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $op = $_GET['op'];
        if($op == 'Search'){
            $orderID = $_GET['orderID'];
            $stmt = $conn -> prepare("SELECT * FROM `orders` WHERE `Payment` != 1 AND `Order_ID` LIKE '%$orderID%'");
            $stmt -> execute();
            $orders = $stmt -> fetchAll(PDO::FETCH_ASSOC);
            $count = count($orders);
            if($count > 0){
                
              ?>
                <div class="table-responsive p-0 ordersTable">
                  <table class="table align-items-center mb-0">
                    <thead>
                      <tr>
                        <th class="text-secondary text-xxs font-weight-bolder opacity-7 ps-2">OrderID</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Customer-Name</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Customer-Phone</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Customer-Email</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">location</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Notes</th>
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
                                <a href="<?=$order['LocationLink']?>"><?=$order['Location']?></a>
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
                                <a href="orders.php" class="text-secondary font-weight-bold text-s" data-toggle="tooltip" data-original-title="Edit order">
                                  Edit
                                </a>
                                <br>
                                <a href="orders.php?do=Delete&orderId=<?=$order['ID']?>" class="text-secondary font-weight-bold text-s confirm" data-toggle="tooltip" data-original-title="Delete order">
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
                                    <h3 class="mb-0 text-lg font-weight-bold">There's no such OrderID.</h3>
                                </div>
                            </div>
                        </li>
                    </ul>
                <?php
            }
                
            

        }
        
    }

?>