<?php
define('APP_RUNNING', 1);

ob_start();
session_start();

if (!isset($_SESSION["employee"])) {
    header("Location: ess-login.php");
}

if (empty($_GET["employee_ssn"])) {
    header("Location: employees.php?success=false");
}

$employee_ssn = $_GET["employee_ssn"];

require_once '../globals.include.php';

// Get the user
$ssn = $_SESSION["employee"];
$stmt = $dbConn->prepare("SELECT users.*, employees.* FROM users, employees WHERE users.user_id = employees.user_id AND employees.employee_ssn = :ssn");
$stmt->bindParam(":ssn", $ssn);
$stmt->execute();
$user = $stmt->fetch();

// Get employee
$stmt = $dbConn->prepare("SELECT users.*, employees.* FROM users, employees WHERE users.user_id = employees.user_id AND employees.employee_ssn = :ssn");
$stmt->bindParam(":ssn", $employee_ssn);
$stmt->execute();
$employee = $stmt->fetch();

// Get the departments
$stmt = $dbConn->prepare("SELECT * FROM employee_departments");
$stmt->execute();
$deps = $stmt->fetchAll();

$dep_id = $user["employee_dep_id"];

if (isset($_POST["save"])) {
    if (!empty($_POST["department"])) {
        $dep_id = (int)$_POST["department"];
    }
    $stmt = $dbConn->prepare("UPDATE employees SET employee_dep_id = :dep_id WHERE employee_ssn= :employee_ssn");
    $stmt->bindParam(":dep_id", $dep_id);
    $stmt->bindParam(":employee_ssn", $employee_ssn);
    $stmt->execute();
    header("Location: employees.php?success=true");
}

if (isset($_POST["delete"])) {
    $stmt = $dbConn->prepare("DELETE FROM employees WHERE employee_ssn =:ssn");
    $stmt->bindParam(":ssn", $employee_ssn);
    $stmt->execute();
    header("Location: employees.php?success=true");
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
            <div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary col-2">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-decoration-none">
                    <img src="../img/logo-white.svg" alt="Logo" width="150" class="d-inline-block align-text-top">
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link text-white">
                            <i class="bi bi-house"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="employees.php" class="nav-link text-white">
                            <i class="bi bi-person-badge"></i>
                            Employees
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="transactions.php" class="nav-link text-white">
                            <i class="bi bi-currency-dollar"></i>
                            Transactions
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="parcels.php" class="nav-link text-white">
                            <i class="bi bi-box2"></i>
                            Logistics
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="customers.php" class="nav-link text-white active" aria-current="page">
                            <i class="bi bi-person-gear"></i>
                            Customers
                        </a>
                    </li>
                </ul>
                <hr>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <strong><?= $user["name"]; ?></strong>
                    </a>
                    <ul class="dropdown-menu text-small">
                        <li><a class="dropdown-item" href="ess-logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
            <main class="col px-md-4 py-4" style="height: 100vh">
                <h4><a href="employees.php"><i class="bi bi-arrow-left"></i> Go back</a></h4>
                <form action="editemployee.php?employee_ssn=<?= $employee_ssn; ?>" method="post">
                    <h4 class="mb-3">Adjust or make changes, click <strong>Go back</strong> to abort any changes</h4>
                    <div class="mb-3">
                        <div class="mb-3">
                            <label for="method" class="form-label">Departments</label>
                            <select class="form-select" id="department" name="department" aria-label="Default select example">
                                <option selected>Choose...</option>
                                <?php foreach ($deps as $dep) : ?>
                                    <option value="<?= $dep["employee_dep_id"]; ?>"><?= $dep["name"]; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <hr class="my-4">
                    <button type="submit" name="save" class="mb-3 btn btn-lg btn-primary">Save changes</button>
                    <button type="submit" name="delete" class="mb-3 btn btn-lg btn-danger">Remove employee</button>
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