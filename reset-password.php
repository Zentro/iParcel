<?php
define('APP_RUNNING', 1);

ob_start();
session_start();

require_once 'globals.include.php';

if (isset($_SESSION["user"])) {
    header("Location: dashboard.php");
}

$errors = [];

$success = "";

if (isset($_GET["success"])) {
    $success = "Your account has been created. An email with an activation link has been sent to you.";
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Reset my password - iParcel</title>
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
    <div class="vh-100 d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-4">
                    <div class="py-4 text-center">
                        <img src="img/logo.svg" alt="iParcel" width="200">
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-success" role="alert">
                                <i class="bi bi-check-circle-fill"></i>
                                An email with a link to reset your password has been sent to the email you provided. It will expire in 30 minutes.
                            </div>
                            <form action="/password-reset" method="post" enctype="application/x-www-form-urlencoded">
                                <div class="mb-3">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                                <button type="submit" class="mb-3 w-100 btn btn-lg btn-primary">Send password reset link</button>
                                <div class="mb-3">
                                    <a href="/login.php">Login</a>
                                    <a href="/newaccount.php">Register</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="py-4 text-center">
                        © iParcel 2023
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>