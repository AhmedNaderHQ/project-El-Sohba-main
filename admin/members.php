

<?php
  ob_start(); //Output buffer start
  session_start();
  $pageTitle = 'Members'; ;
  $pageIcon = 'membersicon.ico' ;
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
                          <div class="card-header pb-0">
                            <h3>Members table</h3> 
                          </div>
                          <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                              <table class="table align-items-center mb-0">
                                <thead>
                                  <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Member</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Phone</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Location</th>
                                    <?php
                                      if($_SESSION['user']['Status'] == 1 ){
                                        ?>
                                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Last-Log-In</th>
                                        <?php
                                      }
                                    ?>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Adding-Date</th>
                                    <?php
                                      if($_SESSION['user']['Status'] == 1 ){
                                        ?>
                                          <th class="text-secondary opacity-7">Actions</th>
                                        <?php
                                      }
                                    ?>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                    $options = '';
                                    if( $_SESSION['user']['Status'] == 2 ){
                                      $options = 'WHERE `Status` != 1';
                                    }
                                    $stmt = $conn->prepare("SELECT * FROM `users` $options");
                                    $stmt->execute();
                                    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($users as $user){
                                      ?>
                                        <tr>
                                          <td>
                                            <div class="d-flex px-2 py-1">
                                              <div>
                                                <img src="uploads/images/admins-images/<?=$user['Image-Name']?>" class="avatar avatar-lg rounded-circle me-3" alt="user">
                                              </div>
                                              <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"><?=$user['Name']?></h6>
                                              </div>
                                            </div>
                                          </td>
                                          <td>
                                            <p class="text-xs font-weight-bold mb-0"><?=$user['Email']?></p>
                                          </td>
                                          <td>
                                            <p class="text-xs font-weight-bold mb-0"><?=$user['Phone']?></p>
                                          </td>
                                          <td>
                                            <p class="text-xs font-weight-bold mb-0"><?=$user['Country']?></p>
                                          </td>
                                          <?php
                                            if($_SESSION['user']['Status'] == 1 ){
                                              ?>
                                                <td>
                                                  <p class="text-xs font-weight-bold mb-0"><?=$user['Last-Log-In']?></p>
                                                </td>
                                              <?php
                                            }
                                          ?>
                                          <td class="align-middle text-center text-sm">
                                            <?php
                                              $stmt = $conn->prepare("SELECT `Rank` FROM `ranks` WHERE `ID` = ?");
                                              $stmt->execute(array($user['Status']));
                                              $user_status = $stmt->fetch(PDO::FETCH_ASSOC);
                                            ?>
                                            <span class="badge badge-sm bg-gradient-<?php if($user_status['Rank']=='Supervisor'){echo 'success';}else{echo 'secondary';}?>">
                                              <?=$user_status['Rank']?>
                                            </span>
                                          </td>
                                          <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold"><?=$user['Date']?></span>
                                          </td>
                                          <?php
                                            if($_SESSION['user']['Status'] == 1 ){
                                              ?>
                                                <td class="align-middle">
                                                  <a href="?do=Edit&memberId=<?=$user['ID']?>" class="text-secondary font-weight-bold text-s" data-toggle="tooltip" data-original-title="Edit user">
                                                    Edit
                                                  </a>
                                                  <br>
                                                  <a href="?do=Delete&memberId=<?=$user['ID']?>&imageName=<?=$user['Image-Name']?>" class="text-secondary font-weight-bold text-s confirm" data-toggle="tooltip" data-original-title="Delete user">
                                                    Delete
                                                  </a>
                                                </td>
                                              <?php
                                            }
                                          ?>
                                        </tr>
                                      <?php
                                      
                                    }
                                  ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                        <?php
                          if($_SESSION['user']['Status'] == 1 ){
                            ?>
                              <a href="?do=Add" class="btn bg-gradient-dark mb-0"><i class="fa fa-plus"></i> Add a new member</a>
                            <?php
                          }
                        ?>
                        
                      <?php
                    }
                    elseif($do == 'Add'){
                      ?>
                        <div class="card mb-4">
                          <div class="card-header pb-0">
                            <h3>Add Member</h3>
                            <div class="card-body px-0 pt-0 pb-2">
                              <?php
                                if($_SESSION['user']['Status'] != 1){
                                  ?>
                                    <ul class="list-group">
                                      <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                        <div class="d-flex flex-column">
                                          <span class="text-danger font-weight-bold ms-sm-2">You are <strong>not allowed</strong> to browse this page.</span>
                                        </div>
                                      </li>
                                    </ul>      
                                  <?php
                                  redirectHome(null,$url='members.php');
                                }
                                else{
                                  ?>
                                    <form class="form-horizontal" action="?do=Insert" method="POST" enctype="multipart/form-data">
                                      <!-- Start Name Field -->
                                      <div class="row form-group  my-5 form-group-lg">
                                        <label class="col-sm-2 control-label">Name</label>
                                        <div class="col-sm-10 col-md-6">
                                          <input type="text" class="form-control" name="name" required="required" placeholder="Name of the new member" />
                                        </div>
                                      </div>
                                      <!-- End Name Field -->
                                      <!-- Start Username Field -->
                                      <div class="row form-group  my-5 form-group-lg">
                                        <label class="col-sm-2 control-label">Username</label>
                                        <div class="col-sm-10 col-md-6">
                                          <input type="text" class="form-control" name="username" required="required" placeholder="Username of the new member" />
                                        </div>
                                      </div>
                                      <!-- End Username Field -->
                                      <!-- Start Password Field -->
                                      <div class="row form-group  my-5 form-group-lg">
                                        <label class="col-sm-2 control-label">Password</label>
                                        <div class="col-sm-10 col-md-6">
                                          <input type="password" class="form-control" name="password" required="required" placeholder="Password of the new member" />
                                        </div>
                                      </div>
                                      <!-- End Password Field -->
                                      <!-- Start Rank Field -->
                                      <div class="row form-group  my-5 form-group-lg">
                                        <label class="col-sm-2 control-label">Rank</label>
                                        <div class="col-sm-10 col-md-6">
                                          <select class="form-control" name="rank" required="required">
                                            <option value="0" class="form-control" selected disabled> .... </option>
                                            <?php
                                              $stmt = $conn->prepare("SELECT * FROM `ranks` ");
                                              $stmt->execute();
                                              $ranks = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                              foreach ($ranks as $rank) {
                                                ?>
                                                  <option class="form-control" value="<?=$rank['ID']?>"><?=$rank['Rank']?></option>
                                                <?php
                                              }
                                            ?>
                                          </select>
                                        </div>
                                      </div>
                                      <!-- End Rank Field -->
                                      <!-- Start Email Field -->
                                      <div class="row form-group  my-5 form-group-lg">
                                        <label class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-10 col-md-6">
                                          <input type="text" class="form-control" name="email" required="required" placeholder="Email of the new member" />
                                        </div>
                                      </div>
                                      <!-- End Email Field -->
                                      <!-- Start Phone Field -->
                                      <div class="row form-group  my-5 form-group-lg">
                                        <label class="col-sm-2 control-label">Phone</label>
                                        <div class="col-sm-10 col-md-6">
                                          <input type="text" class="form-control" name="phone" required="required" placeholder="Phone of the new member" />
                                        </div>
                                      </div>
                                      <!-- End Phone Field -->
                                      <!-- Start Country Field -->
                                      <div class="row form-group  my-5 form-group-lg">
                                        <label class="col-sm-2 control-label">Country</label>
                                        <div class="col-sm-10 col-md-6">
                                          <input type="text" class="form-control" name="country" required="required" placeholder="Country of the new member" />
                                        </div>
                                      </div>
                                      <!-- End Country Field -->
                                      <!-- Start Info Field -->
                                      <div class="row form-group  my-5 form-group-lg">
                                        <label class="col-sm-2 control-label">Info</label>
                                        <div class="col-sm-10 col-md-6">
                                          <textarea class="form-control" name="info" required="required" placeholder="Info about the new member" ></textarea>
                                        </div>
                                      </div>
                                      <!-- End Info Field -->
                                      <!-- Start Image Field -->
                                      <div class="row form-group  my-5 form-group-lg">
                                        <label class="col-sm-2 control-label">Image</label>
                                        <div class="col-sm-10 col-md-6">
                                          <input type="file" class="form-control" name="image" accept=".png, .jpg, .jpeg, .webp, .avif" required="required"  placeholder="Image of the new member" />
                                        </div>
                                      </div>
                                      <!-- End Image Field -->
                                      <!-- Start Submit Field -->
                                      <div class="row form-group my-5">
                                        <div class="offset-sm-2 col-sm-10">
                                          <input type="submit" class="btn bg-gradient-dark mb-0" value="Add member"/>
                                        </div>
                                      </div>
                                      <!-- End Submit Field -->
                                    </form>
                                  <?php
                                }
                              ?>
                              
                            </div>
                          </div>
                        </div>
                      <?php
                    }
                    elseif($do == 'Insert'){
                      ?>  
                        <div class="card mb-4">
                          <div class="card-header pb-0">
                            <h3>Insert Member</h3>
                            <div class="card-body px-0 pt-0 pb-2">
                              <?php
                                if($_SESSION['user']['Status'] != 1){
                                  ?>
                                    <ul class="list-group">
                                      <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                        <div class="d-flex flex-column">
                                          <span class="text-danger font-weight-bold ms-sm-2">You are <strong>not allowed</strong> to browse this page.</span>
                                        </div>
                                      </li>
                                    </ul>      
                                  <?php
                                  redirectHome(null,$url='members.php');
                                }else{
                                  if($_SERVER['REQUEST_METHOD'] == 'POST'){
                                    
                                    $name = $_POST['name'];
                                    $username = $_POST['username'];
                                    $password = $_POST['password'];
                                    $rank = (isset($_POST['rank'])) ? $_POST['rank'] : '' ;
                                    $email = $_POST['email'];
                                    $phone = $_POST['phone'];
                                    $country = $_POST['country'];
                                    $info = $_POST['info'];
                                    $hashPassword = sha1($password);

                                    
                                    $img = $_FILES['image'];
                                    $imageName =  $img['name'];
                                    $imageSize =  $img['size'];
                                    $imageTmp =  $img['tmp_name'];
                                    $imageType =  $img['type'];

                                    // List of Allowed image types to be uploaded
                                    $AllowedImageExt = array('png', 'jpg', 'jpeg', 'webp', 'avif');

                                    // Get image extension
                                    $imageNameArray = explode(".", $imageName);
                                    $imageExt = strtolower(end( $imageNameArray ));

                                    // Validate The Form.
                                    $formErrors = array();
                                    if (checkItem('Username', 'users', $username) > 0) { $formErrors[] = 'This username is already taken.' ; }
                                    if (empty($username)) { $formErrors[] = 'Username can\'t Be <strong>Empty</strong>.' ; }
                                    if (empty($password)) { $formErrors[] = 'Password can\'t Be <strong>Empty</strong>.' ; }
                                    if (strlen($username) < 4) { $formErrors[] = 'Username can\'t Be Less Than <strong>4 Characters</strong>.' ; }
                                    if (strlen($username) > 20) { $formErrors[] = 'Username can\'t Be More Than <strong>20 Characters</strong>.' ; }
                                    if (empty($name)) { $formErrors[] = 'Name can\'t Be <strong>Empty</strong>.' ; }
                                    if (empty($rank)) { $formErrors[] = 'You have to choose a<strong> Rank</strong>.' ; }
                                    if (empty($email)) { $formErrors[] = 'Email can\'t Be <strong>Empty</strong>.' ; }
                                    if (empty($phone)) { $formErrors[] = 'Phone can\'t Be <strong>Empty</strong>.' ; }
                                    if (empty($info)) { $formErrors[] = 'Info can\'t Be <strong>Empty</strong>.' ; }
                                    if( empty($imageName)) { $formErrors[] = 'You have to upload an <strong>Image</strong>.' ; }
                                    if( ! empty($imageName) && $imageSize > 4194304 ) { $formErrors[] = 'Image size can\'t exceed<strong>4MB</strong>.' ; }
                                    if(! empty($imageName) && ! in_array($imageExt, $AllowedImageExt)) { $formErrors[] = 'This extension is <strong>Not Allowed</strong>.' ; }
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
                                            $stored_image = rand(0, 10000).'_'.$imageName;
                                            move_uploaded_file($imageTmp, "uploads/images/admins-images//".$stored_image);
                                            $stmt = $conn->prepare("INSERT INTO `users`(`Name`, `Email`, `Username`, `Password`, `Status`, `Date`, `Phone`, `Country`, `About`, `Image-Name`) VALUES (:zname, :zemail, :zusername, :zpassword, :zrank, now(), :zphone, :zcountry, :zabout, :zimage )");
                                            $stmt->execute(array('zname' => $name, 'zemail' => $email, 'zusername' => $username, 'zpassword' => $hashPassword, 'zrank' => $rank, 'zphone' => $phone, 'zcountry' => $country, 'zabout' => $info, 'zimage' => $stored_image));
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
                                            redirectHome(null,$url='members.php');
                                          
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
                                            <?php redirectHome(null, $url='members.php'); ?>
                                          </div>
                                        </li>
                                      </ul> 
                                    <?php
                                  }
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
                            <h3>Edit Member</h3>
                            <?php
                              if($_SESSION['user']['Status'] != 1){
                                ?>
                                  <ul class="list-group">
                                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                      <div class="d-flex flex-column">
                                        <span class="text-danger font-weight-bold ms-sm-2">You are <strong>not allowed</strong> to browse this page.</span>
                                      </div>
                                    </li>
                                  </ul>      
                                <?php
                                redirectHome(null,$url='members.php');
                              }
                              else{
                                if(isset($_GET['memberId']) && is_numeric($_GET['memberId'])){
                                  $memberId = $_GET['memberId'];
                                  $check = checkItem('ID', 'users', $memberId);
                                  if($check > 0){
                                    $stmt= $conn->prepare("SELECT * FROM `users` WHERE `ID` = ?");
                                    $stmt->execute(array($memberId));
                                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                      <form class="form-horizontal" action="?do=Update" method="POST" enctype="multipart/form-data">
                                        <!-- Start Name Field -->
                                        <input type="hidden" name="id" value="<?=$memberId?>">
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
                                          <label class="col-sm-2 control-label">Rank</label>
                                          <div class="col-sm-10 col-md-6">
                                            <select class="form-control" name="rank" required>
                                              <?php
                                                $stmt = $conn->prepare("SELECT * FROM `ranks` ");
                                                $stmt->execute();
                                                $ranks = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                foreach ($ranks as $rank) {
                                                  ?>
                                                    <option class="form-control" <?php if($rank['ID'] == $user['Status']){ echo 'selected' ;} ?> value="<?=$rank['ID']?>"><?=$rank['Rank']?></option>
                                                  <?php
                                                }
                                              ?>
                                            </select>
                                          </div>
                                        </div>
                                        <!-- End Email Field -->
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
                                        <!-- Start Country Field -->
                                        <div class="row form-group  my-5 form-group-lg">
                                          <label class="col-sm-2 control-label">Country</label>
                                          <div class="col-sm-10 col-md-6">
                                            <input type="text" class="form-control" name="country" required="required" placeholder="Country of the new member" value="<?=$user['Country']?>"/>
                                          </div>
                                        </div>
                                        <!-- End Country Field -->
                                        <!-- Start Info Field -->
                                        <div class="row form-group  my-5 form-group-lg">
                                          <label class="col-sm-2 control-label">Info</label>
                                          <div class="col-sm-10 col-md-6">
                                            <textarea class="form-control" name="info" required="required" placeholder="Info about the new member" ><?=$user['About']?></textarea>
                                          </div>
                                        </div>
                                        <!-- End Info Field -->
                                        <!-- Start Image Field -->
                                        <div class="row form-group  my-5 form-group-lg">
                                          <label class="col-sm-2 control-label">Image</label>
                                          <div class="col-sm-10 col-md-6">
                                            <input type="hidden" name="oldImage" value="<?=$user['Image-Name']?>">
                                            <input type="file" class="form-control" name="newImage" accept=".png, .jpg, .jpeg, .webp, .avif" />
                                            <span style="color:#253134;">Leave blank if you do not want it to be changed.</span> 
                                          </div>
                                        </div>
                                        <!-- End Image Field -->
                                        <!-- Start Submit Field -->
                                        <div class="row form-group my-5">
                                          <div class="offset-sm-2 col-sm-10">
                                              <input type="submit" class="btn bg-gradient-dark mb-0" value="Update member"/>
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
                                            <?php redirectHome(null,$url='members.php'); ?>
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
                                          <?php redirectHome(null,$url='members.php'); ?>
                                        </div>
                                      </li>
                                    </ul> 
                                  <?php
                                }
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
                            <h3>Update Member</h3>
                            <div class="card-body px-0 pt-0 pb-2">
                              <?php
                                if($_SESSION['user']['Status'] != 1){
                                ?>
                                  <ul class="list-group">
                                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                      <div class="d-flex flex-column">
                                        <span class="text-danger font-weight-bold ms-sm-2">You are <strong>not allowed</strong> to browse this page.</span>
                                      </div>
                                    </li>
                                  </ul>      
                                <?php
                                redirectHome(null,$url='members.php');
                              }
                              else{ 
                                if($_SERVER['REQUEST_METHOD']=='POST'){
                                  $formErrors = array();
                                  $id = $_POST['id'];
                                  $name = $_POST['name'];
                                  $username = $_POST['username'];
                                  if(empty($_FILES['newImage']['name']) ){
                                    $image = $_POST['oldImage'];  
                                  }
                                  else{
                                    $imageName = $_FILES['newImage']['name'];
                                    $imageSize = $_FILES['newImage']['size'];
                                    $imageTmp = $_FILES['newImage']['tmp_name'];
                                    $AllowedImageExt = array("jpeg", "jpg", "png");
                                    $img_name_array = explode('.', $imageName);
                                    $ImgActExt = strtolower(end($img_name_array));
                                    if(! in_array($ImgActExt, $AllowedImageExt)){$formErrors[] = 'The image extension is <strong>Not Allowed</strong>.';}
                                    if($imageSize > 4194304){$formErrors[] = 'The image can\'t exceed <strong>4MB</strong>.';}
                                    if( empty($formErrors)){
                                      $path = "uploads/images/admins-images//" ;
                                      unlink($path.$_POST['oldImage']);
                                      $image = rand(0, 10000).'_'.$imageName;
                                      move_uploaded_file($imageTmp, $path.$image);
                                    }
                                  }
                                  if(! empty($_POST['newpassword'])){
                                    $password = $_POST['newpassword'];
                                    $hashPassword = sha1($password);
                                  }else{
                                    $hashPassword = $_POST['oldpassword'];
                                  }
                                
                                  $rank = (isset($_POST['rank'])) ? $_POST['rank'] : '' ;
                                  $email = $_POST['email'];
                                  $phone = $_POST['phone'];
                                  $country = $_POST['country'];
                                  $info = $_POST['info'];
                                      
                                  

                                  // Validate The Form.
                                  
                                  if (checkItemEdit('Username', 'users', $username, 'ID', $id) > 0) { $formErrors[] = 'This username is already taken.' ; }
                                  if (empty($username)) { $formErrors[] = 'Username can\'t Be <strong>Empty</strong>.' ; }
                                  if (empty($hashPassword)) { $formErrors[] = 'Password can\'t Be <strong>Empty</strong>.' ; }
                                  if (strlen($username) < 4) { $formErrors[] = 'Username can\'t Be Less Than <strong>4 Characters</strong>.' ; }
                                  if (strlen($username) > 20) { $formErrors[] = 'Username can\'t Be More Than <strong>20 Characters</strong>.' ; }
                                  if (empty($name)) { $formErrors[] = 'Name can\'t Be <strong>Empty</strong>.' ; }
                                  if (empty($rank)) { $formErrors[] = 'You have to choose a<strong> Rank</strong>.' ; }
                                  if (empty($email)) { $formErrors[] = 'Email can\'t Be <strong>Empty</strong>.' ; }
                                  if (empty($phone)) { $formErrors[] = 'Phone can\'t Be <strong>Empty</strong>.' ; }
                                  if (empty($info)) { $formErrors[] = 'Info can\'t Be <strong>Empty</strong>.' ; }

                                
                                      
                                  ?>
                                    
                                    <ul class="list-group">
                                      <?php if(! empty($formErrors)){echo '<h4 class="mb-3 text-sm">Form errors</h4>';} ?>
                                      <?php 
                                        foreach ($formErrors as $error) {
                                          ?>
                                            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                              <div class="d-flex flex-column">
                                                <span class="text-dark font-weight-bold ms-sm-2"><?=$error?></span>
                                              </div>
                                            </li>
                                          <?php
                                        }
                                      ?>
                                      <?php 
                                        if(empty($formErrors)){
                                          $stmt = $conn->prepare("UPDATE `users` SET `Name` = ? , `Username` = ?, `Password` = ?, `Email` = ? , `Status` = ?, `Phone` = ?, `Country` = ?, `About` = ?, `Image-Name` = ? WHERE `ID` = ?");
                                          $stmt->execute(array($name, $username, $hashPassword, $email, $rank, $phone, $country, $info, $image, $id));
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
                                          redirectHome(null,$url='members.php');
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
                                          <?php redirectHome(null,$url='members.php'); ?>
                                        </div>
                                      </li>
                                    </ul> 
                                  <?php
                                }

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
                            <h3>Delete Member</h3>
                            <?php
                              if($_SESSION['user']['Status'] != 1){
                                ?>
                                  <ul class="list-group">
                                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                      <div class="d-flex flex-column">
                                        <span class="text-danger font-weight-bold ms-sm-2">You are <strong>not allowed</strong> to browse this page.</span>
                                      </div>
                                    </li>
                                  </ul>      
                                <?php
                                redirectHome(null,$url='members.php');
                              }else{
                                if(isset($_GET['memberId']) && is_numeric($_GET['memberId'])){
                                  $memberId = $_GET['memberId'];
                                  $imageName = $_GET['imageName'];
                                  $check = checkItem('ID', 'users', $memberId) ;
                                  if($check > 0){
                                    $path = "uploads/images/admins-images//" ;
                                    unlink($path.$imageName);
                                    $stmt = $conn->prepare("DELETE FROM `users` WHERE `ID` = ? ");
                                    $stmt->execute(array($memberId));
                                    $count = $stmt->rowCount();
                                    if($count > 0){
                                      ?>
                                        <ul class="list-group">
                                          <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                            <div class="d-flex flex-column">
                                              <span class="text-dark font-weight-bold ms-sm-2"><?=$count?> Record successfully deleted.</span>
                                              <?php redirectHome(null,$url='members.php'); ?>
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
                                            <?php redirectHome(null,$url='members.php'); ?>
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
                                          <?php redirectHome(null,$url='members.php'); ?>
                                        </div>
                                      </li>
                                    </ul> 
                                  <?php
                                }
                              }
                            ?>
                          </div>
                        </div>
                      <?php
                    }else{
                      ?>
                        <div class="card mb-4">
                          <div class="card-header pb-0">
                          
                          <div class="card-body px-0 pt-0 pb-2">
                            <ul class="list-group">
                              <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                <div class="d-flex flex-column">
                                  <span class="text-danger font-weight-bold ms-sm-2">Sorry, Something went wrong.</span>
                                  <?php redirectHome(null,$url='members.php'); ?>
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
