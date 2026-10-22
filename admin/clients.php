<?php
require_once 'assets/includes/db.php';
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
            <div class="admin-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-lg-10">
                                <h4 class="card-title ms-0 fw-bold mb-0">Clients</h4>
                            </div>
                            <div class="col-lg-2 text-end">
                                <a href="add_clients.php" class="btn dashboard-btn me-auto btn-theme">Add Clients</a>
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

            <div class="row gap-2 mt-5 justify-content-center">
                <?php
                $query = "select * from tbl_clients order by id DESC";
                $result = mysqli_query($con, $query);
                $slno = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row["id"];
                    $img = $row["img"];
                    $slno++;
                    ?>
                    <div class="card custom-card-2 col-12 col-md-3 col-lg-2">
                        <div class="card-body text-center p-0 mb-2">
                            <img src="../assets/img/clients/<?php echo $id ?>/<?php echo $img ?>" class=" object-fit-contain" style="width:120px; height:120px;" alt="">
                        </div>
                        <div class="d-flex gap-2 justify-content-center">
                            <form method="post" action="edit_clients.php" class="me-1">
                                <input type="hidden" name="id" value="<?php echo $id ?>">
                                <button type="submit" name="update_client" class="btn btn-primary btn-sm"
                                    onclick="return confirm('Are you sure to update?');">Update</button>
                            </form>
                            <form method="post" action="assets/functions/functions.php">
                                <input type="hidden" name="id" value="<?php echo $id ?>">
                                <button type="submit" name="delete_client" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure to delete?');"
                                    style="background-color: #ac0404; border: 0;">Delete</button>
                            </form>
                        </div>
                    </div>
                <?php } ?>
            </div>

        </div>
        <!-- </div>
        </div> -->
    </section>

    <?php include("assets/content/script.php"); ?>
    <script>
        changeNav("clients-nav");
    </script>