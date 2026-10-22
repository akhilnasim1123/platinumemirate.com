<?php
include("assets/includes/db.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include("assets/css/style.php");
    ?>

    <title>Add Testimonial | Platinum Interiors LLC</title>
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
                                <h4 class="card-title ms-0 fw-bold mt-2">ADD TESTIMONIAL</h4>
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

            <div class="card custom-card-2 mt-2">
                <div class="card-body p-4">
                    <form method="post" action="assets/functions/functions.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label" for="title">Name :</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter the Name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="title">Designation :</label>
                            <input type="text" class="form-control" name="designation" id="designation" placeholder="Enter the Designation" >
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="description">Description :</label>
                            <textarea name="description" id="description" rows="4" class="form-control" placeholder="Enter the Description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="image">Image :</label>
                            <input type="file" class="form-control" name="img" id="image" accept="image/png, image/gif, image/jpeg, image/webp">
                            <div id="cImage" class="d-none mt-3">
                                <div class="row">
                                    <div class="col-md-4 text-end">
                                        <img src="" width="50" class="float-end">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="image">Alt :</label>
                                        <input type="text" class="form-control form-control-sm" name='alt1'>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn float-end w-100" name="add_testimonial" style="background-color:#fbb13b;">SUBMIT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php include("assets/content/script.php"); ?>
    <script>
        changeNav("testimonial-nav");
        $('#image').on('change', function() {
            var file = this.files[0];

            if (file) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#cImage').find('img').attr('src', e.target.result);
                    $('#cImage').removeClass('d-none');
                }

                reader.readAsDataURL(file);
            } else {
                $('#cImage').addClass('d-none');
            }
        });
    </script>
</body>

</html>