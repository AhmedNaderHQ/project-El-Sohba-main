    <!-- Start Loading  -->
    <div class="loading-overlay">
        <span class="loader"><img style="width: 7rem;" src="assets/img/logo-white.png" alt=""></span>
    </div>
    <!-- End Loading  -->
    
    
    
    
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl position-sticky blur shadow-blur mt-4 left-auto top-1 z-index-sticky" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><?=$pageTitle?></li>
            </ol>
            <h6 class="font-weight-bolder mb-0"><?=$pageTitle?></h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            </div>
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item d-flex align-items-center">
                <a href="logout.php" class="nav-link text-body font-weight-bold px-0">
                    <i class="fa fa-user me-sm-1"></i>
                    <span class="d-sm-inline d-none">Logout</span>
                </a>
                </li>
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                    <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                    </div>
                </a>
                </li>
                <li class="nav-item px-3 d-flex align-items-center">
                </li>
                <li class="nav-item dropdown pe-2 d-flex align-items-center notifications">
                <a class="nav-link text-body p-0 notificationsTrigger" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-bell cursor-pointer"></i>
                    <span class="notificationsCount"></span>
                </a>
                <ul id="myUl" class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4 notificationList" aria-labelledby="dropdownMenuButton">
                    
                    
                </ul>
                </li>
            </ul>
            </div>
        </div>
    </nav>