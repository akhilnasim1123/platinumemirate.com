<footer class="footer-section footer-bg">
    <div class="container">
        <div class="footer-padding">
            <div class="row justify-content-between">
                
                <div class="col-lg-6  border-end">
                   <div class="footer-logo-div py-3 py-lg-4">
                          <div class="">
                            <img src="https://platinumemirate.com/assets/img/logo/Logo-Platinum.svg?v=3.2" alt="" class="footer-logo">
                         </div>
                   
                        <div class="footer-social-div">
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
                   
                   <div class="row border-top py-4">
                        <div class="col-12 col-lg-6">
                            <div class="footer-detail-div">
                                <div class="footer-loc-icon">
                                    <span> <i class="bi bi-geo-alt-fill"></i></span>
                                </div>
                                <div>
                                <p class="mb-0" style="white-space: pre;"><?php echo $address ?>
                                </p>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="col-12 col-lg-6 mt-3 mt-lg-0">
                            <div class="footer-detail-div">
                                <div class="footer-loc-icon">
                                    <span> <i class="bi bi-telephone-fill"></i></span>
                                </div>
                                <div class="footer-loc-div">
                                    <a href="tel:<?php echo str_replace(" ", "", trim($phone_number1)) ?>"
                                        target="_blank"><?php echo $phone_number1 ?></a>
                                    <?php
                                    if ($phone_number2) {
                                        ?>
                                        <a href="tel:<?php echo str_replace(" ", "", trim($phone_number2)) ?>"
                                            target="_blank"><?php echo $phone_number2 ?></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
        
                        <div class="col-12 col-lg-6 mt-3">
                            <div class="footer-detail-div">
                                <div class="footer-loc-icon">
                                    <span> <i class="bi bi-envelope-fill"></i></span>
        
                                </div>
                                <div class="footer-loc-div">
                                    <a href="mailto:<?php echo $email1 ?>" target=" _blank"><?php echo $email1 ?></a>
                                     <a href="www.platinumemirate.com" target=" _blank">www.platinumemirate.com</a>
                                    
                                </div>
                            </div>
                        </div>
                   </div>
                   
                </div>
                
             
             
             
              <div class="col-lg-6 ">
                   <div class="footer-logo-div py-3 py-lg-4">
                          <div class="">
                        <img src="https://platinumemirate.com/assets/img/logo/platoplus Logo.svg" alt="Logo" class="footer-logo">
                         </div>
                   
                        <div class="footer-social-div">
                                    <!--<a href="https://www.linkedin.com/" target="_blank"><i class="bi bi-linkedin"></i></a>-->
                             
                                    <!--<a href="https://instagram.com/" target="_blank"><i class="bi bi-instagram"></i></a>-->
                             
                                    <!--<a href="https://facebook.com/" target="_blank"><i class="bi bi-facebook"></i></a>-->
                             
                                    <!--<a href="https://twitter.com/" target="_blank"><i class="bi bi-twitter-x"></i></a>-->
                                
                                    <!--<a href="https://pinterest.com/" target="_blank"><i class="bi bi-pinterest"></i></a>-->
                           
                                    <!--<a href="https://youtube.com/" target="_blank"><i class="bi bi-youtube"></i></a>-->
                           </div>
                   </div> 
                   
                   <div class="row border-top py-4">
                        <div class="col-12 col-lg-6 ">
                            <div class="footer-detail-div">
                                <div class="footer-loc-icon">
                                    <span> <i class="bi bi-geo-alt-fill"></i></span>
                                </div>
                                <div>
                                <p class="mb-0">112, Al Murjan Tower <br class="d-none d-lg-block"> Dubai - UAE
                                </p>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="col-12 col-lg-6 mt-3 mt-lg-0">
                            <div class="footer-detail-div">
                                <div class="footer-loc-icon">
                                    <span> <i class="bi bi-telephone-fill"></i></span>
                                </div>
                                <div class="footer-loc-div">
                                    <a href="tel:+97148927955"
                                        target="_blank">+971 4 8927 955</a>
                                        <a href="" target="_blank"></a>
                                  
                                </div>
                            </div>
                        </div>
        
                        <div class="col-12 col-lg-6 mt-3">
                            <div class="footer-detail-div">
                                <div class="footer-loc-icon">
                                    <span> <i class="bi bi-envelope-fill"></i></span>
        
                                </div>
                                <div class="footer-loc-div">
                                    <a href="mailto:info@platinumemirate.com" target=" _blank">info@platinumemirate.com</a>
                                     <a href="https://www.platinumemirate.com" target="_blank"> www.platinumemirate.com</a>
                             
                                </div>
                            </div>
                        </div>
                   </div>
                   
                </div>
        
               


                <div class="col-12 col-lg-6 border-top border-end py-3 py-lg-4">
                    <div class="footer-by">
                        
                          <p class="m-0 fw-normal">
                                Copyright © <span id="current_year"></span>
                                <span class="fw-bold">Platinum Interiors LLC</span>
                            </p>
                    </div>
                </div>
                 <div class="col-12 col-lg-6 border-top py-3 py-lg-4">
                    <div class="footer-by d-flex justify-content-center justify-content-lg-end">
                          <p class="m-0 fw-normal">Developed by
                                <a href="https://trickydot.com/" target="_blank" class="text-dark fw-bold">TrickyDot
                                    Technologies Pvt. Ltd.</a>
                            </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</footer>