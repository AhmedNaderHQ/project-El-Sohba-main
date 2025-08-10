

    <?php 
        include 'includes/templates/header.php';
    ?>
</head>

<body>

    <?php
    include 'includes/templates/nav-bar.php';
    ?>




    <div class="directionIntroduction">
        <div>
            <p>your courses</p>
        </div>
    </div>
    <div class="container mb-5 courses mt-5">
        <div class="row row-cols-1 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 g-3">
            <div class="col course col-xsm-6">
                <div class="card">
                    <a href="#">
                        <img src="layout/images/course.png" class="card-img-top" alt="...">
                    </a>
                    <div class="card-body titleCourses">
                        <a href="#" class="text-white">
                            <p class="text-center nameCourses">Name Courses</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col course col-xsm-6">
                <div class="card">
                    <a href="#">
                        <img src="layout/images/course.png" class="card-img-top" alt="...">
                    </a>
                    <div class="card-body titleCourses">
                        <a href="#" class="text-white">
                            <p class="text-center nameCourses">Name Courses</p>
                        </a>
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