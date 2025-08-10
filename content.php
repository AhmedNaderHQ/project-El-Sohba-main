<?php include 'includes/templates/header.php'; ?>
</head>

<body>

    <?php
    include 'includes/templates/nav-bar.php';
    ?>



    <div class="directionIntroduction">
        <div>
            <p>Contact US</p>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <form action="#" method="#">
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input required type="text" class="form-control" id="floatingInputGridFullName" required name="name" placeholder="Full Name*">
                            <label for="floatingInputGridFullName">Name*</label>

                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="tel" class="form-control" id="floatingInputGridTopic" required placeholder="Topic">
                            <label for="floatingInputGridTopic">Topic</label>
                        </div>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingInputEmail" required name="email" placeholder="Email address*">
                    <label for="floatingInputEmail">Email address*</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Comments" id="floatingTextareaComments" style="height: 145px;"></textarea>
                    <label for="floatingTextareaComments">Comments</label>
                </div>
                <div>
                    <button type="submit" class="btn btn-warning rounded-pill float-end fw-bold text-uppercase">Send</button>
                </div>
            </form>

        </div>
    </div>



    <?php
    include 'includes/templates/footer.php';
    include 'includes/templates/footer-script.php';
    ?>
</body>

</html>