<?php include 'includes/templates/header.php'; ?>

</head>

<body>
    <div class="direction mt-0">
        <div>
            <p>register</p>
        </div>
    </div>
    
    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-9 col-12">
                <form action="#" method="#">
                    <div class="form-floating mb-3">
                        <input required type="text" class="form-control" id="floatingInputGridFullName" required
                            name="name" placeholder="Full Name*">
                        <label for="floatingInputGridFullName">Full Name*</label>

                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInputEmail" required name="email"
                            placeholder="Email address*">
                        <label for="floatingInputEmail">Email address*</label>

                    </div>
                    <div class="row g-2">
                        <div class="col-md">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInputUserName" required
                                    name="username" placeholder="Username*">
                                <label for="floatingInputUserName">Username*</label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-floating mb-3">
                                <input type="tel" class="form-control" id="floatingInputGridPhoneNumber" required
                                    name="number" placeholder="Number*">
                                <label for="floatingInputGridPhoneNumber">Number*</label>


                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingInputPassword" required name="password"
                            placeholder="Password*">
                        <label for="floatingInputPassword">Password*</label>
                        <div>
                            <input type="checkbox" onclick="myFunction()" id="checkboxPass">
                            <label for="checkboxPass">Show Password</label>
                        </div>


                    </div>
                    <div>
                        <button type="submit"
                            class="btn btn-danger rounded-pill w-100 fw-bold text-uppercase">register</button>
                    </div>
                </form>
                <p class="text-center mt-4">Have an account ? <a href="login">Login now </a></p>
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