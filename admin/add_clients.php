<?php
include("assets/includes/db.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("assets/css/style.php");
    ?>
    <title>Clients | Platinum Interiors LLC</title>
</head>

<body>
    <?php include("assets/content/navbar.php") ?>
    <section class="home">
        <div class="text">
            <div class="card custom-card-2">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <h5 class="mb-0 fw-bold">Clients</h5>
                </div>
            </div>
            <div class=""></div>
            <div class="card custom-card-2 mt-2">
                <div class="card-body p-4">
                    <form method="post" action="assets/functions/functions.php" enctype="multipart/form-data">
                        <div class="mb-3 col-12 col-md-12">
                            <div>
                                <div class="row justify-content-center mb-3 ms-2" id="imageAppendDiv">
                                    <div class="mb-3 col-12 col-md-8 image-div">
                                        <div class="row justify-content-center w-100 mb-3">
                                            <div class="col-md-10">
                                                <label class="form-label" for="">Image :</label>
                                                <input type="file" class="form-control form-control-sm image-input"
                                                    name="images[]" multiple onchange="imageChange(this)">
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-sm btn-danger mt-1 w-100 mt-4"
                                                    onclick="deleteImage(this)"><i class="bi bi-x"></i></button>
                                            </div>
                                        </div>

                                        <div class="images col-12 d-none mt-3">
                                            <div class="row">
                                                <div class="col-md-4 text-end">
                                                    <img src="" width="50" class="float-end">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label" for="image">Alt :</label>
                                                    <input type="text" class="form-control form-control-sm"
                                                        name='alt[]'>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 text-center">
                                    <button type="button" class="btn btn-success btn-sm" onclick="addImage()">Add
                                        Image</button>
                                </div>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-theme float-end" name="add_clients">SUBMIT</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php include("assets/content/script.php"); ?>
    <script>
        changeNav("clients-nav");
        function addImage() {
            var imageDiv = `
                                         <div class="mb-3 col-12 col-md-8 image-div ms-2">
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
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];

                    if (file) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            var imgPreview = `<div class="col-12 mt-2">
                    <div class="row">
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
    </script>
</body>

</html>