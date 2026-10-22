
<?php
        
       
        include('assets/includes/db.php');

        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');
        error_reporting(E_ALL);



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


<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <meta name="description"
        content="<?php echo $meta_desc ?>" />
    <meta name="keywords"
        content="<?php echo $keywords ?>" />
    <meta name="author" content="Platinum Interiors LLC" />
    <meta property="og:url" content="https://platinumemirate.com" />
    <meta property="og:description"
        content="<?php echo $meta_desc ?>" />
        
    <meta property="og:title" content="Platinum Interiors LLC" />
    <meta property="og:description" content="<?php echo $meta_desc ?>" />
    <meta property="og:url" content="https://platinumemirate.com" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://platinumemirate.com/assets/img/Web_Cover_Platinum.jpg" />

        <link rel="icon" type="image/png" href="https://platinumemirate.com/assets/favicon/favicon-48x48.png" sizes="48x48" />
        <link rel="icon" type="image/svg+xml" href="https://platinumemirate.com/assets/favicon/favicon.svg" />
        <link rel="shortcut icon" href="https://platinumemirate.com/assets/favicon/favicon.ico" />
        <link rel="apple-touch-icon" sizes="180x180" href="https://platinumemirate.com/assets/favicon/apple-touch-icon.png" />
        <meta name="apple-mobile-web-app-title" content="Platinum" />
        <link rel="manifest" href="https://platinumemirate.com/assets/favicon/site.webmanifest" />
        
        <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-6DVPP2S562"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-6DVPP2S562');
</script>



<link rel="stylesheet" href="https://platinumemirate.com/assets/css/style.css?v=14.7" />
    <link rel="stylesheet" href="https://platinumemirate.com/assets/css/slick-theme.css" />
    <link rel="stylesheet" href="https://platinumemirate.com/assets/css/slick.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Amita:wght@400;700&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Space+Grotesk:wght@300..700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
        integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/css/lightgallery.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/css/lg-zoom.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/justifiedGallery@3.8.1/dist/css/justifiedGallery.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.0.0-beta.3/css/lg-thumbnail.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
     <script src="https://www.google.com/recaptcha/api.js"></script>
    <style>

    </style>
    
    
    
    
    
    
    
    