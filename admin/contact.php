<?php
require_once 'assets/includes/db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include("assets/css/style.php");
    ?>
    <style>
        .select-div{
            position: relative;
        }
    </style>
| Platinum Interiors LLC| MHJ Heavy Equipment Trading LLC</title>
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
                                <h4 class="card-title ms-0 fw-bold mb-0">CONTACTS</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card custom-card-2 mt-3">

                <div class="card-body">
                    <div class="d-flex justify-content-center gap-4 align-items-center select-div">
                        <div>
                        <label class="from-label">Select All:</label>
                        <input type="checkbox" class="select_all" id="select_all">
                    </div>
                    <div>
                        <button type="button" name="delete_multi_contact" id="delete_multi_contact" class="btn btn-danger btn-sm"  onclick="return confirm('Are you sure to delete?');" style="background-color: #ac0404; border: 0;" disabled>Delete</button>
                    </div>
                    <div>
                        <span id="selectCount">Selected : 0</span>
                    </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped pt-3 datatable">
                            <thead>
                                <tr class="text-white" style="background-color: #000;">
                                    <th>Select</th>
                                    <th>#</th>
                                    <th>FULL NAME</th>
                                    <th>PHONE</th>
                                    <th>EMAIL</th>
                                    <th>MESSAGE</th>
                                    <th>CONTACT</th>
                                    <th>DELETE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "select * from tbl_contact order by id DESC";
                                $result = mysqli_query($con, $query);
                                $slno = 0;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $slno++;
                                    $id = $row["id"];
                                    $phone = $row["phone"];
                                    $fname = $row["fname"];
                                    $description = $row["description"];
                                    $email = $row["email"];
                                    $contact = $row["date"];
                                ?>
                                    <tr>
                                        <td class="text-center"><input type="checkbox" name="select[]" class="select_contact" data-id="<?php echo $id ?>"></td>
                                        <td><?php echo $slno ?></td>
                                        <td><?php echo $fname ?></td>
                                        <td><?php echo $phone ?></td>
                                        <td><?php echo $email ?></td>
                                        <td><?php echo $description ?></td>
                                        <td><?php echo $contact ?></td>
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
    </section>
    <?php include("assets/content/script.php"); ?>
    <script>
        changeNav("contact-nav");
        function toggleDeleteButton() {
            if ($('.select_contact:checked').length > 0) {
                $('#delete_multi_contact').prop('disabled', false);
            } else {
                $('#delete_multi_contact').prop('disabled', true);
            }
        }
        
        toggleDeleteButton();
        function resetCount(){
            $('#selectCount').text('Selected : '+$('.select_contact:checked').length)
        }
        
        $('.select_contact').on('change', function () {
            toggleDeleteButton();
            resetCount();
        });
        
        $('#select_all').on('change', function () {
            $('.select_contact').prop('checked', this.checked);
            toggleDeleteButton();
            resetCount();
        });
        
        
        $('#delete_multi_contact').on('click', function (e) {
            e.preventDefault();
        
            var selected = $('.select_contact:checked').map(function () {
                return $(this).data('id');
            }).get();
        
            if (selected.length === 0) {
                alert('No contacts selected');
                return;
            }
        
            var formData = new FormData();
            formData.append('multi_contact_delete', '1');
        
            selected.forEach(function (id) {
                formData.append('selected[]', id);
            });
        
            fetch('assets/functions/functions.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                window.location.href = 'https://platinumemirate.com/admin/contact'
            });
        });





    </script>
</body>

</html>