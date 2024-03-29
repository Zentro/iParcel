<?php
define('APP_RUNNING', 1);

ob_start();
session_start();

require_once 'globals.include.php';

?>
<!DOCTYPE html>
<html>

<head>
    <title>Tracking</title>
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
    <div class="container py-5 h-100">
        <div class="row">
            <div class="col">
                <h1>Track Your Package</h1>
                <form action="viewtrucking.php" method="POST">
                    <div class="mb-3">
                        <label for="tracking-number" class="form-label">Enter Tracking Number:</label>
                        <input type="text" class="form-control" id="tracking-number" name="tracknum" placeholder="XXXXXXXXXXXXXXXX">
                    </div>
                    <button type="submit" class="btn btn-primary">Track</button>
                </form>
            </div>
            <div class="col">
                <img src="img/shipping-stock-photo.jpg" class="rounded-3 shadow-lg" >
            </div>
        </div>
    </div>
    <?php include 'footer.include.php'; ?>
</body>

</html>