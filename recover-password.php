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
                <form action="recover-password" method="POST">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInputEmail" name="email" placeholder="Email address" required>
                        <label for="floatingInputEmail">Email address</label>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-danger rounded-pill w-100 fw-bold text-uppercase">Reset password</button>
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