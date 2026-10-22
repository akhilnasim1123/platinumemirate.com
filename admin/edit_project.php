<?php
include("assets/includes/db.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include("assets/css/style.php");
    ?>

    <title>Edit Project | Platinum Interiors LLC</title>
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
                                <h4 class="card-title ms-0 fw-bold mt-2">EDIT PROJECT</h4>
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
            $query = "select * from tbl_projects where id='$id'";
            $result = mysqli_query($con, $query);
            $slno = 0;
            $row = mysqli_fetch_assoc($result);
            $title = $row["title"];
            $cover_img = $row["cover_img"];
            $cover_alt = $row["cover_alt"];
            $category = $row["category"];
            $location = $row["location"];
            $description = $row["description"];
            $keyword = $row["keyword"];
            ?>

            <form method="post" action="assets/functions/functions.php" enctype="multipart/form-data">
                <div class="card custom-card-2 mt-2">
                    <div class="card-body p-4 data-table">
                        <div class="row">
                            <div class="mb-3 col-12 col-md-12">
                                <label class="form-label" for="image">Cover Image:</label>
                                <input type="file" class="form-control form-control-sm" name="img" id="image" accept="image/png, image/gif, image/jpeg, image/webp">


                                <div id="cImage" class="altImg mt-3">
                                    <div class="row">
                                        <div class="col-12 text-end">
                                            <button class="btn btn-sm btn-danger br-0" style="border-radius:0px" type="button" onclick="removeImage(this,'image')">Remove</button>
                                        </div>
                                        <div class="col-md-4 text-end">
                                            <img src="../assets/img/projects/<?php echo $id ?>/<?php echo $cover_img ?>" width="50" class="float-end">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="image">Alt :</label>
                                            <input type="text" class="form-control form-control-sm" name='cover_alt' value="<?php echo $cover_alt ?>">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-12" id="home_content">
                                <div class="row">
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label" for="home_title">Title :</label>
                                        <input type="text" class="form-control form-control-sm" name="title" id="title" placeholder="Enter Title" value="<?php echo $title ?>" required>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="category">Category :</label>
                                        <select name="category" id="category" class="form-control form-control-sm" required>
                                            <option value="" selected>Select Category</option>
                                            <?php

                                            $sel_cat = "select * from tbl_categories order by id DESC";
                                            $run_cat = mysqli_query($con, $sel_cat);
                                            while ($row_cat = mysqli_fetch_array($run_cat)) {
                                                echo "<option value='$row_cat[id]'>$row_cat[title]</option>";
                                            }

                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="location">Location :</label>
                                        <input type="text" class="form-control form-control-sm" name="location" id="location" placeholder="Enter Location" value="<?php echo $location ?>" required>
                                    </div>
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label" for="description">Description :</label>
                                        <textarea class="form-control form-control-sm" rows="5" name="description" id="description" placeholder="Enter Description" required><?php echo $description ?></textarea>
                                    </div>

                                    <div class="divider w-100"></div>

                                    <div class="col-12 mb-3">
                                        <h6 class="text-start px-3 py-2 text-white bg-dark fw-bold mb-3 width-100 text-center">More Photos</h6>
                                        <div class="row justify-content-center mb-3 ms-2" id="imageAppendDiv">
                                            <?php
                                            $isql = "SELECT * FROM tbl_project_img WHERE pid='$id'";
                                            $irun = mysqli_query($con, $isql);
                                            while ($irow = mysqli_fetch_array($irun)) {
                                                $iimg = $irow['img'];
                                                $ialt = $irow['img_alt'];
                                            ?>
                                                <div class="mb-3 col-12 col-md-7 col-xl-7 ms-3 image-div">
                                                    <div class="row justify-content-center w-100 mb-3">
                                                        <div class="col-md-10">
                                                            <label class="form-label" for="">Image :</label>
                                                            <input type="file" class="form-control form-control-sm image-input" name="images[]" multiple onchange="imageChange(this)">
                                                            <input type="hidden" class="form-control form-control-sm image-input" name="old_images[]" value="<?php echo $iimg ?>">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <button type="button" class="btn btn-sm btn-danger mt-1 w-100 mt-4" onclick="deleteImage(this)"><i class="bi bi-x"></i></button>
                                                        </div>
                                                    </div>

                                                    <div class="images col-12 mt-3">
                                                        <div class="row">
                                                            <div class="col-md-4 text-end">
                                                                <img src="../assets/img/projects/<?php echo $id ?>/<?php echo $iimg ?>" width="50" class="float-end">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label" for="image">Alt :</label>
                                                                <input type="text" class="form-control form-control-sm" name='alt[]' value="<?php echo $ialt ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="mb-3 text-center">
                                            <button type="button" class="btn btn-success btn-sm" onclick="addImage()">Add Image</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <input type="hidden" value="<?php echo $id ?>" name="id">
                        <input type="hidden" value="<?php echo $cover_img ?>" name="old_cover">
                        <button type="submit" class="btn btn-success float-end w-100" id="submit" name="update_project" style="background-color:#fbb13b; border:none;">SUBMIT</button>
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

        changeNav("projects-nav");

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

        function addImage() {
            var imageDiv = `
                                         <div class="mb-3 col-12 col-md-7 image-div ms-2">
                                            <div class="row justify-content-center w-100 mb-3">
                                            <div class="col-md-10">
                                                <label class="form-label" for="">Image :</label>
                                                <input type="file" class="form-control form-control-sm image-input"  name="images[]" multiple  onchange="imageChange(this)">
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-sm btn-danger mt-1 w-100 mt-4" onclick="deleteImage(this)"><i class="bi bi-x"></i></button>
                                            </div>
                                        </div>
                                        
                                        <div class="images col-12 d-none mt-3">
                                            <div class="row">
                                                <div class="col-md-4 text-end">
                                                    <img src="" width="50" class="float-end">
                                                </div>
                                                 <div class="col-md-6">
                                                     <label class="form-label" for="">Alt :</label>
                                                    <input type="text" class="form-control form-control-sm" name='alt[]'>
                                                </div>
                                            </div>
                                            
                                        </div>
                                </div>
         `
            $('#imageAppendDiv').append(imageDiv)
        }

        function deleteImage(button) {
            $(button).parents('.image-div').remove()
        }

        function imageChange(input) {
    var files = input.files;
    var $input = $(input);
    var $imageDiv = $input.parents('.image-div').find('.images');

    // Clear any existing preview images
    $imageDiv.empty();

    if (files.length > 0) {
        // Loop through each file
        for (var i = 0; i < files.length; i++) {
            var file = files[i];

            if (file) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var imgPreview = `<div class="col-12 mt-2">
                        <div class="row align-items-center">
                            <div class="col-md-4 text-end">
                                <img src="${e.target.result}" width="50" class="float-end">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="">Alt :</label>
                                <input type="text" class="form-control form-control-sm" name='alt[]'>
                            </div>
                        </div>
                    </div>`;

                    $imageDiv.append(imgPreview);
                    $imageDiv.removeClass('d-none');
                };

                reader.readAsDataURL(file);
            }
        }
    } else {
        $imageDiv.addClass('d-none');
    }
}

// Function to remove a specific image preview
function removeImage(button) {
    $(button).closest('.col-12.mt-2').remove(); // Remove the image preview div
}


        $("#category").val('<?php echo $category ?>');
    </script>
</body>

</html>