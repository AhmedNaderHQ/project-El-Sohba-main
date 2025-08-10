<?php
  ob_start(); //Output buffer start
  session_start();
  $pageTitle = 'Comments'; 
  $pageIcon = 'commentsicon';
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
                            $stmt = $conn->prepare("SELECT COUNT(`ID`) AS `COUNT` FROM `comments`");
                            $stmt->execute();
                            $commentsNum = $stmt->fetch(PDO::FETCH_ASSOC);
                            $pagesNum = ceil($commentsNum['COUNT']/$onePageItems);
                            $pageNum = (isset($_GET['pageNum'])) ? $_GET['pageNum'] : 1 ;
                            if($pageNum > $pagesNum-1 && $pagesNum != 0){ $pageNum = $pagesNum; }
                            $num = ($pageNum - 1)*$onePageItems ;
                            $stmt = $conn->prepare("SELECT * FROM `comments` LIMIT $onePageItems  OFFSET $num");
                            $stmt->execute();
                            $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            $count = $stmt->rowCount();
                            if($count > 0){
                              ?>
                                <div class="card-header pb-0">
                                  <h3>Comments table</h3>
                                  
                                </div>
                                <div class="card-body px-0 pt-0 pb-2">
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
                                        <span class="text-dark font-weight-bold ms-sm-2">There's no comments to show.</span>
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
                    else{
                      ?>
                        <div class="card mb-4">
                          <div class="card-header pb-0">
                          
                          <div class="card-body px-0 pt-0 pb-2">
                            <ul class="list-group">
                              <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                <div class="d-flex flex-column">
                                  <span class="text-danger font-weight-bold ms-sm-2">Sorry, Something went wrong.</span>
                                  <?php redirectHome(null,$url='comments.php'); ?>
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
