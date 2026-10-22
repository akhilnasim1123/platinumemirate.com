<?php
 session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    
    <?php include 'assets/contents/style.php' ?>
    

    <title>CONTACT US - PLATINUM INTERIORS LLC</title>
</head>

<body>
    <?php include 'assets/contents/nav.php' ?>
    <section class="contact-section">
        <img src="assets/img/contact/contact-img-platinum.png?v=2" class="contact-banner-image" alt="">
        <div class="contact-banner-head">
            <span data-aos="fade-down" class="span-size">GET IN TOUCH WITH PLATINUM INTERIORS LLC</span>
            <h1 data-aos="fade-right" class="fw-bold mb-0 text-upper head-size">
                
                We are here to assist you: <spa class="text-theme">Contact us</spa>
            </h1>
                <p class="d-none d-md-block" data-aos="zoom-in">
                    
                    Connect with our team of experts who are eager to turn your vision into reality. Whether it's innovative designs, precise planning, or seamless execution, we’re here to guide you through every step. Reach out today and let’s get started on creating something remarkable together.
                </p>
        </div>

    </section>

    <!-------------------------------------------------------------------------------->
    <section>
        <div class="container">
            <div class="d-padding">
                <div class="row">
                    <div class="col-12 mb-5"  data-aos="fade-right">
                        <div class="contact-ads-div col-lg-7">
                            <h5 class="sub-head">[CONNECT WITH PLATINUM INTERIORS LLC]</h5>
                            <h3 class="text-upper"><spa class="text-theme">Reach Out to Us</spa> - We Are All Ready With a Saga of Ideas for You! Call Us and Book Your Personal Enquiry</h3>
                            <p>
                          To find the best interiors, just message us, call or request a call back. You can meet us in mail or at our office to make the most pleasing interiors for your space.</p>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-6 mt-4">
                                
                           <div class="contact-details">
                            <h4>Connection Details</h4>
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

                           <div class="contact-social">
                            <h4>Social Media Connections</h4>
                            <div class="contact-social-icons" data-aos="zoom-in">
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
                            
                              <div class="col-lg-6 mt-4">
                                
                           <div class="contact-details">
                            <h4>Connection Details</h4>
                            <div class="location">
                                <div class="icon">
                                    <span><i class="bi bi-geo-alt-fill"></i></span>
                                </div>
                                <div class="details">
                                    <p class="mb-0" style="">112, Al Murjan Tower <br class="d-none d-lg-block"> Dubai - UAE
                                    </p>
                                </div>
                            </div>
                            <div class="location">
                                <div class="icon">
                                    <span><i class="bi bi-envelope-fill"></i></span>
                                </div>
                                <div class="details">
                                    <a href="mailto:info@platoplus.ae"
                                        target=" _blank">info@platoplus.ae</a>
                                   
                                </div>
                            </div>
                            <div class="location">
                                <div class="icon">
                                    <span><i class="bi bi-telephone-fill"></i></span>
                                </div>
                                <div class="details">
                                    <a href="tel:+97148927955" target="_blank">+971 4 8927 955</a>
                                 
                                </div>
                            </div>
                           </div>

                          <!-- <div class="contact-social">-->
                          <!--  <h4>Social Media Connections</h4>-->
                          <!--  <div class="contact-social-icons" data-aos="zoom-in">-->
                          <!--      <a href="https://www.linkedin.com/" target="_blank"><i class="bi bi-linkedin"></i></a>-->
            
                          <!--      <a href="https://instagram.com/" target="_blank"><i class="bi bi-instagram"></i></a>-->
                           
                          <!--      <a href="https://facebook.com/" target="_blank"><i class="bi bi-facebook"></i></a>-->
                         
                          <!--      <a href="https://twitter.com/" target="_blank"><i class="bi bi-twitter-x"></i></a>-->
             
                          <!--      <a href="https://pinterest.com/" target="_blank"><i class="bi bi-pinterest"></i></a>-->
                            
                          <!--      <a href="https://youtube.com/" target="_blank"><i class="bi bi-youtube"></i></a>-->
                          <!--  </div>-->
                          <!--</div>-->
                            </div>
                            
                            
                        </div>

                    </div>

                    <div class="col-lg-6 mt-4">
                        <div class="contact-form-div">
                            <h4>Enquiry Form</h4>
                            <p>Please fill the form below and request a call from us to enquire about all your concerns and work inquiries.</p>
                            <form method="post" action="assets/function/function.php">
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="name" aria-describedby="name"
                                        placeholder="What is your Full Name ?" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control" id="Email" aria-describedby="emailHelp"
                                        placeholder="What is your Email Address ?" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <input type="number" class="form-control" id="number" aria-describedby="number"
                                        placeholder="What is your Phone number ?" name="phone" required>
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control" id="exampleFormControlTextarea1"
                                        placeholder="How can i help you ?" name="message" required></textarea>
                                </div>
                             
                                      <div class="col-md-6 my-2">
                                         <div class="recap-div">
                                            <!-- Google reCAPTCHA -->
                                            <div class="g-recaptcha"
                                                data-sitekey="6LflcS8sAAAAAK1GFkP8eKMa3Fk02o2X7QxHRqEj"
                                                data-callback="enableBtn"></div>
                                        </div>
                                </div>
                                <button type="submit" name="contact" class="btn" id="submitButton" disabled>Submit</button>
                            </form>
                        </div>

                    </div>
                    
                     <div class="col-lg-6 mt-0 mt-lg-4">
                       <div class="row h-100">
                           <div class="col-lg-6 mt-4 mt-lg-0">
                                <div class="contact-map">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3604.7235151834334!2d55.474020476212495!3d25.38058122424703!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f586472ad71df%3A0x862d395468563e40!2sPlatinum%20Interiors%20LLC!5e0!3m2!1sen!2sin!4v1729489625893!5m2!1sen!2sin"
                                        style="border:0;" allowfullscreen="" loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div> 
                           </div>
                           
                             <div class="col-lg-6 mt-4 mt-lg-0 ">
                                <div class="contact-map">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3607.186968198644!2d55.37898277621059!3d25.29792162761208!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f5d0668c85f7f%3A0x1d28520a82ef5117!2sPlatoplus%20Design%20%26%20Fitout%20LLC!5e0!3m2!1sen!2sin!4v1749729995373!5m2!1sen!2sin" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div> 
                           </div>
                       </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-------------------------------------------------------------------------------->

    
    <?php include 'assets/contents/footer.php' ?>
    <?php include 'assets/contents/scripts.php' ?>

        <?php

if (isset($_SESSION['success'])) { ?>
    <script>
        toastFun("<?php echo $_SESSION['success'] ?>")
    </script>
<?php
    // unset($_SESSION['success']);
} else if (isset($_SESSION['error'])) { ?>
    <script>
        toastError("<?php echo $_SESSION['error'] ?>")
    </script>
<?php } ?>
    <script>
        changeNav('none')
    </script>
</body>

</html>