<?php
require_once 'assets/includes/db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include("assets/css/style.php");
    ?>

    <title>Blogs | Platinum Interiors LLC</title>
</head>

<body>

    <?php include("assets/content/navbar.php") ?>
    <section class="home">
        <div class="text">
            <div class="admin-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-lg-10">
                                <h4 class="card-title ms-0 fw-bold mb-0">BLOGS</h4>
                            </div>
                            <div class="col-lg-2 text-end">
                                <a href="add_blog.php" class="btn dashboard-btn me-auto" style="background-color: #fbb13b;">Add Blog</a>
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
                <div class="card-body">
                    <table class="table table-bordered table-striped pt-3 datatable">
                        <thead>
                            <tr class="text-white" style="background-color: #000000;">
                                <th class="fit">Sl NO</th>
                                <th>Author</th>
                                <th class="fit">Image</th>
                                <th>Title</th>
                                <th class="fit">Date</th>
                                <th class="fit">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "select * from tbl_blogs order by id DESC";
                            $result = mysqli_query($con, $query);
                            $slno = 0;
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row["id"];
                                $author = $row["author"];
                                $img = $row["cover_img"];
                                $title = $row["title"];
                                $date = $row["date"];
                                $slno++;
                            ?>
                                <tr>
                                    <td class="fit"><?php echo $slno ?></td>
                                    <td><?php echo $author ?></td>
                                    <td class="fit"><img src="../assets/img/blogs/<?php echo $id ?>/cover/<?php echo $img ?>" width="70"></td>
                                    <td><?php echo $title ?></td>
                                    <td class="fit"><?php echo $date ?></td>
                                    <td class="fit">
                                        <div class="d-flex">
                                            <form method="post" action="edit_blog.php" class="me-1">
                                                <input type="hidden" name="id" value="<?php echo $id ?>">
                                                <button type="submit" name="update_blog" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure to update?');">Update</button>
                                            </form>
                                            <form method="post" action="assets/functions/functions.php">
                                                <input type="hidden" name="id" value="<?php echo $id ?>">
                                                <button type="submit" name="delete_blog" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete?');" style="background-color: #ac0404; border: 0;">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <?php include("assets/content/script.php"); ?>
    <script>
        changeNav("blogs-nav");
    </script>
</body>

</html>