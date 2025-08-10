<?php include 'includes/templates/header.php'; ?>

</head>

<body>

    <div class="direction mt-0">
        <div>
            <p>Questions to help you</p>
        </div>
    </div>
    <div class="container mt-5 ">
        <div class="row d-flex justify-content-center">
            <div class="col-md-9 col-12">
                <form action="#" method="#">
                    <div class="mb-3">
                        <h3>What is your goal from the platform?</h3>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefaultGoalPlatform"
                                id="flexRadioDefaultSecondLanguage">
                            <label class="form-check-label" for="flexRadioDefaultSecondLanguage">
                                Learn a second language
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefaultGoalPlatform"
                                id="flexRadioDefaultSoftware">
                            <label class="form-check-label" for="flexRadioDefaultSoftware">
                                Learn software
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefaultGoalPlatform"
                                id="flexRadioDefaultHardware">
                            <label class="form-check-label" for="flexRadioDefaultHardware">
                                Learn hardware
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <h3>Choose the type of second language</h3>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefaultSecondLang"
                                id="flexRadioDefaultEnglish">
                            <label class="form-check-label" for="flexRadioDefaultEnglish">
                                English
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefaultSecondLang"
                                id="flexRadioDefaultFrench">
                            <label class="form-check-label" for="flexRadioDefaultFrench">
                                French
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <h3>How far have you progressed in this language?</h3>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefaultProgressed"
                                id="flexRadioDefaultBeginner">
                            <label class="form-check-label" for="flexRadioDefaultBeginner">
                                Beginner
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefaultProgressed"
                                id="flexRadioDefaultExpert">
                            <label class="form-check-label" for="flexRadioDefaultExpert">
                                Expert
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <h3>What do you want to learn the basics?</h3>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefaultBasics"
                                id="flexRadioDefaultJS">
                            <label class="form-check-label" for="flexRadioDefaultJS">
                                JS
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefaultBasics"
                                id="flexRadioDefaultPHP">
                            <label class="form-check-label" for="flexRadioDefaultPHP">
                                PHP
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefaultBasics"
                                id="flexRadioDefaultPython">
                            <label class="form-check-label" for="flexRadioDefaultPython">
                                python
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <h3>What did you learn before?</h3>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefaultHTML">
                            <label class="form-check-label" for="flexCheckDefaultHTML">
                                HTML
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckCheckedCSS">
                            <label class="form-check-label" for="flexCheckCheckedCSS">
                                CSS
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckCheckedPython">
                            <label class="form-check-label" for="flexCheckCheckedPython">
                                Python
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckCheckedFrontEnd">
                            <label class="form-check-label" for="flexCheckCheckedFrontEnd">
                                Front End
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <h3>What field have you worked in before or what field of work do you intend to work in?</h3>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="CheckDefaultFrontEnd">
                            <label class="form-check-label" for="CheckDefaultFrontEnd">
                                Front End
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="CheckDefaultBackEnd">
                            <label class="form-check-label" for="CheckDefaultBackEnd">
                                Back End
                            </label>
                        </div>
                        
                    </div>

                    <div>
                        <button type="submit"
                            class="btn btn-danger rounded-pill w-100 fw-bold text-uppercase">Submit</button>
                    </div>
                </form>
                <div class="p-1 Copyright text-center mt-3">
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