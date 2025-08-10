<?php include 'includes/templates/header.php'; ?>

</head>

<body>

    <div class="direction mt-0">
        <div>
            <p>login </p>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-9 col-12">
                <form action="#" method="#">


                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInputUserName" required name="username"
                            placeholder="Username*">
                        <label for="floatingInputUserName">Username*</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingInputPassword" required name="password"
                            placeholder="Password*">
                        <label for="floatingInputPassword">Password*</label>
                        <a href="#" class="text-muted">forget password</a>
                        <div>
                            <input type="checkbox" onclick="myFunction()" id="checkboxPass">
                            <label for="checkboxPass">Show Password</label>
                        </div>


                    </div>
                    <div>
                        <button type="submit"
                            class="btn btn-danger rounded-pill w-100 fw-bold text-uppercase">Login</button>
                    </div>
                </form>
                <p class="text-center mt-4">I do not have an account ? <a href="register.php">register now </a></p>
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