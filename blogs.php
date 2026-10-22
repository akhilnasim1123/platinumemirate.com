<!DOCTYPE html>
<html lang="en">

<head>

    <?php include 'assets/contents/style.php' ?>

    <title>BLOGS - PLATINUM INTERIORS LLC</title>

</head>

<body>
    <?php include 'assets/contents/nav.php' ?>
    <!---------------------------------------------------------------------------------->

    <section class="service-section">
        <div class="container p-top">
            <div class="d-padding">
                <div class="blog-div-head">
                    <h5 class="text-theme sub-head">[OUR RECENT BLOGS]</h5>
                    <!--<h3 class="main-head">Human Mind Is Changing Each Second and Thereby <span class="text-theme">Ideas and Designs</span></h3>-->
                    <h3 class="main-head text-upper">Platinum Perspectives: <br> <span class="text-theme"> Trends, Tips, and Inspiration</span></h3>

                </div>
                <?php
    $query = "select * from tbl_blogs order by id DESC";
    $result = mysqli_query($con, $query);
    $count = mysqli_num_rows($result);
    if ($count > 0) {
    ?>
                <div class="row">
                    <?php

                    $slno = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row["id"];
                        $author = $row["author"];
                        $img = $row["cover_img"];
                        $title = $row["title"];
                        $date = $row["date"];
                        $keyword = $row["keyword"];
                        $short_desc = $row["short_desc"];
                        $description = $row["description"];
                        $slno++;
                        if ($slno == 1) {
                            ?>

                            <div class="col-12 mt-3" data-aos="fade-right">
                                <div class="blog-div">
                                    <a href="https://platinumemirate.com/blog/<?php echo $keyword ?>"><img
                                            src="https://platinumemirate.com/assets/img/blogs/<?php echo $id ?>/cover/<?php echo $img ?>"
                                            class="blog-image" alt=""></a>

                                    <div class="blog-contant-div">
                                        <div class="blog-person-div">
                                            <div class="blog-person-detail">
                                                <!-- <img src="assets/img/blog/pexels-stefanstefancik-91227.jpg"
                                            class="blog-person-img" alt=""> -->
                                                <div class="blog-date-name">
                                                    <span><?php echo $date ?></span>
                                                    <i class="bi bi-dot"></i>
                                                    <p><?php echo $author ?></p>
                                                </div>
                                            </div>
                                            <div class="blog-share-div">
                                                <!--<span>Cusomization Case Study</span>-->
                                                <a href="https://www.addtoany.com/share#url=https://platinumemirate.com/blog/<?php echo $keyword ?>&title=*<?php echo strip_tags($title) ?>*%0a%0a<?php echo strip_tags($short_desc) ?>%0a%0aRead More👇%0a%0a"
                                                    target="_blank"><img src="assets/img/blog/share.png" alt=""></a>
                                            </div>
                                        </div>
                                        <a href="https://platinumemirate.com/blog/<?php echo $keyword ?>">
                                            <div class="blog-content-head">
                                                <h3><?php echo $title ?>
                                                </h3>
                                                <p><?php echo $short_desc ?></p>
                                            </div>
                                        </a>

                                    </div>
                                </div>
                            </div>


                            <div class="col-12 mt-3">
                                <div>
                                    <hr>
                                </div>
                            </div>

                        <?php } else { ?>

                            <div class="col-12 col-md-6 col-lg-4 mt-3"  data-aos="zoom-in">
                                <div class="blog-div-two">
                                    <a href="https://platinumemirate.com/blog/<?php echo $keyword ?>" class="blog-div-two-image">
                                        <img src="https://platinumemirate.com/assets/img/blogs/<?php echo $id ?>/cover/<?php echo $img ?>"
                                            alt="">
                                    </a>
                                    <div class="row mt-3">
                                        <div class="col-10">
                                            <a href="https://platinumemirate.com/blog/<?php echo $keyword ?>">
                                                    <div class="blog-content-head-two">
                                                        <div class="blog-date-name-two">
                                                            <p class="mb-0"><?php echo $author ?></p>
                                                            <i class="bi bi-dot"></i>
                                                            <span><?php echo $date ?></span>
                                                        </div>
                                                        <h5><?php echo $title ?></h5>
                                                        
                                                        <?php
                                                        $maxLength = 100; 
                                                    
                                                        if (strlen($short_desc) > $maxLength) {
                                                            $truncated_desc = substr($short_desc, 0, $maxLength) . '...';
                                                            echo "<p>$truncated_desc <span  class='text-theme'>more</span></p>";
                                                        } else {
                                                            echo "<p>$short_desc</p>";
                                                        }
                                                        ?>
                                                    </div>
                                            </a>
                                        </div>
                                        <div class="col-2 ps-0 ps-lg-2">
                                            <div class="blog-share-div-two">
                                                <a href="https://www.addtoany.com/share#url=https://platinumemirate.com/blog/<?php echo $keyword ?>&title=*<?php echo strip_tags($title) ?>*%0a%0a<?php echo strip_tags($short_desc) ?>%0a%0aRead More👇%0a%0a"
                                                    target="_blank"><img src="assets/img/blog/share.png" alt=""></a>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        <?php }
                    } ?>
                </div>
    
    <?php } else {?>
                
                <div class="row justify-content-center align-items-center p-2" style="height: 50vh;">
                <div class="text-center not-found">
                    <span class="text-theme ">No Blogs Found</span>
                </div>
                </div>
            <?php }?>
            </div>
        </div>

    </section>

    <?php include 'assets/contents/footer.php' ?>
    <?php include 'assets/contents/scripts.php' ?>

    <script>
        changeNav('blogs-nav')
    </script>

</body>

</html>