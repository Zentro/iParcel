<?php
define('APP_RUNNING', 1);
define('APP_ESS_EMPLOYEES', 1);

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
$user = $stmt->fetch();

// Get employees
$stmt = $dbConn->prepare("SELECT 
u.user_id, u.name, e.employee_ssn,
ed.name as department_name
FROM users AS u, employees AS e
JOIN employee_departments AS ed ON e.employee_dep_id = ed.employee_dep_id
WHERE u.user_id = e.user_id ");
$stmt->execute();
$employees = $stmt->fetchAll();

$success = "";
if (isset($_GET["success"])) {
    $success = $_GET["success"];
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
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Employees</h1>
                </div>
                <?php if ($success == "false") : ?>
                    <div class="alert alert-danger" role="alert">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        Your changes could not be saved.
                    </div>
                <?php endif; ?>
                <?php if ($success == "true") : ?>
                    <div class="alert alert-success" role="alert">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        Your changes were saved.
                    </div>
                <?php endif; ?>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Employee ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Department</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($employees as $employee) : ?>
                            <tr>
                                <th scope="row"><a href="editemployee.php?employee_ssn=<?= $employee["employee_ssn"]; ?>"><?= $employee["employee_ssn"]; ?></a></th>
                                <td><?= $employee["name"]; ?></td>
                                <td><?= $employee["department_name"]; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <a href="addemployee.php" class="btn btn-dark"><i class="bi bi-person-plus"></i> Add employee</a>
                <footer class="pt-5 d-flex justify-content-between">
                    <span>Copyright © 2023 iParcel</span>
                </footer>
            </main>
        </div>
    </div>
</body>

</html>