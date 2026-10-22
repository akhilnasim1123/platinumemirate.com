<?php
include("assets/includes/db.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include("assets/css/style.php");
    ?>

    <title>Edit Blog | Platinum Interiors LLC</title>
</head>

<body>
    <?php include("assets/content/navbar.php") ?>
    <section class="home">
        <div class="text">
            <div class="admin-card mt-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-11">
                                <h4 class="card-title ms-0 fw-bold mt-2">EDIT BLOG</h4>
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

            <?php
            $id = $_POST["id"];
            $sql = "select * from tbl_blogs where id='$id'";
            $run = mysqli_query($con, $sql);
            $row = mysqli_fetch_array($run);

            $cover_img = $row["cover_img"];
            $cover_alt = $row["cover_alt"];
            $title = $row["title"];
            $author = $row["author"];
            $short_desc = $row["short_desc"];
            $blog_desc = $row["description"];
            $view_img = $row["view_img"];
            $view_alt = $row["view_alt"];
            $blog_date = $row["date"];
            $keyword = $row["keyword"];

            ?>

            <div class="card custom-card-2 mt-2">
                <div class="card-body p-4">
                    <form method="post" action="assets/functions/functions.php" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label" for="date">Date :</label>
                            <input type="date" class="form-control" name="date" id="date" value="<?php echo $blog_date ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="author">Author :</label>
                            <input type="text" class="form-control" name="author" id="author" value="<?php echo $author ?>" placeholder="Enter Author Name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="cover_img">Cover Image:</label>
                            <input type="file" class="form-control" name="cover_img" id="cover_img" accept="image/png, image/gif, image/jpeg, image/webp">
                            <div id="Image" class="mt-3">
                                <div class="row">
                                    <div class="col-md-4 text-end">
                                        <img src="../assets/img/blogs/<?php echo $id ?>/cover/<?php echo $cover_img ?>" width="50" class="float-end">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="image">Alt :</label>
                                        <input type="text" class="form-control form-control-sm" value="<?php echo $cover_alt ?>" name='alt'>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="view_img">View Image:</label>
                            <input type="file" class="form-control" name="view_img" id="view_img" accept="image/png, image/gif, image/jpeg, image/webp">
                            <div id="Image2" class="mt-3">
                                <div class="row">
                                    <div class="col-md-4 text-end">
                                        <img src="../assets/img/blogs/<?php echo $id ?>/<?php echo $view_img ?>" width="50" class="float-end">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="image">Alt :</label>
                                        <input type="text" class="form-control form-control-sm" value="<?php echo $view_alt ?>" name='alt2'>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="title">Title :</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title" value="<?php echo $title ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="description">Short Description :</label>
                            <textarea name="description" id="description" rows="4" class="form-control" placeholder="Enter Description" required><?php echo $short_desc ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="title">Long Description :</label>
                            <div id="editor0"></div>
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="old_cover_img" value="<?php echo $cover_img ?>">
                            <input type="hidden" name="old_view_img" value="<?php echo $view_img ?>">
                            <input type="hidden" name="long_description" id="long_description" value="<?php echo htmlspecialchars($blog_desc) ?>">
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <input type="hidden" name="keyword" value="<?php echo $keyword ?>">
                            <button type="submit" class="btn btn-theme float-end w-100" name="update_blog">SUBMIT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php include("assets/content/script.php"); ?>
    <script>
        Quill.register({
            'modules/tableUI': quillTableUI.default
        }, true)

        Quill.register('modules/imageResize', QuillResizeModule);

        var quill = new Quill('#editor0', {
            theme: 'snow',
            modules: {
                table: true,
                tableUI: true,
                toolbar: toolbaroptions,
                imageResize: {}
            }
        });

        const table = quill.getModule('table');
        document.querySelector('.ql-table').addEventListener('click', function() {
            table.insertTable(2, 2);
        });

        changeNav("blogs-nav");

        $(document).ready(function() {
            const savedContent = $("#long_description").val();;
            loadContentIntoQuill(savedContent);
        })

        $('#cover_img').on('change', function() {
            var file = this.files[0];

            if (file) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#Image').find('img').attr('src', e.target.result);
                    $('#Image').removeClass('d-none');
                }

                reader.readAsDataURL(file);
            } else {
                $('#Image').addClass('d-none');
            }
        });

        $('#view_img').on('change', function() {
            var file = this.files[0];

            if (file) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#Image2').find('img').attr('src', e.target.result);
                    $('#Image2').removeClass('d-none');
                }

                reader.readAsDataURL(file);
            } else {
                $('#Image2').addClass('d-none');
            }
        });

        function generateUniqueId() {
            return '_' + Math.random().toString(36).substr(2, 9);
        }
        
        quill.getModule('toolbar').addHandler('image', function() {
            selectLocalImage();
        });

        function selectLocalImage() {
            const input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.click();

            input.onchange = () => {
                const file = input.files[0];
                if (/^image\//.test(file.type)) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        insertToEditor(e.target.result);
                    };
                    reader.readAsDataURL(file);
                } else {
                    console.warn('You could only upload images.');
                }
            };
        }

        function insertToEditor(url) {
            const range = quill.getSelection();
            const uniqueId = generateUniqueId();
            quill.insertEmbed(range.index, 'image', url);

            // Create an input field for the alt text
            const altInput = document.createElement('input');
            altInput.type = 'text';
            altInput.placeholder = 'Enter alt text for image';
            altInput.classList.add("form-control", "mb-3")
            altInput.dataset.uniqueId = uniqueId;

            // Append the input field below the editor
            $('#alt-input-container').append(altInput);

            // Update the alt attribute when the user types in the input field
            $(altInput).on('input', function() {
                const uniqueId = $(this).data('uniqueId');
                const images = quill.root.querySelectorAll('img');
                const imageToUpdate = Array.from(images).find(img => img.dataset.uniqueId === uniqueId);
                if (imageToUpdate) {
                    $(imageToUpdate).attr('alt', $(this).val());
                }
            });

            // Add a unique data attribute to the inserted image
            const images = quill.root.querySelectorAll('img');
            const insertedImage = images[images.length - 1];
            if (insertedImage) {
                insertedImage.dataset.uniqueId = uniqueId;
            }
        }

        // Listen for changes in the editor to detect deleted images
        quill.on('text-change', function(delta, oldDelta, source) {
            if (source === 'user') {
                const currentImages = quill.root.querySelectorAll('img');
                const inputFields = $('#alt-input-container input');

                inputFields.each(function() {
                    const uniqueId = $(this).data('uniqueId');
                    const correspondingImage = Array.from(currentImages).find(img => img.dataset.uniqueId === uniqueId);

                    if (!correspondingImage) {
                        $(this).remove(); // Remove the input field if its corresponding image is deleted
                    }
                });
            }

            $("#long_description").val(quill.root.innerHTML);
        });

        
        function loadContentIntoQuill(content) {
            // Load the content into the Quill editor
            quill.clipboard.dangerouslyPasteHTML(content);

            // Find all images in the loaded content
            const images = quill.root.querySelectorAll('img');

            images.forEach((image, index) => {
                const uniqueId = generateUniqueId();
                image.dataset.uniqueId = uniqueId; // Assign a unique ID to each image

                // Create an input field for the alt text
                const altInput = document.createElement('input');
                altInput.type = 'text';
                altInput.placeholder = 'Enter alt text for image';
                altInput.classList.add("form-control", "mb-3");
                altInput.dataset.uniqueId = uniqueId;

                // Pre-fill the input with the existing alt text from the image
                altInput.value = image.getAttribute('alt') || '';

                // Append the input field below the editor
                $('#alt-input-container').append(altInput);

                // Update the alt attribute when the user types in the input field
                $(altInput).on('input', function() {
                    const images = quill.root.querySelectorAll('img');
                    const imageToUpdate = Array.from(images).find(img => img.dataset.uniqueId === uniqueId);
                    if (imageToUpdate) {
                        $(imageToUpdate).attr('alt', $(this).val());
                    }
                });
            });
        }
    </script>
</body>

</html>