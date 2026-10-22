<?php

ini_set('memory_limit', '-1');

include("../includes/db.php");
date_default_timezone_set('Asia/Dubai');


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once dirname(__DIR__, 6) . '/shared-libs/PHPMailer/src/PHPMailer.php';
require_once dirname(__DIR__, 6) . '/shared-libs/PHPMailer/src/SMTP.php';
require_once dirname(__DIR__, 6) . '/shared-libs/PHPMailer/src/Exception.php';


function compress($source, $destination, $quality)
{

    $info = getimagesize($source);
    if ($info['mime'] == 'image/jpeg' || $info['mime'] == 'image/jpg') {
        $image = imagecreatefromjpeg($source);

        imagejpeg($image, $destination, $quality);

        return $destination;
    } else {

        move_uploaded_file($source, $destination);
        // copy($source,$destination);
    }
}

if (isset($_POST['logout'])) {
    unset($_SESSION['habrix_admin_loggedin']);
    header("Location:../../login.php");
}

if (isset($_POST["login"])) {
    // 1. Set Timezone to match your region (e.g. Asia/Kolkata)
    date_default_timezone_set('Asia/Kolkata');

    $username = mysqli_real_escape_string($con, $_POST["username"]);
    $password = mysqli_real_escape_string($con, $_POST["password"]);
    $passhash = hash("sha256", $password);

    // Verify User Credential
    $sql = "SELECT * FROM tbl_company WHERE username='$username' AND password='$passhash'";
    $run = mysqli_query($con, $sql);
    $count = mysqli_num_rows($run);

    $time = date("Y-m-d H:i:s");
    
    // Check attempts in the last 5 minutes
    $five_minutes_ago = date("Y-m-d H:i:s", strtotime("-5 minutes"));
    $bsql = "SELECT COUNT(*) AS attempts FROM tbl_login_attempt WHERE attempt_time >= '$five_minutes_ago'";
    $brun = mysqli_query($con, $bsql);
    $row = mysqli_fetch_assoc($brun);
    $attempts = $row['attempts'];

    if ($attempts >= 5) {
        // Lockout for exactly 5 minutes (300 seconds) starting from NOW
        $currentTime = time();
        $unlockTime = $currentTime + 300;
        
        // Pass the UNLOCK TIMESTAMP to the URL
        header("Location: ../../login.php?error=Too many attempts&unlock_time=$unlockTime");
        exit();
    }

    if ($count === 0) { 
        // Record failure
        $nbsql = "INSERT INTO tbl_login_attempt(attempt_time) VALUES ('$time')";
        mysqli_query($con, $nbsql);

        header("Location: ../../login.php?error=Invalid credential");
        exit();
    } else { 
        $_SESSION["habrix_admin_loggedin"] = true;
        header("Location: ../../index.php");
        exit();
    }
}


if (isset($_POST["add_project"])) {
    $cover_alt = mysqli_real_escape_string($con, $_POST["cover_alt"]);
    $title = mysqli_real_escape_string($con, $_POST["title"]);
    $category = mysqli_real_escape_string($con, $_POST["category"]);
    $location = mysqli_real_escape_string($con, $_POST["location"]);
    $description = mysqli_real_escape_string($con, $_POST["description"]);


    $m_img = $_FILES["img"]["name"];
    $tmp_name = $_FILES["img"]["tmp_name"];
    
    // Generate unique keyword
    $keyword = strtolower(str_replace([" ", "&"], "-", $title));
    $is_keyword = false;
    while (!$is_keyword) {
        $check_keyword = "SELECT * FROM tbl_projects WHERE keyword='$keyword'";
        $run_keyword = mysqli_query($con, $check_keyword);
        if (mysqli_num_rows($run_keyword) === 0) {
            $is_keyword = true;
        } else {
            $keyword = $keyword . "-" . rand(100, 999);
        }
    }

    $sql = "INSERT INTO tbl_projects(title, cover_img, cover_alt,category,  location, description, keyword) 
            VALUES('$title', '$m_img', '$cover_alt', '$category', '$location', '$description', '$keyword')";

    if (mysqli_query($con, $sql)) {
        $pid = mysqli_insert_id($con);
        $project_img_dir = "../../../assets/img/projects/" . $pid;
        
        if (!file_exists($project_img_dir)) {
            mkdir($project_img_dir, 0755, true);
        }

        if ($m_img && move_uploaded_file($tmp_name, $project_img_dir . "/" . $m_img)) {
            compress($project_img_dir . "/" . $m_img, $project_img_dir . "/" . $m_img, 50);
        } else {
            die("Failed to move uploaded cover image.");
        }

        if (isset($_FILES["images"])) {
                $img = $_FILES["images"]["name"];
                $tmp_name = $_FILES["images"]["tmp_name"];
                $alt = $_POST["alt"];
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            
                for ($sl = 0; $sl < count($img); $sl++) {
                    $image = mysqli_real_escape_string($con, basename($img[$sl]));
            
                    if (!in_array($_FILES['images']['type'][$sl], $allowedTypes) || $_FILES['images']['error'][$sl] !== UPLOAD_ERR_OK) {
                        echo "Error or unsupported file type for image: $image";
                        continue;
                    }
            
                    $psql = "INSERT INTO tbl_project_img(pid, img, img_alt) VALUES('$pid', '$image', '" . mysqli_real_escape_string($con, $alt[$sl]) . "')";
                    if (mysqli_query($con, $psql)) {
                        if (move_uploaded_file($tmp_name[$sl], $project_img_dir . "/" . $image)) {
                            compress($project_img_dir . "/" . $image, $project_img_dir . "/" . $image, 50);
                        } else {
                            echo "Failed to move uploaded file: $image";
                        }
                    } else {
                        echo "Failed to insert image into database: " . mysqli_error($con);
                    }
                }
            }

        header("Location: ../../projects.php?success=Project added successfully");
    } else {
        header("Location: ../../projects.php?error=Failed to add Project!");
    }
}


