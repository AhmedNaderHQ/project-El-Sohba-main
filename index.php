<?php include 'includes/templates/header.php'; ?>
</head>

<body>

    <?php
    include 'includes/templates/nav-bar.php';
    ?>





    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="layout/images/carousel2.png" class="d-block w-100" alt="..." />
            </div>
            <div class="carousel-item">
                <img src="layout/images/carousel3.png" class="d-block w-100" alt="..." />
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-5 col-md-6 col-12">
                <img style="width: 100%; height: 100%" src="layout/images/El-sohba2.png" alt="" />
            </div>
            <div class="col-lg-7 col-md-6 col-12">
                <h2 class="text-uppercase fw-bold">About El-Sohba</h2>
                <p>
                    E-learning platforms and roadmaps for different fields provide
                    opportunities for individuals to develop skills and achieve their
                    professional goals. They are powerful tools that enable
                    individuals to guide their learning and progress in their preferred
                    career path, with a diverse range of resources and field-specific
                    guidance available. <a href="about.php" class="text-danger">Read more.....</a>
                </p>
            </div>
        </div>
    </div>
    <div class="container mt-5 courses">
        <h2 class="text-uppercase fw-bold text-center mb-4">Course content</h2>
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
                    <span class="badge bg-danger">Free Course</span>
                    <span class="badge bg-dark text-white languageCourses">English</span>
                </div>
            </div>
            <div class="col course col-xsm-6">
                <div class="card">
                    <a href="#">
                        <img src="layout/images/course2.png" class="card-img-top" alt="...">
                    </a>
                    <div class="card-body titleCourses">
                        <a href="#" class="text-white">
                            <p class="text-center nameCourses">Name Courses</p>
                        </a>
                    </div>

                    <span class="badge bg-danger">Free Course</span>
                    <span class="badge bg-dark text-white languageCourses">English</span>
                </div>
            </div>
            <div class="col course col-xsm-6">
                <div class="card">
                    <a href="#">
                        <img src="layout/images/course2.png" class="card-img-top" alt="...">
                    </a>
                    <div class="card-body titleCourses">
                        <a href="#" class="text-white">
                            <p class="text-center nameCourses">Name Courses</p>
                        </a>
                    </div>

                    <span class="badge bg-danger">Free Course</span>
                    <span class="badge bg-dark text-white languageCourses">English</span>
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

                    <span class="badge bg-danger">Free Course</span>
                    <span class="badge bg-dark text-white languageCourses">English</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5 ourTeam">
        <h2 class="text-uppercase fw-bold text-center mb-4">our team</h2>
        <div class="row">
            <div class="row row-cols-1 row-cols-lg-5 row-cols-md-4 row-cols-sm-2  g-3">
                <div class="col">
                    <div class="card member">
                        <img src="layout/images/AhmedIsmail.png" class="card-img-top rounded-circle p-3" alt="...">
                        <div class="card-body ps-0 pe-0">
                            <h5 class="card-title text-center text-capitalize fw-bold">Ahmed Ismail</h5>
                            <div class="socialMember text-center">
                                <a href="https://www.linkedin.com/in/ahmed-ismail-a03185255/" target="_blank"><i class="fab fa-linkedin"></i></a>
                                <a href="https://github.com/AhmedMohIsmail" target="_blank"><i class="fa-brands fa-github"></i></a>
                                <a href="https://www.facebook.com/profile.php?id=100055979297555&locale=ar_AR" target="_blank"><i class="fab fa-facebook"></i></a>
                            </div>
                        </div>
                        <div style="position: absolute;top: -4px;">
                            <span class="badge bg-danger">Project Manager</span>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card member">
                        <img src="layout/images/AhmedAbdullah.jpeg" class="card-img-top rounded-circle p-3" alt="...">
                        <div class="card-body ps-0 pe-0">
                            <h5 class="card-title text-center text-capitalize fw-bold">Ahmed Abdullah</h5>
                            <div class="socialMember text-center">
                                <a href="https://www.facebook.com/profile.php?id=100082720839872&mibextid=ZbWKwL" target="_blank" title="facebook"><i class="fa-brands fa-facebook"></i>
                                </a>
                                <a href="https://www.linkedin.com/in/ahmed-abdullah-877981244" target="_blank" title="linkedin"><i class="fa-brands fa-linkedin"></i></i></a>
                                <a href="https://twitter.com/AhmedAb01841812?t=K03ubODQp_HQjdLXEtH_uw&s=09" target="_blank" title="twitter"><i class="fa-brands fa-twitter"></i>
                                </a>

                            </div>
                        </div>
                        <div style="position: absolute;top: -4px;">
                            <span class="badge bg-danger">Development</span>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card member">
                        <img src="layout/images/mazen.jpeg" class="card-img-top rounded-circle p-3" alt="...">
                        <div class="card-body ps-0 pe-0">
                            <h5 class="card-title text-center text-capitalize fw-bold">Mazen Alasas</h5>
                            <div class="socialMember text-center">
                                <a target="_blank" href="https://www.linkedin.com/in/mazen-ahmed-772831244/"><i class="fab fa-linkedin"></i></a>
                                <a target="_blank" href="https://www.facebook.com/maznalsas"><i class="fab fa-facebook"></i></a>
                                <a target="_blank" href="https://github.com/mazen-alasas"><i class="fa-brands fa-github"></i></a>
                            </div>
                        </div>
                        <div style="position: absolute;top: -4px;">
                            <span class="badge bg-danger">System Designer</span>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card member">
                        <img src="layout/images/AbdelrahmanRefaat.jpg" class="card-img-top rounded-circle p-3" alt="...">
                        <div class="card-body ps-0 pe-0">
                            <h5 class="card-title text-center text-capitalize fw-bold">Abdelrahman Refaat</h5>
                            <div class="socialMember text-center">
                                <a target="_blank" href="https://www.linkedin.com/in/abdelrahman-elgamal-b5b8832a3/"><i class="fab fa-linkedin"></i></a>
                                <a target="_blank" href="https://github.com/AbdoElgamal"><i class="fa-brands fa-github"></i></a>
                                <a target="_blank" href="https://twitter.com/abdoo3423"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                        <div style="position: absolute;top: -4px;">
                            <span class="badge bg-danger">System Designer</span>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card member">
                        <img src="layout/images/AhmedNader.jpg" class="card-img-top rounded-circle p-3" alt="...">
                        <div class="card-body ps-0 pe-0">
                            <h5 class="card-title text-center text-capitalize fw-bold">Ahmed Nader</h5>
                            <div class="socialMember text-center">
                                <a target="_blank" href="https://www.facebook.com/profile.php?id=100054814093633&mibextid=ZbWKwL"><i class="fab fa-facebook"></i></a>
                                <a target="_blank" href="https://www.linkedin.com/in/ahmed-nader-8a0a2529a?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app"><i class="fab fa-linkedin"></i></a>
                                <a target="_blank" href="https://github.com/AhmedNaderHQ"><i class="fa-brands fa-github"></i></a>
                            </div>
                        </div>
                        <div style="position: absolute;top: -4px;">
                            <span class="badge bg-danger">Development</span>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card member">
                        <img src="layout/images/AbdulrahmanMohamed.png" class="card-img-top rounded-circle p-3" alt="...">
                        <div class="card-body ps-0 pe-0">
                            <h5 class="card-title text-center text-capitalize fw-bold">Abdulrahman Mohamed</h5>
                            <div class="socialMember text-center">
                                <a target="_blank" href="https://www.linkedin.com/in/abdo-saad-7a4b932a2/"><i class="fab fa-linkedin"></i></a>
                                <a target="_blank" href="https://web.facebook.com/profile.php?id=100067104798039"><i class="fab fa-facebook"></i></a>
                            </div>
                        </div>
                        <div style="position: absolute;top: -4px;">
                            <span class="badge bg-danger">System Analyst</span>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card member">
                        <img src="layout/images/ZiadMohamed.jpg" class="card-img-top rounded-circle p-3" alt="...">
                        <div class="card-body ps-0 pe-0">
                            <h5 class="card-title text-center text-capitalize fw-bold">Ziad Mohamed</h5>
                            <div class="socialMember text-center">
                                <a target="_blank" href="https://www.linkedin.com/in/ziad-mohamed-759a73240?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app"><i class="fab fa-linkedin"></i></a>
                                <a target="_blank" href="https://www.facebook.com/ziiadmohamedtaha?mibextid=9R9pXO"><i class="fab fa-facebook"></i></a>
                                <a target="_blank" href="https://x.com/ziadtahaaa?t=WDjLHAIjMuPEZBqt8P64gg&s=09"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                        <div style="position: absolute;top: -4px;">
                            <span class="badge bg-danger">System Analyst</span>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card member">
                        <img src="layout/images/AhmedElsherbiny.jpg" class="card-img-top rounded-circle p-3" alt="...">
                        <div class="card-body ps-0 pe-0">
                            <h5 class="card-title text-center text-capitalize fw-bold">Ahmed Elsherbiny</h5>
                            <div class="socialMember text-center">
                                <a target="_blank" href="https://www.linkedin.com/in/ahmed-elsherbiny-/"><i class="fab fa-linkedin"></i></a>
                                <a target="_blank" href="https://www.facebook.com/profile.php?id=100085563128384"><i class="fab fa-facebook"></i></a>
                                <a target="_blank" href="https://github.com/AhmedElsherbiny2"><i class="fa-brands fa-github"></i></a>
                            </div>
                        </div>
                        <div style="position: absolute;top: -4px;">
                            <span class="badge bg-danger">Development</span>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card member">
                        <img src="layout/images/AbdulrahmanAziz.jpg" class="card-img-top rounded-circle p-3" alt="...">
                        <div class="card-body ps-0 pe-0">
                            <h5 class="card-title text-center text-capitalize fw-bold">Abdulrahman Adel</h5>
                            <div class="socialMember text-center">
                                <a target="_blank" href="https://eg.linkedin.com/in/abdulrahman-abdelazez-36808020a"><i class="fab fa-linkedin"></i></a>
                                <a target="_blank" href="https://www.facebook.com/aboda.adel.12?mibextid=GoaLI4isD9cHbeUg"><i class="fab fa-facebook"></i></a>
                                <a target="_blank" href="https://twitter.com/Abdo_3ziiz"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                        <div style="position: absolute;top: -4px;">
                            <span class="badge bg-danger">Development</span>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card member">
                        <img src="layout/images/AbdulrahmanElmahdy.png" class="card-img-top rounded-circle p-3" alt="...">
                        <div class="card-body ps-0 pe-0">
                            <h5 class="card-title text-center text-capitalize fw-bold">Abdulrahman Elmahdy</h5>
                            <div class="socialMember text-center">
                                <a target="_blank" href="https://www.facebook.com/profile.php?id=100058236901493&mibextid=ZbWKwL"><i class="fab fa-facebook"></i></a>
                            </div>
                        </div>
                        <div style="position: absolute;top: -4px;">
                            <span class="badge bg-danger">System Designer</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="container mt-5">
        <h2 class="text-uppercase fw-bold text-center mb-4">Contact us</h2>
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