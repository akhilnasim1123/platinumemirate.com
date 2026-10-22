<?php
include("assets/includes/db.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include("assets/css/style.php");
    ?>

    <title>Edit Service | Platinum Interiors LLC</title>
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
        }#cImage img{
            filter:brightness(0);
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
                                <h4 class="card-title ms-0 fw-bold mt-2">EDIT SERVICE</h4>
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
            $sql = "select * from tbl_services where id='$id'";
            $run = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($run);

            $img = $row["img"];
            $img_alt = $row["img_alt"];
            $title = $row["title"];
            $desc = $row["description"];
            ?>

            <form method="post" action="assets/functions/functions.php" enctype="multipart/form-data">
                <div class="card custom-card-2 mt-2">
                    <div class="card-body p-4 data-table">
                        <div class="row">
                            <div class="mb-3 col-12 col-md-12">
                                <label class="form-label" for="image">Icon:</label>
                                <input type="file" class="form-control form-control-sm" name="img" id="image" accept="image/png, image/gif, image/jpeg, image/webp">


                                <div id="cImage" class="altImg mt-3">
                                    <div class="row">
                                        <div class="col-12 text-end">
                                            <button class="btn btn-sm btn-danger br-0" style="border-radius:0px" type="button" onclick="removeImage(this,'image')">Remove</button>
                                        </div>
                                        <div class="col-md-4 text-end">
                                            <img src="../assets/img/services/<?php echo $id ?>/<?php echo $img ?>" width="50" class="float-end">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="image">Alt :</label>
                                            <input type="text" class="form-control form-control-sm" value="<?php echo $img_alt ?>" name='alt'>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-12" id="home_content">
                                <div class="row">
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label" for="home_title">Title :</label>
                                        <input type="text" class="form-control form-control-sm" name="title" id="home_title" value="<?php echo $title ?>" placeholder="Enter Title" required>
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label" for="description">Description :</label>
                                        <textarea name="description" id="description" class="form-control form-control-sm" placeholder="Enter description" rows="4" required><?php echo $desc ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?php echo$id ?>">
                        <input type="hidden" name="old_img" value="<?php echo $img ?>">
                        <button type="submit" class="btn btn-success float-end w-100" id="submit" name="update_service" style="background-color:#fbb13b; border:none;">SUBMIT</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <?php include("assets/content/script.php"); ?>
    <script>
        function removeImage(button, input) {

            $(button).parents('.altImg').addClass('d-none')
            $(button).parents('.altImg').find('input').val('')
            $('#' + input).val('')

        }

        changeNav("services-nav");
        
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