if (isset($_POST["delete_project"])) {
    $id = mysqli_real_escape_string($con, $_POST["id"]);

    $delete_project_img = "DELETE FROM tbl_project_img WHERE pid='$id'";
    mysqli_query($con, $delete_project_img);

    $delete_project = "DELETE FROM tbl_projects WHERE id='$id'";
    mysqli_query($con, $delete_project);

    $project_img_dir = "../../../assets/img/projects/" . $id;
    deleteDirectory($project_img_dir);
    header("Location: ../../projects.php?success=Project deleted successfully");
}


if (isset($_POST["update_project"])) {
    $id = mysqli_real_escape_string($con, $_POST["id"]);
    $cover_alt = mysqli_real_escape_string($con, $_POST["cover_alt"]);
    $title = mysqli_real_escape_string($con, $_POST["title"]);
    $category = mysqli_real_escape_string($con, $_POST["category"]);
    $location = mysqli_real_escape_string($con, $_POST["location"]);
    $description = mysqli_real_escape_string($con, $_POST["description"]);
    $old_cover = mysqli_real_escape_string($con, $_POST["old_cover"]);

    $keyword = str_replace(" ", "-", strtolower($title));
    $keyword = str_replace("&", "-", strtolower($keyword));
    $is_keyword = false;
    while ($is_keyword == false) {
        $check_keyword = "select * from tbl_projects where keyword='$keyword'";
        $run_keyword = mysqli_query($con, $check_keyword);
        $keyword_count = mysqli_num_rows($run_keyword);
        if ($keyword_count === 0) {
            $is_keyword = true;
        } else {
            $keyword = $keyword . "-" . rand(100, 999);
        }
    }

    $m_img = "";
    if ($_FILES['img']['size'] != 0) {
        $m_img = mysqli_real_escape_string($con, $_FILES["img"]["name"]);
        $tmp_name = $_FILES["img"]["tmp_name"];

        $to = "../../../assets/img/projects/" . $id . "/" . $m_img;


        $old_img_path = "../../../assets/img/projects/" . $id . "/" . $old_cover;
        if (file_exists($old_img_path)) {
            unlink($old_img_path);
        }

        compress($tmp_name, $to, 50);
    } else {
        $m_img = $old_cover;
    }

    $sql = "UPDATE tbl_projects SET 
          title='$title', 
          cover_img='$m_img', 
          cover_alt='$cover_alt', 
          category='$category',  
          location='$location', 
          description='$description', 
          keyword='$keyword'
          WHERE id='$id'";

    $run = mysqli_query($con, $sql);
    if ($run) {
        $isql = "DELETE FROM tbl_project_img WHERE pid='$id'";
        $irun = mysqli_query($con, $isql);

        if ($irun) {

            $isql = "DELETE FROM tbl_project_img WHERE pid='$id'";
            $irun = mysqli_query($con, $isql);

            if ($irun) {
                if (isset($_FILES['images'])) {
                    $img = $_FILES["images"]["name"];
                    $tmp_name3 = $_FILES["images"]["tmp_name"];
                    $alt = $_POST["alt"];

                    $old_img = $_POST["old_images"];
                    $project_dir = "../../../assets/img/projects/" . $id;

                    foreach ($img as $key => $image) {
                        if ($image) {
                            $alt_text = mysqli_real_escape_string($con, $alt[$key]);

                            $idsql = "INSERT INTO tbl_project_img(pid, img, img_alt) VALUES('$id', '$image', '$alt_text')";
                            $idrun = mysqli_query($con, $idsql);

                            if ($idrun) {
                                $to = $project_dir . "/" . $image;
                                compress($tmp_name3[$key], $to, 50);
                            } else {
                                header("Location: ../../projects.php?error=Failed to insert new image into database!");
                                exit;
                            }
                        } else {
                            $image = $old_img[$key];
                            $alt_text = mysqli_real_escape_string($con, $alt[$key]);

                            if ($image !== '0') {
                                $idsql = "INSERT INTO tbl_project_img(pid, img, img_alt) VALUES('$id', '$image', '$alt_text')";
                                $idrun = mysqli_query($con, $idsql);

                                if (!$idrun) {
                                    header("Location: ../../projects.php?error=Failed to update image information!");
                                    exit;
                                }
                            }
                        }
                    }

                    header("Location: ../../projects.php?success=Project Updated Successfully");
                } else {
                    header("Location: ../../projects.php?error=Failed to Update Project!");
                }
            }
        } else {
            header("Location: ../../projects.php?error=Failed to Update Project!");
        }
    }



    if ($run === TRUE) {
        header("Location: ../../projects.php?success=Project Updated Successfully");
    } else {
        header("Location: ../../projects.php?error=Failed to Update Project!");
    }
}



