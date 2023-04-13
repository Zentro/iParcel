<?php
define('APP_RUNNING', 1);

ob_start();
session_start();

require_once 'globals.include.php';

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
}

$user_id = $_SESSION["user"];

$stmt = $dbConn->prepare("SELECT name,email,phone,email_confirmed FROM users WHERE user_id= :user_id");
$stmt->bindParam(":user_id", $user_id);
$stmt->execute();
$user = $stmt->fetch();

$name = $user["name"];
$email = $user["email"];
$phone = $user["phone"];
$ec = $user["email_confirmed"];

$errors = [];

if (isset($_POST["save"])) {
    if ($ec == 0) {
        array_push($errors, "Your email hasn't been confirmed yet. You can't make any changes to your account until your email has been confirmed.");
    } else {
        if (!empty($_POST["name"])) {
            $name = $_POST["name"];
        }
        if (!empty($_POST["phone"])) {
            $phone = $_POST["phone"];
        }
        $stmt = $dbConn->prepare("UPDATE users SET name = :name, phone = :phone WHERE user_id= :user_id");
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        header("Location: profile.php?success=true");
    }
}

$success = "";

if (isset($_GET["success"])) {
    $success = "Your changes have been saved.";
}
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
            <form action="profile.php" method="post">
                <h4 class="mb-3">Change your account settings</h4>
                <div class="mb-3">
                    <div class="mb-3">
                        <label for="first_name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="<?= $name; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" name="email" placeholder="<?= $email; ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="phone">Phone number</label>
                        <input type="text" class="form-control" name="phone" placeholder="<?= $phone; ?>">
                    </div>
                </div>
                <hr class="my-4">
                <button type="submit" name="save" class="mb-3 btn btn-lg btn-primary">Save changes</button>
                <button type="button" class="mb-3 btn btn-lg btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Delete my account</button>
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header border-bottom-0">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Account deletion confirmation</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body py-0">
                                <p>Are you sure you want to delete your account? You cannot recover your account once it has been deleted. All information associated with your account will be anonyomized.</p>
                            </div>
                            <div class="modal-footer flex-column align-items-stretch w-100 gap-2 pb-3 border-top-0">
                                <button type="button" class="btn btn-lg btn-danger" data-bs-dismiss="modal">I understand</button>
                                <button type="button" formmethod="delete" formaction="/settings" class="btn btn-lg btn-secondary">I change my mind</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php include 'footer.include.php'; ?>
</body>

</html>