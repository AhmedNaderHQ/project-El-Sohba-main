<?php include 'includes/templates/header.php'; ?>

</head>

<body>

    <?php
        include 'includes/templates/nav-bar.php';
    ?>


    <div class="directionIntroduction">
        <div>
            <p>HTML</p>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <p style="font-size: 1.1rem;">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Molestiae error
                doloribus reprehenderit, maiores reiciendis nemo nihil accusantium! Minima, similique nulla totam, esse
                sequi, quibusdam commodi aperiam illum repellat inventore voluptatum! Lorem, ipsum dolor sit amet
                consectetur adipisicing elit. Magnam, blanditiis culpa. Commodi rerum harum, adipisci laudantium,
                pariatur eum officia eius dignissimos libero placeat perspiciatis. Sunt ab explicabo ratione laudantium
                id.</p>
            <div class="col-12 d-block d-md-none">
                <div class="card">
                    <a class="courseWeeks active" href="">
                        <div class="card-body">
                            First Month
                        </div>
                    </a>
                </div>
                <div class="card">
                    <a class="courseWeeks" href="">
                        <div class="card-body">
                            First Month
                        </div>
                    </a>
                </div>
                <div class="card">
                    <a class="courseWeeks" href="">
                        <div class="card-body">
                            First Month
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-12 col-lg-8 col-md-8 mt-md-0 mt-3">
                <div class="card bg-danger">
                    <div class="card-body fw-bold text-uppercase fs-3">
                        First Month
                    </div>
                </div>
                <div class="card contactWeeks">
                    <div class="card-body">
                        <p class="mb-1">Introduction and What I Need To Learn</p>
                        <a href="#" class="text-danger">Watch Video</a>
                    </div>
                </div>
                <div class="card contactWeeks">
                    <div class="card-body">
                        <p class="mb-1">Introduction and What I Need To Learn</p>
                        <a href="#" class="text-danger">Watch Video</a>
                    </div>
                </div>
                <div class="card contactWeeks">
                    <div class="card-body">
                        <p class="mb-1">Introduction and What I Need To Learn</p>
                        <a href="#" class="text-danger">Watch Video</a>
                    </div>
                </div>
                <div class="card contactWeeks">
                    <div class="card-body">
                        <p class="mb-1">Introduction and What I Need To Learn</p>
                        <a href="#" class="text-danger">Watch Video</a>
                    </div>
                </div>
            </div>
            <div class="col-3 d-none d-md-block coursesWeeks" id="coursesWeeks">
                <div class="card">
                    <a class="courseWeeks active" href="">
                        <div class="card-body">
                            First Month
                        </div>
                    </a>
                </div>
                <div class="card">
                    <a class="courseWeeks" href="">
                        <div class="card-body">
                            First Month
                        </div>
                    </a>
                </div>
                <div class="card">
                    <a class="courseWeeks" href="">
                        <div class="card-body">
                            First Month
                        </div>
                    </a>
                </div>


            </div>
        </div>
    </div>


    <div class="container mt-5">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled me-auto">
                    <a class="page-link">Previous</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>


    <?php
    include 'includes/templates/footer.php';
    include 'includes/templates/footer-script.php';
    ?>

</body>

</html>