if (isset($_POST["add_testimonial"])) {
    $name = mysqli_real_escape_string($con, $_POST["name"]);
    $designation = mysqli_real_escape_string($con, $_POST["designation"]);
    $description = mysqli_real_escape_string($con, $_POST["description"]);
    $alt = mysqli_real_escape_string($con, $_POST["alt1"]);

    $img = "";
    if ($_FILES['img']['size'] != 0) {
        $img = $_FILES["img"]["name"];
        $tmp_name = $_FILES["img"]["tmp_name"];
    }
    $sql = "insert into tbl_testimonial(name,designation,description,img,img_alt1) values('$name','$designation','$description','$img','$alt')";
    $run = mysqli_query($con, $sql);
    $pid = mysqli_insert_id($con);

    if ($_FILES['img']['size'] != 0) {
        if (!file_exists("../../../assets/img/testimonial/" . $pid)) {
            mkdir("../../../assets/img/testimonial/" . $pid, 0777, true);
        }
        $to = "../../../assets/img/testimonial/" . $pid . "/" . $img;
        compress($tmp_name, $to, 50);
    }

    if ($run === TRUE) {
        header("Location: ../../testimonial.php?success=Testimonial added successfully");
    } else {
        header("Location: ../../testimonial.php?error=Failed to add testimonial!");
    }
}

if (isset($_POST["delete_testimonial"])) {
    $id = mysqli_real_escape_string($con, $_POST["id"]);
    $sql = "SELECT * FROM tbl_testimonial WHERE id='$id'";
    $result = mysqli_query($con, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $testimonial = mysqli_fetch_assoc($result);
        $pid = $testimonial["id"];
        $imageDir = "../../../assets/img/testimonial/" . $pid;

        $deleteSql = "DELETE FROM tbl_testimonial WHERE id='$id'";
        $deleteRun = mysqli_query($con, $deleteSql);

        if ($deleteRun === TRUE) {
            if (is_dir($imageDir)) {
                $files = glob($imageDir . '/*');
                foreach ($files as $file) {
                    if (is_file($file)) {
                        unlink($file);
                    }
                }
                deleteDirectory($imageDir);
            }

            header("Location: ../../testimonial.php?success=Testimonial deleted successfully");
        } else {
            header("Location: ../../testimonial.php?error=Failed to delete testimonial!");
        }
    } else {
        header("Location: ../../testimonial.php?error=Testimonial not found!");
    }
}

if (isset($_POST["update_testimonial"])) {
    $id = mysqli_real_escape_string($con, $_POST["id"]);
    $name = mysqli_real_escape_string($con, $_POST["name"]);
    $designation = mysqli_real_escape_string($con, $_POST["designation"]);
    $description = mysqli_real_escape_string($con, $_POST["description"]);
    $alt = mysqli_real_escape_string($con, $_POST["alt1"]);
    $m_img = "";

    if ($_FILES['img']['size'] != 0) {
        $m_img = $_FILES["img"]["name"];
        $tmp_name = $_FILES["img"]["tmp_name"];
        if (!file_exists("../../../assets/img/testimonial/" . $id)) {
            mkdir("../../../assets/img/testimonial/" . $id, 0777, true);
        }
        $to = "../../../assets/img/testimonial/" . $id . "/" . $m_img;
        compress($tmp_name, $to, 50);
    } else {
        $m_img = $_POST["old_img"];
    }
    $sql = "update tbl_testimonial set name='$name',designation='$designation',description='$description',img='$m_img',img_alt1='$alt' where id='$id'";
    $run = mysqli_query($con, $sql);
    if ($run === TRUE) {
        header("Location: ../../testimonial.php?success=Testimonial updated successfully");
    } else {
        header("Location: ../../testimonial.php?error=Failed to update testimonial!");
    }
}


if (isset($_POST["add_category"])) {
    $titles = $_POST["title"];  
    foreach ($titles as $title) {
        $title = mysqli_real_escape_string($con, $title);
        
        $keyword = str_replace(" ", "-", strtolower($title));
        $keyword = str_replace("&", "-", strtolower($keyword));
        
        $is_keyword = false;
        
        while ($is_keyword == false) {
            $check_keyword = "SELECT * FROM tbl_categories WHERE keyword='$keyword'";
            $run_keyword = mysqli_query($con, $check_keyword);
            $keyword_count = mysqli_num_rows($run_keyword);

            if ($keyword_count === 0) {
                $is_keyword = true;
            } else {
                $keyword = $keyword . "-" . rand(100, 999);
            }
        }

        $sql = "INSERT INTO tbl_categories(title, keyword) VALUES('$title', '$keyword')";
        $run = mysqli_query($con, $sql);
    }

    if ($run) {
        header("Location: ../../categories.php?success=Category added successfully");
    } else {
        header("Location: ../../categories.php?error=Failed to add category!");
    }
}



if (isset($_POST["delete_category"])) {
    $id = mysqli_real_escape_string($con, $_POST["id"]);
    $sql = "SELECT * FROM tbl_categories WHERE id='$id'";
    $result = mysqli_query($con, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $testimonial = mysqli_fetch_assoc($result);
        $pid = $testimonial["id"];

        $deleteSql = "DELETE FROM tbl_categories WHERE id='$id'";
        $deleteRun = mysqli_query($con, $deleteSql);

        if ($deleteRun === TRUE) {
            header("Location: ../../categories.php?success=Category deleted successfully");
        } else {
            header("Location: ../../categories.php?error=Failed to delete category!");
        }
    } else {
        header("Location: ../../categories.php?error=Category not found!");
    }
}

