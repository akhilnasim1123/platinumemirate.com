<?php
include("assets/includes/db.php");
?>
<!doctype html>
<html lang="en">

<head>
    <?php
    include("assets/css/style.php");
    ?>
    <title>Dashboard | Platinum Interiors LLC</title>
</head>

<body>
    <?php include("assets/content/navbar.php") ?>
    <section class="home">
        <div class="text">
            <div class="admin-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <h4 class="card-title ms-0 fw-bold mt-2">HOME</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="home-cards mt-3">
                <div class="row">
                    
                    <div class="col-md-12">
                        <div class="row">
                            <?php
                            $ser_sql = "select * from tbl_categories";
                            $run_ser = mysqli_query($con, $ser_sql);
                            $ser_count = mysqli_num_rows($run_ser);
                            ?>
                            <div class="col-12 col-md-3 mb-3">
                                <div class="card" style="background-color: #fff;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <h6 class="card-title fw-bold">CATEGORIES</h6>
                                                <h4 class="fw-bold text-black" style="color: #000;"><?php echo $ser_count ?></h4>
                                            </div>
                                            <div class="col-lg-4">

                                                <div class="card-img-bg mt-2 text-center">
                                                    <i class="bi bi-card-checklist" style="font-size: 30px;"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="card-text">Total Categories</p>
                                    </div>
                                </div>
                            </div>



                            <?php
                            $blogs_sql = "select * from tbl_projects";
                            $run_blogs = mysqli_query($con, $blogs_sql);
                            $blogs_count = mysqli_num_rows($run_blogs);
                            ?>
                            <div class="col-12 col-md-3 mb-3">
                                <div class="card" style="background-color: #fff;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <h6 class="card-title fw-bold">PROJECTS</h6>
                                                <h4 class="fw-bold text-black" style="color: #000;"><?php echo $blogs_count ?></h4>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="card-img-bg mt-2 text-center">
                                                    <i class="bi bi-newspaper" style="font-size: 30px;"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="card-text">Total Projects</p>
                                    </div>
                                </div>
                            </div>

                            <?php
                            $tes_sql = "select * from tbl_testimonial";
                            $run_tes = mysqli_query($con, $tes_sql);
                            $tes_count = mysqli_num_rows($run_tes);
                            ?>
                            <div class="col-12 col-md-3 mb-3">
                                <div class="card" style="background-color: #fff;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <h6 class="card-title fw-bold">TESTIMONIALS</h6>
                                                <h4 class="fw-bold text-black" style="color: #000;"><?php echo $tes_count ?></h4>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="card-img-bg mt-2 text-center">
                                                    <i class="bi bi-chat-left-text" style="font-size: 30px;"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="card-text">Total Testimonials</p>
                                    </div>
                                </div>
                            </div>

                            <?php
                            $tes_sql = "select * from tbl_blogs";
                            $run_tes = mysqli_query($con, $tes_sql);
                            $tes_count = mysqli_num_rows($run_tes);
                            ?>
                            <div class="col-12 col-md-3 mb-3">
                                <div class="card" style="background-color: #fff;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <h6 class="card-title fw-bold">BLOGS</h6>
                                                <h4 class="fw-bold text-black" style="color: #000;"><?php echo $tes_count ?></h4>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="card-img-bg mt-2 text-center">
                                                    <i class="bi bi-chat-left-text" style="font-size: 30px;"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="card-text">Total Blogs</p>
                                    </div>
                                </div>
                            </div>
                            
                  
                     

                            <div class="col-md-12">
                                <div class="card custom-card-2">
                                    <div class="card-body">
                                        <h6 class="text-center fw-bold text-dark">Latest Contacts</h6>
                                        <table class="table table-bordered table-striped pt-3 datatable">
                                            <thead>
                                            <tr class="text-white" style="background-color: #000;">
                                                <th>FULL NAME</th>
                                                <th>PHONE</th>
                                                <th>EMAIL</th>
                                                <th>MESSAGE</th>
                                                <th>DATE</th>
                                                <th>DELETE</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = "select * from tbl_contact order by id DESC LIMIT 10";
                                                $result = mysqli_query($con, $query);
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $id = $row["id"];
                                                    $phone = $row["phone"];
                                                    $fname = $row["fname"];
                                                    $date = $row["date"];
                                                    $description = $row["description"];
                                                    $email = $row["email"];
                                                ?>
                                                    <tr>
                                                        <td><?php echo $fname ?></td>
                                                        <td><?php echo $phone ?></td>
                                                        <td><?php echo $email ?></td>
                                                        <td><?php echo $description ?></td>
                                                        <td><?php echo $date ?></td>
                                                        <td>
                                                            <form method="post" action="assets/functions/functions.php">
                                                                <input type="hidden" name="id" value="<?php echo $id ?>">
                                                                <button type="submit" name="delete_contact" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete?');" style="background-color: #ac0404; border: 0;">Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
    <?php include("assets/content/script.php"); ?>
    
<script>console.log(<?php echo $_SESSION["habrix_admin_loggedin"] ?> );</script>
<script>console.log('sssssssssssssssssssssssssssssss')</script>
    <script>
        changeNav("home-nav");
    </script>
</body>

</html>