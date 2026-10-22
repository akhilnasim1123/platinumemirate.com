<?php
include("assets/includes/db.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include("assets/css/style.php");
    ?>

    <title>Edit Category | Platinum Interiors LLC</title>
    <style>
        #cImage,
        #vImage,
        .image-div {
            padding: 10px 27px;
            border: 1px dashed;
        }

        .image-div img {
            height: 75px;
            width: 100px;
            border-radius: 6px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <?php include("assets/content/navbar.php") ?>
    <section class="home">
        <div class="text">
            <div class="admin-card mt-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-11">
                                <h4 class="card-title ms-0 fw-bold mt-2">EDIT CATEGORY</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            if (isset($_GET["error"])) {
            ?>
                <div class="alert alert-danger text-center mt-2" role="alert">
                    <?php
                    $error = $_GET["error"];
                    echo $error;
                    ?>
                </div>

            <?php
            } else if (isset($_GET["success"])) {
            ?>
                <div class="alert alert-success text-center mt-2" role="alert">
                    <?php
                    $error = $_GET["success"];
                    echo $error;
                    ?>
                </div>
            <?php } ?>

            <?php
            $id = $_POST["id"];
            $sql = "select * from tbl_categories where id='$id'";
            $run = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($run);

            $title = $row["title"];
            ?>

            <form method="post" action="assets/functions/functions.php" enctype="multipart/form-data">
                <div class="card custom-card-2 mt-2">
                    <div class="card-body p-4 data-table">
                        <div class="row">
                            <div class="col-md-12" id="home_content">
                                <div class="row">
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label" for="home_title">Title :</label>
                                        <input type="text" class="form-control form-control-sm" name="title" id="home_title" value="<?php echo $title ?>" placeholder="Enter Title" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?php echo$id ?>">
                        <button type="submit" class="btn btn-success float-end w-100" id="submit" name="update_category" style="background-color:#fbb13b; border:none;">SUBMIT</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <?php include("assets/content/script.php"); ?>
    <script>
        changeNav("categories-nav");
        
    
    </script>
</body>

</html>