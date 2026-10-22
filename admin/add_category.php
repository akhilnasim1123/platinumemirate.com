<?php
include("assets/includes/db.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include("assets/css/style.php");
    ?>

    <title>Add Category | Platinum Interiors LLC</title>
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
                                <h4 class="card-title ms-0 fw-bold mt-2">ADD CATEGORY</h4>
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

            <form method="post" action="assets/functions/functions.php" enctype="multipart/form-data">
                <div class="card custom-card-2 mt-2">
                    <div class="card-body p-4">
                        <div class="row justify-content-center">
                            <div class="col-md-8" id="home_content">
                                <div class="row align-items-center">
                                    <div class="mb-3 col-md-10">
                                        <label class="form-label" for="home_title">Category :</label>
                                        <input type="text" class="form-control form-control-sm" name="title[]"
                                            id="home_title" placeholder="Enter Category Name" required>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <button type="button" class="btn btn-success btn-sm w-100 mt-3"
                                            onclick="addCategory()">Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success float-end w-100" id="submit" name="add_category"
                            style="background-color:#fbb13b; border:none;">SUBMIT</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <?php include("assets/content/script.php"); ?>
    <script>


        changeNav("categories-nav");
        function addCategory() {
            var row = `
                                    <div class="row align-items-center">
                                    <div class="mb-3 col-md-10">
                                        <label class="form-label" for="home_title">Category :</label>
                                        <input type="text" class="form-control form-control-sm" name="title[]" id="home_title" placeholder="Enter Category Name" required>
                                    </div>
                                    <div class="mb-3 col-2">
                                        <button type="button" class="btn btn-danger btn-sm w-100 mt-3 " onclick="removeCategory(this)">Remove</button>
                                    </div>
                                </div>
            `;
            
        $('#home_content').append(row)
        }

        function removeCategory(btn) {
            $(btn).parent().parent().remove();
        }

    </script>
</body>

</html>