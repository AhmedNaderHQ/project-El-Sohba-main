<?php include 'includes/templates/header.php'; ?>

</head>

<body>

    <?php
    include 'includes/templates/nav-bar.php';
    ?>
    

    <div class="directionIntroduction">
        <div>
            <p>Welcome Ahmed Abdullah</p>
        </div>
    </div>

    <div class="container mt-5 pt-5 pb-5">
        <div class="row">
            <div class="col-md-6 mt-3">
                <a href="your-courses.php" style="color: #000;" aria-label="page order">
                    <div class="card" style="background-color: #fff0; border: 1px solid rgb(0, 0, 0);">
                        <div class="card-body p-5">
                            <h5 class="card-title"><i class="fa-solid fa-clipboard-list"></i> Your courses</h5>
                            <p class="card-text mt-3">Courses registered for on the website</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6 mt-3">
                <a href="information.php" style="color: #000;" aria-label="information page">
                    <div class="card" style="background-color: #fff0; border: 1px solid rgb(0, 0, 0);">
                        <div class="card-body p-5">
                            <h5 class="card-title"><i class="fa-solid fa-user-gear"></i> your information</h5>
                            <p class="card-text mt-3">All your data to edit.</p>
                        </div>
                    </div>
                </a>
            </div>

        </div>
        <div>
            <button type="button" class="btn btn-danger mt-3 me-auto" style="text-transform: uppercase;font-weight: bold;" aria-label="Delete account" data-bs-toggle="modal" data-bs-target=".deleteAccountModel">Deleting an account <i class="fa-solid fa-trash"></i></button>
            <!-- Modal -->
            <div class="modal fade deleteAccountModel" tabindex="-1" role="dialog" aria-labelledby="deleteAccountModelLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteAccountModelLabel" style="text-transform:capitalize">Deleting an account</h5>
                            <button type="button" class="btn-close btnCloseOrder" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <span class="text-danger" style="font-size: 25px;">Are you sure you want to delete your account?!</span>
                            <p class="text-danger" style="font-size: 18px;">*PS: All your information and orders will be deleted.</p>
                        </div>
                        <div class="modal-footer">
                            <a href="deleteAccount" aria-label="yas delete"><button type="button" class="btn btn-danger">Yes</button></a>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <?php
    include 'includes/templates/footer.php';
    include 'includes/templates/footer-script.php';
    ?>
</body>

</html>