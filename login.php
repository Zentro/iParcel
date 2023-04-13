<?php
define('APP_RUNNING', 1);

ob_start();
session_start();

require_once './globals.include.php';
require_once APP_DIR . '/inc/class_loginhandler.php';

$loginHandler = new loginHandler($dbConn);

if (isset($_SESSION["user"])) {
    header("Location: /dashboard");
}

$errors = [];

if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $stmt = $dbConn->prepare("SELECT user_id,email,password FROM users WHERE email= :email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch();
        if (!password_verify($password, $user["password"])) {
            array_push($errors, "That password doesn't work for this account. Enter a different account or try a different password.");
        } else {
            header("Location: /dashboard");
            $_SESSION["user"] = $user["user_id"];
        }
    } else {
        array_push($errors, "That account doesn't exist. Enter a different account or try a different password.");
    }
}

$success = "";

if (isset($_GET["success"])) {
    $success = "Your account has been created. An email with an activation link has been sent to you.";
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login - iParcel</title>
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
                        <a href="/"><img src="img/logo.svg" alt="iParcel" width="200"></a>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <?php if (!empty($success)) : ?>
                                <div class="alert alert-success" role="alert">
                                    <i class="bi bi-exclamation-triangle-fill"></i>
                                    <?= $success; ?>
                                </div>
                            <?php endif; ?>
                            <?php foreach ($errors as $error) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <i class="bi bi-exclamation-triangle-fill"></i>
                                    <?= $error; ?>
                                </div>
                            <?php endforeach; ?>
                            <form action="/login" method="post">
                                <div class="mb-3">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                                <div class="mb-3">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Remember me</label>
                                </div>
                                <button type="submit" name="submit" class="mb-3 w-100 btn btn-lg btn-primary">Login</button>
                                <div class="mb-3">
                                    <a href="/reset-password">Reset my password</a>
                                    <a href="/register">Register</a>
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