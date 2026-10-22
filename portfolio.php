<!DOCTYPE html>
<html lang="en">

<head>
    
    <?php include 'assets/contents/style.php' ?>

    <title>PORTFOLIO - PLATINUM INTERIORS LLC</title>

</head>

<body>
    <?php include 'assets/contents/nav.php' ?>
    <section class="project-section">
        <div class="container p-top">
            <div class="d-padding">
                <div class="team-head-div" data-aos="zoom-in">
                    <h5 class="sub-head">[OUR VALUABLE PROJECTS]</h5>
                    <h3 class="main-head text-upper">From Concept to completion: A showcase of   <br> Our Finest <span
                            class="text-theme">Works</span></h3>
                            <!--<p>Our works are the most excellent reflection pf ourselves. Explore our finest work we have done till date to know more about our creative ideas and works to make your choice of design to us. We provide you here with each and every parts of each project we have done.</p>-->

                </div>
                <?php
                            $query = "select * from tbl_projects order by id DESC";
                            $result = mysqli_query($con, $query);
                            if (mysqli_num_rows($result) > 0) {
                            ?>
                <div class="row">

                <?php
                            $slno = 0;
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row["id"];
                                $title = $row["title"];
                                $category = $row["category"];
                                $img = $row["cover_img"];
                                $keyword = $row["keyword"];
                                $category_sql = "select * from tbl_categories where id=$category";
                                $category_result = mysqli_query($con, $category_sql);
                                $category_row = mysqli_fetch_assoc($category_result);
                                $category_name = $category_row["title"];
                                $slno++;
                            ?>
                                <a href="https://platinumemirate.com/project/<?php echo $keyword ?>" class="col-12 col-lg-6 mt-3">
                                    <div class="project-div">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="Project-main-div">
                                                    <div class="project-div-head">
                                                        <h4 class="text-theme mb-0"><?php echo $title ?></h4>
                                                        <p><?php echo $category_name ?></p>
                                                    </div>
                                                    <div class="view-project-div">
                                                       <button><i class="bi bi-arrow-right"></i>View Project</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            $isql = "SELECT * FROM tbl_project_img WHERE pid='$id' limit 2";
                                            $irun = mysqli_query($con, $isql);
                                            while ($irow = mysqli_fetch_array($irun)) {
                                                $iimg = $irow['img'];
                                                $ialt = $irow['img_alt'];
                                            ?>
                                            <div class="col-12 col-md-6 mt-3">
                                                <div class="project-image">
                                                    <img src="https://platinumemirate.com/assets/img/projects/<?php echo $id ?>/<?php echo $iimg ?>" alt="" loading="lazy">
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </a>
                            <?php }?>

                </div>
                <?php } else {?>
                
                    <div class="row justify-content-center align-items-center p-2" style="height: 50vh;">
                    <div class="text-center not-found">
                        <span class="text-theme ">No Projects Found</span>
                    </div>
                    </div>
                <?php }?>
            </div>
        </div>

    </section>

  
    <?php include 'assets/contents/footer.php' ?>
    <?php include 'assets/contents/scripts.php' ?>
    <script>
        
        changeNav('portfolio-nav')
    </script>

</body>

</html>