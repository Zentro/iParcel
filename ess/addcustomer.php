<?php
define('APP_RUNNING', 1);
define('APP_ESS_CUSTOMERS', 1);

ob_start();
session_start();

if (!isset($_SESSION["employee"])) {
    header("Location: ess-login.php");
}

require_once '../globals.include.php';

// Get the user
$ssn = $_SESSION["employee"];
$stmt = $dbConn->prepare("SELECT users.*, employees.* FROM users, employees WHERE users.user_id = employees.user_id AND employees.employee_ssn = :ssn");
$stmt->bindParam(":ssn", $ssn);
$stmt->execute();
$user2 = $stmt->fetch();

$errors = [];

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $stmt = $dbConn->prepare("SELECT email FROM users WHERE email =:email");
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    if ($stmt->rowCount() == 0) {

        $password = $_POST["password"];
        $phone = $_POST["phone"];

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
        header("Location: customers.php?success=true");
    } else {
        array_push($errors, "That account already exists with that email. Please use a different email.");
    }
}

if (isset($_POST["delete"])) {
}
?>
<!DOCTYPE html>
<html data-bs-theme="dark">

<head>
    <title>Employee Self-Service - iParcel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.include.php'; ?>
            <main class="col px-md-4 py-4" style="height: 100vh">
                <h4><a href="customers.php"><i class="bi bi-arrow-left"></i> Go back</a></h4>
                <?php foreach ($errors as $error) : ?>
                    <div class="alert alert-danger" role="alert">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        <?= $error; ?>
                    </div>
                <?php endforeach; ?>
                <form action="addcustomer.php" method="post">
                    <h4 class="mb-3">Create an account, click <strong>Go back</strong> to abort any changes</h4>
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
                        <label for="phone">Phone number</label>
                        <input type="text" class="form-control" name="phone">
                    </div>
                    <hr class="my-4">
                    <button type="submit" name="submit" class="mb-3 btn btn-lg btn-primary">Create</button>
                </form>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
                <footer class="pt-5 d-flex justify-content-between">
                    <span>Copyright © 2023 iParcel</span>
                </footer>
            </main>
        </div>
    </div>
</body>

</html>