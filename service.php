<!DOCTYPE html>
<html lang="en">

<head>
    
    <?php include 'assets/contents/style.php' ?>

    <title>SERVICES - PLATINUM INTERIORS LLC</title>

</head>

<body>
    <?php include 'assets/contents/nav.php' ?>
            <section class="service-banner-section">
        <img src="https://platinumemirate.com/assets/img/home/service-banner-img.jpg" class="service-banner-image" alt="">
        <div class="service-banner-head-div">
            <span class="service-sub span-size">OUR SERVICES FOR YOU</span>
            <h1 class="fw-bold mb-0 text-upper head-size">Exceptional designs, tailored to <span class="text-theme">bring your vision to life!</span> </h1>
        </div>
    </section>
    
    <section class="service-section">
        <div class="container">
            <div class="d-padding">
                <div class="row justify-content-center">
                <?php
                    $query = "
                        SELECT * 
                        FROM tbl_services
                        ORDER BY FIELD(title, 
                            'Design and Build',
                            'Fit Out',
                            'Joinery & Carpentary Works',
                            'Customised Interior Decors',
                            'Gypsum Works',
                            'Upholstery and Soft Furnishing',
                            'Metal Fabrication and Glassworks',
                            'Gypsum Partitions and Ceiling',
                            'Theme Painting'
                        )";
                
                    $result = mysqli_query($con, $query) or die(mysqli_error($con));
                
                    $slno = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row["id"];
                        $title = $row["title"];
                        $img = $row["img"];
                        $desc = $row["description"];
                        $slno++;
                ?>
                    <div class="col-12 col-md-6 col-xxl-3 mt-3"  data-aos="zoom-in">
                        <div class="service-div">
                            <img src="https://platinumemirate.com/assets/img/services/<?php echo $id ?>/<?php echo $img ?>" alt="">
                            <h5 class="text-theme"><?php echo $title ?></h5>
                            <p><?php echo $desc ?></p>
                        </div>
                    </div>
                <?php } ?>

                </div>
            </div>
        </div>

    </section>

 <?php include 'assets/contents/footer.php' ?>
 <?php include 'assets/contents/scripts.php' ?>

 <script>
    changeNav('service-nav')
 </script>

</body>

</html>