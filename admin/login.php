<?php
session_start();
date_default_timezone_set('Asia/Kolkata'); // Ensure timezone matches backend
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
if (isset($_SESSION["habrix_admin_loggedin"])) {
    header("Location: index.php");
    exit();
}
// Calculate remaining time based on the timestamp in the URL
$remaining = 0;
if (isset($_GET['unlock_time'])) {
    $unlockTime = (int)$_GET['unlock_time'];
    $currentTime = time();
    $remaining = max(0, $unlockTime - $currentTime);
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="https://platinumemirate.com/assets/favicon/favicon-48x48.png" sizes="48x48" />
    <link rel="icon" type="image/svg+xml" href="https://platinumemirate.com/assets/favicon/favicon.svg" />
    <link rel="shortcut icon" href="https://platinumemirate.com/assets/favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="https://platinumemirate.com/assets/favicon/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="Platinum" />
    <link rel="manifest" href="https://platinumemirate.com/assets/favicon/site.webmanifest" />
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css?v=1">
    <title>Login | Platinum Interiors LLC</title>
</head>

<body>
    <section class="login-page">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6 login-bg" style="background-color: white;">
                    <img src="assets/images/logo/logo.svg?v=2" class="img-fluid" width="350">
                </div>
                <div class="col-lg-6 d-flex justify-content-center align-items-center">
                    <form method="POST" class="w-75" action="assets/functions/functions.php">
                        <h4>Admin Login</h4>
                        <p>Hey, enter your credential to sign in to your account</p>
                        
                        <?php
                        if (isset($_GET["error"])) {
                        ?>
                            <div class="alert alert-danger text-center" role="alert">
                                <?php
                                $error = $_GET["error"];
                                echo strip_tags($error);
                                ?>
                            </div>
                        <?php
                        }
                        ?>


                        <div class="mb-3">
                            <i class="bi bi-lock"></i>
                            <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="Enter username" required>
                        </div>
                        <div class="mb-3">
                            <i class="bi bi-key"></i>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                        </div>
                        <div class="text-center">
                            <input type="submit" name="login" value="LOGIN" class="btn w-100 login">
                        </div>

                        <?php if ($remaining > 0): ?>
                            <div class="alert alert-warning text-center mt-3" id="timerAlert" role="alert">
                                Too many attempts. Please wait <span id="countdown" style="font-weight:bold;"><?php echo $remaining; ?></span> seconds.
                            </div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<?php
if ($remaining > 0) {
?>
<script>
document.addEventListener("DOMContentLoaded", function() {
    let countdown = <?php echo $remaining; ?>;
    const countdownEl = document.getElementById('countdown');
    const loginBtn = document.querySelector('input[name="login"]');
    
    // Disable immediately
    if (loginBtn) {
        loginBtn.disabled = true;
        loginBtn.value = "Please Wait " + countdown + "s";
    }
    const timerInterval = setInterval(() => {
        countdown--;
        
        // Update UI
        if (countdownEl) countdownEl.textContent = countdown;
        if (loginBtn) loginBtn.value = "Please Wait " + countdown + "s";
        // Enable when finished
        if (countdown <= 0) {
            clearInterval(timerInterval);
            if (loginBtn) {
                loginBtn.disabled = false;
                loginBtn.value = "LOGIN";
            }
        }
    }, 1000);
});
</script>
<?php
}
?>

</body>
</html>