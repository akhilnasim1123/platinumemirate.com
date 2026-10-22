<?php
require_once 'assets/includes/db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include("assets/css/style.php");
    ?>

    <title>Services | Platinum Interiors LLC</title>
    <style>
        .table img{
            filter:brightness(0);
        }
    </style>
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
                                <h4 class="card-title ms-0 fw-bold mb-0">SERVICES</h4>
                            </div>
                            <div class="col-lg-2 text-end">
                                <a href="add_service.php" class="btn dashboard-btn me-auto btn-theme">Add Service</a>
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
                                <th>Image</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "select * from tbl_services order by id ASC";
                            $result = mysqli_query($con, $query);
                            $slno = 0;
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row["id"];
                                $title = $row["title"];
                                $img = $row["img"];
                                $desc = $row["description"];
                                $slno++;
                            ?>
                                <tr>
                                    <td class="fit"><?php echo $slno ?></td>
                                    <td><img src="../assets/img/services/<?php echo $id ?>/<?php echo $img?>" width="70"></td>
                                    <td><?php echo $title ?></td>
                                    <td><?php echo $desc ?></td>
                                    <td>
                                        <div class="d-flex">
                                            <form method="post" action="edit_service.php" class="me-1">
                                                <input type="hidden" name="id" value="<?php echo $id ?>">
                                                <button type="submit" name="update_service" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure to update?');">Update</button>
                                            </form>
                                            <form method="post" action="assets/functions/functions.php">
                                                <input type="hidden" name="id" value="<?php echo $id ?>">
                                                <button type="submit" name="delete_service" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete?');" style="background-color: #ac0404; border: 0;">Delete</button>
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
        changeNav("services-nav");
    </script>
</body>

</html>