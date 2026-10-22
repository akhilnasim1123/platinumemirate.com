<?php
include("assets/includes/db.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("assets/css/style.php");
    ?>
    <title>Team | Platinum Interiors LLC</title>
</head>

<body>
    <?php include("assets/content/navbar.php") ?>
    <section class="home">
        <div class="text">
            <div class="card custom-card-2">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <h5 class="mb-0 fw-bold">Team</h5>
                </div>
            </div>
            <div class=""></div>
            <div class="card custom-card-2 mt-2">
                <div class="card-body p-4">
                    <form method="post" action="assets/functions/functions.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label" for="name">Name :</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Title" required style="background-color:#f0f1f2; height:36px;">
                        </div>
                        <div class="mb-3 col-12 col-md-12">
                                <label class="form-label" for="image">Profile:</label>
                                <input type="file" class="form-control form-control-sm" name="img" id="image" accept="image/png, image/gif, image/jpeg, image/webp" required>

                                <div id="cImage" class="altImg d-none mt-3">
                                    <div class="row">
                                        <div class="col-12 text-end">
                                            <button class="btn btn-sm btn-danger br-0" style="border-radius:0px" type="button" onclick="removeImage(this,'image')">Remove</button>
                                        </div>
                                        <div class="col-md-4 text-end">
                                            <img src="" width="50" class="float-end">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="image">Alt :</label>
                                            <input type="text" class="form-control form-control-sm" name='alt'>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="link">Designation :</label>
                                <input type="text" class="form-control" name="designation" id="link" placeholder="Enter Designation" required style=" background-color:#f0f1f2; height:36px;">
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-success float-end" name="add_team" style="background-color: #7d1128;">SUBMIT</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php include("assets/content/script.php"); ?>
    <script>
        changeNav("team-nav");
        function removeImage(button, input) {

$(button).parents('.altImg').addClass('d-none')
$(button).parents('.altImg').find('input').val('')
$('#' + input).val('')

}
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