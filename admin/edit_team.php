<?php
include("assets/includes/db.php");

$id = $_POST["id"];
$sql = "select * from tbl_team where id='$id'";
$run = mysqli_query($con, $sql);
$row = mysqli_fetch_array($run);
$name = $row['name'];
$designation = $row['designation'];
$img = $row['img'];
$img_alt = $row['img_alt'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("assets/css/style.php");
    ?>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <title>Edit Team</title>
</head>

<body>
    <?php include("assets/content/navbar.php") ?>
    <section class="home">
        <div class="text">
            <div class="card custom-card-2">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div class="row w-100">
                        <div class="col-12">
                        <h5 class="mb-0 fw-bold">Edit Team</h5>
                        </div>
                    </div>
                </div>
            </div>

            <form method="post" action="assets/functions/functions.php" enctype="multipart/form-data">
                <div class="card custom-card-2 mt-2">
                    <div class="card-body p-4">
                    <div class="mb-3 col-12 col-md-12">
                                <label class="form-label" for="image">Profile:</label>
                                <input type="file" class="form-control form-control-sm" name="img" id="image" accept="image/png, image/gif, image/jpeg, image/webp">
                                <div id="cImage" class="altImg mt-3">
                                    <div class="row">
                                        <div class="col-12 text-end">
                                            <button class="btn btn-sm btn-danger br-0" style="border-radius:0px" type="button" onclick="removeImage(this,'image')">Remove</button>
                                        </div>
                                        <div class="col-md-4 text-end">
                                            <img src="../assets/img/team/<?php echo $id ?>/<?php echo $img ?>" width="50" class="float-end">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="image">Alt :</label>
                                            <input type="text" class="form-control form-control-sm" value="<?php echo $img_alt ?>" name='alt'>
                                        </div>
                                    </div>

                                </div>
                                </div>
                        <div class="mb-3">
                            <label class="form-label" for="title">Name :</label>
                            <input type="text" class="form-control" name="name" id="title" placeholder="Enter Name" value="<?php echo $name ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="title">Designation :</label>
                            <input type="text" class="form-control" name="designation" id="title" placeholder="Enter Designation" value="<?php echo $designation ?>" required>
                        </div>

                    </div>
                </div>
                
                <div class="card custom-card-2 mt-2">
                    <div class="card-body p-2">
                        <div class="mb-3">
                            <input type="hidden" name="old_img" value="<?php echo $img ?>">
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <button type="submit" class="btn btn-success float-end" name="edit_team" style="background-color: #7d1128;">SUBMIT</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    </div>
    <?php include("assets/content/script.php"); ?>
    <script>
        changeNav("team-nav");
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

        function removeImage(button, input) {

$(button).parents('.altImg').addClass('d-none')
$(button).parents('.altImg').find('input').val('')
$('#' + input).val('')

}
    </script>
</body>

</html>