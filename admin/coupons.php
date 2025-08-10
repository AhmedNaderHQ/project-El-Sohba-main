<?php
  ob_start(); //Output buffer start
  session_start();
  $pageTitle = 'Coupons'; ;
  $pageIcon = 'coupon.ico' ;
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
                          $stmt = $conn->prepare("SELECT * FROM `coupons`");
                          $stmt->execute();
                          $coupons = $stmt->fetchAll(PDO::FETCH_ASSOC);
                          $count = $stmt->rowCount();
                          if($count > 0){
                            ?>
                              <div class="card-header pb-0">
                                <h3>Coupons table</h3>
                              </div>
                              <div class="card-body px-0 pt-0 pb-2">
                                <div class="table-responsive p-0">
                                  <table class="table align-items-center justify-content-center mb-0">
                                    <thead>
                                      <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Coupon</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Description</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Value</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Limit</th>
                                        <?php
                                          if($_SESSION['user']['Status'] == 1 ){
                                            ?>
                                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Added-By</th>
                                            <?php
                                          }
                                        ?>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Adding-Date</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        
                                        foreach ($coupons as $coupon) {
                                          ?>
                                            <tr>
                                              <td>
                                                <div class="d-flex px-2">
                                                  <div class="my-auto">
                                                    <h6 class="mb-0 text-lg"><?=$coupon['Coupon']?></h6>
                                                  </div>
                                                </div>
                                              </td>
                                              
                                              <td>
                                                <span class="text-xs font-weight-bold text-center">
                                                  <?=$coupon['Description']?>
                                                </span>
                                              </td>
                                              <td class="align-middle text-center">
                                                <span class="text-xs font-weight-bold text-center">
                                                  <?=$coupon['Value']?>
                                                </span>
                                              </td>
                                              <td class="align-middle text-center">
                                                <span class="text-xs font-weight-bold text-center">
                                                  <?=$coupon['Limit']?>
                                                </span>
                                              </td>
                                              <?php
                                                if($_SESSION['user']['Status'] == 1 ){
                                                  ?>
                                                    <td>
                                                      <p class="text-xs font-weight-bold mb-0">
                                                        <?php
                                                          $stmt = $conn->prepare("SELECT `Name` FROM `users` WHERE `ID` = ? ");
                                                          $stmt->execute(array($coupon['Admin_ID']));
                                                          $admin = $stmt->fetch(PDO::FETCH_ASSOC);
                                                          echo $admin['Name'];
                                                        
                                                        ?>
                                                      </p>
                                                    </td>
                                                  <?php
                                                }
                                              ?>
                                              <td>
                                                <span class="text-xs font-weight-bold text-center"><?=$coupon['Adding-Date']?></span>
                                              </td>
                                              
                                              <td class="align-middle">
                                                <!-- <button class="btn btn-link text-secondary mb-0">
                                                  <i class="fa fa-ellipsis-v text-s"></i>
                                                </button> -->
                                                <a href="?do=Edit&copId=<?=$coupon['ID']?>" class="text-secondary font-weight-bold text-s" data-toggle="tooltip" data-original-title="Edit coupon">
                                                  Edit
                                                </a>
                                                <br>
                                                <a href="?do=Delete&copId=<?=$coupon['ID']?>" class="text-secondary font-weight-bold text-s confirm" data-toggle="tooltip" data-original-title="Delete coupon">
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
                              </div>
                            <?php
                          }
                          else{
                            ?>
                              <div class="card-body px-0 pt-2 pb-2">
                                  <ul class="list-group">
                                      <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                          <div class="d-flex flex-column">
                                              <span class="text-dark font-weight-bold ms-sm-2">There's no coupons to show.</span>
                                          </div>
                                      </li>
                                  </ul> 
                              </div>
                            <?php
                          }
                        ?>
                        
                      </div>
                      <a href="?do=Add" class="btn bg-gradient-dark mb-0"><i class="fa fa-plus"></i>  Generate a new coupon</a>
                    <?php
                  }
                  elseif($do == 'Add'){
                    ?>
                      <div class="card mb-4">
                        <div class="card-header pb-0">
                          <h3>Add Coupon</h3>
                          <div class="card-body px-0 pt-0 pb-2">
                            <form class="form-horizontal" action="?do=Insert" method="POST" >
                              <!-- Start Description Field -->
                              <div class="row form-group  my-5 form-group-lg">
                                <label class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-10 col-md-6">
                                  <textarea type="text" class="form-control" name="description" placeholder="Description of the new coupon" /></textarea>
                                </div>
                              </div>
                              <!-- End Description Field -->
                              <!-- Start Value Field -->
                              <div class="row form-group  my-5 form-group-lg">
                                <label class="col-sm-2 control-label">Value</label>
                                <div class="col-sm-10 col-md-6">
                                  <input type="number"  min="1" max="100" class="form-control" name="value" required="required" placeholder="Value of the new coupon" />
                                </div>
                              </div>
                              <!-- End Value Field -->
                              <!-- Start Limit Field -->
                              <div class="row form-group  my-5 form-group-lg">
                                <label class="col-sm-2 control-label">Limit</label>
                                <div class="col-sm-10 col-md-6">
                                  <input type="number" class="form-control" min="1" name="limit" required="required" placeholder="Limit of the new coupon" />
                                </div>
                              </div>
                              <!-- End Limit Field -->
                              <!-- Start Submit Field -->
                              <div class="row form-group my-5">
                                <div class="offset-sm-2 col-sm-10">
                                  <input type="submit" class="btn bg-gradient-dark mb-0" value="Add coupon"/>
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
                          <h3>Insert Coupon</h3>

                          <div class="card-body px-0 pt-0 pb-2">
                          <?php 
                            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                              
                              $description = $_POST['description'];
                              $value = $_POST['value'];
                              $limit = $_POST['limit'];
                              $formErrors = array();
                              // if(empty($name)){$formErrors[] = 'Name must not be empty.';}
                              // if(checkItem('Coupon', 'coupons', $name) == 1){$formErrors[] = 'This name is already taken.';}
                              if(empty($limit)){$formErrors[] = 'Limit must not be empty.';}
                              if(empty($value)){$formErrors[] = 'Value must not be equal to zero.';}
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

                                      $coupon = strtoupper(generateRandomString(8));
                                      $stmt = $conn->prepare("INSERT INTO `coupons` (`Coupon`, `Description`, `Value`, `Limit`, `Admin_ID`) VALUES (:zname, :zdesc, :zvalue, :zlimit, :zadmin);");
                                      $stmt->execute(array('zname' => $coupon, 'zdesc' => $description, 'zvalue' => $value, 'zlimit' => $limit, 'zadmin' => $_SESSION['user']['ID']));
                                      $count = $stmt->rowCount();
                                      ?>
                                        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                          <div class="d-flex flex-column">
                                            <span class="text-dark font-weight-bold ms-sm-2"><?=$count?> record inserted successfully.</span>
                                          </div>
                                        </li>
                                      <?php
                                      redirectHome(null, $url='coupons.php');
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
                                      <?php redirectHome(null, $url='coupons.php'); ?>
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
                          <h3>Edit Coupon</h3>
                          <div class="card-body px-0 pt-0 pb-2">
                            <?php
                              if(isset($_GET['copId']) && is_numeric($_GET['copId'])){
                                $copId = $_GET['copId'];
                                $check = checkItem('ID', 'coupons', $copId);
                                if($check > 0){
                                  $stmt= $conn->prepare("SELECT * FROM `coupons` WHERE `ID` = ?");
                                  $stmt->execute(array($copId));
                                  $coupon = $stmt->fetch(PDO::FETCH_ASSOC);
                                  ?>
                                    <form class="form-horizontal" action="?do=Update" method="POST" >
                                      <input type="hidden" name="id" value="<?=$copId?>">
                                      <!-- Start Description Field -->
                                      <div class="row form-group  my-5 form-group-lg">
                                        <label class="col-sm-2 control-label">Description</label>
                                        <div class="col-sm-10 col-md-6">
                                          <textarea type="text" class="form-control" name="description" placeholder="Description of the new coupon" /><?=$coupon['Description']?></textarea>
                                        </div>
                                      </div>
                                      <!-- End Description Field -->
                                      <!-- Start Value Field -->
                                      <div class="row form-group  my-5 form-group-lg">
                                        <label class="col-sm-2 control-label">Value</label>
                                        <div class="col-sm-10 col-md-6">
                                          <input type="number"  min="1" max="100" class="form-control" name="value" value="<?=$coupon['Value']?>" required="required" placeholder="Value of the new coupon" />
                                        </div>
                                      </div>
                                      <!-- End Value Field -->
                                      <!-- Start Limit Field -->
                                      <div class="row form-group  my-5 form-group-lg">
                                        <label class="col-sm-2 control-label">Limit</label>
                                        <div class="col-sm-10 col-md-6">
                                          <input type="number" class="form-control" min="1" name="limit" required="required"  value="<?=$coupon['Limit']?>" placeholder="Limit of the new coupon" />
                                        </div>
                                      </div>
                                      <!-- End Limit Field -->
                                      <!-- Start Submit Field -->
                                      <div class="row form-group my-5">
                                        <div class="offset-sm-2 col-sm-10">
                                          <input type="submit" class="btn bg-gradient-dark mb-0" value="Update coupon"/>
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
                                          <?php redirectHome(null,$url='coupons.php'); ?>
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
                                        <?php redirectHome(null,$url='coupons.php'); ?>
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
                          <h3>Update Coupon</h3>
                          <div class="card-body px-0 pt-0 pb-2">
                            <?php
                              if($_SERVER['REQUEST_METHOD'] == 'POST'){

                                $id = $_POST['id'];
                                $description = $_POST['description'];
                                $value = $_POST['value'];
                                $limit = $_POST['limit'];
                                $formErrors = array();
                                // if(empty($name)){$formErrors[] = 'Name must not be empty.';}
                                if(empty($limit)){$formErrors[] = 'Limit must not be empty.';}
                                if(empty($value)){$formErrors[] = 'Value must not be equal to zero.';}
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
                                    
                                        $stmt = $conn->prepare("UPDATE `coupons` SET `Description` = ?, `Value` = ?, `Limit`= ? WHERE `ID` = ?");
                                        $stmt->execute(array($description, $value, $limit, $id));
                                        $count = $stmt->rowCount();
                                        ?>
                                          <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                            <div class="d-flex flex-column">
                                              <span class="text-dark font-weight-bold ms-sm-2"><?=$count?> record updated successfully.</span>
                                            </div>
                                          </li>
                                        <?php
                                        redirectHome(null, $url='coupons.php');
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
                                        <?php redirectHome(null,$url='coupons.php'); ?>
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
                          <h3>Delete Coupon</h3>
                          <div class="card-body px-0 pt-0 pb-2">
                            <?php
                              if(isset($_GET['copId']) && is_numeric($_GET['copId'])){
                                $copId = $_GET['copId'];
                                $check = checkItem('ID', 'coupons', $copId);

                                if($check > 0){

                                  $stmt = $conn->prepare("DELETE FROM `coupons` WHERE `ID` = ?");
                                  $stmt->execute(array($copId));
                                  $count = $stmt->rowCount();
                                  if ($count > 0){
                                    ?>
                                      <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                        <div class="d-flex flex-column">
                                          <span class="text-dark font-weight-bold ms-sm-2"><?=$count?> record deleted successfully.</span>
                                        </div>
                                      </li>
                                    <?php
                                    redirectHome(null, $url='coupons.php');
                                  }else{
                                    ?>
                                      <ul class="list-group">
                                        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                          <div class="d-flex flex-column">
                                            <span class="text-danger font-weight-bold ms-sm-2">Sorry, something went wrong, please try again.</span>
                                            <?php redirectHome(null,$url='coupons.php'); ?>
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
                                          <span class="text-danger font-weight-bold ms-sm-2">There's no such an ID.</span>
                                          <?php redirectHome(null,$url='coupons.php'); ?>
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
                                        <?php redirectHome(null,$url='coupons.php'); ?>
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
                                <?php redirectHome(null,$url='coupons.php'); ?>
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
