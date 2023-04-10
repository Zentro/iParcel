<?php
define('APP_RUNNING', 1);

ob_start();
session_start();

require_once 'globals.include.php';

if (isset($_SESSION["user"])) {
    header("Location: /dashboard");
}

$errors = [];

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    // emails must be unique, last ditch effort before SQL unique key
    $stmt = $dbConn->prepare("SELECT email FROM users WHERE email =:email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    if ($stmt->rowCount() == 0) {

        $password = $_POST["password"];
        $repeat_password = $_POST["repeat_password"];
        $phone = $_POST["phone"];
        if ($password != $repeat_password) {
            array_push($errors, "Your passwords don't match. They must match.");
        } else {
            $user_id = guidv4();
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $dbConn->prepare("INSERT INTO users 
        (user_id, name, email, password, phone, user_group_id, user_group_role_id, email_confirmed) 
        VALUES (:user_id,:name,:email,:password,:phone,0,0,0)");
            $stmt->bindParam(":user_id", $user_id);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $password_hash);
            $stmt->bindParam(":phone", $phone);
            $stmt->execute();
            header("Location: /login?success=true");
        }
    } else {
        array_push($errors, "That account already exists with that email. Please use a different email or login to that account.");
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Register - iParcel</title>
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
                            <?php foreach ($errors as $error) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <i class="bi bi-exclamation-triangle-fill"></i>
                                    <?= $error; ?>
                                </div>
                            <?php endforeach; ?>
                            <form action="/register" method="post">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                                <div class="mb-3">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                                <div class="mb-3">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                                <div class="mb-3">
                                    <label for="repeat_password">Repeat password</label>
                                    <input type="password" class="form-control" name="repeat_password">
                                </div>
                                <div class="mb-3">
                                    <label for="phone">Phone number</label>
                                    <input type="text" class="form-control" name="phone">
                                </div>
                                <button type="submit" name="submit" class="mb-3 w-100 btn btn-lg btn-primary">Register</button>
                                <div class="mb-3">
                                    <a href="/login">Login</a>
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