if (isset($_POST["update_category"])) {
    $id = mysqli_real_escape_string($con, $_POST["id"]);
    $title = mysqli_real_escape_string($con, $_POST["title"]);

   

    $keyword = str_replace(" ", "-", strtolower($title));
    $keyword = str_replace("&", "-", strtolower($keyword));
    $is_keyword = false;
    while ($is_keyword == false) {
        $check_keyword = "select * from tbl_categories where keyword='$keyword'";
        $run_keyword = mysqli_query($con, $check_keyword);
        $keyword_count = mysqli_num_rows($run_keyword);
        if ($keyword_count === 0) {
            $is_keyword = true;
        } else {
            $keyword = $keyword . "-" . rand(100, 999);
        }
    }

    $sql = "update tbl_categories set title='$title', keyword='$keyword' where id='$id'";
    $run = mysqli_query($con, $sql);
    if ($run === TRUE) {
        header("Location: ../../categories.php?success=Category updated successfully");
    } else {
        header("Location: ../../categories.php?error=Failed to update category!");
    }
}

if (isset($_POST["add_carousel"])) {
    $title = mysqli_real_escape_string($con, $_POST["title"]);
    $description = mysqli_real_escape_string($con, $_POST["description"]);
    $device = mysqli_real_escape_string($con, $_POST["device"]);
    $alt = mysqli_real_escape_string($con, $_POST["alt"]);

    $img = "";
    if ($_FILES['img']['size'] != 0) {
        $img = $_FILES["img"]["name"];
        $tmp_name = $_FILES["img"]["tmp_name"];
    }

    $sql = "insert into tbl_carousels(device, img, img_alt,title,description) values('$device','$img','$alt','$title','$description')";
    $run = mysqli_query($con, $sql);
    $pid = mysqli_insert_id($con);

    if ($_FILES['img']['size'] != 0) {
        if (!file_exists("/var/www/mhjequipment.com/mhj/assets/img/carousels/" . $pid)) {
            mkdir("/var/www/mhjequipment.com/mhj/assets/img/carousels/" . $pid, 0777, true);
        }
        $to = "/var/www/mhjequipment.com/mhj/assets/img/carousels/" . $pid . "/" . $img;
        compress($tmp_name, $to, 50);
    }
    if ($_FILES['img']['error'] !== UPLOAD_ERR_OK) {
        die("Upload failed with error code " . $_FILES['img']['error']);
    }

    if ($run === TRUE) {
       header("Location: ../../carousels.php?success=Carousel added successfully");
    } else {
      header("Location: ../../carousels.php?error=Failed to add carousel!");
    }
}

if (isset($_POST["delete_carousel"])) {
    $id = mysqli_real_escape_string($con, $_POST["id"]);
    $sql = "SELECT * FROM tbl_carousels WHERE id='$id'";
    $result = mysqli_query($con, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $testimonial = mysqli_fetch_assoc($result);
        $pid = $testimonial["id"];
        $imageDir = "../../../assets/img/carousels/" . $pid;

        $deleteSql = "DELETE FROM tbl_carousels WHERE id='$id'";
        $deleteRun = mysqli_query($con, $deleteSql);

        if ($deleteRun === TRUE) {
            if (is_dir($imageDir)) {
                $files = glob($imageDir . '/*');
                foreach ($files as $file) {
                    if (is_file($file)) {
                        unlink($file);
                    }
                }
                deleteDirectory($imageDir);
            }

            header("Location: ../../carousels.php?success=Carousel deleted successfully");
        } else {
            header("Location: ../../carousels.php?error=Failed to delete carousel!");
        }
    } else {
        header("Location: ../../carousels.php?error=Carousel not found!");
    }
}

if (isset($_POST["update_carousel"])) {
    $id = mysqli_real_escape_string($con, $_POST["id"]);
    $device = mysqli_real_escape_string($con, $_POST["device"]);
    $alt = mysqli_real_escape_string($con, $_POST["alt"]);
    $title = mysqli_real_escape_string($con, $_POST["title"]);
    $description = mysqli_real_escape_string($con, $_POST["description"]);

    $m_img = "";
    if ($_FILES['img']['size'] != 0) {
        $m_img = $_FILES["img"]["name"];
        $tmp_name = $_FILES["img"]["tmp_name"];
        if (!file_exists("../../../assets/img/carousels/" . $id)) {
            mkdir("../../../assets/img/carousels/" . $id, 0777, true);
        }
        $to = "../../../assets/img/carousels/" . $id . "/" . $m_img;
        compress($tmp_name, $to, 50);
    } else {
        $m_img = $_POST["old_img"];
    }

    $sql = "update tbl_carousels set device='$device', img='$m_img', img_alt='$alt',title='$title',description='$description' where id='$id'";
    $run = mysqli_query($con, $sql);
    if ($run === TRUE) {
        header("Location: ../../carousels.php?success=Carousel updated successfully");
    } else {
        header("Location: ../../carousels.php?error=Failed to update carousel!");
    }
}

