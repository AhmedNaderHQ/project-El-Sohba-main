<?php
ob_start(); //Output buffer start
session_start();
$pageTitle = 'Emails';;
$pageIcon = 'emailicon.ico';
if (isset($_SESSION['user'])) {
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
            $do = (isset($_GET['do'])) ? $_GET['do'] : 'Manage';
            if ($do == 'Manage') {

            ?>
              <div class="card mb-4">
                <?php
                // $onePageItems = 5;
                // $stmt = $conn->prepare("SELECT COUNT(`ID`) AS `COUNT` FROM `customers` WHERE `VerificationStatus` = 1 ");
                // $stmt->execute();
                // $customersNum = $stmt->fetch(PDO::FETCH_ASSOC);
                // $pagesNum = ceil($customersNum['COUNT']/$onePageItems);
                // $pageNum = (isset($_GET['pageNum'])) ? $_GET['pageNum'] : 1 ;
                // if($pageNum > $pagesNum-1 && $pagesNum != 0){ $pageNum = $pagesNum; }
                // $num = ($pageNum - 1)*$onePageItems ;
                $stmt = $conn->prepare("SELECT `ID`, `Name`, `Email`, `Adding-Date` FROM `customers` WHERE `VerificationStatus` = 1 AND `Subscription` = 1");
                $stmt->execute();
                $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $countCustomers = $stmt->rowCount();
                $stmt = $conn->prepare("SELECT `ID`, `Customer_Name`, `Customer_Email`, `Adding-Date` FROM `orders` WHERE `Status` = 1 AND `Subscription` = 1");
                $stmt->execute();
                $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $countOrders = $stmt->rowCount();
                if (($countCustomers + $countOrders) > 0) {
                ?>
                  <div class="card-header pb-0">
                    <h3>Emails table</h3>
                    <div class="ms-md-auto pe-md-3">
                      <form action="?do=SendAll" method="POST">
                        <div class="input-group row p-3">

                          <div class="col-sm-8 col-12 ">
                            <label class="control-label">Coupon</label>
                            <select name="coupon" style="padding: 9px;border: 1px solid black;" class="form-control" required>
                              <option class="form-control" selected disabled> Select Coupon </option>
                              <?php
                              // WHERE `LIMIT` >= ($countCustomers + $countOrders)
                              $stmt = $conn->prepare("SELECT `Coupon`, `ID` FROM `coupons` ");
                              $stmt->execute();
                              $coupons = $stmt->fetchAll(PDO::FETCH_ASSOC);
                              foreach ($coupons as $coupon) {
                                ?>
                                  <option class="form-control" value="<?= $coupon['ID'] ?>"><?= $coupon['Coupon'] ?></option>
                                <?php
                              }
                              ?>
                            </select>
                          </div>
                          <div class="col-sm-4 col-12 mt-sm-0 mt-3 d-flex align-items-end">
                            <input type="submit" class="btn bg-gradient-dark mb-0" value="Send to All" />
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0 customersTable">
                      <table class="table align-items-center mb-0">
                        <thead>
                          <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Customer</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Source</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Adding-Date</th>
                            <th class="text-secondary opacity-7">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          foreach ($customers as $customer) {
                          ?>
                            <tr>
                              <td>
                                <div class="d-flex px-2 py-1">
                                  <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm"><?= $customer['Name'] ?></h6>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <p class="text-xs font-weight-bold mb-0"><?= $customer['Email'] ?></p>
                              </td>
                              <td>
                                <p class="text-xs font-weight-bold mb-0">Customer</p>
                              </td>
                              <td class="align-middle ">
                                <span class="text-secondary text-xs font-weight-bold"><?= $customer['Adding-Date'] ?></span>
                              </td>
                              <td class="align-middle">
                                <a href="?do=Delete&customerId=<?= $customer['ID'] ?>" class="text-secondary font-weight-bold text-s confirm" data-toggle="tooltip" data-original-title="Delete customer">
                                  Delete
                                </a>
                              </td>

                            </tr>
                          <?php

                          }
                          foreach ($orders as $order) {
                          ?>
                            <tr>
                              <td>
                                <div class="d-flex px-2 py-1">
                                  <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm"><?= $order['Customer_Name'] ?></h6>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <p class="text-xs font-weight-bold mb-0"><?= $order['Customer_Email'] ?></p>
                              </td>
                              <td>
                                <p class="text-xs font-weight-bold mb-0">Order</p>
                              </td>
                              <td class="align-middle ">
                                <span class="text-secondary text-xs font-weight-bold"><?= $order['Adding-Date'] ?></span>
                              </td>
                              <td class="align-middle">
                                <a href="?do=Delete&orderId=<?= $order['ID'] ?>" class="text-secondary font-weight-bold text-s confirm" data-toggle="tooltip" data-original-title="Delete customer">
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
                } else {
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
            <?php
            } elseif ($do == 'SendAll') {
            ?>
              <div class="card mb-4">
                <div class="card-header pb-0">
                  <h3>Send Emails</h3>
                  <div class="card-body px-0 pt-0 pb-2">
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                      // echo'<pre>';       
                      // print_r($_POST);                           
                      // echo'</pre>';

                      $coupon = (isset($_POST['coupon'])) ? $_POST['coupon'] : null;



                      // Validate The Form.
                      $formErrors = array();

                      if (empty($coupon) || $coupon == null) {
                        $formErrors[] = 'You must chose a <strong>coupon</strong>.';
                      }

                    ?>

                      <ul class="list-group">
                        <?php if (!empty($formErrors)) {
                          echo '<h4 class="mb-3 text-sm">Form errors</h4>';
                        } ?>
                        <?php
                        foreach ($formErrors as $error) {
                        ?>
                          <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                            <div class="d-flex flex-column">
                              <span class="text-danger font-weight-bold ms-sm-2"><?= $error ?></span>
                            </div>
                          </li>
                        <?php
                        }
                        ?>
                        <?php
                        if (empty($formErrors)) {
                          $stmt = $conn->prepare("SELECT `ID`, `Name`, `Email`  FROM `customers` WHERE `VerificationStatus` = 1 AND `Subscription` = 1");
                          $stmt->execute();
                          $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
                          $countCustomers = $stmt->rowCount();
                          $stmt = $conn->prepare("SELECT `ID`, `Customer_Name`, `Customer_Email`  FROM `orders` WHERE `Status` = 1 AND `Subscription` = 1");
                          $stmt->execute();
                          $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
                          $countOrders = $stmt->rowCount();
                          if (($countCustomers + $countOrders) > 0) {

                            foreach ($customers as $customer) {
                              //mail the coupon
                            }
                            foreach ($orders as $order) {
                              //mail the coupon
                            }
                        ?>
                            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                              <div class="d-flex flex-column">
                                <span class="text-dark font-weight-bold ms-sm-2"><?= ($countCustomers + $countOrders) ?> emails sent successfully.</span>
                              </div>
                            </li>
                        <?php
                          }
                          redirectHome(null, $url = 'emails.php');
                        }
                        ?>
                      </ul>
                    <?php

                    } else {
                    ?>
                      <ul class="list-group">
                        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                          <div class="d-flex flex-column">
                            <span class="text-danger font-weight-bold ms-sm-2">Sorry, you can't browse this page directly.</span>
                            <?php redirectHome(null, $url = 'emails.php'); ?>
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
            } elseif ($do == 'Delete') {
            ?>
              <div class="card mb-4">
                <div class="card-header pb-0">
                  <h3>Delete Customer</h3>
                  <?php
                  if (isset($_GET['customerId']) && is_numeric($_GET['customerId'])) {
                    $customerId = $_GET['customerId'];
                    $check = checkItem('ID', 'customers', $customerId);
                    if ($check > 0) {
                      $stmt = $conn->prepare("UPDATE `customers` SET `Subscription` = 0 WHERE `ID` = ? ");
                      $stmt->execute(array($customerId));
                      $count = $stmt->rowCount();
                      if ($count > 0) {
                  ?>
                        <ul class="list-group">
                          <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                            <div class="d-flex flex-column">
                              <span class="text-dark font-weight-bold ms-sm-2"><?= $count ?> Record successfully deleted.</span>
                              <?php redirectHome(null, $url = 'emails.php'); ?>
                            </div>
                          </li>
                        </ul>
                      <?php
                      }
                    } else {
                      ?>
                      <ul class="list-group">
                        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                          <div class="d-flex flex-column">
                            <span class="text-danger font-weight-bold ms-sm-2">There's no such an ID.</span>
                            <?php redirectHome(null, $url = 'emails.php'); ?>
                          </div>
                        </li>
                      </ul>
                      <?php
                    }
                  } elseif (isset($_GET['orderId']) && is_numeric($_GET['orderId'])) {
                    $orderId = $_GET['orderId'];
                    $check = checkItem('ID', 'orders', $orderId);
                    if ($check > 0) {
                      $stmt = $conn->prepare("UPDATE `orders` SET `Subscription` = 0 WHERE `ID` = ? ");
                      $stmt->execute(array($orderId));
                      $count = $stmt->rowCount();
                      if ($count > 0) {
                      ?>
                        <ul class="list-group">
                          <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                            <div class="d-flex flex-column">
                              <span class="text-dark font-weight-bold ms-sm-2"><?= $count ?> Record successfully deleted.</span>
                              <?php redirectHome(null, $url = 'emails.php'); ?>
                            </div>
                          </li>
                        </ul>
                      <?php
                      }
                    } else {
                      ?>
                      <ul class="list-group">
                        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                          <div class="d-flex flex-column">
                            <span class="text-danger font-weight-bold ms-sm-2">There's no such an ID.</span>
                            <?php redirectHome(null, $url = 'emails.php'); ?>
                          </div>
                        </li>
                      </ul>
                    <?php
                    }
                  } else {
                    ?>
                    <ul class="list-group">
                      <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                        <div class="d-flex flex-column">
                          <span class="text-danger font-weight-bold ms-sm-2">Sorry, you can't browse this page directly.</span>
                          <?php redirectHome(null, $url = 'emails.php'); ?>
                        </div>
                      </li>
                    </ul>
                  <?php
                  }
                  ?>
                </div>
              </div>
            <?php
            } else {
            ?>
              <div class="card mb-4">
                <div class="card-header pb-0">

                  <div class="card-body px-0 pt-0 pb-2">
                    <ul class="list-group">
                      <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                        <div class="d-flex flex-column">
                          <span class="text-danger font-weight-bold ms-sm-2">Sorry, Something went wrong.</span>
                          <?php redirectHome(null, $url = 'emails.php'); ?>
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
} else {
  header('Location:index.php');
}
ob_end_flush();
?>