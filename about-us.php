<?php
define('IN_APP', 1);

ob_start();
session_start();

require_once 'globals.include.php';

?>
<!DOCTYPE html>
<html>

<head>
    <title>About Us</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php include 'navbar.include.php'; ?>
    <div class="container">
    <div class="m-5 p-5">
        <h1 class="text-center text-primary fw-bold">About Us</h1>
    </div>
</div>
<div class="container">
    <p class="fs-4">
        iParcel was established in 2023 with the goal of becoming the leading online and in-person mailing company. iParcel strives to provide 
        <span class="fw-bold text-primary">reliable and cost-effective</span> shipping services to both businesses and individuals. iParcel offers 
        <span class="text-primary">domestic, international, and express</span> shipping. Consumers can easily 
        find <span class="fw-bold text-primary">quotes, track, and manage</span> their packages from anywhere at any time through iParcel's intuitive online platform.
    </p> 
    <p class="fs-5">
        iParcel continues to work with partners inside the shipping industry to provide better service for their users. <a href="/support">Contact Us.</a>
    </p>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>