if (isset($_POST["add_service"])) {
    $title = mysqli_real_escape_string($con, $_POST["title"]);
    $desc = mysqli_real_escape_string($con, $_POST["description"]);
    $alt = mysqli_real_escape_string($con, $_POST["alt"]);

    $img = "";
    if ($_FILES['img']['size'] != 0) {
        $img = $_FILES["img"]["name"];
        $tmp_name = $_FILES["img"]["tmp_name"];
    }
    $sql = "insert into tbl_services(title, description, img, img_alt) values('$title', '$desc', '$img','$alt')";
    $run = mysqli_query($con, $sql);
    $pid = mysqli_insert_id($con);

    if ($_FILES['img']['size'] != 0) {
        if (!file_exists("../../../assets/img/services/" . $pid)) {
            mkdir("../../../assets/img/services/" . $pid, 0777, true);
        }
        $to = "../../../assets/img/services/" . $pid . "/" . $img;
        // compress($tmp_name, $to, 50);
        move_uploaded_file($tmp_name, $to);
    }

    if ($run === TRUE) {
        header("Location: ../../services.php?success=Service added successfully");
    } else {
        header("Location: ../../services.php?error=Failed to add service!");
    }
}

if (isset($_POST["delete_service"])) {
    $id = mysqli_real_escape_string($con, $_POST["id"]);
    $sql = "SELECT * FROM tbl_services WHERE id='$id'";
    $result = mysqli_query($con, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $testimonial = mysqli_fetch_assoc($result);
        $pid = $testimonial["id"];
        $imageDir = "../../../assets/img/services/" . $pid;

        $deleteSql = "DELETE FROM tbl_services WHERE id='$id'";
        $deleteRun = mysqli_query($con, $deleteSql);

        if ($deleteRun === TRUE) {
            if (is_dir($imageDir)) {
                $files = glob($imageDir . '/*');
                foreach ($files as $file) {
                    if (is_file($file)) {
                        unlink($file);
                    }
                }
                deleteDirectory($imageDir);
            }

            header("Location: ../../services.php?success=Service deleted successfully");
        } else {
            header("Location: ../../services.php?error=Failed to delete service!");
        }
    } else {
        header("Location: ../../services.php?error=Service not found!");
    }
}

if (isset($_POST["update_service"])) {
    $id = mysqli_real_escape_string($con, $_POST["id"]);
    $title = mysqli_real_escape_string($con, $_POST["title"]);
    $desc = mysqli_real_escape_string($con, $_POST["description"]);
    $alt = mysqli_real_escape_string($con, $_POST["alt"]);

    $m_img = "";
    if ($_FILES['img']['size'] != 0) {
        $m_img = $_FILES["img"]["name"];
        $tmp_name = $_FILES["img"]["tmp_name"];
        if (!file_exists("../../../assets/img/services/" . $id)) {
            mkdir("../../../assets/img/services/" . $id, 0777, true);
        }
        $to = "../../../assets/img/services/" . $id . "/" . $m_img;
        move_uploaded_file($tmp_name, $to);
    } else {
        $m_img = $_POST["old_img"];
    }
    $sql = "update tbl_services set title='$title', description='$desc', img='$m_img', img_alt='$alt' where id='$id'";
    $run = mysqli_query($con, $sql);
    if ($run === TRUE) {
        header("Location: ../../services.php?success=Service updated successfully");
    } else {
        header("Location: ../../services.php?error=Failed to update service!");
    }
}

if (isset($_POST["add_blog"])) {
    if (empty($_POST["title"]) || empty($_POST["description"])) {
        header("Location: ../../blogs.php?error=Title and description are required!");
        exit();
    }

    $title = mysqli_real_escape_string($con, $_POST["title"]);
    $author = mysqli_real_escape_string($con, $_POST["author"]);
    $description = mysqli_real_escape_string($con, $_POST["description"]);
    $long_description = mysqli_real_escape_string($con, $_POST["long_description"]);
    $date = mysqli_real_escape_string($con, $_POST["date"]);
    $cover_alt = mysqli_real_escape_string($con, $_POST["alt"]);
    $view_alt = mysqli_real_escape_string($con, $_POST["alt2"]);

    $keyword = str_replace(" ", "-", strtolower($title));
    $keyword = str_replace("&", "-", strtolower($keyword));
    $is_keyword = false;
    while ($is_keyword == false) {
        $check_keyword = "select * from tbl_blogs where keyword='$keyword'";
        $run_keyword = mysqli_query($con, $check_keyword);
        $keyword_count = mysqli_num_rows($run_keyword);
        if ($keyword_count === 0) {
            $is_keyword = true;
        } else {
            $keyword = $keyword . "-" . rand(100, 999);
        }
    }

    $cm_img = $_FILES["cover_img"]["name"];
    $ctmp_name = $_FILES["cover_img"]["tmp_name"];

    $view_img = $_FILES["view_img"]["name"];
    $view_tmp = $_FILES["view_img"]["tmp_name"];

    $sql = "INSERT INTO tbl_blogs(cover_img, cover_alt, author, title, view_img, view_alt, short_desc, description, date, keyword) 
          VALUES('$cm_img', '$cover_alt', '$author', '$title', '$view_img', '$view_alt', '$description', '$long_description', '$date', '$keyword')";
    $run = mysqli_query($con, $sql);
    if ($run) {
        $pid = mysqli_insert_id($con);

        if (!file_exists("../../../assets/img/blogs/$pid")) {
            mkdir("../../../assets/img/blogs/$pid", 0777, true);
        }
        if (!file_exists("../../../assets/img/blogs/$pid/cover/")) {
            mkdir("../../../assets/img/blogs/$pid/cover/", 0777, true);
        }

        if (!empty($cm_img)) {
            $to = "../../../assets/img/blogs/$pid/cover/$cm_img";
            compress($ctmp_name, $to, 50);
        }

        if (!empty($view_img)) {
            $to = "../../../assets/img/blogs/$pid/$view_img";
            compress($view_tmp, $to, 50);
        }

        header("Location: ../../blogs.php?success=Blog added successfully");
    } else {
        header("Location: ../../blogs.php?error=Failed to add blog!");
    }
}


