<?php
  ob_start(); //Output buffer start
  session_start();
  $pageIcon = 'profileicon.ico';
  if(isset($_SESSION['user'])){
    $pageTitle = $_SESSION['user']['Name'];
    include 'int.php';
    include 'includes/templates/header.php'; 
    include 'databaseconnect.php';
    if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
      
      $notifyMessage = (isset($_POST['message'])) ? $_POST['message'] : 'off';
      $notifyOrder = (isset($_POST['order'])) ? $_POST['order'] : 'off';
      
      $stmt = $conn->prepare("UPDATE `users` SET `notifyMessage`= ?, `notifyOrder`= ? WHERE `ID` = ?");
      $stmt -> execute(array($notifyMessage, $notifyOrder, $_SESSION['user']['ID']));
      $stmt = $conn -> prepare("SELECT * FROM `users` WHERE `ID` = ?");
      $stmt -> execute(array($_SESSION['user']['ID']));
      $_SESSION['user'] = $stmt -> fetch(PDO::FETCH_ASSOC);
    }
    ?>

        <body class="g-sidenav-show bg-gray-100">
            <!-- Start sidebar -->
            <?php include 'includes/templates/sidebar.php'; ?>
            <!-- End sidebar -->
            <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
              <!-- Navbar -->
                <?php include 'includes/templates/nav-bar.php' ?>
              <!-- End Navbar -->
              <div class="container-fluid">
                <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
                  <span class="mask bg-gradient-primary opacity-6"></span>
                </div>
                <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
                  <div class="row gx-4">
                    <div class="col-auto">
                      <div class="avatar avatar-xl position-relative">
                        <img src="uploads/images/admins-images/<?=$_SESSION['user']['Image-Name']?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                      </div>
                    </div>
                    <div class="col-auto my-auto">
                      <div class="h-100">
                        <h5 class="mb-1">
                          <?=$_SESSION['user']['Name']?>
                        </h5>
                        <?php
                          $stmt = $conn->prepare("SELECT `Rank` FROM `ranks` WHERE `ID` = ?");
                          $stmt->execute(array($_SESSION['user']['Status']));
                          $rank = $stmt-> fetch(PDO::FETCH_ASSOC);
                        ?>
                        <p class="mb-0 font-weight-bold text-sm">
                          <?=$rank['Rank']?>
                        </p>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                      <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">

                          <li class="nav-item buttonAppProfile">
                            <a class="nav-link mb-0 px-0 py-1 active " data-bs-toggle="tab" role="tab" aria-selected="true">
                              <svg class="text-dark" width="16px" height="16px" viewBox="0 0 42 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                  <g transform="translate(-2319.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                    <g transform="translate(1716.000000, 291.000000)">
                                      <g transform="translate(603.000000, 0.000000)">
                                        <path class="color-background" d="M22.7597136,19.3090182 L38.8987031,11.2395234 C39.3926816,10.9925342 39.592906,10.3918611 39.3459167,9.89788265 C39.249157,9.70436312 39.0922432,9.5474453 38.8987261,9.45068056 L20.2741875,0.1378125 L20.2741875,0.1378125 C19.905375,-0.04725 19.469625,-0.04725 19.0995,0.1378125 L3.1011696,8.13815822 C2.60720568,8.38517662 2.40701679,8.98586148 2.6540352,9.4798254 C2.75080129,9.67332903 2.90771305,9.83023153 3.10122239,9.9269862 L21.8652864,19.3090182 C22.1468139,19.4497819 22.4781861,19.4497819 22.7597136,19.3090182 Z">
                                        </path>
                                        <path class="color-background" d="M23.625,22.429159 L23.625,39.8805372 C23.625,40.4328219 24.0727153,40.8805372 24.625,40.8805372 C24.7802551,40.8805372 24.9333778,40.8443874 25.0722402,40.7749511 L41.2741875,32.673375 L41.2741875,32.673375 C41.719125,32.4515625 42,31.9974375 42,31.5 L42,14.241659 C42,13.6893742 41.5522847,13.241659 41,13.241659 C40.8447549,13.241659 40.6916418,13.2778041 40.5527864,13.3472318 L24.1777864,21.5347318 C23.8390024,21.7041238 23.625,22.0503869 23.625,22.429159 Z" opacity="0.7"></path>
                                        <path class="color-background" d="M20.4472136,21.5347318 L1.4472136,12.0347318 C0.953235098,11.7877425 0.352562058,11.9879669 0.105572809,12.4819454 C0.0361450918,12.6208008 6.47121774e-16,12.7739139 0,12.929159 L0,30.1875 L0,30.1875 C0,30.6849375 0.280875,31.1390625 0.7258125,31.3621875 L19.5528096,40.7750766 C20.0467945,41.0220531 20.6474623,40.8218132 20.8944388,40.3278283 C20.963859,40.1889789 21,40.0358742 21,39.8806379 L21,22.429159 C21,22.0503869 20.7859976,21.7041238 20.4472136,21.5347318 Z" opacity="0.7"></path>
                                      </g>
                                    </g>
                                  </g>
                                </g>
                              </svg>
                              <span class="ms-1">App</span>
                            </a>
                          </li>
                          
                          <li class="nav-item buttonListProfile">
                            <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" role="tab" aria-selected="false">
                              <i class="fa-solid fa-list-check"></i>
                              <span class="ms-1">To do list</span>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="container-fluid py-4">
                <div class="row">
                  
                  <div class="col-12 col-xl-6 profileInformation mt-2">
                    <div class="card h-100">
                      <div class="card-header pb-0 p-3">
                        <div class="row">
                          <div class="col-md-8 d-flex align-items-center">
                            <h6 class="mb-0">Profile Information</h6>
                          </div>
                          <div class="col-md-4 text-end">
                            <a href="members.php?do=Edit&memberId=<?=$_SESSION['user']['ID']?>">
                              <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                            </a>
                          </div>
                        </div>
                      </div>
                      <div class="card-body p-3">
                        <p class="text-sm">
                          <?=$_SESSION['user']['About']?>
                        </p>
                        <hr class="horizontal gray-light my-4">
                        <ul class="list-group">
                          <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; <?=$_SESSION['user']['Name']?></li>
                          <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong> &nbsp; <?=$_SESSION['user']['Phone']?></li>
                          <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; <?=$_SESSION['user']['Email']?></li>
                          <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Location:</strong> &nbsp; <?=$_SESSION['user']['Country']?></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-12 col-xl-6 PlatformSettings mt-2">
                    <div class="card h-100">
                      <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Notifications Settings</h6>
                      </div>
                      <div class="card-body p-3">

                        <form class="notificationsSettings" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                          <ul class="list-group">
                            <li class="list-group-item border-0 px-0">
                              <div class="form-check form-switch ps-0">
                                <input class="form-check-input ms-auto"  name="message" type="checkbox" id="flexSwitchCheckDefault1" <?php if($_SESSION['user']['notifyMessage'] == 'on'){ echo 'checked'; }?>>
                                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault1">Notify me new messages</label>
                              </div>
                            </li>
                            <li class="list-group-item border-0 px-0">
                              <div class="form-check form-switch ps-0">
                                <input class="form-check-input ms-auto" type="checkbox"  name="order" id="flexSwitchCheckDefault3" <?php if($_SESSION['user']['notifyOrder'] == 'on'){ echo 'checked'; }?>>
                                <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault3">Notify me new orders</label>
                              </div>
                            </li>
                          </ul>
                          <input class="btn bg-gradient-dark float-end" type="submit" value="Save changes">
                        </form>

                      </div>
                    </div>
                  </div>

                  
                  <div class="col-12 mt-4 allToDOList">
                    <div class="card mb-4">
                      <div class="card-header pb-0 p-3">
                        <i class="fa-solid fa-list-check"></i>
                        <h6 class="mb-1" style="display: inline-block;">To Do list</h6>
                        <p class="text-sm">tasks</p>
                      </div>
                      <div class="card-body p-3">
                        <div class="row">
                          <?php
                            $stmt = $conn->prepare("SELECT * FROM `to-do-list`");
                            $stmt -> execute();
                            $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            $count = count($tasks);
                            if($count > 0){
                              ?>
                                <div class="table-responsive p-0 tableToDoList"  style="height: 86%;">
                                  <table class="table align-items-center mb-0">
                                    <thead>
                                      <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Team Member</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Task</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Priority</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
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
                                      ?>
                                    </tbody>
                                  </table>
                                </div>
                              <?php
                            }else{
                              ?>
                                <ul class="list-group success-message">
                                  <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                    <div class="d-flex flex-column">
                                      <span class="text-dark font-weight-bold ms-sm-2">There're no tasks to show.</span>
                                    </div>
                                  </li>
                                </ul> 
                              <?php
                            }
                        
                          ?>
                          <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary me-2 mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                              Add Task
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  
                  <!-- Modal to do list -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body modelTask" id="myForm">
                            <form  class="form-horizontal add-task">
                              <!-- Start Task Field -->
                              <div class="row form-group  my-5 form-group-lg">
                                <label class="col-sm-2 control-label">Task</label>
                                <div class="col-sm-10 col-md-6">
                                  <input type="text" name="text" class="form-control" required="required" placeholder="The task to do">
                                </div>
                              </div>
                              <!-- End Task Field -->
                              <!-- Start user Field -->
                              <div class="row form-group  my-5 form-group-lg">
                                <label class="col-sm-2 control-label">Assigned to</label>
                                <div class="col-sm-10 col-md-6">
                                  <select name="assign" class="form-control" required="required">
                                    <option value="0" class="form-control" selected disabled> ... </option>
                                    <?php
                                      if($_SESSION['user']['Status'] != 1){
                                        $options = 'WHERE `Status` != 1';
                                      }else{
                                        $options = '';
                                      }
                                      $stmt = $conn->prepare("SELECT * FROM `users` $options");
                                      $stmt->execute();
                                      $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                      foreach ($users as $user) {
                                        ?>
                                          <option class="form-control" value="<?=$user['ID']?>"><?=$user['Name']?></option>
                                        <?php
                                      }
                                    ?>
                                    <option class="form-control" value="none">Everyone</option>
                                  </select>
                                </div>
                              </div>
                              <!-- End user Field -->
                              <!-- Start Priority Field -->
                              <div class="row form-group  my-5 form-group-lg">
                                <label class="col-sm-2 control-label">Priority</label>
                                <div class="col-sm-10 col-md-6">
                                  <select name="priority" class="form-control" required="required">
                                    <option value="0" class="form-control" selected disabled> ... </option>
                                    <option value="1" class="form-control" >High Priority</option>
                                    <option value="2" class="form-control" >Middle Priority</option>
                                    <option value="3" class="form-control" >Low Priority</option>
                                  </select>
                                </div>
                              </div>
                              <!-- End Priority Field -->
                              <!-- Start Deadline-Date Field -->
                              <div class="row form-group  my-5 form-group-lg">
                                <label class="col-sm-2 control-label">Deadline</label>
                                <div class="col-sm-10 col-md-6">
                                  <input type="datetime-local" class="form-control" name="deadline" required="required"/>
                                </div>
                              </div>
                              <!-- End Deadline-Date Field -->
                              <div class="row form-group my-5">
                                <div class="offset-sm-2 col-sm-10">
                                  <input type="submit" class="btn bg-gradient-dark mb-0" value="Add Task"/>
                                </div>
                              </div>
                              <!-- End Submit Field -->
                            </form>
                          </div>
                          <div class="modal-footer modelFooterTask">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
                
                <!-- Start footer -->
                <?php include 'includes/templates/footer.php' ?>
                <!-- End footer -->
              </div>
            </div>


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


