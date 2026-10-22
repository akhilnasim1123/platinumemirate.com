<?php
include("assets/includes/db.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("assets/css/style.php");
    ?>
    <title>Settings | Platinum Interiors LLC</title>
</head>

<body>

    <?php include("assets/content/navbar.php") ?>
    <section class="home">
        <div class="text">
            <div class="admin-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-11">
                                <h4 class="card-title ms-0 fw-bold mb-0">SETTINGS</h4>
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

            <div class="card custom-card-2 mt-3">
                <div class="card-body p-3">
                    <div class="row">
                        <?php
                        $sql = "select * from tbl_company where id='1'";
                        $run = mysqli_query($con, $sql);
                        $row = mysqli_fetch_array($run);

                        $place = $row["place"];
                        $address = $row["address"];
                        $phone_number1 = $row["phone_number_1"];
                        $phone_number2 = $row["phone_number_2"];
                        $wa = $row["whatsapp"];
                        $email1 = $row["email"];
                        $email2 = $row["email_2"];
                        $facebook = $row["facebook_link"];
                        $instagram = $row["instagram_link"];
                        $twitter = $row["twitter_link"];
                        $countries = $row['countries'];
                        $project_value = $row['project_value'];
                        $clients = $row['clients'];
                        $linked_in = $row['linked_in'];
                        $experience = $row['experience'];
                        $projects = $row['projects'];
                        $contactEmail = $row['contactEmail'];
                        $pinterest = $row['pinterest'];
                        $youtube = $row['youtube'];
                        $keywords = $row['keywords'];
                        $meta_desc = $row['meta_desc'];
                        ?>
                        <form method="post" action="assets/functions/functions.php" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label" for="place">Place :</label>
                                <input type="text" class="form-control" value="<?php echo $place ?>" name="place" id="place" placeholder="Enter Company Place" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="address">Address :</label>
                                <textarea class="form-control" name="address" id="address" placeholder="Enter Company Address" rows="3" required><?php echo $address ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="email">E-mail :</label>
                                <input type="text" class="form-control" name="email1" value="<?php echo $email1 ?>" id="email" placeholder="Enter Primary Email" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="email">Secondary Email :</label>
                                <input type="text" class="form-control" name="email2" value="<?php echo $email2 ?>" id="email" placeholder="Enter Secondary Email" >
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="email">Contact Email :</label>
                                <input type="text" class="form-control" name="email3" value="<?php echo $contactEmail ?>" id="email" placeholder="Enter Enquery Email" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="phone1">Phone Number 1 :</label>
                                <input type="text" class="form-control" name="phone_number1" value="<?php echo $phone_number1 ?>" id="phone1" placeholder="Enter Primary Phone Number" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="phone2">Phone Number 2 :</label>
                                <input type="text" class="form-control" name="phone_number2" id="phone2" value="<?php echo $phone_number2 ?>" placeholder="Enter Secondary Phone Number" >
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="wa">Whatsapp :</label>
                                <input type="text" class="form-control" name="whatsapp" id="wa" value="<?php echo $wa ?>" placeholder="Enter Whatsapp Number" required>
                            </div>                     
                             <div class="mb-3">
                                <label class="form-label" for="wa">Projects :</label>
                                <input type="number" class="form-control" name="projects" id="wa" value="<?php echo $projects ?>" placeholder="Project Count" required>
                            </div>                           
                             <div class="mb-3">
                                <label class="form-label" for="wa">Year of Experience : :</label>
                                <input type="number" class="form-control" name="experience" id="wa" value="<?php echo $experience ?>" placeholder="Experience Count" required>
                            </div>      
                            <div class="mb-3">
                                <label class="form-label" for="wa">Clients :</label>
                                <input type="number" class="form-control" name="clients" id="quality" value="<?php echo $clients ?>" placeholder="Clients" required>
                            </div>   
                            <div class="mb-3">
                                <label class="form-label" for="wa">Countries :</label>
                                <input type="number" class="form-control" name="countries" id="wa" value="<?php echo $countries ?>" placeholder="Countries" required>
                            </div>    
                            
                            <label class="form-label" for="facebook">Facebook :</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">https://facebook.com/</span>
                                <input type="text" class="form-control" id="facebook" name="facebook" value="<?php echo $facebook ?>">
                            </div>
                            <label class="form-label" for="instagram">Instagram :</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">https://instagram.com/</span>
                                <input type="text" class="form-control" id="instagram" name="instagram" value="<?php echo $instagram ?>">
                            </div>
                            <label class="form-label" for="instagram">Linkedin :</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">https://linkedin.com/</span>
                                <input type="text" class="form-control" id="linkedin" name="linkedin" value="<?php echo $linked_in ?>">
                            </div>
                            <label class="form-label" for="twitter">Twitter :</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">https://x.com/</span>
                                <input type="text" class="form-control" id="twitter" name="twitter" value="<?php echo $twitter ?>">
                            </div>

                            <label class="form-label" for="twitter">Pinterest :</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">https://in.pinterest.com/</span>
                                <input type="text" class="form-control" id="pinterest" name="pinterest" value="<?php echo $pinterest ?>">
                            </div>
                            <label class="form-label" for="twitter">Youtube :</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">https://www.youtube.com/</span>
                                <input type="text" class="form-control" id="youtube" name="youtube" value="<?php echo $youtube ?>">
                            </div>

                            <div class="divider w-100"></div>

                            <div class="mb-3">
                                <label class="form-label" for="keywords">Meta Keywords :</label>
                                <input type="text" class="form-control" value="<?php echo $keywords ?>" name="keywords" id="keywords" placeholder="Enter Meta Keywords" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="meta_desc">Meta Description :</label>
                                <textarea class="form-control" name="meta_desc" id="meta_desc" placeholder="Enter Meta Description" rows="3" required><?php echo $meta_desc ?></textarea>
                            </div>

                            <div class="d-flex justify-content-right mt-4">
                                <button type="submit" class="btn submit_btn btn-sm float-end submit_btn me-1" name="update_settings" style="background-color: #fbb13b;" onclick="return confirm('Are you sure to update?');">UPDATE</button>
                                <button type="button" class="btn btn-success btn-sm submit_btn" name="change_password" data-bs-toggle="modal" data-bs-target="#myModal" style="background-color: #7d1128;">CHANGE PASSWORD</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form method="POST" action="assets/functions/functions.php">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Old Password</label>
                                <input type="password" name="old_pass" class="form-control" id="exampleInputPassword1" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword2" class="form-label">New Password</label>
                                <input type="password" name="new_pass" class="form-control" id="exampleInputPassword2" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword3" class="form-label">Confirm Password</label>
                                <input type="password" name="retype_pass" class="form-control" id="exampleInputPassword3" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger " data-bs-dismiss="modal" style="background-color: #ac0404; border: 0;">Close</button>
                            <button type="submit" name="change_password" class="btn btn-primary submit_btn" style="background-color: #fbb13b;" onclick="return confirm('Are you sure?');">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php include("assets/content/script.php"); ?>
    <script>
        changeNav("settings-nav");
    </script>
</body>

</html>