if (isset($_POST["delete_blog"])) {
    $id = mysqli_real_escape_string($con, $_POST["id"]);

    $sql = "SELECT * FROM tbl_blogs WHERE id='$id'";
    $result = mysqli_query($con, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $blog = mysqli_fetch_assoc($result);
        $pid = $blog["id"];
        $imageDir = "../../../assets/img/blogs/$pid";

        $deleteSql = "DELETE FROM tbl_blogs WHERE id='$id'";
        $deleteRun = mysqli_query($con, $deleteSql);

        if ($deleteRun === TRUE) {
            if (is_dir($imageDir)) {
                $files = glob($imageDir . '/*');
                foreach ($files as $file) {
                    if (is_file($file)) {
                        unlink($file);
                    }
                }
                deleteDirectory($imageDir);
            }

            header("Location: ../../blogs.php?success=Blog deleted successfully");
        } else {
            header("Location: ../../blogs.php?error=Failed to delete blog!");
        }
    } else {
        header("Location: ../../blogs.php?error=Blog not found!");
    }
}


if (isset($_POST["update_blog"])) {
    $id = $_POST["id"];
    $title = mysqli_real_escape_string($con, $_POST["title"]);
    $author = mysqli_real_escape_string($con, $_POST["author"]);
    $description = mysqli_real_escape_string($con, $_POST["description"]);
    $long_description = mysqli_real_escape_string($con, $_POST["long_description"]);
    $date = mysqli_real_escape_string($con, $_POST["date"]);
    $cover_alt = mysqli_real_escape_string($con, $_POST["alt"]);
    $view_alt = mysqli_real_escape_string($con, $_POST["alt2"]);
    $old_cover_img = mysqli_real_escape_string($con, $_POST["old_cover_img"]);
    $old_view_img = mysqli_real_escape_string($con, $_POST["old_view_img"]);
    $keyword = mysqli_real_escape_string($con, $_POST["keyword"]);

    $blog_dir = "../../../assets/img/blogs/$id";
    $cover_dir = "$blog_dir/cover/";

    $cimg = "";
    $vimg = "";

    if (!file_exists($cover_dir)) {
        mkdir($cover_dir, 0777, true);
    }

    if ($_FILES['cover_img']['size'] != 0) {
        $cm_img = $_FILES["cover_img"]["name"];
        $ctmp_name = $_FILES["cover_img"]["tmp_name"];
        $cimg = $cm_img;
        compress($ctmp_name, "$cover_dir/$cm_img", 50);
    } else {
        $cimg = $old_cover_img;
    }

    if ($_FILES['view_img']['size'] != 0) {
        $view_img = $_FILES["view_img"]["name"];
        $view_tmp = $_FILES["view_img"]["tmp_name"];
        $vimg = $view_img;
        compress($view_tmp, "$blog_dir/$view_img", 50);
    } else {
        $vimg = $old_view_img;
    }

    $keyword = str_replace(" ", "-", strtolower($title));
    $keyword = str_replace("&", "-", strtolower($keyword));
    $is_keyword = false;
    while ($is_keyword == false) {
        $check_keyword = "select * from tbl_blogs where keyword='$keyword'";
        $run_keyword = mysqli_query($con, $check_keyword);
        $keyword_count = mysqli_num_rows($run_keyword);
        if ($keyword_count === 0) {
            $is_keyword = true;
        } else {
            $keyword = $keyword . "-" . rand(100, 999);
        }
    }

    $sql = "UPDATE tbl_blogs SET 
              cover_img='$cimg', 
              cover_alt='$cover_alt', 
              author='$author', 
              title='$title', 
              view_img='$vimg', 
              view_alt='$view_alt', 
              short_desc='$description', 
              description='$long_description', 
              date='$date', 
              keyword='$keyword'
          WHERE id='$id'";

    $run = mysqli_query($con, $sql);

    if ($run === TRUE) {
        header("Location: ../../blogs.php?success=Blog updated successfully");
    } else {
        error_log("Blog update failed: " . mysqli_error($con));
        header("Location: ../../blogs.php?error=Failed to update blog!");
    }
}

