<?php include 'includes/templates/header.php'; ?>

</head>

<body>
    <div class="direction mt-0">
        <div>
            <p>VERIFY YOUR EMAIL</p>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <p class="text-center mb-3" style="font-size: 1.3rem;">Please enter the code</p>
            <div class="col-md-9 col-12">
                <form action="verification" method="POST">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <div class="form-floating mb-3">
                        <input type="tel" class="form-control" id="floatingInputGridFullName" placeholder="Enter the code" pattern="[0-9]{4}" maxlength="4" minlength="4" name="verificationCode" required>
                        <label for="floatingInputGridFullName">Enter the code</label>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-warning rounded-pill w-100 fw-bold text-uppercase">Verification</button>
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