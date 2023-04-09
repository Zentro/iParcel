<?php
define('IN_APP', 1);

ob_start();
session_start();

require_once '../globals.include.php';

if (isset($_SESSION["employee"])) {
    header("Location: index.php");
}

$errors = [];
if (isset($_POST["submit"])) {
    $ssn = $_POST["ssn"];
    $password = $_POST["password"];
    $stmt = $dbConn->prepare("SELECT users.*, employees.employee_ssn FROM users, employees WHERE users.user_id = employees.user_id AND employees.employee_ssn = :ssn");
    $stmt->bindParam(":ssn", $ssn);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch();
        if (!password_verify($password, $user["password"])) {
            array_push($errors, "That password doesn't work for this account. Enter a different account or try a different password.");
        } else {
            header("Location: index.php");
            $_SESSION["employee"] = $user["user_id"];
        }
    } else {
        array_push($errors, "That SSN doesn't exist for this account. Enter a different SSN or try a different password.");
    }
}
?>
<!DOCTYPE html>
<html data-bs-theme="dark">

<head>
    <title>Employee Self-Service Login - iParcel</title>
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
    <div class="vh-100 d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-4">
                    <div class="py-4 text-center">
                        <a href="/"><img src="../img/logo-white.svg" alt="iParcel" width="200"></a>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-info" role="alert">
                                <i class="bi bi-shield-lock-fill"></i>
                                Please be advised that for security purposes, your IP address (<?= getip(); ?>) is being logged. We assure you that this information will remain confidential and will only be used to prevent unauthorized access to our systems.
                            </div>
                            <?php foreach ($errors as $error) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <i class="bi bi-exclamation-triangle-fill"></i>
                                    <?= $error; ?>
                                </div>
                            <?php endforeach; ?>
                            <form action="ess-login.php" method="post">
                                <div class="mb-3">
                                    <label for="ssn">SSN</label>
                                    <input type="text" class="form-control" name="ssn">
                                </div>
                                <div class="mb-3">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password">
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Remember me</label>
                                </div>
                                <div class="mb-3">
                                    <a href="../index.php"><i class="bi bi-arrow-left"></i> Go back to main site</a>
                                </div>
                                <button type="submit" name="submit" class="mb-3 w-100 btn btn-lg btn-primary">Login</button>
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