if (isset($_POST["update_settings"])) {
    $place = mysqli_real_escape_string($con, $_POST["place"]);
    $address = mysqli_real_escape_string($con, $_POST["address"]);
    $email1 = mysqli_real_escape_string($con, $_POST["email1"]);
    $email2 = mysqli_real_escape_string($con, $_POST["email2"]);
    $contactEmail = mysqli_real_escape_string($con, $_POST["email3"]);
    $phone_number1 = mysqli_real_escape_string($con, $_POST["phone_number1"]);
    $phone_number2 = mysqli_real_escape_string($con, $_POST["phone_number2"]);
    $wa = mysqli_real_escape_string($con, $_POST["whatsapp"]);
    $keywords = mysqli_real_escape_string($con, $_POST["keywords"]);
    $experience = mysqli_real_escape_string($con, $_POST["experience"]);
    $clients = mysqli_real_escape_string($con, $_POST["clients"]);
    $projects = mysqli_real_escape_string($con, $_POST["projects"]);
    $countries = mysqli_real_escape_string($con, $_POST["countries"]);
    $facebook = mysqli_real_escape_string($con, $_POST["facebook"]);
    $instagram = mysqli_real_escape_string($con, $_POST["instagram"]);
    $linkedin = mysqli_real_escape_string($con, $_POST["linkedin"]);
    $twitter = mysqli_real_escape_string($con, $_POST["twitter"]);
    $youtube = mysqli_real_escape_string($con, $_POST["youtube"]);
    $pinterest = mysqli_real_escape_string($con, $_POST["pinterest"]);
    $meta_desc = mysqli_real_escape_string($con, $_POST["meta_desc"]);
    $sql = "update tbl_company set place='$place',meta_desc='$meta_desc', address='$address' , youtube='$youtube' ,pinterest='$pinterest' ,email='$email1',email_2='$email2' , phone_number_1='$phone_number1' , phone_number_2='$phone_number2' , whatsapp='$wa', facebook_link='$facebook' , instagram_link='$instagram' , twitter_link='$twitter',countries='$countries',clients='$clients',experience='$experience',keywords='$keywords',contactEmail='$contactEmail',projects='$projects',linked_in='$linkedin'  where id='1'";
    $run = mysqli_query($con, $sql);
    if ($run === TRUE) {
        header("Location: ../../settings.php?success=Settings Updated Successfully");
    } else {
        header("Location: ../../settings.php?error=Failes to Update Settings!");
    }
}

if (isset($_POST["change_password"])) {
    $password = $_POST["old_pass"];
    $new_password = $_POST["new_pass"];
    $confirm_password = $_POST["retype_pass"];
    $passhash = hash("sha256", $password);
    $sql = "select * from tbl_company where password='$passhash' AND id='1'";
    $run = mysqli_query($con, $sql);
    $count = mysqli_num_rows($run);
    if ($count != 0) {
        if ($new_password == $confirm_password) {
            $newpass_hash = hash("sha256", $new_password);
            $sql = "update tbl_company set password='$newpass_hash' where id='1'";
            $run = mysqli_query($con, $sql);
            if ($run == TRUE) {
                header("Location: ../../settings.php?success=Password Changed Successfully!");
            } else {
                header("Location: ../../settings.php?error=Failed to Change Password!");
            }
        } else {
            header("Location: ../../settings.php?error=New Passwords Not Match!");
        }
    } else {
        header("Location: ../../settings.php?error=Old Password Is Incorrect!");
    }
}

if (isset($_POST["delete_contact"])) {
    $id = $_POST["id"];
    $sql = "delete from tbl_contact where id='$id'";
    $run = mysqli_query($con, $sql);
    if ($run === TRUE) {
        header("Location: ../../contact.php?success=contact deleted successfully");
    } else {
        header("Location: ../../contact.php?error=Failed to delete contact!");
    }
}

if (isset($_POST["delete_enquiry"])) {
    $id = $_POST["id"];
    $sql = "delete from tbl_enquiries where id='$id'";
    $run = mysqli_query($con, $sql);
    if ($run === TRUE) {
        header("Location: ../../enquiries.php?success=Enquiry deleted successfully");
    } else {
        header("Location: ../../enquiries.php?error=Failed to delete enquiry!");
    }
}


if (isset($_POST["delete_project_enquiry"])) {
    $id = $_POST["id"];
    $sql = "delete from tbl_project_enquiry where id='$id'";
    $run = mysqli_query($con, $sql);
    if ($run === TRUE) {
        header("Location: ../../project_enquiry.php?success=Enquiry deleted successfully");
    } else {
        header("Location: ../../project_enquiry.php?error=Failed to delete enquiry!");
    }
}


function deleteDirectory($dir)
{
    if (!file_exists($dir)) {
        return false;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }
    $files = array_diff(scandir($dir), array('.', '..'));
    foreach ($files as $file) {
        $filePath = "$dir/$file";
        (is_dir($filePath)) ? deleteDirectory($filePath) : unlink($filePath);
    }

    return rmdir($dir);
}





