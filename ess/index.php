<?php
define('APP_RUNNING', 1);
define('APP_ESS_INDEX', 1);

ob_start();
session_start();

if (!isset($_SESSION["employee"])) {
    header("Location: ess-login.php");
}

require_once '../globals.include.php';

// Get # of customers
$stmt = $dbConn->prepare("SELECT COUNT(*) FROM users");
$stmt->execute();
$customer_count = $stmt->fetchColumn();

// Get total of revenue
$stmt = $dbConn->prepare("SELECT SUM(total) FROM transactions");
$stmt->execute();
$revenue_sum = $stmt->fetchColumn();

// Get purchases
$stmt = $dbConn->prepare("SELECT COUNT(*) FROM transactions");
$stmt->execute();
$purchase_count = $stmt->fetchColumn();

// Get # of packages
$stmt = $dbConn->prepare("SELECT COUNT(*) FROM parcels");
$stmt->execute();
$parcel_count = $stmt->fetchColumn();

// Get the user
$ssn = $_SESSION["employee"];
$stmt = $dbConn->prepare("SELECT users.*, employees.* FROM users, employees WHERE users.user_id = employees.user_id AND employees.employee_ssn = :ssn");
$stmt->bindParam(":ssn", $ssn);
$stmt->execute();
$user = $stmt->fetch();

?>
<html data-bs-theme="dark">
<html>

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
                    <h1 class="h2">Welcome back, <?= $user["name"]; ?></h1>
                </div>
                <div class="row my-4">
                    <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0">
                        <div class="card">
                            <h5 class="card-header">Customers</h5>
                            <div class="card-body">
                                <h5 class="card-title"><?= $customer_count; ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
                        <div class="card">
                            <h5 class="card-header">Revenue</h5>
                            <div class="card-body">
                                <h5 class="card-title">$<?= $revenue_sum; ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
                        <div class="card">
                            <h5 class="card-header">Purchases</h5>
                            <div class="card-body">
                                <h5 class="card-title"><?= $purchase_count; ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
                        <div class="card">
                            <h5 class="card-header">Parcels</h5>
                            <div class="card-body">
                                <h5 class="card-title"><?= $parcel_count; ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="pt-5 d-flex justify-content-between">
                    <span>© iParcel 2023</span>
                </footer>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
    <script>
        new Chartist.Line('#traffic-chart', {
            labels: ['Jan', 'Feb', 'March', 'April', 'May', 'June'],
            series: [
                [2000, 2500, 1900, 3400, 5600, 6400]
            ]
        }, {
            low: 0,
            showArea: true
        });
        new Chartist.Line('#traffic-chart2', {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 5'],
            series: [
                [20, 40, 35, 42, 29, 38]
            ]
        }, {
            low: 0,
            showArea: true
        });
    </script>
</body>

</html>