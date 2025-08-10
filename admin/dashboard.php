<?php
  ob_start(); //Output buffer start
  session_start();
  $pageTitle = 'Dashboard'; ;
  $pageIcon = 'dashboardicon.ico' ;
  if(isset($_SESSION['user'])){
    include 'int.php';
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
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                  <a href="orders.php">
                    <div class="card">
                      <div class="card-body p-3">
                        <div class="row">
                          <div class="col-8">
                            <div class="numbers">
                              <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Orders</p>
                              <h5 class="font-weight-bolder mb-0">
                                <?php
                                  $stmt = $conn -> prepare("SELECT COUNT(*) FROM `orders` WHERE `Payment` != 1 ");
                                  $stmt -> execute();
                                  $ordersCount = $stmt -> fetch(PDO::FETCH_ASSOC);
                                  echo $ordersCount['COUNT(*)'];
                                ?>
                              </h5>
                            </div>
                          </div>
                          <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                              <i style="font-size: 25px; color:aliceblue; margin-top:9px;" class="fa-solid fa-bag-shopping"></i>                             </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                  <a href="categories.php">
                    <div class="card">
                      <div class="card-body p-3">
                        <div class="row">
                          <div class="col-8">
                            <div class="numbers">
                              <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Categories</p>
                              <h5 class="font-weight-bolder mb-0">
                                <?php
                                  $stmt = $conn -> prepare("SELECT COUNT(*) FROM `categories`");
                                  $stmt -> execute();
                                  $categoriesCount = $stmt -> fetch(PDO::FETCH_ASSOC);
                                  echo $categoriesCount['COUNT(*)'];
                                ?>
                                
                              </h5>
                            </div>
                          </div>
                          <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                              <i style="font-size: 25px; color:aliceblue; margin-top:9px;" class="fa-solid fa-boxes-stacked"></i>  
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                  <a href="courses.php">
                    <div class="card">
                      <div class="card-body p-3">
                        <div class="row">
                          <div class="col-8">
                            <div class="numbers">
                              <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Courses</p>
                              <h5 class="font-weight-bolder mb-0">
                                <?php
                                  $stmt = $conn -> prepare("SELECT COUNT(*) FROM `courses`");
                                  $stmt -> execute();
                                  $coursesCount = $stmt -> fetch(PDO::FETCH_ASSOC);
                                  echo $coursesCount['COUNT(*)'];
                                ?>
                                
                              </h5>
                            </div>
                          </div>
                          <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                              <i style="font-size: 25px; color:aliceblue; margin-top:9px;" class="fa-solid fa-list"></i>  
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
                <div class="col-xl-3 col-sm-6">
                  <a href="customers.php">
                    <div class="card">
                      <div class="card-body p-3">
                        <div class="row">
                          <div class="col-8">
                            <div class="numbers">
                              <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Customers</p>
                              <h5 class="font-weight-bolder mb-0">
                                <?php
                                  $stmt = $conn -> prepare("SELECT COUNT(*) FROM `customers` WHERE `VerificationStatus` = 1");
                                  $stmt -> execute();
                                  $customersCount = $stmt -> fetch(PDO::FETCH_ASSOC);
                                  echo $customersCount['COUNT(*)'];
                                ?>
                              </h5>
                            </div>
                          </div>
                          <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                              <i style="font-size: 25px; color:aliceblue; margin-top:9px;" class="fa-solid fa-users"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
              
              <div class="row mt-4">
                <div class="col-lg-5 mb-lg-0 mb-4">
                  <div class="card z-index-2">
                    <div class="card-body p-3">
                      <div class="bg-gradient-dark border-radius-lg py-3 pe-1 mb-3">
                        <div class="chart">
                          <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                        </div>
                      </div>
                      
                      <div class="container border-radius-lg">
                        <div class="row">
                          <div class="col-3 py-3 ps-0">
                            <div class="d-flex mb-2">
                              <div class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-primary text-center me-2 d-flex align-items-center justify-content-center">
                                <svg width="10px" height="10px" viewBox="0 0 40 44" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                  <title>document</title>
                                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1870.000000, -591.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                      <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(154.000000, 300.000000)">
                                          <path class="color-background" d="M40,40 L36.3636364,40 L36.3636364,3.63636364 L5.45454545,3.63636364 L5.45454545,0 L38.1818182,0 C39.1854545,0 40,0.814545455 40,1.81818182 L40,40 Z" opacity="0.603585379"></path>
                                          <path class="color-background" d="M30.9090909,7.27272727 L1.81818182,7.27272727 C0.814545455,7.27272727 0,8.08727273 0,9.09090909 L0,41.8181818 C0,42.8218182 0.814545455,43.6363636 1.81818182,43.6363636 L30.9090909,43.6363636 C31.9127273,43.6363636 32.7272727,42.8218182 32.7272727,41.8181818 L32.7272727,9.09090909 C32.7272727,8.08727273 31.9127273,7.27272727 30.9090909,7.27272727 Z M18.1818182,34.5454545 L7.27272727,34.5454545 L7.27272727,30.9090909 L18.1818182,30.9090909 L18.1818182,34.5454545 Z M25.4545455,27.2727273 L7.27272727,27.2727273 L7.27272727,23.6363636 L25.4545455,23.6363636 L25.4545455,27.2727273 Z M25.4545455,20 L7.27272727,20 L7.27272727,16.3636364 L25.4545455,16.3636364 L25.4545455,20 Z"></path>
                                        </g>
                                      </g>
                                    </g>
                                  </g>
                                </svg>
                              </div>
                              <p class="text-xs mt-1 mb-0 font-weight-bold">Users</p>
                            </div>
                            <h4 class="font-weight-bolder"><?=$customersCount['COUNT(*)']?></h4>
                            <div class="progress w-75">
                              <div class="progress-bar bg-dark w-60" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </div>
                          <div class="col-3 py-3 ps-0">
                            <div class="d-flex mb-2">
                              <div class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-info text-center me-2 d-flex align-items-center justify-content-center">
                                <svg width="10px" height="10px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                  <title>spaceship</title>
                                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1720.000000, -592.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                      <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(4.000000, 301.000000)">
                                          <path class="color-background" d="M39.3,0.706666667 C38.9660984,0.370464027 38.5048767,0.192278529 38.0316667,0.216666667 C14.6516667,1.43666667 6.015,22.2633333 5.93166667,22.4733333 C5.68236407,23.0926189 5.82664679,23.8009159 6.29833333,24.2733333 L15.7266667,33.7016667 C16.2013871,34.1756798 16.9140329,34.3188658 17.535,34.065 C17.7433333,33.98 38.4583333,25.2466667 39.7816667,1.97666667 C39.8087196,1.50414529 39.6335979,1.04240574 39.3,0.706666667 Z M25.69,19.0233333 C24.7367525,19.9768687 23.3029475,20.2622391 22.0572426,19.7463614 C20.8115377,19.2304837 19.9992882,18.0149658 19.9992882,16.6666667 C19.9992882,15.3183676 20.8115377,14.1028496 22.0572426,13.5869719 C23.3029475,13.0710943 24.7367525,13.3564646 25.69,14.31 C26.9912731,15.6116662 26.9912731,17.7216672 25.69,19.0233333 L25.69,19.0233333 Z"></path>
                                          <path class="color-background" d="M1.855,31.4066667 C3.05106558,30.2024182 4.79973884,29.7296005 6.43969145,30.1670277 C8.07964407,30.6044549 9.36054508,31.8853559 9.7979723,33.5253085 C10.2353995,35.1652612 9.76258177,36.9139344 8.55833333,38.11 C6.70666667,39.9616667 0,40 0,40 C0,40 0,33.2566667 1.855,31.4066667 Z"></path>
                                          <path class="color-background" d="M17.2616667,3.90166667 C12.4943643,3.07192755 7.62174065,4.61673894 4.20333333,8.04166667 C3.31200265,8.94126033 2.53706177,9.94913142 1.89666667,11.0416667 C1.5109569,11.6966059 1.61721591,12.5295394 2.155,13.0666667 L5.47,16.3833333 C8.55036617,11.4946947 12.5559074,7.25476565 17.2616667,3.90166667 L17.2616667,3.90166667 Z" opacity="0.598539807"></path>
                                          <path class="color-background" d="M36.0983333,22.7383333 C36.9280725,27.5056357 35.3832611,32.3782594 31.9583333,35.7966667 C31.0587397,36.6879974 30.0508686,37.4629382 28.9583333,38.1033333 C28.3033941,38.4890431 27.4704606,38.3827841 26.9333333,37.845 L23.6166667,34.53 C28.5053053,31.4496338 32.7452344,27.4440926 36.0983333,22.7383333 L36.0983333,22.7383333 Z" opacity="0.598539807"></path>
                                        </g>
                                      </g>
                                    </g>
                                  </g>
                                </svg>
                              </div>
                              <p class="text-xs mt-1 mb-0 font-weight-bold">Clicks</p>
                            </div>
                            <h4 class="font-weight-bolder">2m</h4>
                            <div class="progress w-75">
                              <div class="progress-bar bg-dark w-90" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </div>
                          <div class="col-3 py-3 ps-0">
                            <div class="d-flex mb-2">
                              <div class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-warning text-center me-2 d-flex align-items-center justify-content-center">
                                <svg width="10px" height="10px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                  <title>credit-card</title>
                                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                      <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(453.000000, 454.000000)">
                                          <path class="color-background" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z" opacity="0.593633743"></path>
                                          <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                                        </g>
                                      </g>
                                    </g>
                                  </g>
                                </svg>
                              </div>
                              <p class="text-xs mt-1 mb-0 font-weight-bold">Sales</p>
                            </div>
                            <h4 class="font-weight-bolder"><?=$ordersCount['COUNT(*)']?></h4>
                            <div class="progress w-75">
                              <div class="progress-bar bg-dark w-30" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </div>
                          <div class="col-3 py-3 ps-0">
                            <div class="d-flex mb-2">
                              <div class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-danger text-center me-2 d-flex align-items-center justify-content-center">
                                <svg width="10px" height="10px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                  <title>settings</title>
                                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                      <g transform="translate(1716.000000, 291.000000)">
                                        <g transform="translate(304.000000, 151.000000)">
                                          <polygon class="color-background" opacity="0.596981957" points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667"></polygon>
                                          <path class="color-background" d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z" opacity="0.596981957"></path>
                                          <path class="color-background" d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z"></path>
                                        </g>
                                      </g>
                                    </g>
                                  </g>
                                </svg>
                              </div>
                              <p class="text-xs mt-1 mb-0 font-weight-bold">Courses</p>
                            </div>
                            <h4 class="font-weight-bolder"><?=$coursesCount['COUNT(*)']?></h4>
                            <div class="progress w-75">
                              <div class="progress-bar bg-dark w-50" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-7 col-md-6">
                  <div class="card">
                    <div class="card-body p-3">
                      <div class="row">
                        <div class="card-body px-0 pt-0 pb-2">
                          <?php
                            $stmt = $conn -> prepare("SELECT * FROM `comments` WHERE `Status` = 0");
                            $stmt -> execute();
                            $comments = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                            $count = $stmt->rowCount();
                            if ($count > 0){
                              ?>
                                <div class="table-responsive p-0 commentsTable">
                                  <table class="table align-items-center mb-0">
                                    <thead>
                                      <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Adding-Date</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">View Comment</th>
                                        <th class="text-secondary opacity-7"></th>
                                      </tr>
                                    </thead>
                                    <tbody class="commentTbody">
                                      <?php
                                        foreach($comments as $comment){
                                          ?>
                                            <tr>
                                              <td>
                                                <div class="d-flex px-2 py-1">
                                                  <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm"><?=$comment['Name']?></h6>
                                                  </div>
                                                </div>
                                              </td>
                                              <td>
                                                <p class="text-xs font-weight-bold mb-0"><?=$comment['Email']?></p>
                                              </td>
                                              <td class="align-middle text-center text-sm status">
                                                <?php
                                                  if($comment['Status'] == 0){
                                                    ?>
                                                      <span class="badge badge-sm bg-gradient-warning">Unread</span>
                                                    <?php
                                                  }elseif($comment['Status'] == 1){
                                                    ?>
                                                      <span class="badge badge-sm bg-gradient-primary">read</span>
                                                    <?php
                                                  }
                                                ?>
                                                
                                              </td>
                                              <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold"><?=$comment['Date']?></span>
                                              </td>
                                              <td class="align-middle text-center text-sm">
                                                <?php
                                                  if($comment['Order_ID'] != null){
                                                    ?>
                                                      Order comment
                                                    <?php
                                                  }else{
                                                    ?>
                                                      Comment
                                                    <?php
                                                  }
                                                ?>
                                                
                                              </td>
                                              <td class="align-middle text-center">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary me-2 mt-2 viewCommentBtn" data-bs-toggle="modal" data-bs-target="#viewComment<?=$comment['ID']?>" data-id="<?=$comment['ID']?>">
                                                  View Comment
                                                </button>
                                              </td>
                                              <!-- Modal comment -->
                                              <div class="modal fade" id="viewComment<?=$comment['ID']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h1 class="modal-title fs-5" id="exampleModalLabel">View Comment</h1>
                                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                      <?php
                                                        if($comment['Order_ID'] != null){
                                                          ?>
                                                            <p class="mb-2">Order id: <span class="text-primary"><?=$comment['Order_ID']?></span></p>
                                                          <?php
                                                        }
                                                      ?>
                                                      <?=$comment['Comment']?>
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                              <td class="align-middle">
                                                <span class="text-secondary ms-2 font-weight-bold" title="Remove" data-bs-toggle="modal" data-bs-target="#deleteComment<?=$comment['ID']?>" ><i class="fa-solid fa-trash-can"></i></span>
                                                <div class="modal fade" id="deleteComment<?=$comment['ID']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Comment</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                      </div>
                                                      <div class="modal-body">
                                                        Are you sure you want to delete this comment ?
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary deleteComment" data-bs-dismiss="modal" data-id="<?=$comment['ID']?>">Yes</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                            }else{
                              ?>
                                <div class="card-body px-0 pt-2 pb-2">
                                  <ul class="list-group">
                                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                      <div class="d-flex flex-column">
                                        <span class="text-dark font-weight-bold ms-sm-2">There's no messages to show.</span>
                                      </div>
                                    </li>
                                  </ul> 
                                </div>                                
                              <?php

                            }
                          ?>
                        </div>
                      </div>
                    </div>
                  </div>  
                  
                </div>
              </div>
              <div class="row my-4">
                <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
                  <div class="card mb-4">
                    <?php
                      
                      $stmt = $conn->prepare("SELECT * FROM `orders` WHERE `Status` = 0  AND `Payment` != 1  ORDER BY `orders`.`ID` DESC ");
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
                          </div>
                        <?php
                      }
                      else{
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
                </div>
                
              </div>
              <!-- Start footer -->
              <?php include 'includes/templates/footer.php' ?>
              <!-- End footer -->
            </div>
          </main>


          <!--   Core JS Files   -->
          
          <?php include 'includes/templates/footer-script.php' ?>
          <?php
            $stmt = $conn->prepare("SELECT `ID` FROM `categories`");
            $stmt -> execute();
            $categories = $stmt ->fetchAll(PDO::FETCH_ASSOC);
            $categoriesCounter = array();
            foreach($categories as $category){
              $stmt = $conn -> prepare("SELECT COUNT(*) FROM `courses` WHERE `Cat_ID` = ?");
              $stmt -> execute(array($category['ID']));
              $coursesCount = $stmt -> fetch(PDO::FETCH_ASSOC);
              $categoriesCounter[] = $coursesCount['COUNT(*)']; 
            }
            $stmt = $conn->prepare("SELECT `Name` FROM `categories`");
            $stmt -> execute();
            $categories = $stmt ->fetchAll(PDO::FETCH_ASSOC);
            $categoriesName = array();
            foreach($categories as $category){
              $categoriesName[] = $category['Name']; 
            }
          ?>

          <script>
            
            var ctx = document.getElementById("chart-bars").getContext("2d");
            new Chart(ctx, {
              type: "bar",
              data: {
                
                labels: <?=json_encode($categoriesName)?>,
                datasets: [{
                  label: "Courses",
                  tension: 0.4,
                  borderWidth: 0,
                  borderRadius: 4,
                  borderSkipped: false,
                  backgroundColor: "#fff",
                  
                  data: <?=json_encode($categoriesCounter)?>,
                  maxBarThickness: 6
                }, ],
              },
              options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                  legend: {
                    display: false,
                  }
                },
                interaction: {
                  intersect: false,
                  mode: 'index',
                },
                scales: {
                  y: {
                    grid: {
                      drawBorder: false,
                      display: false,
                      drawOnChartArea: false,
                      drawTicks: false,
                    },
                    ticks: {
                      suggestedMin: 0,
                      suggestedMax: 10,
                      beginAtZero: true,
                      padding: 10,
                      font: {
                        size: 14,
                        family: "Open Sans",
                        style: 'normal',
                        lineHeight: 2
                      },
                      color: "#fff"
                    },
                  },
                  x: {
                    grid: {
                      drawBorder: false,
                      display: false,
                      drawOnChartArea: false,
                      drawTicks: false
                    },
                    ticks: {
                      display: false
                    },
                  },
                },
              },
            });


            var ctx2 = document.getElementById("chart-line").getContext("2d");

            var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

            gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
            gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

            var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

            gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
            gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

            new Chart(ctx2, {
              type: "line",
              data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Mobile apps",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#cb0c9f",
                    borderWidth: 3,
                    backgroundColor: gradientStroke1,
                    fill: true,
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                    maxBarThickness: 6

                  },
                  {
                    label: "Websites",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#3A416F",
                    borderWidth: 3,
                    backgroundColor: gradientStroke2,
                    fill: true,
                    data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
                    maxBarThickness: 6
                  },
                ],
              },
              options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                  legend: {
                    display: false,
                  }
                },
                interaction: {
                  intersect: false,
                  mode: 'index',
                },
                scales: {
                  y: {
                    grid: {
                      drawBorder: false,
                      display: true,
                      drawOnChartArea: true,
                      drawTicks: false,
                      borderDash: [5, 5]
                    },
                    ticks: {
                      display: true,
                      padding: 10,
                      color: '#b2b9bf',
                      font: {
                        size: 11,
                        family: "Open Sans",
                        style: 'normal',
                        lineHeight: 2
                      },
                    }
                  },
                  x: {
                    grid: {
                      drawBorder: false,
                      display: false,
                      drawOnChartArea: false,
                      drawTicks: false,
                      borderDash: [5, 5]
                    },
                    ticks: {
                      display: true,
                      color: '#b2b9bf',
                      padding: 20,
                      font: {
                        size: 11,
                        family: "Open Sans",
                        style: 'normal',
                        lineHeight: 2
                      },
                    }
                  },
                },
              },
            });
          </script>
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
