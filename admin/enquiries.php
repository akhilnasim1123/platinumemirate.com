<?php
require_once 'assets/includes/db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include("assets/css/style.php");
    ?>

    <title>Enquiries | Platinum Interiors LLC</title>
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
                                <h4 class="card-title ms-0 fw-bold mb-0">ENQUIRIES</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card custom-card-2 mt-3">

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped pt-3 datatable">
                            <thead>
                                <tr class="text-white" style="background-color: #000;">
                                    <th class="fit">SL NO</th>
                                    <th>FULL NAME</th>
                                    <th>COMPANY</th>
                                    <th>EMAIL</th>
                                    <th>PHONE</th>
                                    <th>COUNTRY</th>
                                    <th>LOCATION</th>
                                    <th>MESSAGE</th>
                                    <th>DATE</th>
                                    <th class="fit">DELETE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "select * from tbl_enquiries order by id DESC LIMIT 10";
                                $result = mysqli_query($con, $query);
                                $slno = 0;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $slno++;
                                    $id = $row["id"];
                                    $name = $row["name"];
                                    $company = $row["company"];
                                    $email = $row["email"];
                                    $phone = $row["phone"];
                                    $location = $row["location"];
                                    $mssg = $row["message"];
                                    $country = $row["country"];
                                    $date = $row["date"];
                                ?>
                                    <tr>
                                        <td class="fit"><?php echo $slno ?></td>
                                        <td><?php echo $name ?></td>
                                        <td><?php echo $company ?></td>
                                        <td><?php echo $email ?></td>
                                        <td><?php echo $phone ?></td>
                                        <td><?php echo $country ?></td>
                                        <td><?php echo $location ?></td>
                                        <td><?php echo $mssg ?></td>
                                        <td><?php echo $date ?></td>
                                        <td class="fit">
                                            <form method="post" action="assets/functions/functions.php">
                                                <input type="hidden" name="id" value="<?php echo $id ?>">
                                                <button type="submit" name="delete_enquiry" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete?');" style="background-color: #ac0404; border: 0;">Delete</button>
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
    </section>
    <?php include("assets/content/script.php"); ?>
    <script>
        changeNav("enquiries-nav");
    </script>
</body>

</html>