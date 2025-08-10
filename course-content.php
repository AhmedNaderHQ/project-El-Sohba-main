<?php include 'includes/templates/header.php'; ?>

</head>

<body>

    <?php
        include 'includes/templates/nav-bar.php';
    ?>



    <div class="directionIntroduction">
        <div>
            <p>front end</p>
        </div>
    </div>

    <div class="container mt-5 courseContent">
        <p style="font-size: 1.1rem;">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Molestiae error doloribus reprehenderit, maiores reiciendis nemo nihil accusantium! Minima, similique nulla totam, esse sequi, quibusdam commodi aperiam illum repellat inventore voluptatum! Lorem, ipsum dolor sit amet consectetur adipisicing elit. Magnam, blanditiis culpa. Commodi rerum harum, adipisci laudantium, pariatur eum officia eius dignissimos libero placeat perspiciatis. Sunt ab explicabo ratione laudantium id.</p>
        <div class="row row-cols-1 row-cols-md-5 g-4">
            <div class="col">
                <div class="card">
                    <a href="#">
                        <div class="card-body text-center">
                            <p class="mb-0 ">HTML</p>
                        </div>
                        <span class="badge bg-danger">1</span>
                        <span class="badge bg-light text-dark"><i class="fas fa-lock-open"></i></span>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card bg-danger ">
                    <a href="#">
                        <div class="card-body text-center">
                            <p class="mb-0 text-uppercase">quiz</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card disabled">
                    <a href="#">
                        <div class="card-body text-center">
                            <p class="mb-0 ">CSS</p>
                        </div>
                        <span class="badge bg-danger">2</span>
                        <span class="badge bg-light text-dark"><i class="fas fa-lock"></i></span>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="card bg-danger disabled">
                    <a href="#">
                        <div class="card-body text-center">
                            <p class="mb-0 text-uppercase">quiz</p>
                        </div>
                        <span class="badge bg-light text-dark"><i class="fas fa-lock"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </div>












    <?php
    include 'includes/templates/footer.php';
    include 'includes/templates/footer-script.php';
    ?>

    <!-- Start of REVE Chat Script-->
    <script type='text/javascript'>
        window.$_REVECHAT_API || (function(d, w) {
            var r = $_REVECHAT_API = function(c) {
                r._.push(c);
            };
            w.__revechat_account = '3831249';
            w.__revechat_version = 2;
            r._ = [];
            var rc = d.createElement('script');
            rc.type = 'text/javascript';
            rc.async = true;
            rc.setAttribute('charset', 'utf-8');
            rc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'static.revechat.com' + '/widget/scripts/new-livechat.js?' + new Date().getTime();
            var s = d.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(rc, s);
        })(document, window);
    </script>
    <!-- End of REVE Chat Script -->
</body>

</html>