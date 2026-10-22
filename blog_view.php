<!DOCTYPE html>
<html lang="en">

<head>
    
    <?php include 'assets/contents/style.php' ?>
   
   <?php

if (isset($_GET['blog'])) {

    // Sanitize input
    $blog_keyword = trim($_GET['blog']);

    // Prepare statement
    $stmt = $con->prepare("SELECT * FROM tbl_blogs WHERE keyword = ?");
    $stmt->bind_param("s", $blog_keyword);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {

        $cover_img = htmlspecialchars($row["cover_img"], ENT_QUOTES, 'UTF-8');
        $cover_alt = htmlspecialchars($row["cover_alt"], ENT_QUOTES, 'UTF-8');
        $title = htmlspecialchars($row["title"], ENT_QUOTES, 'UTF-8');
        $id = htmlspecialchars($row["id"], ENT_QUOTES, 'UTF-8');
        $author = htmlspecialchars($row["author"], ENT_QUOTES, 'UTF-8');
        $short_desc = htmlspecialchars($row["short_desc"], ENT_QUOTES, 'UTF-8');
        $blog_desc = $row["description"]; // keep raw if it contains HTML
        $view_img = htmlspecialchars($row["view_img"], ENT_QUOTES, 'UTF-8');
        $view_alt = htmlspecialchars($row["view_alt"], ENT_QUOTES, 'UTF-8');
        $blog_date = htmlspecialchars($row["date"], ENT_QUOTES, 'UTF-8');
        $keyword = htmlspecialchars($row["keyword"], ENT_QUOTES, 'UTF-8');

    } else {
        echo "Blog not found.";
    }

    $stmt->close();
}

?>
    <title><?php echo $title ?> - PLATINUM INTERIORS LLC</title>

</head>

<body>
    <?php include 'assets/contents/nav.php' ?>
    <section class="blog-view-section">
        <div class="container p-top">
            <div class="d-padding">
                <div class="row">
                    <div class="col-12 col-lg-8"  data-aos="fade-right">
                        <div class="blog-view-head">
                            <div class="blog-view-back">
                                <a href="https://platinumemirate.com/" class="text-dark">HOME</a>
                                <i class="bi bi-dot text-theme"></i>
                                <a href="https://platinumemirate.com/blogs" class="text-theme">BLOGS</a>
                            </div>
                            <h3 class="text-upper"> <span class="text-theme"><?php echo $title ?></h3>
                            <p><?php echo $short_desc ?></p>

                        </div>
                    </div>

                    <div class="col-12 col-lg-4">
                        <div class="blog-view-name-share">
                            <div class="blog-view-date-name-two">
                                <span><?php echo $blog_date ?></span>
                                <i class="bi bi-dot"></i>
                                <p class="mb-0"><?php echo $author ?></p>
                            </div>
                            <a data-aos="zoom-in" href="https://www.addtoany.com/share#url=https://platinumemirate.com/blog/<?php echo $keyword ?>&title=*<?php echo strip_tags($title) ?>*%0a%0a<?php echo strip_tags($short_desc) ?>%0a%0aRead More👇%0a%0a" target="_blank"><img src="https://platinumemirate.com/assets/img/blog/share.png" alt=""></a>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="blog-view-image" data-aos="flip-up">
                            <img src="https://platinumemirate.com/assets/img/blogs/<?php echo $id ?>/<?php echo $view_img ?>" alt="">
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="blog-view-content-div">
                            <p><?php echo $blog_desc ?></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>

    <?php include 'assets/contents/footer.php' ?>
    <?php include 'assets/contents/scripts.php' ?>

</body>

</html>