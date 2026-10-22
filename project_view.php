<!DOCTYPE html>
<html lang="en">

<head>
    
    <?php include 'assets/contents/style.php' ?>
   <?php

if (isset($_GET['project'])) {

    // Sanitize input
    $project = trim($_GET['project']);

    // First query (project)
    $stmt = $con->prepare("SELECT * FROM tbl_projects WHERE keyword = ?");
    $stmt->bind_param("s", $project);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {

        $title = htmlspecialchars($row["title"], ENT_QUOTES, 'UTF-8');
        $id = htmlspecialchars($row["id"], ENT_QUOTES, 'UTF-8');
        $cover_img = htmlspecialchars($row["cover_img"], ENT_QUOTES, 'UTF-8');
        $cover_alt = htmlspecialchars($row["cover_alt"], ENT_QUOTES, 'UTF-8');
        $category = (int)$row["category"]; // force integer
        $location = htmlspecialchars($row["location"], ENT_QUOTES, 'UTF-8');
        $description = $row["description"]; // keep raw if HTML
        $keyword = htmlspecialchars($row["keyword"], ENT_QUOTES, 'UTF-8');

        // Second query (category)
        $cat_stmt = $con->prepare("SELECT * FROM tbl_categories WHERE id = ?");
        $cat_stmt->bind_param("i", $category);
        $cat_stmt->execute();
        $category_result = $cat_stmt->get_result();

        if ($category_row = $category_result->fetch_assoc()) {
            $category_name = htmlspecialchars($category_row["title"], ENT_QUOTES, 'UTF-8');
        }

        $cat_stmt->close();

    } else {
        echo "Project not found.";
    }

    $stmt->close();
}

?>
    <title><?php echo $title ?> - PLATINUM INTERIORS LLC</title>

    <style>
        .pagination a {
            display: inline-block;
            padding: 8px 16px;
            text-decoration: none;
            color: #333;
            border: 1px solid #ddd;
            margin: 0 4px;
            color: #C29300;
            border-color: #C29300;
        }
    
        .pagination a.active {
            background-color: #C29300;
            color: white;
            border-color: #C29300;
        }
    
        .pagination a:hover {
            background-color: #E0A800;
            color: white;
        }
    </style>

</head>

<body>
    <?php include 'assets/contents/nav.php' ?>
    <section class="project-view-section">
        <div class="container p-top">
            <div class="d-padding">
                <div class="project-view-head-div" data-aos="fade-right">
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <div class="project-view-head">
                                <div class="project-view-back">
                                    <a href="https://platinumemirate.com/portfolio">PROJECTS</a>
                                    <i class="bi bi-dot"></i>
                                    <span><?php echo $title ?></span>
                                </div>
                                <h2 class="mb-0"><?php echo $title ?></h2>
                                <span><?php echo $category_name ?></span>
                            </div>
                            <div class="project-view-para mt-2">
                                <h5>Project Description:</h5>
                                <p class="para"><?php echo $description ?></p>
                              <div class="location">
                                 <h5>Project Location:</h5>
                                 <p class="d-none d-md-block mb-0"><?php echo $location ?></p>
                                <h5 class="d-block d-md-none"><span class="text-theme fw-bold"><?php echo $location ?></span></h5>
                              </div>
                           
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="project-view-image">
                                <img src="https://platinumemirate.com/assets/img/projects/<?php echo $id ?>/<?php echo $cover_img ?>" alt="<?php echo $cover_alt ?>">

                            </div>
                        </div>
                    </div>
                </div>

              <?php
                    $imagesPerPage = 10;
                    
                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $offset = ($page - 1) * $imagesPerPage;
                    
                    $totalImagesResult = mysqli_query($con, "SELECT COUNT(*) as total FROM tbl_project_img WHERE pid='$id'");
                    $totalImagesRow = mysqli_fetch_assoc($totalImagesResult);
                    $totalImages = $totalImagesRow['total'];
                    $totalPages = ceil($totalImages / $imagesPerPage);
                    
                    $isql = "SELECT * FROM tbl_project_img WHERE pid='$id' LIMIT $offset, $imagesPerPage";
                    $irun = mysqli_query($con, $isql);
                    ?>
                    
                    <div class="project-view-gallery">
                        <div id="static-thumbnails">
                            <?php while ($irow = mysqli_fetch_array($irun)) { 
                                $iimg = $irow['img'];
                                $ialt = $irow['img_alt'];
                            ?>
                                <a href="https://platinumemirate.com/assets/img/projects/<?php echo $id ?>/<?php echo $iimg ?>">
                                    <img src="https://platinumemirate.com/assets/img/projects/<?php echo $id ?>/<?php echo $iimg ?>?v=2" alt="<?php echo $ialt ?>"  loading="lazy"/>
                                </a>
                            <?php } ?>
                        </div>
                    
                        <?php if ($totalPages > 1): ?>
                            <div class="pagination justify-content-center mt-5">
                                <?php if ($page > 1): ?>
                                    <a href="?page=<?php echo $page - 1; ?>">Previous</a>
                                <?php endif; ?>
                    
                                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                    <a href="?page=<?php echo $i; ?>" <?php if ($i == $page) echo 'class="active"'; ?>><?php echo $i; ?></a>
                                <?php endfor; ?>
                    
                                <?php if ($page < $totalPages): ?>
                                    <a href="?page=<?php echo $page + 1; ?>">Next</a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>




                
                
                
            </div>

        </div>

    </section>

    
    <?php include 'assets/contents/footer.php' ?>
    <?php include 'assets/contents/scripts.php' ?>


    <script>
        lightGalleryFun()
        changeNav('portfolio-nav')
    </script>

</body>

</html>