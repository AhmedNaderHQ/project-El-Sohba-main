<?php include 'includes/templates/header.php'; ?>

</head>

<body>
    <div class="direction mt-0">
        <div>
            <p>Reset password</p>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-9 col-12">
                <form action="reset-password" method="POST">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" minlength="8" required name="newPassword" id="floatingInputPassword" placeholder="New Password">
                        <label for="floatingInputPassword">New Password</label>
                        <div>
                            <input type="checkbox" onclick="myFunction()" id="checkboxPass">
                            <label for="checkboxPass">Show Password</label>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-danger rounded-pill w-100 fw-bold text-uppercase">reset password</button>
                    </div>
                </form>
                <div class="p-1 Copyright text-center">
                    <p>© 2023 El-Sohba All Rights Reserved.</p>
                </div>
            </div>

        </div>
    </div>





    <?php
    include 'includes/templates/footer-script.php';
    ?>
</body>

</html>