if (isset($_POST['add_team'])) {
    $name = mysqli_real_escape_string($con,$_POST['name']);
    $alt = mysqli_real_escape_string($con,$_POST['alt']);
    $designation = mysqli_real_escape_string($con,$_POST['designation']);
    $timg = $_FILES['img']['name'];
    $timg_temp = $_FILES['img']['tmp_name'];
    $sql = "insert into tbl_team (name,designation,img,img_alt) values('$name','$designation','$timg','$alt')";
    $run = mysqli_query($con, $sql);
    $id = mysqli_insert_id($con);
    if ($run) {
      if (!file_exists("../../../assets/img/team/" . $id)) {
        mkdir("../../../assets/img/team/" . $id, 0777, true);
      }
      $to = "../../../assets/img/team/" . $id . '/' . $timg;
      compress($timg_temp, $to, 50);
      header("Location: ../../team.php?success=Team Added Successfully");
    }
    else{
      header("Location: ../../team.php?error=Failed To Add Team");
    }
  }
  
  if (isset($_POST['edit_team'])){
    $id = $_POST['id'];
    $name = mysqli_real_escape_string($con,$_POST['name']);
    $alt = mysqli_real_escape_string($con,$_POST['alt']);
    $designation = mysqli_real_escape_string($con,$_POST['designation']);
    $img = "";
    if ($_FILES['img']['size']!= 0){
      $img = $_FILES['img']['name'];
      $tmp_name = $_FILES["img"]["tmp_name"];
  
      $to = "../../../assets/img/team/" . $id . '/' . $img;
  
      move_uploaded_file($tmp_name, $to);
    }else{
      $img = $_POST["old_img"];
    }
    $sql = "update tbl_team set name='$name',designation='$designation',img='$img',img_alt='$alt' where id='$id'";
    $run = mysqli_query($con,$sql);
    if ($run){
      header("Location: ../../team.php?success=Team Updated Successfully");
    }
    else{
      header("Location: ../../team.php?error=Failed To Update Team");
  }
  }
  
  if (isset($_POST['delete_team'])){
    $id = $_POST['id'];
    $sql = "delete from tbl_team where id='$id'";
    $run = mysqli_query($con,$sql);
    if ($run){
      header("Location: ../../team.php?success=Team Deleted Successfully");
    }
    else{
      header("Location: ../../team.php?error=Failed To Delete Team");
  }
  }

  if (isset($_POST['add_clients'])) {
    $img = $_FILES["images"]["name"];
    $tmp_name = $_FILES["images"]["tmp_name"];
    $alt = $_POST["alt"];
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    $sl = 0;

    while ($sl < count($img)) {
        $image = mysqli_real_escape_string($con, basename($img[$sl]));
        $imageType = $_FILES['images']['type'][$sl];
        $imageError = $_FILES['images']['error'][$sl];

        if (!in_array($imageType, $allowedTypes) || $imageError !== UPLOAD_ERR_OK) {
            echo "Error or unsupported file type for image: $image";
            $sl++;
            continue; 
        }

        $psql = "INSERT INTO tbl_clients(img, img_alt) VALUES('$image', '" . mysqli_real_escape_string($con, $alt[$sl]) . "')";
        
        if (mysqli_query($con, $psql)) {
            $pid = mysqli_insert_id($con); 
            $clients_img_dir = "../../../assets/img/clients/" . $pid; 
            
            if (!file_exists($clients_img_dir)) {
                mkdir($clients_img_dir, 0755, true);
            }

            if (move_uploaded_file($tmp_name[$sl], $clients_img_dir . "/" . $image)) {
                compress($clients_img_dir . "/" . $image, $clients_img_dir . "/" . $image, 50);
            } else {
                echo "Failed to move uploaded file: $image";
            }
        } else {
            echo "Failed to insert image into database: " . mysqli_error($con);
        }

        $sl++;
    }

    header("Location: ../../clients.php?success=Clients Added Successfully");
    exit();
}


if (isset($_POST['update_client'])) {
    $id = $_POST['id'];
    $m_img = "";
    $old_img = $_POST["old_img"];
    $alt = $_POST['alt']; 

    if ($_FILES['img']['size'] != 0) {
        $m_img = $_FILES["img"]["name"];
        $tmp_name = $_FILES["img"]["tmp_name"];
        $clients_img_dir = "../../../assets/img/clients/" . $id;

        if (!file_exists($clients_img_dir)) {
            mkdir($clients_img_dir, 0777, true);
        }

        $to = $clients_img_dir . "/" . $m_img;

        if (!empty($old_img) && file_exists($clients_img_dir . "/" . $old_img)) {
            unlink($clients_img_dir . "/" . $old_img);
        }

        move_uploaded_file($tmp_name, $to);
    } else {
        $m_img = $old_img;
    }

    $sql = "UPDATE tbl_clients SET img='$m_img', img_alt='$alt' WHERE id='$id'";
    $run = mysqli_query($con, $sql);

    if ($run === TRUE) {
        header("Location: ../../clients.php?success=Client updated successfully");
    } else {
        header("Location: ../../clients.php?error=Failed to update client!");
    }
    exit(); 
}


if (isset($_POST['delete_client'])) {
    $id = $_POST['id'];

    $sql = "SELECT img FROM tbl_clients WHERE id='$id'";
    $run = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($run);
    $image = $row['img'];

    $clients_img_dir = "../../../assets/img/clients/" . $id;

    if (!empty($image) && file_exists($clients_img_dir . "/" . $image)) {
        unlink($clients_img_dir . "/" . $image); 
    }

    if (file_exists($clients_img_dir)) {
        rmdir($clients_img_dir); 
    }

    $sql = "DELETE FROM tbl_clients WHERE id='$id'";
    $run = mysqli_query($con, $sql);

    if ($run === TRUE) {
        header("Location: ../../clients.php?success=Client deleted successfully");
    } else {
        header("Location: ../../clients.php?error=Failed to delete client!");
    }
    exit();
}



if (isset($_POST['multi_contact_delete']) && !empty($_POST['selected'])) {

    $selected = $_POST['selected'];

    foreach ($selected as $id) {
        $id = (int)$id;

        $sql = "DELETE FROM tbl_contact WHERE id = $id";
        mysqli_query($con, $sql);
    }

    echo json_encode([
        'status' => 'success',
        'message' => 'Contacts deleted successfully'
    ]);
    exit;
}

echo json_encode([
    'status' => 'error',
    'message' => 'Invalid request'
]);



