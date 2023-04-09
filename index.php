<?php
define('IN_APP', 1);

ob_start();
session_start();

require_once 'globals.include.php';

?>
<!DOCTYPE html>
<html>

<head>
    <title>iParcel</title>
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
    <div class="px-4 py-5 my-5">
        <div class="container">
            <?php include 'confirm-email.include.php'; ?>
            <h2 class="display-4 fw-bold text-center">Ship, Manage, Track, Deliver</h2>
            <p class="fs-4 text-center">All in one place. You'll be able to find shipping quotes and track your packages with our user-friendly
                platform all from the comfort of your home. Our online post office portal strives to process your important
                packages all while making your mailing experience hassle-free!
            </p>
        </div>
        <div class="fs-4 text-center fw-bold mt-5">
            3 Easy Steps To Printing Your Shipping Label
        </div>
        <div class="container mt-5">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card shadow h-100">
                        <h1 class="text-center fw-bold mt-4">1</h1>
                        <div class="card-body">
                            <h5 class="card-title text-center fw-bold text-primary">Sign Up and Login</h5>
                            <p class="card-text">There is no fee to use iParcel. Just register an account with us to start the shipping process.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card shadow h-100">
                        <h1 class="text-center fw-bold mt-4">2</h1>
                        <div class="card-body">
                            <h5 class="card-title text-center fw-bold text-primary">Enter Shipping Information</h5>
                            <p class="card-text">Enter your package information for our best possible quote and select some our wide range of shipping options.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card shadow h-100">
                        <h1 class="text-center fw-bold mt-4">3</h1>
                        <div class="card-body">
                            <h5 class="card-title text-center fw-bold text-primary">Print and Ship</h5>
                            <p class="card-text">Use a label printer or a home printer to print your label to attach to the box. Drop off your package and you're done.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="d-flex justify-content-center">
                <a href="newaccount.php">
                    <button class="btn btn-primary">Register Now!</button>
                </a>
            </div>
        </div>


    </div>
    <?php include 'footer.include.php'; ?>
</body>

</html>