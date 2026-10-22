<div class="website-quick-links">
        <a href="https://platinumemirate.com/contact" target="_blank"><i class="bi bi-headset"></i></a>
       <a href="https://wa.me/<?php echo str_replace(' ', '', $wa); ?>" target="_blank"><i class="bi bi-whatsapp"></i></a>

    </div>
    <nav class="navbar-top fixed-top d-none d-lg-block nav-logo-div">
        <div class="container nav-container">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <a href="https://platinumemirate.com/" class="navbar-brand "><img src="https://platinumemirate.com/assets/img/logo/Logo-Platinum.svg?v=3.1" class="company-logo" /></a>
                    </div>
                    <div class="col-12 col-md-6 d-flex gap-3 align-items-center justify-content-end">
                        <div class="nav-social-div">
                        <?php if ($linked_in) { ?>
                                <a href="https://www.linkedin.com/<?php echo $linked_in; ?>" target="_blank"><i class="bi bi-linkedin"></i></a>
                            <?php } ?>

                            <?php if ($instagram) { ?>
                                <a href="https://instagram.com/<?php echo $instagram; ?>" target="_blank"><i class="bi bi-instagram"></i></a>
                            <?php } ?>

                            <?php if ($facebook) { ?>
                                <a href="https://facebook.com/<?php echo $facebook; ?>" target="_blank"><i class="bi bi-facebook"></i></a>
                            <?php } ?>

                            <?php if ($twitter) { ?>
                                <a href="https://twitter.com/<?php echo $twitter; ?>" target="_blank"><i class="bi bi-twitter-x"></i></a>
                            <?php } ?>

                            <?php if ($pinterest) { ?>
                                <a href="https://pinterest.com/<?php echo $pinterest; ?>" target="_blank"><i class="bi bi-pinterest"></i></a>
                            <?php } ?>

                            <?php if ($youtube) { ?>
                                <a href="https://youtube.com/<?php echo $youtube; ?>" target="_blank"><i class="bi bi-youtube"></i></a>
                            <?php } ?>
                        </div>
                        <div class="nav-contact">
                            <a href="https://platinumemirate.com/contact"><i class="bi bi-telephone-fill"></i> CONTACT US</a>
                        </div>
                        <div>
                            <button class="btn" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                <i class="bi bi-grip-horizontal"></i>
                            </button>
                        </div>

                    </div>
                </div>
            <!-- <div class="nav-items-link"> -->
                <div class="nav-items-link collapse" id="collapseExample">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="card">
                                <ul class="navbar-nav ">
                                    <li class="nav-item">
                                        <a class="nav-link fw-500 text-theme" href="https://platinumemirate.com/"><i
                                                class="bi bi-arrow-right text-theme"></i> Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link fw-500 about-nav" href="https://platinumemirate.com/company" id="about-nav"><i
                                        class="bi bi-arrow-right text-theme d-none"></i>Company</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link fw-500 portfolio-nav" href="https://platinumemirate.com/portfolio" id="portfolio-nav"><i
                                        class="bi bi-arrow-right text-theme d-none"></i>Portfolio</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link fw-500 service-nav" href="https://platinumemirate.com/service" id="service-nav"><i
                                        class="bi bi-arrow-right text-theme d-none"></i>Service</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link fw-500 blogs-nav" href="https://platinumemirate.com/blogs" id="blogs-nav"><i
                                        class="bi bi-arrow-right text-theme d-none"></i>Blogs</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="nav-contact-details">
                                <div class="location">
                                    <div class="icon">
                                        <span><i class="bi bi-geo-alt-fill"></i></span>
                                    </div>
                                    <div class="details">
                                        <p class="mb-0" style="white-space: pre;"><?php echo $address ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="location">
                                <div class="icon">
                                    <span><i class="bi bi-envelope-fill"></i></span>
                                </div>
                                <div class="details">
                                    <a href="mailto:<?php echo $email1 ?>"
                                        target=" _blank"><?php echo $email1 ?></a>
                                        <?php 
                                        if ($email2){
                                         ?>
                                    <a href="mailto:<?php echo $email2 ?>"
                                        target=" _blank"><?php echo $email2 ?></a>
                                        <?php } ?>
                                </div>
                            </div>
                            <div class="location">
                                <div class="icon">
                                    <span><i class="bi bi-telephone-fill"></i></span>
                                </div>
                                <div class="details">
                                    <a href="tel:<?php echo str_replace(" ", "", trim($phone_number1)) ?>" target="_blank"><?php echo $phone_number1 ?></a>
                                    <?php 
                                        if ($phone_number2){
                                         ?>
                                    <a href="tel:<?php echo str_replace(" ", "", trim($phone_number2)) ?>" target="_blank"><?php echo $phone_number2 ?></a>
                                    <?php } ?>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>

                </div>
            <!-- </div> -->

        </div>
    </nav>
    <div class="navbar-top fixed-top d-block d-lg-none">
        <nav class="navbar navbar-expand-xl">
            <div class="container">
                <a href="https://platinumemirate.com/" class="navbar-brand"><img src="https://platinumemirate.com/assets/img/logo/Logo-Platinum.svg?v=3.1" class="company-logo" /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class=""><i class="bi bi-grip-horizontal"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav gap-2 align-items-center">
                        <li class="nav-item">
                            <a class="nav-link fw-500 text-theme home-nav" id="home-nav" href="https://platinumemirate.com/"><i
                                    class="bi bi-arrow-right text-theme"></i> Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-500 about-nav" href="https://platinumemirate.com/company" id="about-nav"><i
                            class="bi bi-arrow-right text-theme d-none"></i>Company</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-500 portfolio-nav" href="https://platinumemirate.com/portfolio"><i
                            class="bi bi-arrow-right text-theme d-none"></i>Portfolio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-500 service-nav" href="https://platinumemirate.com/service" id="service-nav"><i
                            class="bi bi-arrow-right text-theme d-none"></i>Service</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-500 blogs-nav" href="https://platinumemirate.com/blogs" id="blogs-nav"><i
                            class="bi bi-arrow-right text-theme d-none"></i>Blogs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-500" href="https://platinumemirate.com/contact" > Contact Us</a>
                        </li>
                    </ul>
                    <div class="nav-contact-div">
                        <div class="nav-social-div">
                        <?php if ($linked_in) { ?>
                                <a href="https://www.linkedin.com/<?php echo $linked_in; ?>" target="_blank"><i class="bi bi-linkedin"></i></a>
                            <?php } ?>

                            <?php if ($instagram) { ?>
                                <a href="https://instagram.com/<?php echo $instagram; ?>" target="_blank"><i class="bi bi-instagram"></i></a>
                            <?php } ?>

                            <?php if ($facebook) { ?>
                                <a href="https://facebook.com/<?php echo $facebook; ?>" target="_blank"><i class="bi bi-facebook"></i></a>
                            <?php } ?>

                            <?php if ($twitter) { ?>
                                <a href="https://twitter.com/<?php echo $twitter; ?>" target="_blank"><i class="bi bi-twitter-x"></i></a>
                            <?php } ?>

                            <?php if ($pinterest) { ?>
                                <a href="https://pinterest.com/<?php echo $pinterest; ?>" target="_blank"><i class="bi bi-pinterest"></i></a>
                            <?php } ?>

                            <?php if ($youtube) { ?>
                                <a href="https://youtube.com/<?php echo $youtube; ?>" target="_blank"><i class="bi bi-youtube"></i></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>