<?php
define('IN_APP', 1);

ob_start();
session_start();

require_once 'globals.include.php';

?>
<!DOCTYPE html>
<html>

<head>
    <title>Contact Us</title>
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
    <div class="vh-100 d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-4">
                <div class="card shadow">
                <div class="card-body w-100">
                    <h2 class="card-title text-center fw-bold text-primary">Contact Us</h5>
                    <form class="card-body" action="#" method="post">
                    <div class="mb=3">
                    </div>
                    <label for="name">Name</label>
                    <input class="form-control mb-3" type="text" id="name" name="name" required>
                    <label for="email">Email</label>
                    <input class="form-control mb-3" type="email" id="email" name="email" required>
                    <label for="phone">Phone</label>
                    <input class="form-control mb-3" type="tel" id="phone" name="phone" required>
                    <label for="subject">Subject</label>
                    <input class="form-control  mb-3" type="text" id="subject" name="subject" required>
                    <label for="message">Message</label><br>
                    <textarea class="form-control mb-3" id="message" name="message" required></textarea>
                    <input class="form-control bg-primary text-white" type="submit" value="Submit">
                    </form>
                </div>
                </div>
        </div>
    </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>